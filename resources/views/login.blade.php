@extends('template.body')

@section('title')
    <title> Login </title>
@endsection

@section("mainContent")

    <div class="container h-100" style="margin-top: 50px">
        <div class="container-fluid h-100" style="display: flex; justify-content: center;">
            <form class="w-75" style="min-width: 200px; max-width: 400px;" action="/doLogin" method="POST">
            @csrf

                <h1 class="text-center" style="color: #088248">Login</h1>
                <div class="horLineGradient my-4"></div>

                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                        <span class="fa fa-exclamation-circle form-control-feedback"></span>
                        <span>{{ Session::get('error') }}</span>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="form-group has-icon mb-3">
                    <label for="loginUsername">Username</label><br>
                    <span class="fa fa-user form-control-feedback"></span>
                    <input type="text" name="username" id="loginUsername" class="form-control" value="{{ old('username') }}">
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group has-icon mb-5">
                    <label for="loginPass">Password</label><br>
                    <span class="fa fa-lock form-control-feedback"></span>
                    <input type="password" name="password" id="loginPass" class="form-control" value="">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-gradient-green text-white w-100 mb-5" style="border: 0" name="sub">
                    <span class="fa fa-sign-in-alt form-control-feedback mr-2"></span> Login
                </button>
                <div class="form-text mb-3">Don't have an account?
                    <a class="text-light text-decoration-none" href="{{route('register')}}" style="font-size: 16px;">Sign Up Now</a>
                </div>
            </form>
        </div>
    </div>

    <script>

    </script>

@endsection
