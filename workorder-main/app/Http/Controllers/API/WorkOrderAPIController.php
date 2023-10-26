<?php

namespace App\Http\Controllers\API;

use App\Helpers\EmailSend;
use App\Helpers\Helper;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\WorkOrderResource;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\WorkOrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkOrderAPIController extends Controller
{
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $jsonData = $request->json()->all();

            $data = WorkOrder::create([
                'wo_number' => $request->wo_number,
                'order_date' => $jsonData['order_date'],
                'employee_id' => $jsonData['employee_id'],
                'department_id' => $jsonData['department_id'],
                'company_id' => $jsonData['company_id'],
                'start_date' => $jsonData['start_date'],
                'end_date' => $jsonData['end_date'],
                'request_description' => $jsonData['request_description'],
                'status' => '1',
            ]);
            $detail = '';
            foreach ($jsonData['items'] as $item) {
                $qty = $item['qty'];

                // Membuat detail WorkOrder sebanyak qty
                for ($i = 0; $i < $qty; $i++) {
                    $detail = WorkOrderDetail::create([
                        'item' => $item['item'],
                        'qty' => 1,
                        'start_date' => $jsonData['start_date'],
                        'workorder_id' => $data->id,
                    ]);
                }
            }
            $data['items'] = $detail::where('workorder_id', $data->id)->get();

            DB::commit();

            EmailSend::adminSendEmail();

            return ResponseFormatter::success($data,'Data created successfully',201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return ResponseFormatter::error('Something went wrong in '.$th->getMessage(),400);
        }
    }

    public function generateNomor(){
        try {
            $nomor = Helper::generateWONumber();

            return ResponseFormatter::success(['wo_number' => $nomor], 'Data sukses diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Something went wrong in '.$th->getMessage(),400);
        }
    }

    public function all(Request $request)
    {
        try {
            $limit = $request->input('limit');

            $query = WorkOrder::with(['details'])
                ->select('work_orders.id', 'wo_number', 'order_date', 'employees.name as name', 'nrp', 'companies.name as company', 'departments.name as department', 'start_date', 'end_date', 'status', 'request_description')
                ->join('employees', 'work_orders.employee_id', '=', 'employees.id')
                ->join('companies', 'work_orders.company_id', '=', 'companies.id')
                ->join('departments', 'work_orders.department_id', '=', 'departments.id')
                ->where('employee_id', $request->input('user_id'));

            if ($request->input('status')) {
                $status = '';
                if ($request->input('status') == 'pending') {
                    $status = 1;
                } else if ($request->input('status') == 'approved') {
                    $status = 2;
                } else if ($request->input('status') == 'rejected') {
                    $status = 3;
                }
                $query->where('status', $status);
            }

            if ($request->input('status_project')) {
                if ($request->input('status_project') == 'open') {
                    $query->where('end_date', '>', now());
                } else if ($request->input('status_project') == 'close') {
                    $query->where('end_date', '<', now());
                }
            }

            if($request->input('search')){
                $query->where('wo_number','like',$request->input('search').'%');
            }



            $data = $query->orderBy('work_orders.created_at', 'desc')->paginate($limit);

            return ResponseFormatter::success($data, 'Data sukses diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Something went wrong in ' . $th->getMessage(), 400);
        }
    }


    public function show($id)
    {
        try {
            $data = WorkOrder::with(['details'])->find($id);

            if($data != null){
                return ResponseFormatter::success($data, 'Data sukses diambil');
            }

            return ResponseFormatter::error(null,'Data dengan ID '.$id.' tidak ditemukan',404);
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Something went wrong in '.$th->getMessage(),400);
        }
    }
}
