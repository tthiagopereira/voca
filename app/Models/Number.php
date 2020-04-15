<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Number extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'number',
        'pis',
        'status_pis',
        'status_pa',
        'pe',
        'guiche_id',
        'status_pe',
        'created_at',
        'updated_at',
        'deleted_at',

    ];
}
