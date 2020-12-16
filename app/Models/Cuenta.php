<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuenta extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'cuenta_id';

    protected $fillable = [
        'cuenta_banco','cuenta_tipo','cuenta_numero',
    ];
}
