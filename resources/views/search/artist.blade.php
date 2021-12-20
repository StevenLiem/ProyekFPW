@extends('template.body')

@section('title')
    <title> Artist </title>
@endsection

@section("mainContent")
    <div class="text-center fs-2 my-3 fw-bold">
        Artist List
    </div>
    <div class="container rounded" style="background-color: #191a1c;">
        <div class="d-flex flex-wrap justify-content-center m-3">
            @if (count($artists) == 0)
                <h3 class="p-3">No results, sorry</h3>
            @endif
            @foreach ($artists as $artist)
                <div class="card m-3" style="background-color: #323232; max-width: 240px;">
                    <a class="btn btn-success" href="{{ url("/artist/$artist->name") }}">
                        {{ $artist->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <script>

    </script>
@endsection
