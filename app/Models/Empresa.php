<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'empresa_id';

    protected $fillable = [
        'empresa_nombre','empresa_rut','empresa_direccion','empresa_telefono',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'empresa_id', 'empresa_id');
    }

}
