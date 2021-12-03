@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                Pseudo :
            </div>
            <div class="col">
                {{$temoignage->pseudo}}
            </div>
        </div>
        <div class="row">
            <div class="col">
                Type :
            </div>
            <div class="col">
                {{$temoignage->getTypeString()}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                Sujet :
            </div>
            <div class="col">
                {{$temoignage->getNameCible()}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                Email :
            </div>
            <div class="col">
                {{$temoignage->email}}
            </div>
        </div>

        <div class="row">
            <div class="col">
                Lien des documents :
            </div>
            <div class="col">
                <a href="{{$temoignage->link}}" target="_blank">{{$temoignage->link}}</a>
            </div>
        </div>


        <div class="row">
            <div class="col">
                Temoignage :
            </div>
            <div class="col">
                <div class="form-group">
                    <p  style="height: 20vh;" class="form-control">{{$temoignage->temoignage}}</p>
                </div>

            </div>
        </div>


        <div style="text-align: center;">
            <a href="{{route('accepterTemoignageAdmin',['id' => $temoignage->id])}}"  class="btn btn-success">Accepter le témoignage</a>
            <a href="" class="btn btn-warning">Editer</a>
            <a href="{{route('refuserTemoignageAdmin',['id' => $temoignage->id])}}" class="btn btn-danger">Refuser le témoignage</a>
            <a href="{{route('indexAdmin')}}" class="btn btn-secondary">Retour</a>
        </div>


    </div>
@endsection
