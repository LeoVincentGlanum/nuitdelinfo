<?php

namespace App\Http\Controllers;

use App\PhotoSauveteur;
use App\Sauveteur;
use App\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SauveteurController extends Controller
{
    public function index(){
        $sauveteurs = Sauveteur::query()->paginate('10');
        return view('sauveteur/index',['sauveteurs' => $sauveteurs]);
    }

    public function indexSearch(Request $request){
        $searchSauveteur = $request->input('searchSauveteur');
        $split = explode(" ",$searchSauveteur);
        $sauveteur = Sauveteur::query();
        foreach($split as $item){
            $sauveteur->OrWhere('nom','like','%'.$item.'%');
            $sauveteur->OrWhere('prenom','like','%'.$item.'%');
        }
        $sauveteur = $sauveteur->paginate('10');

        return view('sauveteur/index')->with(['sauveteurs' => $sauveteur]);
    }

    public function add(){
        return view('sauveteur/add');
    }

    public function store(Request  $request){
        $nom = $request->input('sauveteurNom');
        $prenom = $request->input('sauveteurPrenom');
        $titre = $request->input('sauveteurTitre');
        $description = $request->input('sauveteurDesc');
        $dateNaiss = $request->input('sauveteurDateNaiss');
        $dateDec = $request->input('sauveteurDateDec');
        $etat = $request->input('sauveteurEtat');

        $sauveteur = new Sauveteur();
        $sauveteur->dateNaissance = $dateNaiss;
        $sauveteur->dateDeMort = $dateDec;
        $sauveteur->titre = $titre;
        $sauveteur->nom = $nom;
        $sauveteur->prenom = $prenom;
        $sauveteur->description = $description;
        $sauveteur->etatCivile = $etat;

        $sauveteur->save();


         if(count($request->file()) < 1)
        {

        } else{
            $name = $sauveteur->id."-".$sauveteur->nom;
            $haher = hash('sha256',$name.'SMEM');
            Storage::putFileAs('/public/sauveteur',$request->file()['image'],$haher.'.jpg');

            $newPhoto = new PhotoSauveteur();
            $newPhoto->sauveteur_id = $sauveteur->id;
            $newPhoto->url = $haher.".jpg";
            $newPhoto->save();
        }


        return redirect()->route('sauveteur')->with(['success' => "Vous avez ajouté un sauveteur"]);
    }


    public function show($id){
        $sauveteur =  Sauveteur::find($id);
        $temoignages = Temoignage::query()->where('type','=',1)->where('type_id','=',$sauveteur->id)->where('status','=',2)->get();
        return view('sauveteur/show')->with(['sauveteur' => $sauveteur,'temoignages' => $temoignages]);
    }

    public function edit($id){
         $sauveteur =  Sauveteur::find($id);
        return view('sauveteur/edit')->with(['sauveteur' => $sauveteur]);
    }

    public function update(Request $request){
        $id = $request->input('sauveteurId');
        $nom = $request->input('sauveteurNom');
        $prenom = $request->input('sauveteurPrenom');
        $titre = $request->input('sauveteurTitre');
        $description = $request->input('sauveteurDesc');
        $dateNaiss = $request->input('sauveteurDateNaiss');
        $dateDec = $request->input('sauveteurDateDec');
        $etat = $request->input('sauveteurEtat');

        $sauveteur = Sauveteur::find($id);
        $sauveteur->dateNaissance = $dateNaiss;
        $sauveteur->dateDeMort = $dateDec;
        $sauveteur->titre = $titre;
        $sauveteur->nom = $nom;
        $sauveteur->prenom = $prenom;
        $sauveteur->description = $description;
        $sauveteur->etatCivile = $etat;
        $sauveteur->save();

         if(count($request->file()) < 1)
        {

        } else{
            $name = $sauveteur->id."-".$sauveteur->nom;
            $haher = hash('sha256',$name.'SMEM');
            Storage::putFileAs('/public/sauveteur',$request->file()['image'],$haher.'.jpg');

            $newPhoto = new PhotoSauveteur();
            $newPhoto->sauveteur_id = $sauveteur->id;
            $newPhoto->url = $haher.".jpg";
            $newPhoto->save();
        }

         return redirect()->route('showSauveteur',['id' => $sauveteur->id])->with(['success' => 'Le sauveteur a bien été edité']);

    }

    public function addImage($id){
        return view('sauveteur/addImage')->with(['id' => $id]);
    }


    public function storeImage(Request  $request){
        $id = $request->input('sauveteurId');
        $sauveteur = Sauveteur::find($id);

         if(count($request->file()) < 1)
        {

        } else{
            $name = $sauveteur->id."-".$sauveteur->nom;
            $haher = hash('sha256',$name.now());
            Storage::putFileAs('/public/sauveteur',$request->file()['image'],$haher.'.jpg');

            $newPhoto = new PhotoSauveteur();
            $newPhoto->sauveteur_id = $sauveteur->id;
            $newPhoto->url = $haher.".jpg";
            $newPhoto->save();
        }

         return redirect()->route('showSauveteur',['id' => $sauveteur->id])->with(['success' => 'Votre photo a été ajouté']);
    }

    public function deleteImage(Request $request){

        $id = $request->input('id');
        $photo = PhotoSauveteur::find($id);
        unlink('storage/sauveteur/'.$photo->url);
        $photo->delete();
        return "success";
    }

}
