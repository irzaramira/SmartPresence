<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public function dosen(){
        return $this->hasOne('App\User', 'id', 'dosen_id');
    }
}
