<div class="relative-top">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #191a1c; border-bottom: 1px solid #158a52;">
        <div class="container-fluid">
            <a href="{{route('home')}}" class="navbar-brand mx-3">
                <img src="{{ asset('peeporeadmanga.png') }}" alt="" style="width: 40px; height: 32px;">
                <span style="color: #158a52; font-size: 18px; font-weight: bold;">PepeManga</span>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <ul class="nav">
                        <li class="nav-list">
                            <a class="btn shadow-none" href="{{route('random')}}" >Random</a>
                        </li>
                        <li class="nav-list">
                            <a class="btn shadow-none" href="{{route('author')}}" >Author</a>
                        </li>
                        <li class="nav-list">
                            <a class="btn shadow-none" href="{{route('artist')}}" >Artist</a>
                        </li>
                        <li class="nav-list">
                            <a class="btn shadow-none" href="{{route('genre')}}" >Genre</a>
                        </li>
                        <li class="nav-list">
                            <a class="btn shadow-none" href="{{route('favorite')}}" >Favorite</a>
                        </li>
                        @if(loggedIn())
                            @if(Auth::user()->privilege == "premium")
                                <li class="nav-list">
                                    <a class="btn shadow-none" href="{{route('notify')}}">History</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
                <div class="navbar-nav ms-auto">
                    <form class="form-inline my-2 my-lg-0" action="/search" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control shadow-none" placeholder="Search Here" name="title" value="{{ Session::get('search') }}" required>
                            <button class="btn btn-success rounded shadow-none" type="submit"><i class="fa fa-search"></i></button>
                            @if (loggedIn())
                                <a class="btn btn-outline-success mx-2 rounded shadow-none" href="{{ url('user/profile') }}" >
                                    <i class="fas fa-user-circle"></i> {{Auth::user()->username}}
                                    @if(Auth::user()->privilege == "premium")
                                        <i class="fas fa-crown"></i>
                                    @endif
                                </a>
                                <a class="btn btn-outline-danger rounded shadow-none" href="{{ url('logout') }}" >Logout</a>
                            @else
                                <a class="btn btn-outline-success mx-2 rounded shadow-none" href="{{route('login')}}" >Sign In</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>
