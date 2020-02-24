@extends('template')
@section('title', 'Mi Cuenta')
@section('main-content')


<div class="container-fluid">
    <div class="row">
        <aside class="profile-nav col-12 col-md-4 col-lg-4 z-depth-1-half">
            <div class="profile-img-wrapper text-center bg-crema py-4">
                <img src="/img/profiles/profile-default.jpeg" alt="avatar" class="rounded-circle col-6">
                <h2 class="pt-3">{{Auth::user()->name}}</h2>
            </div>

            <ul class="list-group list-group-flush" id="accordion">
                <li class="list-group-item">
                    <a class="row profile-list-link" data-toggle="collapse" data-target="#direccionCollapse" aria-expanded="true" aria-controls="direccionCollapse">
                        <i class="col-1 fas fa-map-marker-alt profile-nav-list-icon"></i>
                        <h4 class="col-8 profile-nav-list-text">Direcciones</h4>
                        <i class="col-2 fas fa-chevron-right profile-nav-list-arrow"></i>
                    </a>
                    <div id="direccionCollapse" class="collapse d-md-none" aria-labelledby="headingOne" data-parent="#accordion">
                    <hr>    
                        <div class="card">
                            @yield('content')
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. At nostrum dolores sapiente ipsum mollitia laudantium unde possimus soluta ipsa est.
                        </div>
                    </div>

                </li>
                <li class="list-group-item">
                    <a class="row profile-list-link">
                        <i class="col-1 fas fa-file-invoice-dollar profile-nav-list-icon"></i>
                        <h4 class="col-8 profile-nav-list-text">Órdenes</h4>
                        <i class="col-2 fas fa-chevron-right profile-nav-list-arrow"></i>
                    </a>
                </li>
                <li class="list-group-item">
                    <a class="row profile-list-link">
                        <i class="col-1 far fa-heart profile-nav-list-icon"></i>
                        <h4 class="col-8 profile-nav-list-text">Favoritos</h4>
                        <i class="col-2 fas fa-chevron-right profile-nav-list-arrow"></i>
                    </a>
                </li>
            </ul>
        </aside>

        <main class="d-none d-md-block">
            <div class="container">
                @yield('content')
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, architecto? Eveniet quis, dolorum animi explicabo nihil rerum voluptate id sequi.
            </div>
        </main>

    </div>
</div>

@endsection