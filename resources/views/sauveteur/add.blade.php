@extends('layouts.app')


@section('content')
    <div class="container">
        <form method="post" action="{{route('storeSauveteur')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="sauveteurNom">Nom</label>
                <input type="text" name="sauveteurNom" class="form-control" id="sauveteurNom"
                       aria-describedby="Sauveteur nom"
                       placeholder="Nom du sauveteur">
            </div>
            <div class="form-group">
                <label for="sauveteurPrenom">Prenom</label>
                <input type="text" name="sauveteurPrenom" class="form-control" id="sauveteurPrenom"
                       placeholder="Prenom">
            </div>

            <div class="form-group">
                <label for="sauveteurTitre">Titre</label>
                <input type="text" name="sauveteurTitre" class="form-control" id="sauveteurTitre"
                       placeholder="Capitaine">
            </div>

            <div class="form-group">
                <label for="sauveteurDesc">Description</label>
                <textarea name="sauveteurDesc" class="form-control" id="sauveteurDesc" placeholder=""></textarea>
            </div>

            <div class="form-group">
                <label for="sauveteurDateNaiss">Date de naissance</label>
                <input type="date" name="sauveteurDateNaiss" class="form-control" id="sauveteurDateNaiss"
                       placeholder="">
            </div>

            <div class="form-group">
                <label for="sauveteurDateDec">Date de Décès</label>
                <input type="date" name="sauveteurDateDec" class="form-control" id="sauveteurDateDec" placeholder="">
            </div>

            <div class="form-group">
                <label for="sauveteurEtat">Etat civil</label>
                <textarea name="sauveteurEtat" class="form-control" id="sauveteurEtat" placeholder=""></textarea>
            </div>


            <div class="form-group">
                <label for="photo">Photo</label>
                <input name="image" type="file" class="form-control" id="photo">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
