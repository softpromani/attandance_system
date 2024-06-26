<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherLeave extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];

    public function UserName(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function LeaveTypes(){
        return $this->belongsTo(LeaveType::class,'leave_type');
    }
}
