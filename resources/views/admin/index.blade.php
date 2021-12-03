@extends('layouts.app')

@section('content')
    <div class="container">

        <h3>Espace Administrateur</h3>


        @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

        @if(session()->has('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session()->get('warning') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


        <div>
            {{count($temoignages)}} témoignage en attente en attente d'analyse
        </div>

        <ul class="list-group">
            @foreach($temoignages as $temoignage)
                <li style="    display: flex;
    justify-content: space-between;
    align-items: center;
    align-content: center;" class="list-group-item">Témoignage sur le {{$temoignage->getTypeString()}}  {{$temoignage->getNameCible()}} par {{$temoignage->pseudo}} ({{$temoignage->email}}) <div><a href="{{route('showAdmin',['id' => $temoignage->id])}}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
</svg>&nbsp;Plus d'information</a></div> </li>
            @endforeach
        </ul>


    </div>



@endsection
