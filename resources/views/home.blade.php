@extends('template')
@section('title', 'Home')
@section('main-content')
<main class="bg-crema" id=home>
    <section class="best-sellers container-fluid">

        <h3 class='py-4 noche text-center'>Descubrí lo nuevo, descubrí valuar</h3>
        <div class='container bg-crema'>

            <div class="row zoom-child mx-lg-5">

                @foreach($products as $product)
                        @component('partials.single-product',
                        [
                        'name' => $product->name,
                        'material' => $product->material->name,
                        'price' => $product->price,
                        'id' => $product->id,
                        'photo' => isset($product->firstPhoto['path']) ? $product->firstPhoto['path'] : 'prod-1.png',
                        'index' => $loop->index,
                        'isAuth' => Auth::check()
                        ])
                        @endcomponent
                @endforeach

                </div>
                <div class="text-center">
                    <a class="btn transparent bd-noche noche waves-effect waves-light mx-0 my-4 rounded" href="/products" role="button">Descubrí más »</a>
                </div>
            </div>
    </section>

    <section class="categories py-4 container-fluid bg-noche ">
        <h3 class='py-1 crema text-center'>Categorías</h3>
        <div class="container">

            <div class="row">

                <article class=" col-12 col-md-5 col-lg-3">
                    <div class="category z-depth-1-half mr-2 zoom rounded">
                        <a href="/products">
                            <img src="img/ctg/anillos-mod.png" alt="" class="img-fluid ctg-img">
                            <span class="ctg-prompt bg-noche dark">Anillos</span>
                        </a>
                    </div>
                </article>

                <article class=" col-12 col-md-5 col-lg-3">
                    <div class="category z-depth-1-half mr-2 zoom rounded">
                        <a href="/products">
                            <img src="img/ctg/collar-mod.png" alt="" class="img-fluid ctg-img">
                            <span class="ctg-prompt bg-noche dark">Collares</span>
                        </a>
                    </div>
                </article>

                <article class=" col-12 col-md-5 col-lg-3">
                    <div class="category z-depth-1-half mr-2 zoom rounded">
                        <a href="/products">
                            <img src="img/ctg/pulsera-mod.png" alt="" class="img-fluid ctg-img">
                            <span class="ctg-prompt bg-noche dark">Pulseras</span>
                        </a>
                    </div>
                </article>

                <article class="col-12 col-md-5 col-lg-3">
                    <div class="category z-depth-1-half mr-2 zoom rounded">
                        <a href="/products">
                            <img src="img/ctg/aro-mod.png" alt="" class="img-fluid ctg-img zoom">
                            <span class="ctg-prompt bg-noche dark"> Aros</span>
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="services py-5 bg-white" id="services">
        <div class="svc-wrapper py-5 row mx-5">
            <div class="service noche col-12 col-md-4">
                <i class="fas fa-shield-alt"></i>
                <h3>GARANTÍA</h3>
                <p>¡No te preocupes!. Te ofrecemos garantía de 6 meses para asegurar la excelencia del producto. <a className="text-decoration-none" href="FAQ">Saber mas...</a></p>
            </div>
            <div class="service noche col-12 col-md-4">
                <i class="fas fa-credit-card"></i>
                <h3>PAGOS</h3>
                <p>¡Pagá con todos los medios, en cuotas y seguro! Aprovecha ofertas sin interés. <a className="text-decoration-none" href="FAQ">Saber mas...</a></p>
            </div>
            <div class="service noche col-12 col-md-4">
                <i class="fas fa-truck-loading"></i>
                <h3>ENVÍOS</h3>
                <p>¡Enviamos a todo el país! Así de facíl hasta la puerta de tu casa. <a className="text-decoration-none" href="FAQ">Saber mas...</a></p>
            </div>
        </div>
        <h2 class="title display-3 noche py-4 text-center">ELEGÍ VALUAR</h2>

    </section>
</main>


@endsection