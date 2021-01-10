<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    public function mahasiswa(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    
}
