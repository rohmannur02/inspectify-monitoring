<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Defect extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'pattern',
        'item_code',
        'serial',
        'defect',
        'area',
        'mold',
        'position',
        'image',
        'status',
        'author',
    ];
}