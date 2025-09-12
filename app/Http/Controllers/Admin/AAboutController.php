<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AAboutController extends Controller
{
    // Menampilkan halaman utama dengan tabel
    public function index()
    {
        return view('admin.about');
    }

    // Mengambil data about untuk DataTable
    public function getAbouts(Request $request)
    {
        $abouts = About::query();

        return DataTables::of($abouts)
            // Hapus bagian untuk menampilkan gambar
            ->addColumn('action', function ($about) {
                return [
                    'edit_url' => route('admin.about.edit', $about->id),
                    'delete_id' => $about->id,
                ];
            })
            ->rawColumns(['action']) // Kolom 'action' akan dirender di sisi client
            ->make(true);
    }

    // Menampilkan detail about
    public function show($id)
    {
        $about = About::findOrFail($id); // Mengambil data About berdasarkan ID
    
        return response()->json([
            'title' => $about->title,
            'description' => $about->description, // Mengambil data description
            // Tidak perlu mengirimkan data 'image' lagi
        ]);
    }

    // Menampilkan form untuk menambah about
    public function create()
    {
        return view('admin.about.create');
    }

    // Menyimpan about baru
    public function store(Request $request)
    {
        $request->validate([
            // Hapus validasi 'image' karena kolom image sudah tidak ada
            'title' => 'required|string|max:255',
            'description' => 'required|string', // Kolom description wajib diisi
        ]);

        About::create([
            'title' => $request->title,
            'description' => $request->description, // Menyimpan data description
        ]);

        return redirect()->route('admin.about')->with('success', 'About berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit about
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    // Mengupdate data about
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string', // Kolom description wajib diisi
        ]);
    
        $about = About::findOrFail($id);
    
        // Update tanpa menangani gambar
        $about->update([
            'title' => $request->title,
            'description' => $request->description, // Mengupdate data description
        ]);
    
        return redirect()->route('admin.about')->with('success', 'About berhasil diperbarui!');
    }

    // Menghapus about
    public function destroy($id)
    {
        $about = About::find($id);
        if (!$about) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $about->delete();
        return response()->json(['success' => 'About berhasil dihapus']);
    }
}
