@extends('template.body')

@section('title')
    <title> Genres </title>
@endsection

@section("mainContent")
    <div class="text-center fs-2 my-3 fw-bold">
        Genre List
    </div>
    <div class="container rounded" style="background-color: #191a1c;">
        <div class="d-flex flex-wrap justify-content-center m-3 p-3">
            @if (count($genres) == 0)
                <h3 class="p-3">No results, sorry</h3>
            @endif
            @foreach ($genres as $genre)
                <div class="card m-2" style="background-color: #323232; max-width: 240px;">
                    <a class="btn btn-success" href="{{ url("/genre/$genre->name") }}">
                        {{ $genre->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>

    </script>
@endsection
