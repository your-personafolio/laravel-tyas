<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class ACertificateController extends Controller
{
    public function index()
    {
        return view('admin.certificate', ['title' => 'Certificates']);
    }

    public function getData(Request $request)
    {
        $certificates = Certificate::select('id', 'name', 'issued_by', 'issued_at', 'description', 'file');

        return DataTables::of($certificates)
            ->addColumn('action', function ($certificate) {
                return [
                    'edit_url' => route('admin.certificate.edit', $certificate->id),
                    'delete_id' => $certificate->id,
                ];
            })
            ->rawColumns(['action']) // Kolom 'action' akan dirender di sisi client
            ->make(true);
    
    }


    public function create()
    {
        return view('admin.certificate.create', ['title' => 'Create Certificate']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issued_by' => 'required|string|max:255',
            'issued_at' => 'required|date',
            'description' => 'nullable|string',
            'file' => 'required|mimes:pdf', 
        ]);

        $certificate = new Certificate();
        $certificate->name = $request->input('name');
        $certificate->issued_by = $request->input('issued_by');
        $certificate->issued_at = $request->input('issued_at');
        $certificate->description = $request->input('description');

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            // Cek apakah file dengan nama yang sama sudah ada
            if (Storage::disk('public')->exists('certificates/' . $fileName)) {
                // Jika file dengan nama yang sama sudah ada, tambahkan timestamp ke nama file
                $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();
            }

            $filePath = $file->storeAs('certificates', $fileName, 'public');
            $certificate->file = $filePath;
        }

        $certificate->save();

        return redirect()->route('admin.certificate')->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificate.edit', compact('certificate'), ['title' => 'Edit Certificate']);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issued_by' => 'required|string|max:255',
            'issued_at' => 'required|date',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf',
        ]);

        $certificate = Certificate::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($certificate->file) {
                Storage::disk('public')->delete($certificate->file);
            }

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            if (Storage::disk('public')->exists('certificates/' . $fileName)) {
                $fileName = pathinfo($fileName, PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();
            }

            $filePath = $file->storeAs('certificates', $fileName, 'public');
            $certificate->file = $filePath;
        }

        $certificate->update([
            'name' => $request->name,
            'issued_by' => $request->issued_by,
            'issued_at' => $request->issued_at,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.certificate')->with('success', 'Certificate berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);

        if ($certificate->file) {
            Storage::disk('public')->delete($certificate->file);
        }

        $certificate->delete();

        return redirect()->route('admin.certificate')->with('success', 'Certificate berhasil dihapus.');
    }

    public function show($id)
    {
        $certificate = Certificate::findOrFail($id);
        return response()->json([
            'name' => $certificate->name,
            'issued_by' => $certificate->issued_by,
            'issued_at' => $certificate->issued_at,
            'description' => $certificate->description,
    ]);
    }

}
