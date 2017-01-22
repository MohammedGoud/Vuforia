<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table='users';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name','description'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token','_method','_token'
    ];
}
