<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Panel extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'identification',
        'ip',
        'chama_pa',
        'chama_pis',
        'chama_pe',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
