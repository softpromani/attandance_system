<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddClass extends Model
{
    use HasFactory;
   protected $guarded = [];
   public function sections()
    {
        return $this->hasMany(Section::class,'class_id');
    }
    public function students()
{
    return $this->hasMany(Student::class,'class');
}
}
