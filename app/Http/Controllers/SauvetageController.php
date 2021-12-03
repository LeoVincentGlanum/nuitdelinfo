<?php

namespace App\Http\Controllers;

use App\BateauSauvetage;
use App\BateauSauveteur;
use App\PhotoSauvetage;
use App\Sauvetage;
use App\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SauvetageController extends Controller
{
    public function index(){
        $sauvetages = Sauvetage::query()->paginate('10');
        return view('sauvetage/index')->with(['sauvetages' => $sauvetages]);
    }

    public function indexSearch(Request $request){
        $searchSauveteur = $request->input('searchSauveteur');
        $split = explode(" ",$searchSauveteur);
        $sauvetage = Sauvetage::query();
        foreach($split as $item){
            $sauvetage->OrWhere('titre','like','%'.$item.'%');
        }
        $sauvetage = $sauvetage->paginate('10');

        return view('sauvetage/index')->with(['sauvetages' => $sauvetage]);
    }


    public function add(){
        $bateaux = BateauSauveteur::all();
        return view('sauvetage/add')->with(['bateaux' => $bateaux]);
    }

    public function store(Request $request){




        $titre = $request->input('sauvetageTitre');
        $date = $request->input('sauvetageDate');
        $nbPersonneSauve = $request->input('sauvetageNbPersSave');
        $nbPersonneDecede = $request->input('sauvetageNbPersDec');
        $dureeSortiEnMer = $request->input('sauvetageDureeEnMer');
        $description = $request->input('sauvetageDesc');

        $newSauvetage = new Sauvetage();
        $newSauvetage->titre = $titre;
        $newSauvetage->date = $date;
        $newSauvetage->nbPersonneSauve = $nbPersonneSauve;
        $newSauvetage->nbPersonneDecede = $nbPersonneDecede;
        $newSauvetage->dureeSortiEnMer = $dureeSortiEnMer;
        $newSauvetage->description = $description;

        $newSauvetage->save();

         if($request->input('Bateaux') !== null){
             $bateauxId = $request->input('Bateaux');
             foreach ($bateauxId as $item){
                 $bateauSauvetage = new BateauSauvetage();
                 $bateauSauvetage->bateau_id = $item;
                 $bateauSauvetage->sauvetage_id = $newSauvetage->id;
                 $bateauSauvetage->save();
             }
        }

        if (count($request->file()) < 1) {

        } else {
            $name = $newSauvetage->id . "-" . $newSauvetage->nom;
            $haher = hash('sha256', $name . 'SMEM');
            Storage::putFileAs('/public/sauvetage', $request->file()['image'], $haher . '.jpg');

            $newPhoto = new PhotoSauvetage();
            $newPhoto->sauvetage_id = $newSauvetage->id;
            $newPhoto->url = $haher . ".jpg";
            $newPhoto->save();
        }


        return redirect()->route('sauvetage')->with(['success' => "Vous avez ajouté un sauvetage avec succés !"]);

    }


    public function show($id){
        $sauvetage = Sauvetage::find($id);
         $temoignages = Temoignage::query()->where('type','=',3)->where('type_id','=',$sauvetage->id)->where('status','=',2)->get();
        return view('sauvetage/show')->with(['sauvetage' => $sauvetage,'temoignages' => $temoignages]);
    }

    public function edit($id){
        $sauvetage = Sauvetage::find($id);
        return view('sauvetage/edit')->with(['sauvetage' => $sauvetage]);
    }

    public function update(Request $request){

        $id = $request->input('sauvetage_id');
        $titre = $request->input('sauvetageTitre');
        $date = $request->input('sauvetageDate');
        $nbPersonneSauve = $request->input('sauvetageNbPersSave');
        $nbPersonneDecede = $request->input('sauvetageNbPersDec');
        $dureeSortiEnMer = $request->input('sauvetageDureeEnMer');
        $description = $request->input('sauvetageDesc');

        $newSauvetage = Sauvetage::find($id);
        $newSauvetage->titre = $titre;
        $newSauvetage->date = $date;
        $newSauvetage->nbPersonneSauve = $nbPersonneSauve;
        $newSauvetage->nbPersonneDecede = $nbPersonneDecede;
        $newSauvetage->dureeSortiEnMer = $dureeSortiEnMer;
        $newSauvetage->description = $description;

        $newSauvetage->save();

        if (count($request->file()) < 1) {

        } else {
            $name = $newSauvetage->id . "-" . $newSauvetage->nom;
            $haher = hash('sha256', $name . now());
            Storage::putFileAs('/public/sauvetage', $request->file()['image'], $haher . '.jpg');

            $newPhoto = new PhotoSauvetage();
            $newPhoto->sauvetage_id = $newSauvetage->id;
            $newPhoto->url = $haher . ".jpg";
            $newPhoto->save();
        }


        return redirect()->route('showSauvetage',['id' => $newSauvetage->id])->with(['success' => "Vous avez edité le sauvetage avec succés !"]);

    }


    public function deleteImage(Request $request){

        $id = $request->input('id');
        $photo = PhotoSauvetage::find($id);
        unlink('storage/sauvetage/'.$photo->url);
        $photo->delete();
        return "success";
    }

     public function addImage($id){
        return view('sauvetage/addImage')->with(['id' => $id]);
    }


    public function storeImage(Request $request){
        $id = $request->input('sauvetageId');
        $sauvetage = Sauvetage::find($id);

         if(count($request->file()) < 1)
        {

        } else{
            $name = $sauvetage->id."-".$sauvetage->nom;
            $haher = hash('sha256',$name.now());
            Storage::putFileAs('/public/sauvetage',$request->file()['image'],$haher.'.jpg');

            $newPhoto = new PhotoSauvetage();
            $newPhoto->sauvetage_id = $sauvetage->id;
            $newPhoto->url = $haher.".jpg";
            $newPhoto->save();
        }

         return redirect()->route('showSauvetage',['id' => $sauvetage->id])->with(['success' => 'Votre photo a été ajouté']);
    }

}
