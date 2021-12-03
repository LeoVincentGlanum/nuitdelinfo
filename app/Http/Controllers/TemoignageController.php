<?php

namespace App\Http\Controllers;

use App\BateauSauveteur;
use App\Sauvetage;
use App\Sauveteur;
use App\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    public function add($type,$id){
        if ($type == '1'){
            $sauveteur = Sauveteur::find($id);
            $nom = $sauveteur->nom." ".$sauveteur->prenom;
        }elseif ($type == '2'){
            $bateau = BateauSauveteur::find($id);
            $nom = $bateau->nom;
        }else{
            $sauvetage = Sauvetage::find($id);
            $nom = $sauvetage->titre;
        }
        return view('temoignage/add')->with(['type' => $type , 'id' => $id, 'nom' => $nom]);
    }


    public function store(Request $request){
        $id = $request->input('id');
        $email = $request->input('email');
        $type = $request->input('type');
        $pseudo = $request->input('pseudo');
        $link = $request->input('link');
        $description = $request->input('description');

        $temoignage = new Temoignage();
        $temoignage->email = $email;
        $temoignage->pseudo = $pseudo;
        $temoignage->type = $type;
        $temoignage->type_id = $id;
        $temoignage->temoignage = $description;
        $temoignage->link = $link;
        $temoignage->save();

        if($type == 1){
            return redirect()->route('showSauveteur',['id' => $id]);
        } elseif($type == 2){
            return redirect()->route('showBateau',['id' => $id]);
        } else{
            return redirect()->route('showSauvetage',['id' => $id]);
        }


    }
}
