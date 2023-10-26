<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrderDetail extends Model
{
    use HasFactory;
    protected $table = 'work_order_details';
    protected $fillable = ['item','qty','image','start_date','final_date','hours_use','unit_id','workorder_id'];
    public function workorder(){
        return $this->belongsTo(WorkOrder::class,'workorder_id');
    }
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id');
    }
}
