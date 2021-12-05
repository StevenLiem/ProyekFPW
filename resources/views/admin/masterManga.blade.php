@extends('template.body')

@section('title')
    <title> Master </title>
@endsection

@section("mainContent")

<div class="container" style="margin-top: 100px">
    <nav>
        <div class="nav nav-tabs d-flex border-0" id="nav-tab" role="tablist">
            <button class="nav-link flex-fill border-0 active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Manga</button>
            <button class="nav-link flex-fill border-0" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Author & Artist</button>
            <button class="nav-link flex-fill border-0" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Genre</button>
        </div>
    </nav>

    <div class="tab-content p-3 rounded" id="nav-tabContent" style="background-color: #191a1c">
        {{-- MANGA --}}
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <table class="table table-dark table-striped table-hover text-center">
                <thead>
                    <tr>
                        <th class="col-md-3">Title</th>
                        <th class="col-md-3">Artist & Author</th>
                        <th class="col-md-3">Genre</th>
                        <th class="col-md-1">Total Pages</th>
                        <th class="col-md-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $genre = DB::table('genre')->get();
                    @endphp
                    @foreach ($manga_list as $manga)
                        <tr>
                            <td>{{ $manga->title }}</td>

                            @if ($manga->author->name == $manga->artist->name)
                                <td>{{ $manga->artist->name }}</td>
                            @else
                                <td>{{ $manga->artist->name . ' & ' . $manga->author->name}}</td>
                            @endif

                            @php
                                $genreString = "";
                            @endphp
                            @foreach ($manga->genres as $genre)
                                @php
                                    $genreString .= $genre->name . ', ';
                                @endphp
                            @endforeach
                            <td>{{ substr($genreString, 0, -2) }}</td>

                            <td>{{ $manga->total_page }}</td>

                            <td id="actionButton">
                                @if ($manga->trashed())
                                    <a href="{{ url("admin/deleteManga/$manga->id") }}" class="btn btn-success">Restore</a>
                                @else
                                    <a href="{{ url("admin/deleteManga/$manga->id") }}" class="btn btn-danger">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- AUTHOR & ARTIST --}}
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <h3>Author</h3>
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalAdd" data-bs-mode="Add Author">
                Add Author
            </button>
            <table class="table table-dark table-striped table-hover text-center" id="tableAuthor">
                @php
                    $author = DB::table('author')->get();
                @endphp
                <thead>
                    <tr>
                        <th class="col-md-3">Name</th>
                        <th class="col-md-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($author as $data)
                        <tr>
                            <td>{{ $data->name}}</td>
                            <td id="actionButton">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate" data-bs-mode="Edit Author" data-bs-id="{{$data->id}}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Artist</h3>
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalAdd" data-bs-mode="Add Artist">
                Add Artist
            </button>
            <table class="table table-dark table-striped table-hover text-center" id="tableArtist">
                @php
                    $artist = DB::table('artist')->get();
                @endphp
                <thead>
                    <tr>
                        <th class="col-md-3">Name</th>
                        <th class="col-md-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artist as $data)
                        <tr>
                            <td>{{ $data->name}}</td>
                            <td id="actionButton">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate" data-bs-mode="Edit Artist" data-bs-id="{{$data->id}}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- GENRE --}}
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalAdd" data-bs-mode="Add Genre">
                Add Genre
            </button>
            <table class="table table-dark table-striped table-hover text-center" id="tableGenre">
                <thead>
                    <tr>
                        <th class="col-md-3">Name</th>
                        <th class="col-md-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $genre = DB::table('genre')->get();
                    @endphp
                    @foreach ($genre as $data)
                        <tr>
                            <td>{{ $data->name}}</td>
                            <td id="actionButton">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUpdate" data-bs-mode="Edit Genre" data-bs-id="{{$data->id}}">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="col-form-label" id="labelName">Name:</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                        <div class="text-danger fw-bold mt-2" id="error" style="display: none;">Name Already Exist</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-submit" >Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="col-form-label" id="labelName">Name:</label>
                        <input type="text" class="form-control" name="updateName" id="updateName" required>
                        <div class="text-danger fw-bold mt-2" id="errorUpdate" style="display: none;">Name Already Exist</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-update" >Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var mode, id;
    var modalAdd = document.getElementById('modalAdd');
    modalAdd.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        mode = button.getAttribute('data-bs-mode');

        var modalTitle = modalAdd.querySelector('.modal-title');
        var modalBodyName = modalAdd.querySelector('.modal-body #name');

        modalTitle.textContent = mode;
        modalBodyName.value = '';
    });

    var modalUpdate = document.getElementById('modalUpdate');
    modalUpdate.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        id = button.getAttribute('data-bs-id');
        mode = button.getAttribute('data-bs-mode');

        var modalTitle = modalUpdate.querySelector('.modal-title');
        var modalBodyName = modalUpdate.querySelector('.modal-body #updateName');

        modalTitle.textContent = mode;
        modalBodyName.value = '';
    });

    $('#modalAdd').on('hide.bs.modal', function () {
        $("#error").hide();
    });

    $('#modalUpdate').on('hide.bs.modal', function () {
        $("#errorUpdate").hide();
    });

    $('.btn-submit').on('click', function(){
        if ($('#name').val() !== ""){
            var url = 'add' + mode.substring(4);
            let name = $('#name').val();
            $.ajax({
                url: '/admin/'+url,
                method: 'POST',
                data: {
                    _token: '<?php echo csrf_token() ?>',
                    name: name
                },
                success: function(data){
                    console.log(data);
                    $("#modalAdd").modal('hide');
                    $("#table"+mode.substring(4)).load(window.location.href + " #table"+mode.substring(4) );
                },
                error: function(data){
                    console.log(data);
                    $("#error").show();
                }
            })
        }
    });

    $('.btn-update').on('click', function(){
        if ($('#updateName').val() != ""){
            var url = 'update' + mode.substring(5) + '/' + id;
            let name = $('#updateName').val();
            $.ajax({
                url: '/admin/'+url,
                method: 'POST',
                data: {
                    _token: '<?php echo csrf_token() ?>',
                    name: name
                },
                success: function(data){
                    console.log(data);
                    $("#modalUpdate").modal('hide');
                    $("#table"+mode.substring(5)).load(window.location.href + " #table"+mode.substring(5) );
                },
                error: function(data){
                    console.log(data);
                    $("#errorUpdate").show();
                }
            })
        }
    });
</script>

@endsection
