<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Userclass extends Model
{
    public function class(){
        return $this->hasOne('App\Classes', 'id', 'classes_id');
    }

    public function user(){
        return $this->hasOne('App\User', 'id', 'dosen_id');
    }
}
