@extends('template')
@section('title', 'Pago')
@section('main-content')
<main class="bg-gris  d-block p-3 p-md-5">
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card p-3 p-md-5 col-lg-8">
            <div class="row clear align-items-center justify-content-between">
                <i class="far fa-check-circle verde col-12 col-md-2 text-center mb-3 mb-md-0 p-0" style="font-size: 6rem"></i>
                <div class="col-12 col-md-9">
                    <h2>¡Muchas gracias por tu compra!</h2>
                    <h4>Tu pago se completo correctamente</h4>
                    <h5>Podés consultar la orden desde <a href="/profile">tus ordenes</a></h5>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection