<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveSetup extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'years',
        'paid_leave',
        'unpaid_leave',
    ];
    public static $type=['casual'=>'casual','sick'=>'sick'];

}
