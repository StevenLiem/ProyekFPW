@extends('template.body')

@section('title')
    <title> {{$manga->title}} </title>
@endsection

@section("mainContent")
    @php
        $images = Storage::disk('public')->files("manga/$manga->id");
        $cover = $images[0];
    @endphp
    <div class="container p-3 my-3 rounded" style="background-color: #191a1c">
        <div class="d-flex flex-row flex-wrap">
            <div class="d-flex flex-column m-3">
                <img draggable="false" class="img-fluid rounded" style="width: 24rem; max-width: 100%; height: auto; max-height: 400px" src="{{ asset("storage/$cover") }}" alt="{{ asset("storage/$cover") }}">
                @if (loggedIn())
                    <div id="btnFav">
                        @php
                            $result = DB::connection("conn_proyek")->table('user_favorite')
                                        ->where('id_user','=',Auth::user()->id)
                                        ->where('id_manga','=',$manga->id)->first();
                        @endphp
                        @if ($result != null)
                            <button class="btn btn-danger w-100" id="favButton">
                                <span class="far fa-heart"></span>
                                Unfavorite
                            </button>
                        @else
                            <button class="btn btn-success w-100" id="favButton">
                                <span class="fas fa-heart"></span>
                                Favorite
                            </button>
                        @endif
                    </div>
                @endif
            </div>
            <div class="d-flex flex-column m-3 overflow-auto">
                <div class="mb-1" id="title" style="font-size: 28px; font-weight: bold">
                    {{ $manga->title }}
                </div>
                <hr style="margin: 5px 0px">
                @php
                    $authorName = $manga->author->name;
                    $artistName = $manga->artist->name;
                @endphp
                <div class="my-1">
                    Author : <a href="{{ url("/author/$authorName") }}"><span class="badge bg-secondary">{{ $authorName }}</span></a>
                </div>
                <div class="my-1">
                    Artist : <a href="{{ url("/artist/$artistName") }}"><span class="badge bg-secondary">{{ $artistName }}</span></a>
                </div>
                <div class="my-1">
                    Genre :
                    @foreach ($manga->genres as $genre)
                        <a href="{{ url("/genre/$genre->name") }}"><span class="badge bg-secondary">{{ $genre->name }}</span></a>
                    @endforeach
                </div>
                <hr style="margin: 5px 0px">
                <div class="mt-2" id="synopsis" style="font-size: 12px">
                    <span class="mb-2" style="font-size: 14px; font-weight: bold">Synopsis</span><br>
                    {{ $manga->synopsis }}
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-3 p-3 rounded-3 row row-cols-1 row-cols-md-5" style="background-color: #191a1c; margin:auto; width:90%;">
        @php
            natsort($images);
            $images = array_values($images);
            $j = 0;
        @endphp
        @for ($i = 0; $i < sizeof($images); $i++)
            @php
                $cover = $images[$i];
                $j+=1;
            @endphp
            <div class="d-flex flex-wrap justify-content-center">
                <div class="card h-100 mt-2 mb-2" style="background-color: #191a1c">
                    <a class="text-decoration-none text-light" href="{{ url("show/$manga->id/$j") }}">
                        <img draggable="false" class="img-fluid rounded-3" style="max-height: 300px" src="{{ asset("storage/$cover") }}" alt="{{ $cover }}">
                    </a>
                </div>
            </div>
        @endfor
    </div>

    <div class="container p-3 mb-2 rounded text-center" style="background-color: #191a1c">
        <h5><i class="fas fa-comments"></i> Post a Comment</h5>
        <textarea class="form-control my-3 mx-auto w-75" style="resize: none" name="comment" id="comment" cols="30" rows="3"></textarea>
        @if (loggedIn())
            <button class="btn btn-success" id="btnSubmitComment"><i class="fas fa-comment"></i> submit comment</button>
        @else
            <a href="{{ url("login") }}" class="btn btn-primary"><i class="fas fa-comment"></i> Login to Post Comment</a>
        @endif
    </div>
    <div class="container mb-3 rounded" id="comments" style="background-color: #191a1c">
        @if ($manga->comments->count() == 0)
            <h3 class="text-center p-3">No Comment Yet</h3>
        @else
            @foreach ($manga->comments as $comment)
                <div class="comment p-2">
                    <div>
                        <span class="fw-bold me-1">{{ $comment->owner->username }}</span>
                        <span class="text-muted ">{{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</span>
                    </div>
                    <div>{{ $comment->content }}</div>
                </div>
            @endforeach
        @endif

    </div>

    <script>
        $('#btnSubmitComment').on('click', function(){
            if ($('#comment').val() !== ""){
                let comment = $('#comment').val();
                $.ajax({
                    url: window.location.pathname+'/addComment',
                    method: 'POST',
                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        comment: comment
                    },
                    success: function(data){
                        console.log(data);
                        $('#comment').val("");
                        $("#comments").load(window.location.href + " #comments");
                    },
                    error: function(data){
                        console.log(data);
                    }
                })
            }
        });

        $('#btnFav').on('click', function(){
            $.ajax({
                url: window.location.pathname+'/addFavorite',
                method: 'POST',
                data: {
                    _token: '<?php echo csrf_token() ?>'
                },
                success: function(data){
                    console.log(data);
                    $("#btnFav").load(window.location.href + " #btnFav");
                },
                error: function(data){
                    console.log(data);
                }
            })
        });
    </script>
@endsection
