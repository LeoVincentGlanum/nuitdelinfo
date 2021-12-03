<?php

namespace App\Http\Controllers;

use App\BateauSauveteur;
use App\PhotoBateau;
use App\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BateauController extends Controller
{
    public function index()
    {
        $bateaux = BateauSauveteur::query()->paginate('10');
        return view('bateau/index')->with(['bateaux' => $bateaux]);
    }
    public function indexSearch(Request $request){
        $searchSauveteur = $request->input('searchSauveteur');
        $split = explode(" ",$searchSauveteur);
        $bateaux = BateauSauveteur::query();
        foreach($split as $item){
            $bateaux->OrWhere('nom','like','%'.$item.'%');
        }
        $bateaux = $bateaux->paginate('10');

        return view('bateau/index')->with(['bateaux' => $bateaux]);
    }

    public function add()
    {
        return view('bateau/add');
    }

    public function store(Request $request)
    {

        $nom = $request->input('bateauNom');
        $constructeur = $request->input('bateauConstructeur');
        $commande = $request->input('bateauCommande');
        $type = $request->input('bateauType');
        $dimension = $request->input('bateauDimensions');
        $installation = $request->input('bateauInstallation');
        $finDeService = $request->input('bateauFinDeService');
        $description = $request->input('bateauDesc');

        $bateau = new BateauSauveteur();
        $bateau->nom = $nom;
        $bateau->constructeur = $constructeur;
        $bateau->commande = $commande;
        $bateau->type = $type;
        $bateau->dimensions = $dimension;
        $bateau->installation = $installation;
        $bateau->finDeService = $finDeService;
        $bateau->description = $description;

        $bateau->save();

        if (count($request->file()) < 1) {

        } else {
            $name = $bateau->id . "-" . $bateau->nom;
            $haher = hash('sha256', $name . 'SMEM');
            Storage::putFileAs('/public/bateau', $request->file()['image'], $haher . '.jpg');

            $newPhoto = new PhotoBateau();
            $newPhoto->bateau_id = $bateau->id;
            $newPhoto->url = $haher . ".jpg";
            $newPhoto->save();
        }


        return redirect()->route('bateaux')->with(['success' => "Vous avez ajouté un bateau avec succés !"]);


    }

    public function show($id)
    {
        $bateau = BateauSauveteur::find($id);
         $temoignages = Temoignage::query()->where('type','=',2)->where('type_id','=',$bateau->id)->where('status','=',2)->get();
        return view('bateau/show')->with(['bateau' => $bateau,'temoignages' => $temoignages]);
    }

    public function edit($id){
        $bateau = BateauSauveteur::find($id);
        return view('bateau/edit')->with(['bateau' => $bateau]);
    }

    public function update(Request $request){
        $id = $request->input('bateau_id');
        $nom = $request->input('bateauNom');
        $constructeur = $request->input('bateauConstructeur');
        $commande = $request->input('bateauCommande');
        $type = $request->input('bateauType');
        $dimension = $request->input('bateauDimensions');
        $installation = $request->input('bateauInstallation');
        $finDeService = $request->input('bateauFinDeService');
        $description = $request->input('bateauDesc');

        $bateau = BateauSauveteur::find($id);
        $bateau->nom = $nom;
        $bateau->constructeur = $constructeur;
        $bateau->commande = $commande;
        $bateau->type = $type;
        $bateau->dimensions = $dimension;
        $bateau->installation = $installation;
        $bateau->finDeService = $finDeService;
        $bateau->description = $description;

        $bateau->save();

        if (count($request->file()) < 1) {

        } else {
            $name = $bateau->id . "-" . $bateau->nom;
            $haher = hash('sha256', $name . now());
            Storage::putFileAs('/public/bateau', $request->file()['image'], $haher . '.jpg');

            $newPhoto = new PhotoBateau();
            $newPhoto->bateau_id = $bateau->id;
            $newPhoto->url = $haher . ".jpg";
            $newPhoto->save();
        }

        return redirect()->route('showBateau',['id' => $bateau->id])->with(['success' => "Vous avez modifié le bateau avec succés !"]);
    }

    public function deleteImage(Request $request){

        $id = $request->input('id');
        $photo = PhotoBateau::find($id);
        unlink('storage/bateau/'.$photo->url);
        $photo->delete();
        return "success";
    }


    public function addImage($id){
        return view('bateau/addImage')->with(['id' => $id]);
    }

    public function storeImage(Request $request){
        $id = $request->input('bateauId');
        $bateau = BateauSauveteur::find($id);

         if(count($request->file()) < 1)
        {

        } else{
            $name = $bateau->id."-".$bateau->nom;
            $haher = hash('sha256',$name.now());
            Storage::putFileAs('/public/bateau',$request->file()['image'],$haher.'.jpg');

            $newPhoto = new PhotoBateau();
            $newPhoto->bateau_id = $bateau->id;
            $newPhoto->url = $haher.".jpg";
            $newPhoto->save();
        }

         return redirect()->route('showBateau',['id' => $bateau->id])->with(['success' => 'Votre photo a été ajouté']);
    }

}
