@extends('layouts.app')

@section('content')
<div class="container">
        <form method="post" action="{{route('updateBateau')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="bateauNom">Nom</label>
                <input type="hidden" name="bateau_id" value="{{$bateau->id}}">
                <input type="text" name="bateauNom" class="form-control" id="bateauNom"
                       aria-describedby="Sauveteur nom"
                       placeholder="Nom du bateau" value="{{$bateau->nom}}">
            </div>
            <div class="form-group">
                <label for="bateauConstructeur">Constructeur</label>
                <input type="text" name="bateauConstructeur" class="form-control" id="bateauConstructeur"
                       placeholder="Constructeur" value="{{$bateau->constructeur}}">
            </div>

            <div class="form-group">
                <label for="bateauType">Type</label>
                <input type="text" name="bateauType" class="form-control" id="bateauType"
                       placeholder="" value="{{$bateau->type}}">
            </div>

            <div class="form-group">
                <label for="bateauDesc">Description</label>
                <textarea name="bateauDesc" class="form-control" id="bateauDesc" placeholder="">{{$bateau->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="bateauDimensions">Dimensions</label>
                <input type="text" name="bateauDimensions" class="form-control" id="bateauDimensions"
                       placeholder="" value="{{$bateau->dimensions}}">
            </div>

            <div class="form-group">
                <label for="bateauCommande">Date de la commande</label>
                <input type="date" name="bateauCommande" class="form-control" id="bateauCommande" placeholder="" value="{{$bateau->commande}}">
            </div>

            <div class="form-group">
                <label for="bateauInstallation">Installation</label>
                <input name="bateauInstallation" class="form-control" id="bateauInstallation" placeholder="" value="{{$bateau->installation}}">
            </div>


            <div class="form-group">
                <label for="photo">Photo</label>
                <input name="image" type="file" class="form-control" id="photo">
            </div>


            <div class="form-group">
                <label for="bateauFinDeService">Date de fin de service</label>
                <input type="date" name="bateauFinDeService" class="form-control" id="bateauFinDeService" placeholder="" value="{{$bateau->finDeService}}">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection


@section('js')
    <script>
    tinymce.init({
  selector: 'textarea#bateauDesc',  // change this value according to your HTML
  plugin: 'a_tinymce_plugin',
  a_plugin_option: true,
  a_configuration_option: 400
});
    </script>
@endsection
