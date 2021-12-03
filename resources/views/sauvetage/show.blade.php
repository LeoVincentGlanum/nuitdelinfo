@extends('layouts.app')

@section('content')
   <div class="container">
        <div>
        @csrf
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <a class="btn btn-danger" href="{{route('sauvetage')}}">Retour à la liste</a>
            @auth
                <a class="btn btn-warning" href="{{route('editSauvetage',['id' => $sauvetage->id])}}">Editer le
                    sauvetage</a>
                <a class="btn btn-success" href="{{route('addImageSauvetage',['id' => $sauvetage->id])}}">Ajouter une image</a>
            @endif

            <div class="row mt-5" >
                <div class="col">
                    Titre :
                </div>
                <div class="col">
                    {{$sauvetage->titre}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Date :
                </div>
                <div class="col">
                    {{$sauvetage->date}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Nombre de personnes sauvées  :
                </div>
                <div class="col">
                    {{$sauvetage->nbPersonneSauve}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Nombre de personnes décèdées :
                </div>
                <div class="col">
                    {{$sauvetage->nbPersonneDecede}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    Durée sortie en mer :
                </div>
                <div class="col">
                    {!! $sauvetage->dureeSortiEnMer !!}
                </div>
            </div>

            <div class="row">
                <div class="col">
                    Description :
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {!! $sauvetage->description !!}
                </div>
            </div>

            <div class="row" data-masonry="{&quot;percentPosition&quot;: true }">

            @foreach($sauvetage->photos as $picture)
                <div id="photo_{{$picture->id}}" class="col-sm-6 col-lg-4 mb-2 mt-2 display-flex-image">
                    <img data-id="{{$picture->id}}" data-src="{{ asset('storage/sauvetage/'.$picture->url)}}" src="{{ asset('storage/sauvetage/'.$picture->url)}}" class="img-fluid deletedImage" alt="img">
                </div>
            @endforeach
    </div>


             <div class="my-5">
            <H3>Témoignage </H3>

                 <div class="my-5">
            <H3>Témoignage </H3>

            @foreach($temoignages as $temoignage)
            <div>
                <div class="row">
                    <div class="col">Pseudo :</div>
                    <div class="col">{{$temoignage->pseudo}}</div>
                </div>
                <div class="row">
                    <div class="col">
                        Témoignage :
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{$temoignage->temoignage}}
                    </div>
                </div>
            </div>
                <hr>
            @endforeach

            <div>

            <div>
                <a href="{{route('addTemoignage',['type' => 3,'id' => $sauvetage->id])}}" class="btn btn-success">Ajouter
                    un témoignage</a>
            </div>

        </div>


        </div>
    </div>


    <!-- Button trigger modal -->
<button type="button" id="deleteImage" class="btn btn-primary d-none" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Attention ! </h5>
        <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez vous supprimer cette photo ?
          <img id="imagetoDelete" src="" alt="image a supprimer" style="max-width: 100px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="valideSupp">Supprimer</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
    @auth
    <script>
        $( document ).ready(function() {
          $(".deletedImage").on("click",function (){
              let id = this.dataset.id;
              let src = this.dataset.src;
              $("#imagetoDelete").removeAttr("src")
              $("#imagetoDelete").attr("src",src)
              $("#deleteImage").click()
              $("#valideSupp").removeAttr('data-id')
              $("#valideSupp").attr('data-id',id)
          })

          $("#valideSupp").on("click",function (){
              let id = this.dataset.id
              $.ajax(
					    {
						    type: "POST",
						    url: "/sauvetage/deleteImage",
						    data: {
                                id : id
                            },
						    headers: {
							    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						    },
						    success: function (result) {
                                if (result === "success"){
                                    $("#photo_"+id).remove();
                                    $("#closeModal").click();
                                }
						    }
					    }
				    );
          })
});
    </script>
    @endif
@endsection
