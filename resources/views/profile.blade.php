@extends('template')
@section('title', 'Mi Cuenta')
@section('main-content')


<main class="container-fluid">
    <aside class="profile-nav col-12 col-lg-4 z-depth-1-half">
        <div class="profile-img-wrapper text-center bg-crema py-4">
            <img src="/img/profiles/profile-default.jpeg" alt="avatar" class="rounded-circle col-6">
            <h2 class="pt-3">{{Auth::user()->name}}</h2>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a class="row profile-list-link">
                    <i class="col-1 fas fa-map-marker-alt profile-nav-list-icon"></i>
                    <h4 class="col-8 profile-nav-list-text">Direcciones</h4>
                    <i class="col-2 fas fa-chevron-right profile-nav-list-arrow"></i>
                </a>
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
                    <i class="col-1 fas fa-map-marker-alt profile-nav-list-icon"></i>
                    <h4 class="col-8 profile-nav-list-text">Direcciones</h4>
                    <i class="col-2 fas fa-chevron-right profile-nav-list-arrow"></i>
                </a>
            </li>
        </ul>
    </aside>
</main>

@endsection