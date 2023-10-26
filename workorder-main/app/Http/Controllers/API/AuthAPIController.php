<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthAPIController extends Controller
{
    public function login(Request $request){
        try {

           if(Auth::guard('employee')->attempt(['nrp' => $request->input('nrp'),'password' => $request->input('password')])){
            $user = Auth::guard('employee')->user();
            $user['company'] = Company::select('id','name','address')->findOrFail($user->company_id);
            $user['departemen'] = Department::select('id','name')->findOrFail($user->department_id);
            $token = $user->createToken('MyApp',['employee'])->plainTextToken;

            return response()->json(['message' => 'User logged in!', 'data' => new AuthResource($user), 'token' => $token]);
           }else{
               return response()->json(['error'=>'Invalid nrp or password.'],400);
           }


        } catch (\Throwable $th) {
            return ResponseFormatter::error('Something went wrong in '.$th->getMessage(),400);
        }
    }

    public function logout()
    {
        try {

            $user = Auth::user()->tokens()->delete();

            return response()->json(['message' => 'User logged out!'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong in AuthController.logout'
            ]);
        }
    }
}
