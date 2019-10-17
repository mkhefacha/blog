<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public  function  users(){


        return $this->belongsToMany('App\User','user_role','role_id' ,'user_id');
    }


    public static function role_user(){

        return static::where('name', 'user')->first();
    }

    public static function role_editor(){

        return static::where('name', 'editor')->first();
    }

    public static function role_admin(){

        return static::where('name', 'admin')->first();
    }



}
