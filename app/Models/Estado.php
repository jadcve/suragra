<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'estado_id';

    protected $fillable = [
        'estado_tipo',
    ];
}
