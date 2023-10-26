<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function index(Request $request)
    {
        $title = 'Data Karyawan';

        if($request->ajax()){
            $data = Employee::with(['department','company'])->limit(1000)->get();

            return \DataTables::of($data)
                  ->addIndexColumn()
                  ->addColumn('action', function ($row) {

                      $btn = '<a href="' . route('karyawan.edit', $row->id) . '" class="btn btn-sm btn-outline-warning me-1"><i class="fa fa-edit"></i></a>'.
                                '<form id="form-delete" action="'.route('karyawan.destroy', $row->id).'" method="post" class="d-inline">
                                '.method_field('DELETE').'
                                '.csrf_field().'
                                <button type="button" class="btn btn-sm btn-outline-warning btn-delete"><i class="fas fa-trash"></i></button>
                                </form>';

                      return $btn;
                  })
                  ->rawColumns(['action'])
                  ->make();
        }

        return view('pages.employee.index', compact('title'));
    }


    public function create()
    {
        $title = 'Tambah Data Karyawan';
        $employee = new Employee();
        $method = 'POST';
        $action = route('karyawan.store');
        $department = Department::get();
        $company = Company::get();

        return view('pages.employee.form', compact('title','employee','method','action','department','company'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nrp' => 'required|',
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'no_handphone' => 'required',
            'date_born' => 'required',
            'address' => 'required',
            'department_id' => 'required|exists:departments,id',
            'company_id' => 'required|exists:companies,id',
            'password' => 'required',
        ]);
        try {
            DB::beginTransaction();

            Employee::create([
                'nrp' => $request->nrp,
                'name' => $request->name,
                'email' => $request->email,
                'no_handphone' => $request->no_handphone,
                'date_born' => $request->date_born,
                'address' => $request->address,
                'department_id' => $request->department_id,
                'company_id' => $request->company_id,
                'password' => bcrypt($request->password),
            ]);
            DB::commit();

            return redirect()->route('karyawan.index')->with('success','Data berhasil ditambahkan');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $title = 'Edit Data Karyawan';
        $employee = Employee::findOrFail($id);
        $method = 'PUT';
        $action = route('karyawan.update', $employee->id);
        $nomor = Helper::generateEmployeeNumber();
        $department = Department::get();
        $company = Company::get();

        return view('pages.employee.form', compact('title','employee','method','action','nomor','department','company'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nrp' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'no_handphone' => 'required',
            'date_born' => 'required',
            'address' => 'required',
            'department_id' => 'required|exists:departments,id',
            'company_id' => 'required|exists:companies,id',

        ]);

        try {
            DB::beginTransaction();

            $employee = Employee::findOrFail($id);

            // Memeriksa apakah password baru diisi
            if (!empty($request->password)) {
                $password = bcrypt($request->password);
            } else {
                $password = $employee->password;
            }

            $employee->update([
                'nrp' => $request->nrp,
                'name' => $request->name,
                'email' => $request->email,
                'no_handphone' => $request->no_handphone,
                'date_born' => $request->date_born,
                'address' => $request->address,
                'department_id' => $request->department_id,
                'company_id' => $request->company_id,
                'password' => $password,
            ]);

            DB::commit();

            return redirect()->route('karyawan.index')->with('success', 'Data berhasil diperbarui');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Employee::findOrFail($id)->delete();

            DB::commit();
            return redirect()->route('karyawan.index')->with('success','Data berhasil dihapus');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}
