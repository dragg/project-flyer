<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
