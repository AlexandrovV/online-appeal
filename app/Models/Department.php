<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;

    public function teachers() {
        return $this -> hasMany(Teacher::class);
    }

//    public function teachers() {
//        return $this->hasMany('App\Models\Teacher');
//    }

//    public function manyToManyExample() {
//        return $this->belongsToMany(Teacher::class); // Указываю конечный в m-to-m
//    }

//    public function subjects() {
//        return $this->hasMany('App\Models\Subject');
//    }
}
