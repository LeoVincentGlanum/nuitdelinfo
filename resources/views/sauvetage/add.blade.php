@extends('layouts.app')


@section('content')
    <div class="container">
        <form method="post" action="{{route('storeSauvetage')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="sauvetageTitre">Titre</label>
                <input type="text" name="sauvetageTitre" class="form-control" id="sauvetageTitre"
                       aria-describedby="Sauvetage titre"
                       placeholder="Titre du sauvetage">
            </div>
            <div class="form-group">
                <label for="sauvetageDate">Date du sauvetage</label>
                <input type="date" name="sauvetageDate" class="form-control" id="sauvetageDate"
                       placeholder="">
            </div>

            <div class="form-group">
                <label for="sauvetageNbPers">Nombre de personnes sauvées</label>
                <input type="number" name="sauvetageNbPersSave" class="form-control" id="sauvetageNbPers"
                       placeholder="">
            </div>

            <div class="form-group">
                <label for="sauvetageNbPersDec">Nombre de personnes décèdées</label>
                <input type="number" name="sauvetageNbPersDec" class="form-control" id="sauvetageNbPersDec"
                       placeholder="">
            </div>

            <div class="form-group">
                <label for="sauvetageDureeEnMer">Durée en mer</label>
                <input type="text" name="sauvetageDureeEnMer" class="form-control" id="sauvetageDureeEnMer"
                       placeholder="">
            </div>


            <div class="form-group">
                <label for="sauvetageDesc">Description</label>
                <textarea name="sauvetageDesc" class="form-control" id="sauvetageDesc" placeholder=""></textarea>
            </div>


            <div class="form-group">
                <label for="photo">Photo</label>
                <input name="image" type="file" class="form-control" id="photo">
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect2">Selectionner les bateaux sauveur</label>
                <select multiple class="form-control" id="exampleFormControlSelect2" name="Bateaux[]">
                    @foreach($bateaux as $bateau)
                        <option value="{{$bateau->id}}">{{$bateau->nom}}</option>
                    @endforeach
                </select>
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


        // $(document).ready(function () {
        //     $("#bateau").on("keydown",function (){
        //         let cpt = $("#bateau").val().length
        //         if (cpt > )
        //     })
        // });


    </script>
@endsection

