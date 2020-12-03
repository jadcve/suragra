<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodicidad extends Model
{
    protected $primaryKey = 'periodicidad_id';

    protected $fillable = [
        'periodicidad_tipo',
    ];
}
