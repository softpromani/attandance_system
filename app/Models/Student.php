<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    use HasFactory, SoftDeletes , HasRoles;
    protected $guarded = [];

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
    public function className()
    {
        return $this->belongsTo(AddClass::class,'class');
    }
    public function sectionName()
    {
        return $this->belongsTo(Section::class,'section');
    }

}
