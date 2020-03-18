@extends('template')
@section('title', 'Carrito')
@section('main-content')
<main class="main-content" id="cart">
    <div class="row p-0 m-0">
        <section class="item-list-cart col-12 col-md-9 col-lg-9">
            <h1 class="cart-title mb-4">Tu carrito</h1>
            <ul v-if="Object.keys(products).length > 0" class="clearlist cart-list col-12 col-md-9 col-lg-8">
                <hr class="h-separator">
                <li class="" v-for="(product, index) in products" :key="index">
                    <div class="row cart-item mx-2 px-2">
                        <div class="img-wrapper-cart col-4 col-sm-3 col-md-2 col-lg-2">
                            <img :src="product.first_photo.path != undefined ? '/storage/products/' + product.first_photo.path  : '' " alt="" class="cart-prod-img img-fluid rounded-circle bd-verde z-depth-1-half">
                        </div>


                        <number-input title="cant" :initial="product.units" min="0" @increment="product.units++" @decrement="product.units == 0 ? 0 : product.size--" class="col-6 col-md-2 my-4"></number-input>

                        <number-input title="talle" :initial="product.size" min="0" @increment="product.size++" @decrement="product.size == 0 ? 0 : product.size--" class="col-6 col-md-2 my-4"></number-input>

                        <!-- @increment="product.size++" @decrement="product.size == 0 ? 0 : product.size--" -->

                        <div class="col-5 col-md-3 col-lg-3 m-0">
                            <h4 class="prod-name m-0">@{{product.name}}</h4>
                            <small>@{{product.material.name}}</small>
                        </div>
                        <h5 class="prod-price verde col-12 col-md-2 col-lg-2 m-0 mt-3 mt-md-0">$@{{calculatePrice(product)}}</h5>
                        <a @click="deleteProduct(product.unique_id)" href="#" class="cart-delete rojo col-2 col-md-1 col-lg-1"><i class="fas fa-times"></i></a>
                    </div>
                    <hr class="h-separator">
                </li>
            </ul>
            <div v-else class="row mt-3">
                <i class="fas fa-shopping-cart fav-empty-list-icon verde col-3 col-md-2 col-lg-1"></i>
                <h2 class="col-8 fav-empty-list-text">Todavía no has agregado productos al carrito!</h2>
            </div>
        </section>
    </div>

</main>

<script>
    var app = new Vue({
        el: '#cart',
        data: {
            products: [],
            refreshCartItems: 0
        },
        computed: {

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

            deleteProduct(unique_id) {
                let me = this;
                axios.post('/cart/delete', {
                        unique_id: unique_id
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
            },
            commitChanges() {
                let me = this;
                axios.put('/cart/refresh', {
                        cart: me.products
                    })
                    .then(function(response) {
                        console.log('modified');

                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function() {
                        // always executed
                    });
            },
            calculatePrice(product) {
                return product.units * product.price;
            },
            increment(num) {
                num++;
                this.commitChanges();
            },
            decrement(num) {
                num--;
                this.commitChanges();
            },
        },

        mounted() {
            this.products = [];
            this.listarProductos();
        }
    });

    Vue.component('number-input', {
        props: ['title', 'min', 'max', 'initial'],
        template: '',
        template: `
            <div class="number-input-custom">
                <div class="row number-input-group">
                    <a><i class="fas fa-minus number-input-control" @click="$emit('decrement')"></i></a>
                    <input type="number" class="number-input" :value="value" disabled min="min" max="max" @input="$emit('input', $event.target.value)">
                    <a><i class="fas fa-plus number-input-control" @click="$emit('increment')"></i></a>
                </div>
                <div class="row justify-content-center"><small>@{{title}}</small></div>
            </div>
        `,
        computed: {
            value() {
                return this.initial < 0 ? 0 : this.initial;
            }
        }

    })
</script>
@endsection