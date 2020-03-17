@extends('template')
@section('title', 'Carrito')
@section('main-content')
<main class="main-content" id="cart">
    <div class="row p-0 m-0">
        <section class="item-list-cart col-12 col-md-9 col-lg-9">
            <h1 class="cart-title mb-4">Tu carrito</h1>
            <ul class="clearlist cart-list col-12 col-md-9 col-lg-8">
                <hr class="h-separator">
                <li class="" v-for="(product, index) in products" :key="index">
                    <div class="row cart-item mx-2 px-2">
                        <div class="img-wrapper-cart col-5 col-sm-3 col-md-3 col-lg-2">
                            <img :src="products[index].first_photo.path != undefined ? '/storage/products/' + products[index].first_photo.path  : '' " alt="" class="cart-prod-img img-fluid rounded-circle bd-verde z-depth-1-half">
                        </div>

                        <div class="row md-form form-sm">
                            <input type="number" id="number" class="form-control form-control-sm">
                            <label for="number" class="">Small input</label>
                        </div>

                        <div class="col-5 col-md-4 col-lg-3 m-0">
                            <h4 class="prod-name m-0">@{{product.name}}</h4>
                            <small>@{{product.material.name}} - T: @{{product.size}}</small>
                        </div>
                        <h5 class="prod-price verde col-12 col-md-2 col-lg-2 m-0">$@{{product.price}}</h5>
                        <a @click="deleteProduct(index)" href="#" class="cart-delete rojo col-2 col-md-1 col-lg-1"><i class="fas fa-times"></i></a>
                    </div>
                    <hr class="h-separator">
                </li>
            </ul>
        </section>
    </div>

    <!-- <aside class="summary-section z-depth-1-half bg-crema col-12 col-md-4 col-lg-4">

            <div class="summary">
                <h5 class="summary-title">Método de pago</h5>

                <div class="credit-card bg-noche crema">
                    <h5 class="cc-title">Credit card</h5>
                    <div class="cc-number" v-if="numberEmpty">
                        <?php
                        for ($i = 0; $i < 4; $i++) {
                            echo '
                                        <span class="cc-dots">
                                            <i class="fas fa-circle"></i>
                                            <i class="fas fa-circle"></i>
                                            <i class="fas fa-circle"></i>
                                            <i class="fas fa-circle"></i>
                                        </span>
                                ';
                        }
                        ?>
                    </div>
                    <div class="cc-number" else>
                        @{{cardNumberSeparated}}
                    </div>
                    <div class="cc-name">
                        @{{name}}
                    </div>
                    <div class="cc-date">
                        @{{month}}/@{{year}}
                    </div>

                    <i class="cc-logo fab fa-cc-visa"></i>

                </div>

                <form class="summary-form" action="cart" method="POST">
                    <div class="md-form">
                        <input type="text" id="form1" class="form-control" v-model="name" name="name">
                        <label for="form1" class="">Nombre en tarjeta</label>
                    </div>

                    <div class="md-form">
                        <input type="number" id="cardNumber" class="form-control" v-model="cardNumber" name="number">
                        <label for="cardNumber" class="">Nº tarjeta</label>
                    </div>
                    <div class="sub-form">
                        <div class="col-2">
                            <div class="md-form">
                                <input type="number" id="inputMes" class="form-control" v-model="month">
                                <label for="inputMes" class="">mm</label>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="md-form">
                                <input type="number" id="form4" class="form-control" v-model="year">
                                <label for="form4" class="">aa</label>
                            </div>
                        </div>

                        <div class="col-2 cvv">
                            <div class="md-form">
                                <input type="text" id="form5" class="form-control">
                                <label for="form5" class="">CVV</label>
                            </div>
                        </div>
                    </div>

                    <div class="md-form">
                        <input type="text" id="form6" class="form-control">
                        <label for="form6" class="">Dirección envío</label>
                    </div>
                    <div class="md-form">
                        <input type="number" id="form7" class="form-control">
                        <label for="form7" class="">Código postal</label>
                    </div>

                    <button type="submit" name="button" class="btn bg-verde summary-btn">Finalizar compra</button>
                </form>


            </div>
        </aside> -->

    </div>
</main>

<script>
    var app = new Vue({
        el: '#cart',
        data: {
            products: [],
            refreshCartItems: 0
        },
        computed: {},
        methods: {
            listarProductos() {
                let me = this;
                axios.get('/cart/get')
                    .then(function(response) {
                        me.products = response.data[0];
                        console.log(response.data[0]);

                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function() {
                        // always executed
                    });
            },

            deleteProduct(index) {
                let me = this;
                axios.post('/cart/delete', {
                        id: index
                    })
                    .then(function(response) {
                        me.listarProductos();
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function() {
                        // always executed
                    });
            }

        },
        mounted() {
            this.products = [];
            this.listarProductos();
        }
    });

    Vue.component('number-input', {
        props: ['initial'],
        template: '',
    })
</script>
@endsection