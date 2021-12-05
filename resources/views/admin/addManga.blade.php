@extends('template.body')

@section('title')
    <title> Master </title>
@endsection

@section("mainContent")

<div class="container" style="margin-top: 100px">
    <form action="/admin/addNewManga" method="post" class="w-100" enctype="multipart/form-data">
    @csrf

        <div class="rounded p-3 mb-3 w-100" style="background-color: #191a1c">
            <h3><span class="fa fa-upload me-2 mb-3"></span>Upload Manga
                <input type="button" value="Upload Guidelines" style="float: right;" class="btn btn-info" id="btnGuide">
            </h3>

            <div class="card mb-3 p-3 bg-dark" id="guide" style="display: none;">
                <b>Please refer to the guidelines</b>
                <ul>
                    <li>Archive file type must be .zip</li>
                    <li>No password protected archives.</li>
                    <li>Put all images inside zip. The archive cannot have directories.</li>
                    <li>Image must be png or jpg.</li>
                    <li>Image numbers must be in sequence. Do not zeropad image numbers. (01, 02, etc).</li>
                </ul>
            </div>

            @if (Session::has('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="fa fa-exclamation-circle form-control-feedback"></span>
                    <span>{{ Session::get('msg') }}</span>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right"><strong>Title</strong></label>
                <div class="col-sm-12">
                    <input type="text" name="title" id="title" class="form-control bg-dark text-light border-0" value="{{ old('title') }}" required>
                </div>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right"><strong>Author</strong></label>
                <div class="col-sm-12">
                    @php
                        $author_list = DB::table('author')->get();
                    @endphp
                    <select name="author" class="form-select bg-dark text-light border-0" required>
                        <option value="" disabled selected>Select Author</option>
                        @foreach ($author_list as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right"><strong>Artist</strong></label>
                <div class="col-sm-12">
                    @php
                        $artist_list = DB::table('artist')->get();
                    @endphp
                    <select name="artist" class="form-select bg-dark text-light border-0" required>
                        <option value="" disabled selected>Select Artist</option>
                        @foreach ($artist_list as $artist)
                            <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="">
                <label for="" class="col-sm-2 col-form-label text-right"><strong>Genres</strong></label>
                <br>
                <div class="d-flex flex-wrap col-sm-12">
                    @php
                        $genre_list = DB::table('genre')->get();
                    @endphp
                    @foreach ($genre_list as $genre)
                        <div class='form-check-inline mb-3'>
                            <input type="checkbox" class="btn-check" id="btncheck{{ $genre->id }}" name="genre[]" value="{{ $genre->id }}">
                            <label class="btn btn-outline-success" for="btncheck{{ $genre->id }}" style="height: 30px; font-size: 12px">
                                {{ $genre->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('genre')
                    <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label text-right"><strong>Synopsis</strong></label>
                <div class="col-sm-12">
                    <textarea name="synopsis" id="synopsis" cols="10" rows="5" class="form-control bg-dark text-light border-0" required></textarea>
                </div>
            </div>

            <div class="form-group row" id="submitzip">
                <label for="" class="col-sm-2 col-form-label text-right"><strong>File (.zip only)</strong></label>
                <div class="col-sm-12">
                    <input class="form-control bg-dark text-white border-0" type="file" name="mangaFile" accept=".zip" required>
                </div>
                @error('mangaFile')
                    <small class="text-danger fw-bold my-2">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-4 text-center" id="">
                <div class="col-sm-12">
                    <button type="submit" name="addManga" class="btn btn-gradient-green w-50" style="color: white;">
                        <span class="fa fa-plus-circle me-2"></span>Add Manga
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
    $(document).ready(function() {
        $("#btnGuide").click(function() {
            $("#guide").toggle();
        });
    });
</script>

@endsection
