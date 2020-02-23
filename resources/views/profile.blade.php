@extends('template')
@section('title', 'Mi Cuenta')
@section('main-content')


<!--Main-->
<div class="container">
    <div class="row d-flex py-5">
        
        <!--Info del perfil-->
        <div class="col-12 col-lg-12 my-3">
            <div class="row d-flex pt-4 my-2">            
                <div class="col-12 col-md-6 col-lg-4 text-center">
                    <h1>
                        <i class="fas fa-user-circle img-profile noche"></i>
                    </h1>
                </div>
                <div class="col-12 col-md-6 my-auto col-lg-8 profile-info">
                        <h2 class='my-0 noche'>{{ Auth::user()->name}} {{Auth::user()->surname}}</h2>
                    <div class="my-3">
                        <p class='my-1'>
                            <i class="fas fa-map-marker-alt"></i>
                            Calle Falsa 123, Córdoba, X5000
                        </p>
                        <p>
                            <i class="fas fa-mobile-alt"></i>
                            <a href="tel:{{Auth::user()->phone}}">{{Auth::user()->phone}}</a>
                        </p>
                    </div>
                </div>          
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h4 class='mt-3'>Mis artículos deseados:</h4>
            </div>
        </div>         
    </div>
</div>


@endsection