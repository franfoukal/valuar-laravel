@extends('template')
@section('title', 'Mi Cuenta')
@section('main-content')
<main class="container-fluid" id="profile">
    <span class="d-none is-mobile"></span>
    <div class="row m-0 profile-wrapper">
        <aside class="profile-nav col-12 col-md-5 col-lg-4">
            <div class="profile-img-wrapper text-center text-md-left">
                <div class="col-9 col-md-8 col-lg-6 profile-img-wrap bd-crema rounded-circle shadow">
                    <img src="{{isset(Auth::user()->photo['path'])? '/storage/profile/' . Auth::user()->photo['path'] : '/img/profile/profile-default.jpeg'}}" alt="" class="h-100">
                    @yield('change-avatar')
                </div>
                <!-- <img src="{{isset(Auth::user()->photo['path'])? '/storage/' . Auth::user()->photo['path'] : '/img/profile/profile-default.jpeg'}}" alt="" class="profile-img shadow p-0 rounded-circle col-9 col-md-8 col-lg-6 bd-crema"> -->
            </div>
            <div class="row profile-header">
                <h1 class="profile-name">{{ucfirst(Auth::user()->name)}}</h1>
                <a href="/profile/user" class="profile-edit-icon"><i class="fas fa-cog verde"></i></a>
            </div>
            <h5 class="profile-email">{{Auth::user()->email}}</h5>

            <nav>
                <ul class="clearlist profile-list">
                    <li class="profile-list-item"><a href="#">Órdenes</a></li>
                    <li class="profile-list-item"><a href="/profile/favs">Favoritos</a></li>
                    <li class="profile-list-item"><a href="/profile/address">Direcciones</a></li>
                    <!-- <li class="profile-list-item"><a href="/profile/address-aut">Direcciones <small>google</small></a></li> -->
                </ul>
            </nav>
        </aside>

        <div class="profile-main col-md-7 col-lg-8 my-4">
            @yield('section')
        </div>
    </div>

</main>

@endsection