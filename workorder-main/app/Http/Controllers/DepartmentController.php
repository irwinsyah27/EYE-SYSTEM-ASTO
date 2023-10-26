<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Data Departemen';

        if($request->ajax()){
            $data = Department::limit(1000)->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="' . route('departemen.edit', $row->id) . '" class="btn btn-sm btn-outline-warning me-1"><i class="fa fa-edit"></i></a>'.
                          '<form id="form-delete" action="'.route('departemen.destroy', $row->id).'" method="post" class="d-inline">
                          '.method_field('DELETE').'
                          '.csrf_field().'
                          <button type="button" class="btn btn-sm btn-outline-warning btn-delete"><i class="fas fa-trash"></i></button>
                          </form>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('pages.department.index', compact('title'));
    }


    public function create()
    {
        $title = 'Tambah Data Departemen';
        $department = new Department();
        $method = 'POST';
        $action = route('departemen.store');

        return view('pages.department.form', compact('title','department','action','method'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            DB::beginTransaction();

            Department::create([
                'name' => $request->name
            ]);

            DB::commit();
            return redirect()->route('departemen.index')->with('success','Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $title = 'Edit Data Departemen';
        $department = Department::findOrFail($id);
        $method = 'PUT';
        $action = route('departemen.update', $department->id);

        return view('pages.department.form', compact('title','department','action','method'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $department = Department::findOrFail($id);

            $department->update([
                'name' => $request->name
            ]);

            DB::commit();
            return redirect()->route('departemen.index')->with('success','Data berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }

    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Department::findOrFail($id)->delete();

            DB::commit();
            return redirect()->route('departemen.index')->with('success','Data berhasil dihapus');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
