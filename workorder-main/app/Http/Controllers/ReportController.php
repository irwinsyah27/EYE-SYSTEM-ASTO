<?php

namespace App\Http\Controllers;

use App\Exports\WorkOrderExport;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Report per Periode';
        $tgl = '';

        if($request->ajax()){
            $query = WorkOrder::with(['details','company','employee'])->whereHas('details',function($q) {
                $q->whereNotNUll('unit_id');
            });

            if($request->tanggal){
                $tgl = $request->tanggal;
                $mulai = Carbon::parse(explode('-', $request->tanggal)[0])->format('Y-m-d');
                $sampai = Carbon::parse(explode('-', $request->tanggal)[1])->format('Y-m-d');

                $query->whereBetween('order_date', [$mulai, $sampai]);
            }



            $data = $query->limit(1000)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('amount', function($row){
                    return $row->details()->sum('qty') ?? '0';
                })
                ->addColumn('avg_use', function($row){
                    return $row->details()->sum('hours_use').' Jam';
                })
                ->editColumn('start_date', function($row){
                    return Carbon::parse($row->start_date)->format('d/m/Y');
                })
                ->editColumn('end_date', function($row){
                    return Carbon::parse($row->end_date)->format('d/m/Y');
                })
                ->rawColumns(['avg_use','amount','start_date','end_date'])
                ->make();
        }

        return view('pages.report.index', compact('title','tgl'));
    }

    public function export(Request $request)
    {
        if ($request->tanggal) {
            $mulai = Carbon::parse(explode('-', $request->tanggal)[0])->format('Y-m-d');
            $sampai = Carbon::parse(explode('-', $request->tanggal)[1])->format('Y-m-d');

            $data  = WorkOrder::with(['details','company','employee'])->whereBetween('order_date', [$mulai, $sampai])->get();

            $title = 'Report Work Order Periode ' . $mulai . ' - ' . $sampai;
            $periode = Carbon::parse($mulai)->format('d/m/Y').' S.D '.Carbon::parse($sampai)->format('d/m/Y');
        }
        return Excel::download(new WorkOrderExport($data, $periode), $title . '.xlsx');
    }
}
