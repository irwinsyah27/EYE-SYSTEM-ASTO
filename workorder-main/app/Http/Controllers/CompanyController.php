<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Perusahaan';

        if($request->ajax()){
            $data = Company::limit(1000)->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="' . route('perusahaan.edit', $row->id) . '" class="btn btn-sm btn-outline-warning me-1"><i class="fa fa-edit"></i></a>'.
                          '<form id="form-delete" action="'.route('perusahaan.destroy', $row->id).'" method="post" class="d-inline">
                          '.method_field('DELETE').'
                          '.csrf_field().'
                          <button type="button" class="btn btn-sm btn-outline-warning btn-delete"><i class="fas fa-trash"></i></button>
                          </form>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make();
        }
        return view('pages.company.index', compact('title'));
    }


    public function create()
    {
        $title = 'Tambah Data Perusahaan';
        $company = new Company();
        $method = 'POST';
        $action = route('perusahaan.store');

        return view('pages.company.form', compact('title','company','action','method'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        try {
            DB::beginTransaction();

            Company::create([
                'name' => $request->name,
                'address' => $request->address
            ]);

            DB::commit();
            return redirect()->route('perusahaan.index')->with('success','Data berhasil ditambahkan');
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
        $title = 'Edit Data Perusahaan';
        $company = Company::findOrFail($id);
        $method = 'PUT';
        $action = route('perusahaan.update', $company->id);

        return view('pages.company.form', compact('title','company','action','method'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $department = Company::findOrFail($id);

            $department->update([
                'name' => $request->name,
                'address' => $request->address
            ]);

            DB::commit();
            return redirect()->route('perusahaan.index')->with('success','Data berhasil diperbarui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }

    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Company::findOrFail($id)->delete();

            DB::commit();
            return redirect()->route('perusahaan.index')->with('success','Data berhasil dihapus');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
