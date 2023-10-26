<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{

    public function index(Request $request)
    {
        $title = "Data Unit";

        if($request->ajax()){
            $data = Unit::limit(1000)->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                $btn = '<a href="' . route('unit.edit', $row->id) . '" class="btn btn-sm btn-outline-warning me-1"><i class="fa fa-edit"></i></a>'.
                          '<form id="form-delete" action="'.route('unit.destroy', $row->id).'" method="post" class="d-inline">
                          '.method_field('DELETE').'
                          '.csrf_field().'
                          <button type="button" class="btn btn-sm btn-outline-warning btn-delete"><i class="fas fa-trash"></i></button>
                          </form>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make();
        }

        return view('pages.unit.index', compact('title'));
    }

    public function create()
    {
        $title = "Tambah Data Unit";
        $unit = new Unit();
        $method = "POST";
        $action = route('unit.store');

        return view('pages.unit.form', compact('title','unit','method','action'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit' => 'required',
            'egi' => 'required',
            'type' => 'required',
        ]);
        try {
            DB::beginTransaction();

            Unit::create([
                'unit' => $request->unit,
                'egi' => $request->egi,
                'type' => $request->type,
            ]);
            DB::commit();

            return redirect()->route('unit.index')->with('success','Data berhasil ditambahkan');

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
        $title = "Edit Data Unit";
        $unit = Unit::findOrFail($id);
        $method = "PUT";
        $action = route('unit.update', $id);

        return view('pages.unit.form', compact('title','unit','method','action'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unit' => 'required',
            'egi' => 'required',
            'type' => 'required',
        ]);
        try {
            DB::beginTransaction();

            Unit::findOrFail($id)->update([
                'unit' => $request->unit,
                'egi' => $request->egi,
                'type' => $request->type,
            ]);
            DB::commit();

            return redirect()->route('unit.index')->with('success','Data berhasil ditambahkan');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Unit::findOrFail($id)->delete();

            DB::commit();
            return redirect()->route('unit.index')->with('success','Data berhasil dihapus');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function getByType($type)
    {
        $units = Unit::where('type','=', $type)->get();

        return response()->json($units);
    }

    public function getEgiByUnit($unit)
    {
        $egis = Unit::where('unit', $unit)->pluck('egi');

        return response()->json(['egis' => $egis]);
    }
}
