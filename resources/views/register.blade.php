@extends('template.body')

@section('title')
    <title> Register </title>
@endsection

@section("mainContent")

    <div class="container h-100" style="margin-top: 50px">
        <div class="container-fluid" style="display: flex; justify-content: center;">
            <form class="w-75" style="min-width: 200px; max-width: 400px;" action="/doRegister" method="POST">
            @csrf

                <h1 class="text-center" style="color: #088248">Register</h1>
                <div class="horLineGradient my-4"></div>

                @if (Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="fa fa-exclamation-circle form-control-feedback"></span>
                        <span>{{ Session::get('msg') }}</span>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="form-group has-icon mb-2">
                    <label for="">Email</label>
                    <span class="fa fa-envelope form-control-feedback"></span>
                    <input type="email" name="email" id="registerEmail" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group has-icon mb-2">
                    <label for="">Username</label>
                    <span class="fa fa-user form-control-feedback"></span>
                    <input type="text" name="username" id="" class="form-control" value="{{ old('username') }}">
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group has-icon mb-2">
                    <label for="">Password</label>
                    <span class="fa fa-lock form-control-feedback"></span>
                    <input type="password" name="password" id="registerPass" class="form-control">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group has-icon mb-5">
                    <label for="">Confirm Password</label>
                    <span class="fa fa-lock form-control-feedback"></span>
                    <input type="password" name="password_confirmation" id="registerConPass" class="form-control">
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-gradient-green text-white w-100 mb-4" style="border: 0" name="sub">
                    <span class="fa fa-sign-in-alt form-control-feedback mr-2"></span> Register
                </button>
                <div class="form-text mb-3">Already have an account?
                    <a class="text-light text-decoration-none" href="{{route('login')}}" style="font-size: 16px">Login Here</a>
                </div>
            </form>
        </div>
    </div>

    <script>

    </script>

@endsection
