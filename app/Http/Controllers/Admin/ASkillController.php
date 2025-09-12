<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use Yajra\DataTables\DataTables;

class ASkillController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $skills = Skill::all();
            return DataTables::of($skills)
                ->addColumn('action', function ($row) {
                    return '
                        <div class="flex justify-center space-x-2 py-2">
                            <a href="'.route('admin.skills.edit', $row->id).'" class="py-1 px-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Edit</a>
                            <form id="delete-form-'.$row->id.'" action="'.route('admin.skills.destroy', $row->id).'" method="POST" class="inline">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="button" class="py-1 px-3 bg-red-600 text-white rounded hover:bg-red-700 transition" onclick="confirmDelete('.$row->id.')">Hapus</button>
                            </form>
                        </div>';
                })
                ->editColumn('id', function ($row) {
                    return '<div class="text-center">'.$row->id.'</div>';
                })
                ->editColumn('title', function ($row) {
                    return '<div class="text-center">'.$row->title.'</div>';
                })
                ->rawColumns(['action', 'id', 'title', 'persen'])
                ->make(true);
        }

        return view('admin.skills');
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'persen' => 'required|integer|min:0|max:100',
        ]);

        Skill::create([
            'title' => $request->title,
            'persen' => $request->persen
        ]);

        return redirect()->route('admin.skills')->with('success', 'Skill berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        return view('admin.skills.edit',compact('skill'));
    }

    public function update(Request $request,$id)
    {
        $skill = Skill::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'persen' => 'required|integer|min:0|max:100',
        ]);
    
        $skill->title = $request->input('title');
        $skill->persen = $request->input('persen');
        
        $skill->save();
    
        return redirect()->route('admin.skills')->with('success', 'Skill berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Skill::destroy($id);
        return redirect()->route('admin.skills')->with('success', 'Skill berhasil dihapus!');
    }
}
