<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #191a1c; border-bottom: 1px solid #158a52;">
        <div class="container-fluid">
            <div href="#" class="navbar-brand mx-3">
                <span style="color: #158a52; font-size: 18px; font-weight: bold;">ADMIN</span>
            </div>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <form>
                    <div class="navbar-nav">
                        <ul class="nav">
                            <li class="nav-list">
                                <a class="btn shadow-none" href="{{route('master')}}" >Manage Users</a>
                            </li>
                            <li class="nav-list">
                                <a class="btn shadow-none" href="{{route('masterManga')}}" >Manage Manga</a>
                            </li>
                            <li class="nav-list">
                                <a class="btn shadow-none" href="{{route('addManga')}}" >Add Manga</a>
                            </li>
                        </ul>
                    </div>
                </form>
                <div class="navbar-nav ms-auto">
                    <form class="form-inline my-2 my-lg-0">
                        <div class="input-group">
                            <a class="btn btn-outline-danger mx-2 rounded shadow-none" href="{{route('logout')}}" >Logout</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>
