<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AContactController extends Controller
{
    // Menampilkan halaman utama dengan tabel
    public function index()
    {
        return view('admin.contact');
    }

    // Mengambil data contact untuk DataTable
    public function getContacts(Request $request)
    {
        $contacts = Contact::query();

        return DataTables::of($contacts)
            ->addColumn('action', function ($contact) {
                return [
                    'edit_url' => route('admin.contact.edit', $contact->id),
                    'delete_id' => $contact->id,
                ];
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // Menampilkan form untuk menambah contact
    public function create()
    {
        return view('admin.contact.create');
    }

    // Menyimpan contact baru
    public function store(Request $request)
    {
        $request->validate([
            'sosmed' => 'required|string|max:255',  // Validasi untuk nama sosial media
            'name' => 'required|string|max:255',    // Validasi untuk nama pengguna
            'link' => 'nullable|url',               // Validasi untuk URL
            'issued_at' => 'nullable|date',        // Validasi untuk tanggal
        ]);

        Contact::create([
            'sosmed' => $request->sosmed,
            'name' => $request->name,
            'link' => $request->link,
            'issued_at' => $request->issued_at,
        ]);

        return redirect()->route('admin.contact')->with('success', 'Kontak berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit contact
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contact.edit', compact('contact'));
    }

    // Mengupdate data contact
    public function update(Request $request, $id)
    {
        $request->validate([
            'sosmed' => 'required|string|max:255',  // Validasi untuk nama sosial media
            'name' => 'required|string|max:255',    // Validasi untuk nama pengguna
            'link' => 'nullable|url',               // Validasi untuk URL
            'issued_at' => 'nullable|date',        // Validasi untuk tanggal
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update([
            'sosmed' => $request->sosmed,
            'name' => $request->name,
            'link' => $request->link,
            'issued_at' => $request->issued_at,
        ]);

        return redirect()->route('admin.contact')->with('success', 'Kontak berhasil diperbarui');
    }

    // Menghapus contact
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $contact->delete();
        return response()->json(['success' => 'Kontak berhasil dihapus']);
    }
}
