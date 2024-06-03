<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function className()
    {
        return $this->belongsTo(AddClass::class,'class_id');
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'section');
    }
}
