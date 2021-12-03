<?php

namespace App\Http\Controllers;

use App\Temoignage;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function index(){
        $temoignages = Temoignage::query()->where('status','=','1')->paginate('10');
        return view('admin/index')->with(['temoignages' => $temoignages]);
    }

    public function show($id){
        $temoignage = Temoignage::find($id);
        return view('admin/show')->with(['temoignage' => $temoignage]);
    }

    public function refuser($id){
        $temoignage = Temoignage::find($id);
        $temoignage->status = 0;
        $temoignage->save();

        return redirect()->route('indexAdmin')->with(['warning' => 'vous avez refuser un temoignage ']);
    }

    public function accepter($id){
        $temoignage = Temoignage::find($id);
        $temoignage->status = 2;
        $temoignage->save();

        return redirect()->route('indexAdmin')->with(['success' => 'vous avez accepté un temoignage ']);
    }
}
