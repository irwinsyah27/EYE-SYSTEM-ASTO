<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentAPIController extends Controller
{
    public function all()
    {
        try {
            $data = Department::get();

            return ResponseFormatter::success($data, 'data berhasil diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Something went wrong in '.$th->getMessage(),400);
        }
    }

    public function findById($id)
    {
        try {
            $data = Department::find($id);

            if(!$data){
                return ResponseFormatter::error(null,'data dengan ID '.$id.' tidak ditemukan',404);
            }

            return ResponseFormatter::success($data, 'data dengan ID '.$id.' berhasil diambil');
        } catch (\Throwable $th) {
            return ResponseFormatter::error('Something went wrong in '.$th->getMessage(),400);
        }
    }
}
