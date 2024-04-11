<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function feeyear()
    {
        return $this->belongsTo(Year::class,'year');
    }

    public function feemonth()
    {
        return $this->belongsTo(Month::class,'month');
    }

}
