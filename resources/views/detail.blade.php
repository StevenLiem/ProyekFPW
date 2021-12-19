@extends('template.body')

@section('title')
    <title> Detail </title>
@endsection

@section("mainContent")
    <div class="container mt-5 mb-3 p-3 rounded-3" style="background-color: #191a1c; margin:auto; width:90%;">
        @php
            $images = Storage::disk('public')->files("manga/$manga->id");
            $cover = $images[0];
            $genreString = "";
            $ctr = 1;
        @endphp
        @foreach ($manga->genres as $genre)
            @if($ctr == $manga->genres->count())
                @php $genreString .= $genre->name; @endphp
            @else
                @php $genreString .= $genre->name . ", "; $ctr += 1; @endphp
            @endif
        @endforeach
        <div class="card" style="background-color: #191a1c;">
            <div class="row g-0">
                <div class="col-md-4">
                    <a class="text-decoration-none text-light" href="{{ url("show/$manga->id/1") }}">
                        <img draggable="false" class="img-fluid rounded-3" style="margin-left:100px; max-height: 500px;" src="{{ asset("storage/$cover") }}" alt="{{ $cover }}">
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card-body" style="margin-left:200px">
                        <h5 class="card-title mb-5">{{ $manga->title }}</h5>
                        <p class="card-text">Author : {{ $manga->author->name }}</p>
                        <p class="card-text">Artist : {{ $manga->artist->name }}</p>
                        <p class="card-text">Genre : {{ $genreString }}</p>
                        <p class="card-text">Synopsis : {{ $manga->synopsis }}</p>
                    </div>
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
            <div class="col">
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
    </script>
@endsection
