<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultProduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'pattern',
        'schedule',
        'actual',
        'shift',
        'group',
        'author',
    ];
}