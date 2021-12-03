<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    public function getTypeString(){
        if ($this->type == 1){
            return "Sauveteur";
        } elseif ($this->type == 2){
            return "Bateau";
        }else{
            return "Sauvetage";
        }
    }

    public function getNameCible(){
        if ($this->type == 1){
            $sauveteur = Sauveteur::find($this->id);
            return $sauveteur->nom." ".$sauveteur->prenom;
        } elseif ($this->type == 2){
            $bateau = BateauSauveteur::find($this->id);
            return $bateau->nom;
        }else{
            $sauvetage = Sauvetage::find($this->id);
            return $sauvetage->titre;
        }
    }
}
