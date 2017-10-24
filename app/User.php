<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','is_active','photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token'
    ];

    //one to many relation(reverse)
    public function role(){

        return $this->belongsTo('App\Role');
    }


    public function photo() {

        return $this->belongsTo('App\Photo');
    }


    public function is_admin(){
       // ako user-ot e aktiven i e admin vracame true,a ako ne vracame false
        if($this->is_active == 1 && $this->role->name == 'admin'){

            return true;
        }else {
            
            return false;
        }
    }


    public function posts(){

        return $this->hasMany('App\Post');
    }
}
