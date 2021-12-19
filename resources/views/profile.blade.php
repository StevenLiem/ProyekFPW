@extends('template.body')

@section('title')
    <title> Profile </title>
@endsection

@section("mainContent")
    <div class="container mt-5 mb-3 p-3 rounded-3" style="background-color: #191a1c; margin:auto; width:90%;">
        <form action="{{url('user/update')}}" method="POST">
            @csrf
            <h1>My Profile</h1>
            <input type="hidden" name="id" value="{{Auth::user()->id}}">

            @if (Session::has('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="fa fa-exclamation-circle form-control-feedback"></span>
                    <span>{{ Session::get('msg') }}</span>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <label for="updateUsername">Username</label>
            <input type="text" name="username" id="updateUsername" class="form-control" value="{{Auth::user()->username}}">
            @error('username')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <label for="updateEmail">Email</label>
            <input type="text" name="email" id="updateEmail" class="form-control" value="{{Auth::user()->email}}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <label for="updatePassword">Password</label><br>
            <input type="password" name="password" id="updatePassword" class="form-control" placeholder="New Password" style="width: 45%; float: left;" value="">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <input type="password" name="password_confirmation" id="updateConfirm" class="form-control" placeholder="Confirm New Password" style="width: 45%; float: left; margin-left: 10%;" value="">
            @error('confirm')
                <small class="text-danger">{{ $message }}</small>
            @enderror <br><br>
            <button type="submit" class="btn btn-gradient-green text-white w-100 mb-5" style="border: 0" name="sub">
                {{-- <span class="fa fa-update-alt form-control-feedback mr-2"></span> Update --}}
                Update
            </button>
        </form>
    </div>

    <script>

    </script>

@endsection
