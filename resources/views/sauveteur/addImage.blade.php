@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="post" enctype="multipart/form-data" action="{{route('sendPictureSauveteur')}}">
            @csrf
            <div class="form-group">
                <input type="hidden" value="{{$id}}" name="sauveteurId">
                <label for="addPhoto">Photos</label>
                <input type="file" class="form-control" id="addPhoto" aria-describedby="photo"
                       placeholder="" name="image">
                <small id="emailHelp" class="form-text text-muted">Format png jpg recommander.</small>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
@endsection
