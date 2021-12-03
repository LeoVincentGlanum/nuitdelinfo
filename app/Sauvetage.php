<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sauvetage extends Model
{
    protected $with = ['photos'];

    public function photos(){
         return $this->hasMany(PhotoSauvetage::class,'sauvetage_id','id');
    }
}
