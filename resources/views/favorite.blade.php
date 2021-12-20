@extends('template.body')

@section('title')
    <title> Favorite </title>
@endsection

@section("mainContent")
    <div class="text-center fs-2 my-3">
        <span class="fas fa-heart" style="color: hotpink"></span> My Favorite
    </div>
    <div class="container rounded" style="background-color: #191a1c;">
        <div class="d-flex flex-wrap justify-content-center m-3">
            @if (count(Auth::user()->favorites) == 0)
                <h3 class="p-3">Your favorite is empty</h3>
            @endif
            @foreach (Auth::user()->favorites as $manga)
                @php
                    $images = Storage::disk('public')->files("manga/$manga->id");
                    $cover = $images[0];
                @endphp
                <div class="card m-2" style="background-color: #323232; max-width: 240px;">
                    <a class="text-decoration-none text-light" href="{{ url("/show/$manga->id") }}">
                        <img draggable="false" class="img-fluid" style="max-width: 100%; height: auto" src="{{ asset("storage/$cover") }}" alt="">
                        <div class="card-body text-center">
                            <span class="card-title">{{ $manga->title }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>

    </script>
@endsection

