<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id');
    }

    public function month()
    {
        return $this->belongsTo(Month::class, 'month_id');
    }

}
