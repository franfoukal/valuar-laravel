@extends('template')
@section('title', 'Carrito')
@section('main-content')
<main class="main-content" id="cart">
    <div class="row p-0 m-0">
        <section class="item-list-cart col-12 col-md-8 col-lg-8">
            <div class="cont col-11">
                <h1 class="cart-title">Tu carrito</h1>
                <ul class="clearlist">
                    <li class="mb-4" v-for="(product, index) in products" :key="index">
                        <div class="row cart-item mx-2 px-2 z-depth-1-half">

                            <div class="img-wrapper-cart col-5 col-md-3 col-lg-2">
                                <img :src="products[index].photos[0].path != undefined ? 'hola' : 'chau' " alt="" class="cart-prod-img img-fluid rounded-circle bd-piel">
                            </div>

                            <h4 class="prod-name col-5 col-md-4 col-lg-3">@{{product.name}}</h4>
                            <a @click="deleteProduct(index)" href="#" class="cart-delete rojo col-2 col-md-1 col-lg-1"><i class="fas fa-times"></i></a>

                            <h5 class="prod-price verde col-12 col-md-2 col-lg-2">$@{{product.price}}</h5>
                        </div>
                    </li>
                </ul>



                <h3 class="total-price">Total:

                </h3>
            </div>
        </section>

        <aside class="summary-section z-depth-1-half bg-crema col-12 col-md-4 col-lg-4">

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
    </div>
    </aside>
    </div>
</main>

<script>
    var app = new Vue({
        el: '#cart',
        data: {
            name: "",
            cardNumber: "",
            month: "",
            year: "",
            products: [],
            refreshCartItems: 0
        },
        computed: {
            numberEmpty: function() {
                return this.cardNumber == "";
            },
            cardNumberSeparated: function() {
                if (!this.numberEmpty) {
                    return this.cardNumber.replace(/(\d{4})(\d{4})(\d{4})(\d{4})/, "$1-$2-$3-$4");
                } else {
                    return "";
                }
            }
        },
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
            this.listarProductos();
        }
    })
</script>
@endsection