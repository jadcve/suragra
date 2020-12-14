<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alarma extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'alarma_id';

    protected $fillable = [
        'alarma_nombre','alarma_subject','alarma_contenido',
    ];

    public function periodicidad()
    {
        return $this->hasOne(Periodicidad::class, 'periodicidad_id', 'periodicidad_id');
    }

    public function AlarmaUser()
    {
        return $this->hasMany(AlarmaUser::class);
    }
}
