<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BateauSauveteur extends Model
{
    protected $with = ['photos'];

    public function photos(){
         return $this->hasMany(PhotoBateau::class,'bateau_id','id');
    }
}
