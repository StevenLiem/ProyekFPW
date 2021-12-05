@extends('template.body')

@section('title')
    <title> Master </title>
@endsection

@section("mainContent")

<div class="container" style="margin-top: 100px">
    <h2>Manage Users</h2>
    <div class="container-fluid p-2" style="background-color: #191a1c">
        <table class="table table-dark table-striped table-hover text-center">
            <thead>
                <tr>
                    <th class="col-md-3">Email</th>
                    <th class="col-md-3">Username</th>
                    <th class="col-md-3">Privilege</th>
                    <th class="col-md-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users_data as $user)
                    <tr>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->privilege }}</td>
                        <td id="actionButton">
                            @if ($user->status == 'active')
                                <a class="btn btn-danger" href="{{ url("admin/banUser/$user->id") }}">Ban</a>
                            @else
                                <a class="btn btn-success" href="{{ url("admin/banUser/$user->id") }}">Unban</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
