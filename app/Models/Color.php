<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'color_pa',
        'name_color_pa',
        'blank_pa',
        'color_pis',
        'name_color_pis',
        'blank_pis',
        'color_pe',
        'name_color_pe',
        'blank_pe',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
