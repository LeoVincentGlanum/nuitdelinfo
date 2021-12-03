@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="">

            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <h3>Les Bateaux </h3>

            <form method="get" action="{{route('bateauxSearch')}}">
                <div class="form-group">
                    <label for="searchSauveteur">Nom du bateau</label>
                    <input type="text" name="searchSauveteur" class="form-control" id="searchSauveteur"
                           aria-describedby="emailHelp" placeholder="Nom du bateau"
                           value="{{request('searchSauveteur')}}">
                </div>

                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </form>

            @auth
                <a href="{{route("addBateau")}}" class="btn btn-success">Ajouter un bateau</a>
                <a href="#" class="btn btn-warning">Voir les demandes d'ajout</a>
            @else
                <a href="#" class="btn btn-success">Sudgerer un ajout </a>
            @endif

            <ul class="my-5 list-group">
                @if(count($bateaux) < 1)
                    <div class="alert alert-danger " role="alert">
                        <h4 class="alert-heading">Aie ! </h4>
                        <p>Nous n'avons pas trouvé de resultat pour la recherche avec le mot clef : <b>{{request('searchSauveteur')}}</b></p>
                        <hr>
                        <a href="{{route('bateaux')}}"><p class="mb-0">Cliquez ici pour retirer le filtre de recherche .</p></a>
                    </div>
                @endif
                @foreach($bateaux as $bateau)
                    <a href="{{route('showBateau',['id' => $bateau->id])}}">
                        <li class="list-group-item"
                            style="display: flex;flex-wrap: nowrap;justify-content: space-between;align-items: center;">
                            <div>
                                {{ $bateau->nom}}
                            </div>
                            <div>
                                {{ $bateau->commande}}
                            </div>
                            {{ $bateau->type}}

                            @if( !$bateau->photos->isEmpty())

                                <img style="max-height: 20vw;max-width: 25vw"
                                     src="{{ asset('storage/bateau/'.$bateau->photos->first()->url) }}"
                                     alt="Photo du sauveteur">
                            @else
                                <img style="max-height: 20vw;max-width: 25vw" src="{{ asset('img/bateau.jpg') }}"
                                     alt="Photo du bateau de base">
                            @endif

                        </li>
                    </a>
                @endforeach
            </ul>

            {{ $bateaux->links() }}
        </div>

    </div>
@endsection
