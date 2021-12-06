@extends('template.body')

@section('title')
    <title> Detail </title>
@endsection

@section("mainContent")
    <div class="container mt-5 mb-3 p-3 rounded-3" style="background-color: #191a1c; margin:auto; width:90%;">
        @php
            $images = Storage::disk('public')->files("manga/$manga->id");
            $cover = $images[0];
        @endphp
        <div class="card" style="background-color: #191a1c;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img draggable="false" class="img-fluid" style="margin-left:100px; max-height: 500px;" src="{{ asset("storage/$cover") }}" alt="">
                </div>
                <div class="col-md-8">
                    <div class="card-body" style="margin-left:200px">
                        <h5 class="card-title mb-5">{{ $manga->title }}</h5>
                        <p class="card-text">Author : {{ $manga->author->name }}</p>
                        <p class="card-text">Artist : {{ $manga->artist->name }}</p>
                        <p class="card-text">Synopsis : {{ $manga->synopsis }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5 p-3 rounded-3 row row-cols-1 row-cols-md-5" style="background-color: #191a1c; margin:auto; width:90%;">
        @for ($i = 1; $i < sizeof($images); $i++)
            @php
                $images = Storage::disk('public')->files("manga/$manga->id");
                $cover = $images[$i];
            @endphp
            <div class="col">
                <div class="card h-100" style="background-color: #191a1c">
                    <img draggable="false" class="img-fluid" style="max-height: 300px" src="{{ asset("storage/$cover") }}" alt="">
                </div>
            </div>
        @endfor
    </div>
@endsection
