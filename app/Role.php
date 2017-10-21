<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name'];

    //one to many relation-parent
    public function users(){
        
        return $this->hasMany('App\User');
    }
}
