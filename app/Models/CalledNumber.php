<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalledNumber extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'number',
        'where',
        'color_line',
        'name_color_line',
        'guiche',
        'created_at',
        'updated_at',
        'deleted_at',

    ];
}
