<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class libVisit extends Model
{
    use HasFactory;

    protected $fillable = ['s_id', 'user_type', 'lname', 'fname', 'mname', 'course', 'office', 'campus', 'year', 'desc', 'sem'];
}
