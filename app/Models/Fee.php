<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function feeDetails()
    {
        return $this->hasMany(FeeDetail::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

   

}
