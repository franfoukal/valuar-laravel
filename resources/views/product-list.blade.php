@extends('template')
@section('title', 'Lista de Productos')
@section('main-content')
<div class="container-fluid bg-crema" id="product-list">
    <div class="container bg-crema">
        <!--Banner-->

        @include('partials.prod-list-banner')

        <div class="row categorias-row bg-crema">
            <div class="col-12 my-auto bg-crema">
                <div class="bg-crema rounded mt-3">
                    <ul class='list-unstyled text-center'>
                        <li class='menu-li'>
                            <button class='btn bg-crema menu-btn dropdown-toggle' data-toggle='dropdown' type='button'>
                                Categorías
                            </button>
                            <div class="dropdown-menu">
                                <a class='dropdown-item' href="">Alhajas</a>
                                <a class='dropdown-item' href="">Colgantes</a>
                                <a class='dropdown-item' href="">Anillos</a>
                                <a class='dropdown-item' href="">Pulseras</a>
                            </div>
                        </li>
                        <li class='menu-li'>
                            <button class='btn bg-crema menu-btn dropdown-toggle' data-toggle="dropdown" type="button">
                                Ordenar por:
                            </button>
                            <div class="dropdown-menu">
                                <a class='dropdown-item' href="">A - Z</a>
                                <a class='dropdown-item' href="">Mayor Precio</a>
                                <a class='dropdown-item' href="">Menor Precio</a>
                            </div>
                        </li>
                        <li class='menu-li'>
                            <button class='btn bg-crema menu-btn dropdown-toggle' data-toggle="dropdown" type='button'>
                                Filtrar por:
                            </button>
                            <div class="dropdown-menu">
                                <span class='dropdown-item'>Material: </span>
                                <a class='dropdown-item' href="">Oro</a>
                                <a class='dropdown-item' href="">Plata</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Lista de productos & Menu Categorias-->
        <div class="row main-row bg-crema">
            <!--Categorías de costado-->
            <nav class="col-lg-2 bg-crema rounded-lg categorias-side">
                <ul class='list-unstyled my-2'>
                    <li>
                        <h5 class='mb-1 noche cat-title'>Categorías: </h5>
                    </li>
                    <li>
                        <a class='noche' href="#">
                            Alhajas
                        </a>
                    </li>
                    <li>
                        <a class='noche' href="#">
                            Colgantes
                        </a>
                    </li>
                    <li>
                        <a class='noche' href="">
                            Anillos
                        </a>
                    </li>
                    <li>
                        <a class='noche' href="">
                            Pulseras
                        </a>
                    </li>
                    <li>
                        <div class="divisor my-1"></div>
                    </li>
                    <li>
                        <h5 class='my-1 cat-title noche'>
                            Ordenar por:
                        </h5>
                    </li>
                    <li>
                        <a class='noche' href="#">A - Z</a>
                    </li>
                    <li>
                        <a class='noche' href="#">Mayor Precio</a>
                    </li>
                    <li>
                        <a class='noche' href="#">Menor Precio</a>
                    </li>
                    <li>
                        <div class="divisor my-1"></div>
                    </li>
                    <li>
                        <h5 class='my-1 cat-title noche'>
                            Filtrar por:
                        </h5>
                    </li>
                    <li>
                        <h6 class='noche'>Material: </h6>
                    </li>
                    <li>
                        <a class='noche' href="">Oro</a>
                    </li>
                    <li>
                        <a class='noche' href="">Plata</a>
                    </li>
                </ul>
            </nav>
            <!--Lista de productos-->
            <div class="col-12 col-lg-10">
                <div class="row">
                    <div v-for="(product, index) in products" :key="index" class="col-12 col-md-4 col-lg-3 product">
                        @component('partials.single-product',
                        [
                        'name' => '@{{product.name}}',
                        'price' => '@{{product.price}}',
                        'material' => '@{{product.material}}',
                        'photo' => '@{{product.photos}}'
                        ])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
        <!--Paginación de abajo-->
        <!-- FALTA PONER PAGiNACION -->
    </div>
</div>


<script>
    var app = new Vue({
        el: '#product-list',
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
                axios.get('http://localhost:8888/valuar/v2/product/get/20')
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