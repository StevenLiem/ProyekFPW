@extends('template.body')

@section('title')
    <title> Home </title>
@endsection

@section("mainContent")
    <div class="container-fluid row row-cols-1 row-cols-md-5 g-4 mt-3 mb-5" style="margin:auto;">
        @foreach ($manga_list as $manga)
            @php
                $images = Storage::disk('public')->files("manga/$manga->id"); // ambil semua gambar
                $cover = $images[0]; // ambil gambar pertama sebagai cover
            @endphp
            <div class="col">
                <div class="card h-100 border-0" style="background-color: #191a1c">
                    <a class="text-decoration-none text-light" href="{{ url("show/$manga->id") }}">
                        <img draggable="false" class="img-fluid rounded-top" style="max-height: 300px; width:fit-content;" src="{{ asset("storage/$cover") }}" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $manga->title }}</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
