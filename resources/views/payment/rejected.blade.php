@extends('template')
@section('title', 'Pago')
@section('main-content')

<main class="bg-gris  d-block" style="padding: 6rem 2rem ">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card p-5 col-lg-8">
            <div class="row clear align-items-center justify-content-between">
                <i class="fas fa-exclamation-triangle rojo col-12 col-md-2 text-center mb-3 mb-md-0 mr-md-1" style="font-size: 5rem"></i>
                <div class="col-12 col-md-9">
                    <h2>Algo salió mal con el pago</h2>
                    <h4>Intenta nuevamente! Tu <a href="/cart">pedido</a> te espera</h4>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection