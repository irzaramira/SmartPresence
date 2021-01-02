<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userclass extends Model
{
    public function class(){
        return $this->hasOne('App\Classes', 'id', 'classes_id');
    }
}
