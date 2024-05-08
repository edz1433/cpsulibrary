<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        's_id',
        'lname',
        's_fname',
        's_mname',
        's_course',
        's_year',
        's_desc',
        's_sem',
    ];
}
