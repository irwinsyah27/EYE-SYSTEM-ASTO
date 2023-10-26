<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationAPIController extends Controller
{
    public function all(Request $request){
        try {
            $limit = $request->input('limit');

            $query = Notification::select('notifications.id', 'notifications.date','notifications.status','notifications.description')
                ->join('employees', 'notifications.employee_id', '=', 'employees.id')
                ->where('employee_id', $request->input('user_id'));


            if($request->input('search')){
                $query->where('date','like',$request->input('search').'%');
            }

            $data = $query->orderBy('notifications.created_at', 'desc')->paginate($limit);

            return ResponseFormatter::success($data, 'Data sukses diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Something went wrong in ' . $th->getMessage(), 400);

        }
    }
}
