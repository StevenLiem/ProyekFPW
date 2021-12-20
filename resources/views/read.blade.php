@extends('template.body')

@section('title')
    <title> {{$manga->title}} </title>
@endsection

@section("mainContent")
    <div class="container-fluid mt-2 mb-4">
        @php
            $images = Storage::disk('public')->files("manga/$manga->id");
            natsort($images);
            $images = array_values($images);
        @endphp
        <div class="d-flex justify-content-between mb-2">
            <div>
                <button class="btn btn-success rounded shadow-none">
                    <a class="text-decoration-none text-light" href="{{ url("show/$manga->id") }}">
                        <div><i class="fa fa-reply"></i></div>
                    </a>
                </button>
            </div>
            <div>
                @php $next = $page+1; $back = $page-1; $start = 1; $end = sizeof($images); @endphp
                @if($page > 1)
                    <button class="btn btn-success rounded shadow-none">
                        <a class="text-decoration-none text-light" href="{{ url("show/$manga->id/$start") }}">
                            <div><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></div>
                        </a>
                    </button>
                    <button class="btn btn-success rounded shadow-none">
                        <a class="text-decoration-none text-light" href="{{ url("show/$manga->id/$back") }}">
                            <div><i class="fa fa-chevron-left"></i></div>
                        </a>
                    </button>
                @endif
                <span>{{ $page }} of {{ ($manga->total_page) }}</span>
                @if($page < sizeof($images))
                    <button class="btn btn-success rounded shadow-none">
                        <a class="text-decoration-none text-light" href="{{ url("show/$manga->id/$next") }}">
                            <div><i class="fa fa-chevron-right"></i></div>
                        </a>
                    </button>
                    <button class="btn btn-success rounded shadow-none">
                        <a class="text-decoration-none text-light" href="{{ url("show/$manga->id/$end") }}">
                            <div><i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></div>
                        </a>
                    </button>
                @endif
            </div>
            <div></div>
        </div>
        @for ($i = 0; $i < sizeof($images); $i++)
            @php
                $cover = $images[$i];
            @endphp
            @if($i == $page-1)
                @if($i == sizeof($images)-1)
                    <a class="text-decoration-none text-light" href="{{ url("show/$manga->id") }}">
                        <img draggable="false" class="img-fluid rounded-3 d-block mx-auto w-100" src="{{ asset("storage/$cover") }}" alt="{{ $cover }}" style="max-width:800px">
                    </a>
                @else
                    <a class="text-decoration-none text-light" href="{{ url("show/$manga->id/$next") }}">
                        <img draggable="false" class="img-fluid rounded-3 d-block mx-auto w-100" src="{{ asset("storage/$cover") }}" alt="{{ $cover }}" style="max-width:800px">
                    </a>
                @endif
            @endif
        @endfor
    </div>
@endsection


