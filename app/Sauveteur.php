<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sauveteur extends Model
{

    protected $with = ['photos'];

    public function photos(){
         return $this->hasMany(PhotoSauveteur::class,'sauveteur_id','id');
    }
}


