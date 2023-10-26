<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected $table = 'work_orders';
    protected $guarded = ['id','created_at','updated_at'];
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function company(){
        return $this->belongsTo(Company::class,'company_id');
    }

    public function details(){
        return $this->hasMany(WorkOrderDetail::class,'workorder_id','id');
    }
}
