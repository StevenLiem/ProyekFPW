@extends('template.body')

@section('title')
    <title> Home </title>
@endsection

@section("mainContent")

    {{-- <div class="container-fluid"> --}}

        {{-- Contoh ambil gambar dari storage --}}
        {{-- @php
            $manga_list = DB::table('manga')->get();
        @endphp
        @foreach ($manga_list as $manga)
            @php
                $images = Storage::disk('public')->files("manga/$manga->id"); // ambil semua gambar
                $cover = $images[0]; // ambil gambar pertama sebagai cover
            @endphp
            <div class="card mb-3 w-100" style="background-color: #191a1c">
                <div class="row g-0">
                    <div class="col-sm-2 text-center">
                        <img draggable="false" class="img-fluid" style="max-height: 300px" src="{{ asset("storage/$cover") }}" alt="">
                    </div>
                    <div class="col-sm-10">
                        <div class="card-body">
                            <h5 class="card-title">{{ $manga->title }}</h5>
                            <hr>
                            <p class="card-text">{{ $manga->synopsis }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach --}}

    {{-- </div> --}}
    <div class="container-fluid row row-cols-1 row-cols-md-5 g-4 mt-3">
        @php
            $manga_list = DB::table('manga')->get();
        @endphp
        @foreach ($manga_list as $manga)
            @php
                $images = Storage::disk('public')->files("manga/$manga->id"); // ambil semua gambar
                $cover = $images[0]; // ambil gambar pertama sebagai cover
            @endphp
            <div class="col">
                <div class="card h-100" style="background-color: #191a1c">
                    <a class="text-decoration-none text-light" href="{{ url("show/$manga->id") }}">
                        <img draggable="false" class="img-fluid" style="max-height: 300px" src="{{ asset("storage/$cover") }}" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $manga->title }}</h5>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
      </div>

    <script>

    </script>

@endsection
