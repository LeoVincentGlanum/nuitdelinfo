@extends('layouts.app')

@section('content')
    <div class="container">
        @if($type == 1)
            <h3>Soumission de témoignage concernant le sauveteur <a
                    href="{{route('showSauveteur',['id' => $id])}}"><b>{{$nom}}</b></a></h3>
        @elseif($type == 2)
            <h3>Soumission de témoignage concernant le bateau <a
                    href="{{route('showBateau',['id' => $id])}}"><b>{{$nom}}</b></a></h3>
        @else
            <h3>Soumission de témoignage concernant le sauvetage <a
                    href="{{route('showSauvetage',['id' => $id])}}"><b>{{$nom}}</b></a></h3>
        @endif

        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Merci !</h4>
            <p>Grace à vous, vous contribuez à ce que la mémoire de milier de sauveteurs perdurent dans le temps.</p>
            <hr>
            <p class="mb-0">Votre témoingnage ne sera pas tout de suite en ligne. Il sera auparavant analysé par un administrateur</p>
        </div>

        <form method="post" action="{{route('storeTemoignage')}}">
            @csrf
            <input type="hidden" name="type" value="{{$type}}">
            <input type="hidden" name="id" value="{{$id}}">


            <div class="form-group">
                <label for="exampleInputEmail1">Adresse email</label>
                <input required type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                       placeholder="Votre adresse email">
                <small id="emailHelp" class="form-text text-muted">Aucune démarche commercial ne sera effectué.</small>
            </div>
            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input required type="text" name="pseudo" class="form-control" id="pseudo" placeholder="">
            </div>

            <div class="form-group">
                <label for="link">Lien de vos documents ? </label>
                <input type="text" name="link" class="form-control" id="link" placeholder="">
            </div>

            <div class="form-group">
                <label for="description">Témoignagne </label>
                <textarea style="height: 20vh;" required type="text" name="description" class="form-control" id="description"
                          placeholder=""></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Soumettre</button>

        </form>
    </div>
@endsection
