@extends('template')
@section('title', 'Home')
@section('main-content')
<main class="bg-crema" id=home>
    <section class="best-sellers container-fluid">

        <h3 class='py-4 noche text-center'>Descubrí lo nuevo, descubrí valuar</h3>
        <div class='container bg-crema'>

            <div class="row zoom-child">

                <!-- <p v-for="(product, index) in products" :key="index">@{{product.name + " "+ product.price + '\n'}}</p> -->
                <span v-for="(product, index) in products" :key="index" class="col-12 col-md-4 col-lg-3 product">
                    @component('partials.single-product',
                    [
                    'name' => '@{{product.name}}',
                    'price' => '@{{product.price}}',
                    'material' => '@{{product.material}}',
                    'photo' => '@{{product.photos}}'
                    ])

                    @endcomponent
                </span>
            </div>
            <div class="text-center">
                <a class="btn transparent bd-noche noche waves-effect waves-light mx-0 my-4 rounded" href="/product-list" role="button">Descubrí más »</a>
            </div>
        </div>
    </section>

    <section class="categories py-4 container-fluid bg-noche ">
        <h3 class='py-1 crema text-center'>Categorías</h3>
        <div class="container">

            <div class="row">

                <article class=" col-12 col-md-5 col-lg-3">
                    <div class="category z-depth-1-half mr-2 zoom rounded">
                        <a href="/product-list">
                            <img src="img/ctg/anillos-mod.png" alt="" class="img-fluid ctg-img">
                            <span class="ctg-prompt bg-noche dark">Anillos</span>
                        </a>
                    </div>
                </article>

                <article class=" col-12 col-md-5 col-lg-3">
                    <div class="category z-depth-1-half mr-2 zoom rounded">
                        <a href="/product-list">
                            <img src="img/ctg/collar-mod.png" alt="" class="img-fluid ctg-img">
                            <span class="ctg-prompt bg-noche dark">Collares</span>
                        </a>
                    </div>
                </article>

                <article class=" col-12 col-md-5 col-lg-3">
                    <div class="category z-depth-1-half mr-2 zoom rounded">
                        <a href="/product-list">
                            <img src="img/ctg/pulsera-mod.png" alt="" class="img-fluid ctg-img">
                            <span class="ctg-prompt bg-noche dark">Pulseras</span>
                        </a>
                    </div>
                </article>

                <article class="col-12 col-md-5 col-lg-3">
                    <div class="category z-depth-1-half mr-2 zoom rounded">
                        <a href="/product-list">
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

<script>
    var app = new Vue({
        el: '#home',
        data: {
            products: []
        },
        computed: {
            locationLog: function() {
                return window.location.pathname == '/home' || window.location.pathname == '/';
            }
        },
        methods: {
            listarProductos() {
                let me = this;
                axios.get('http://localhost:8888/valuar/v2/product/get/4')
                    .then(function(response) {
                        // handle success
                        me.products = response.data;
                        me.products.map(function(product) {
                            product.photos = product.photos.split(', ')
                        });
                        console.log(me.products);

                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function() {
                        // always executed
                    });
            },
        },
        mounted() {
            this.listarProductos();
        }
    });
</script>

@endsection