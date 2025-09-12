<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class AHomeController extends Controller
{
    /**
     * Menampilkan halaman utama Home.
     */
    public function index()
    {
        return view('admin.home');
    }

    /**
     * Menampilkan detail data Home.
     */
    public function show($id)
    {
        $home = Home::findOrFail($id);

        return response()->json([
            'name' => $home->name,
            'skills' => $home->skills,
            'description' => $home->description,
            'image' => $home->image ? asset('storage/' . $home->image) : null, // Path lengkap gambar
        ]);
    }

    /**
     * Mengambil data untuk DataTable.
     */
    public function data()
    {
        $homes = Home::query();

        return DataTables::of($homes)
            ->addColumn('image', function ($home) {
                // Menambahkan path untuk gambar yang disimpan di public/storage
                return asset('storage/' . $home->image);
            })
            ->addColumn('action', function ($home) {
                return [
                    'edit_url' => route('admin.home.edit', $home->id),
                    'delete_id' => $home->id,
                ];
            })
            ->rawColumns(['action']) // Kolom 'action' akan dirender di sisi client
            ->make(true);
    }

    /**
     * Menampilkan form untuk membuat data baru.
     */
    public function create()
    {
        return view('admin.home.create');
    }

    /**
     * Menyimpan data baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'skills' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Simpan gambar
        $imagePath = $request->file('image')->store('images', 'public');
    
        // Simpan data lainnya
        Home::create([
            'name' => $request->name,
            'description' => $request->description,
            'skills' => $request->skills,
            'image' => $imagePath, // Menyimpan path gambar
        ]);
    
        return redirect()->route('admin.home')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data.
     */
    public function edit($id)
    {
        $home = Home::findOrFail($id);
        return view('admin.home.edit', compact('home'));
    }

    /**
     * Memperbarui data di database.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'skills' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        $home = Home::findOrFail($id);

        // Perbarui gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($home->image) {
                Storage::disk('public')->delete($home->image);
            }
            $home->image = $request->file('image')->store('images/homes', 'public');
        }

        $home->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'skills' => $validated['skills'],
            'image' => $home->image,
        ]);

        return redirect()->route('admin.home')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy($id)
    {
        $home = Home::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($home->image) {
            Storage::disk('public')->delete($home->image);
        }

        $home->delete();

        return response()->json(['success' => 'Data berhasil dihapus!']);
    }
}
