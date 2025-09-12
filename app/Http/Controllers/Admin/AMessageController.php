<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AMessageController extends Controller
{
    // Menampilkan halaman utama dengan tabel
    public function index()
    {
        // Menampilkan tampilan untuk daftar pesan
        return view('admin.message');
    }

    // Mengambil data message untuk DataTable
    public function getMessage(Request $request) // Ganti getMessages menjadi getMessage
    {
        $messages = Message::query();

        return DataTables::of($messages)
        ->make(true);// Kolom 'action' akan dirender di sisi client
    }

    // Menampilkan form untuk menambah pesan
    public function create()
    {
        return view('admin.message.create'); // Ganti messages menjadi message
    }

    // Menyimpan pesan baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
    
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
    
        return redirect()->back()->with('success', 'Pesan mu telah terkirim!');// Ganti messages menjadi message
    }

    // Menampilkan form untuk mengedit pesan
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.message.edit', compact('message')); // Ganti messages menjadi message
    }

    // Mengupdate data pesan
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $message = Message::findOrFail($id);

        // Update data pesan
        $message->update([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->route('admin.message')->with('success', 'Pesan berhasil diperbarui'); // Ganti messages menjadi message
    }

    // Menghapus pesan
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return response()->json(['success' => 'Pesan berhasil dihapus']); // Ganti messages menjadi message
    }
}
