<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class AProjectsController extends Controller
{
    // Menampilkan halaman utama dengan tabel
    public function index()
    {
        // Menampilkan tampilan untuk daftar project
        return view('admin.project');
    }

    // Mengambil data project untuk DataTable
    public function getProjects(Request $request)
    {
        $projects = Project::query();

        return DataTables::of($projects)
            ->addColumn('action', function ($project) {
                return [
                    'edit_url' => route('admin.project.edit', $project->id),
                    'delete_id' => $project->id,
                ];
            })
            ->rawColumns(['action']) // Kolom 'action' akan dirender di sisi client
            ->make(true);
    }

    // Menampilkan form untuk menambah project
    public function create()
    {
        return view('admin.project.create');
    }

    // Menyimpan project baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
            'issued_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store the image and get its path
            $imagePath = $request->file('image')->store('projects', 'public');
        }
    
        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'issued_at' => $request->issued_at,
            'image' => $imagePath, // Store the image path in the database
        ]);
    
        return redirect()->route('admin.project')->with('success', 'Project berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit project
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.project.edit', compact('project'));
    }

    // Mengupdate data project
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'required|url',
            'issued_at' => 'required|date',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Validasi gambar
        ]);
    
        $project = Project::findOrFail($id);

        // Cek apakah ada gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($project->image && Storage::exists('public/' . $project->image)) {
                Storage::delete('public/' . $project->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('projects', 'public');
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $imagePath = $project->image;
        }

        // Update data proyek
        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'issued_at' => $request->issued_at,
            'image' => $imagePath, // Simpan path gambar jika ada
        ]);
    
        return redirect()->route('admin.project')->with('success', 'Project berhasil diperbarui');
    }

    // Menghapus project
    public function destroy($id)
    {
        $project = Project::find($id);
        if (!$project) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Hapus gambar terkait jika ada
        if ($project->image && Storage::exists('public/' . $project->image)) {
            Storage::delete('public/' . $project->image);
        }

        $project->delete();
        return response()->json(['success' => 'Project berhasil dihapus']);
    }
}
