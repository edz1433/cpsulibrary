<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;
    protected $fillable = ['s_id', 'time_in', 'time_out', 'date', 'status'];
}
