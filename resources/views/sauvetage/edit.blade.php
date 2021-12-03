@extends('layouts.app')


@section('content')
    <div class="container">
        <form method="post" action="{{route('updateSauvetage')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="sauvetageTitre">Titre</label>
                <input type="hidden" value="{{$sauvetage->id}}" name="sauvetage_id">
                <input type="text" name="sauvetageTitre" class="form-control" id="sauvetageTitre"
                       aria-describedby="Sauvetage titre"
                       placeholder="Titre du sauvetage" value="{{$sauvetage->titre}}">
            </div>
            <div class="form-group">
                <label for="sauvetageDate">Date du sauvetage</label>
                <input type="date" name="sauvetageDate" class="form-control" id="sauvetageDate"
                       placeholder="" value="{{$sauvetage->date}}">
            </div>

            <div class="form-group">
                <label for="sauvetageNbPers">Nombre de personnes sauvées</label>
                <input type="number" name="sauvetageNbPersSave" class="form-control" id="sauvetageNbPers"
                       placeholder="" value="{{$sauvetage->nbPersonneSauve}}">
            </div>

            <div class="form-group">
                <label for="sauvetageNbPersDec">Nombre de personnes décèdées</label>
                <input type="number" name="sauvetageNbPersDec" class="form-control" id="sauvetageNbPersDec"
                       placeholder="" value="{{$sauvetage->nbPersonneDecede}}">
            </div>

            <div class="form-group">
                <label for="sauvetageDureeEnMer">Durée en mer</label>
                <input type="text" name="sauvetageDureeEnMer" class="form-control" id="sauvetageDureeEnMer"
                       placeholder="" value="{{$sauvetage->dureeSortiEnMer}}">
            </div>


            <div class="form-group">
                <label for="sauvetageDesc">Description</label>
                <textarea name="sauvetageDesc" class="form-control" id="sauvetageDesc" placeholder="">{{$sauvetage->description}}</textarea>
            </div>


            <div class="form-group">
                <label for="photo">Photo</label>
                <input name="image" type="file" class="form-control" id="photo">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection


@section('js')
    <script>
    tinymce.init({
  selector: 'textarea#sauvetageDesc',  // change this value according to your HTML
  plugin: 'a_tinymce_plugin',
  a_plugin_option: true,
  a_configuration_option: 400
});
    </script>
@endsection
