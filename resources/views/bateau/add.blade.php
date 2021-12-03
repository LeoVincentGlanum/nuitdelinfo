@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" action="{{route('storeBateau')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="bateauNom">Nom</label>
                <input type="text" name="bateauNom" class="form-control" id="bateauNom"
                       aria-describedby="Sauveteur nom"
                       placeholder="Nom du bateau">
            </div>
            <div class="form-group">
                <label for="bateauConstructeur">Constructeur</label>
                <input type="text" name="bateauConstructeur" class="form-control" id="bateauConstructeur"
                       placeholder="Constructeur">
            </div>

            <div class="form-group">
                <label for="bateauType">Type</label>
                <input type="text" name="bateauType" class="form-control" id="bateauType"
                       placeholder="">
            </div>

            <div class="form-group">
                <label for="bateauDesc">Description</label>
                <textarea name="bateauDesc" class="form-control" id="bateauDesc" placeholder=""></textarea>
            </div>

            <div class="form-group">
                <label for="bateauDimensions">Dimensions</label>
                <input type="text" name="bateauDimensions" class="form-control" id="bateauDimensions"
                       placeholder="">
            </div>

            <div class="form-group">
                <label for="bateauCommande">Date de la commande</label>
                <input type="date" name="bateauCommande" class="form-control" id="bateauCommande" placeholder="">
            </div>

            <div class="form-group">
                <label for="bateauInstallation">Installation</label>
                <textarea name="bateauInstallation" class="form-control" id="bateauInstallation" placeholder=""></textarea>
            </div>


            <div class="form-group">
                <label for="photo">Photo</label>
                <input name="image" type="file" class="form-control" id="photo">
            </div>


            <div class="form-group">
                <label for="bateauFinDeService">Date de fin de service</label>
                <input type="date" name="bateauFinDeService" class="form-control" id="bateauFinDeService" placeholder="">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
