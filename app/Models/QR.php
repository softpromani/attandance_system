<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QR extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $table = 'qr';
    protected $casts = [
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', '1');
    }

}
