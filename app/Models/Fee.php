<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeCurrentYearInvoices(){
        $this->whereBetween('created_at',[Carbon::parse(Carbon::now()->year.'04-01'),Carbon::parse(Carbon::now()->addYear()->year.'03-31')]);
    }
    public function feeDetails()
    {
        return $this->hasMany(FeeDetail::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


   

}
