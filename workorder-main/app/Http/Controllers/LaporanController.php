<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Laporan';

        if($request->ajax()){
            $query = WorkOrder::with(['details','company','employee'])->whereHas('details',function($q) {
                $q->whereNotNUll('unit_id');
            });

            if($request->status){
                if ($request->input('status') == 'open') {
                    $query->where('end_date', '>', now());
                } else if ($request->input('status') == 'close') {
                    $query->where('end_date', '<', now());
                }
            }

            if($request->tanggal){
                $mulai = Carbon::parse(explode('-', $request->tanggal)[0])->format('Y-m-d');
                $sampai = Carbon::parse(explode('-', $request->tanggal)[1])->format('Y-m-d');

                $query->whereBetween('order_date', [$mulai, $sampai]);
            }



            $data = $query->limit(1000);

            return DataTables::of($data)
                ->addColumn('units', function($row){
                    return $row->details()->pluck('item')->unique()->implode(', ') ?? '-';
                })
                ->addColumn('amount', function($row){
                    return $row->details()->sum('qty') ?? '0';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' .
                    route('laporan.show', $row->id) . '" class="btn btn-sm btn-outline-warning me-1"><i class="fa fa-eye"></i></a>';

                    return $btn;
                })
                ->addColumn('status_project', function($row){
                    $currentDate = Carbon::now();
                    $endDate = Carbon::parse($row->end_date);

                    if ($currentDate > $endDate) {
                        return '<span class="badge rounded-pill bg-danger">CLOSED</span>';
                    } else {
                        return '<span class="badge rounded-pill bg-info">OPEN</span>';
                    }
                })
                ->editColumn('status', function($row){
                    $statusMap = [
                        1 => '<span class="badge rounded-pill bg-warning">Pending</span>',
                        2 => '<span class="badge rounded-pill bg-success">Disetujui</span>',
                        3 => '<span class="badge rounded-pill bg-danger">Ditolak</span>',
                    ];

                    return $statusMap[$row->status] ?? '';
                })
                ->rawColumns(['action','status','status_project'])
                ->make();
        }

        return view('pages.laporan.index', compact('title'));
    }

    public function show($id)
    {
        $title = 'Data Detail Laporan';
        $data = WorkOrder::with(['employee','department','company','details'])->findOrFail($id);

        return view('pages.laporan.detail', compact('title','data'));
    }
}
