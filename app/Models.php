<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='modals';
    protected $primaryKey = 'id';
    protected $fillable = [
         ];

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
