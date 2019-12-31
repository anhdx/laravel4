<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
	 use HasApiTokens, Notifiable;
	 /**
* The attributes that are mass assignable.
*
* @var array
*/
	protected $fillable = [
		'name','email','password',
	];
    protected $table = 'user';

    // public function product(){
    // 	return $this->hasMany('App\Models\product','id_user','id');
    // }
    /**
* The attributes that should be hidden for arrays.
*
* @var array
*/
	protected $hidden = [
		'password','remember_token',
	];
}
