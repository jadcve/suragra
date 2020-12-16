<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlarmaUser extends Model
{
    protected $primaryKey = 'alarma_user_id';
    protected $table = 'alarma_users';

    protected $fillable = [
        'alarma_id','user_id',
    ];

   
}
