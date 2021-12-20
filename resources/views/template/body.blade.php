<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        {{-- bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        {{-- jquery --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- font awesome -->
        <script src="https://kit.fontawesome.com/a223c9a82e.js" crossorigin="anonymous"></script>
        {{-- css --}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        {{-- <title>Document</title> --}}
        @yield('title')
        {{-- logo --}}
        <link rel="shortcut icon" href="{{ asset('peeporeadmanga.png') }}" type="image/x-icon">
    </head>
    <body class="bg-dark">

        @if (loggedIn() && Auth::user()->role == "admin")
            @include('template.adminHeader')
        @else
            @include('template.header')
        @endif

        @yield('mainContent')

    </body>
</html>
