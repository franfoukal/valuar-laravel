@extends('template')
@section('title', 'Carrito')
@section('main-content')
<cart inline-template class="main-content" id="cart">
    <div class="row p-0 m-0">
        <section class="item-list-cart col-12 col-md-7 col-lg-6">
            <h1 class="cart-title my-2">Tu carrito</h1>
            <ul v-if="Object.keys(products).length > 0" class="clearlist cart-list col-12 col-md-12 col-lg-12">
                <hr class="h-separator">
                <li class="" v-for="(product, index) in products" :key="index">
                    <div class="row cart-item mx-2 px-2">
                        <a class="img-wrapper-cart col-4 col-sm-3 col-md-2 col-lg-2" :href="'/product/' + product.id">
                            <img :src="product.first_photo.path != undefined ? '/storage/products/' + product.first_photo.path  : '' " alt="" class="cart-prod-img img-fluid rounded-circle bd-verde z-depth-1-half">
                        </a>

                        <number-input title="cant" :initial="product.units" min="0" @increment="increment(index, 'units')" @decrement="decrement(index, 'units')" class="col-6 col-md-2 my-4"></number-input>
                        <number-input title="talle" :initial="product.size" min="0" @increment="increment(index, 'size')" @decrement="decrement(index, 'size')" class="col-6 col-md-2 my-4"></number-input>
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
            <div v-else class="row mt-3 cart-list align-items-center">
                <i class="fas fa-shopping-cart fav-empty-list-icon verde col-3 col-md-2 col-lg-2"></i>
                <h2 class="col-8 fav-empty-list-text">Todavía no has agregado productos al carrito!</h2>
            </div>
        </section>

        <section class="col-12 col-md-5 col-lg-5 ml-auto bg-crema shadow-lg cart-checkout">
            <div class="card cart-checkout-card mx-auto my-5">
                <div class="card-body text-center p-5 dashed">
                    <h5 class="mb-2 verde text-left">Tenés un código o vaucher? <br> Ingresalo acá!</h5>
                    <div class="cart-promo-code">
                        <div class="md-form mt-3">
                            <label for="form1" class="active">Código promocional</label>
                            <input type="text" id="form1" class="form-control" v-model="voucher.code" @blur="checkVoucher" @change="checkVoucher" :class="voucher.validation">
                            <div class="invalid-feedback">
                                @{{error}}
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <div class="row cart-total m-0 p-0 mb-3">
                            <small>Descuento</small>
                            <div class="cart-total-child-middle mx-3"></div>
                            <small>@{{discount}}</small>
                        </div>
                        <div class="row cart-total m-0 p-0">
                            <h5 class="m-0">Subtotal</h5>
                            <div class="cart-total-child-middle mx-3"></div>
                            <p class="m-0">$ @{{products.size != 0 ? subtotalPrice : 0}}</p>
                        </div>
                        <div class="row cart-total mt-4">
                            <a href="/checkout" class="btn col-12 text-white bg-verde">Continuar compra</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</cart>

<script type="application/javascript">
    Vue.component('cart', {
        data() {
            return {
                products: [],
                refreshCartItems: 0,
                voucher: {
                    code: window.localStorage.getItem('voucher-code') ? window.localStorage.getItem('voucher-code') : '',
                    isValid: undefined,
                    type: undefined,
                    discount: 0,
                    validation: undefined
                },
                error: undefined,
            }
        },
        computed: {
            subtotalPrice() {
                var me = this;
                var subtotal = this.products.reduce(function(suma, item) {
                    return suma + (item.price * item.units);
                }, 0);
                switch (this.voucher.type) {
                    case 'voucher':
                        return (subtotal - parseFloat(this.voucher.discount)).toFixed(2);
                        break;
                    case 'discount':
                        return (subtotal * (1 - this.voucher.discount)).toFixed(2);
                        break;
                    default:
                        return subtotal;
                        break;
                }
            },

            discount() {
                switch (this.voucher.type) {
                    case 'voucher':
                        return '$' + this.voucher.discount;
                        break;
                    case 'discount':
                        return (this.voucher.discount * 100).toFixed(2) + '%';
                break;
                default:
                return 0;
                break;
            }
        },
    },
    methods: {
        listarProductos() {
            let me = this;
            axios.get('/cart/get')
                .then(function(response) {
                    me.products = response.data.cart;
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
                    me.$root.$emit('delete-from-cart');
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
            axios.post('/cart/refresh', {
                    cart: me.products
                })
                .then(function(response) {
                    console.log(response);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                })
                .finally(function() {
                    me.listarProductos();
                });
        },
        calculatePrice(product) {
            return product.units * product.price;
        },
        increment(index, attr) {
            this.products[index][attr]++;
            this.commitChanges();
        },
        decrement(index, attr) {
            this.products[index][attr] == 0 ? 0 : this.products[index][attr]--;
            this.commitChanges();
        },
        checkVoucher() {
            var me = this;
            this.error = undefined;
            this.voucher.validation = undefined;
            this.voucher.type = undefined;
            this.voucher.isValid = undefined;
            this.voucher.discount = 0;

            axios.post('/voucher/valid', {
                    code: me.voucher.code
                })
                .then(function(response) {
                    console.log(response);
                    me.voucher.isValid = true;
                    me.voucher.validation = 'is-valid';
                    me.voucher.type = response.data.voucher.type;
                    me.voucher.discount = response.data.voucher.value;
                    window.localStorage.setItem('voucher-code', me.voucher.code);
                    window.localStorage.setItem('voucher-value', me.voucher.discount);
                    window.localStorage.setItem('voucher-type', me.voucher.type);

                })
                .catch(function(error) {
                    // handle error
                    console.log(error.response);
                    me.voucher.validation = 'is-invalid';
                    me.error = error.response.data.msg;
                    window.localStorage.removeItem('voucher-code');
                    window.localStorage.removeItem('voucher-value');
                    window.localStorage.removeItem('voucher-type');
                })
        }
    },
    mounted() {
        this.products = [];
        this.listarProductos();
        if (this.voucher.code != '') {
            this.checkVoucher();
        }
    }
    });

    Vue.component('number-input', {
        props: ['title', 'min', 'max', 'initial'],
        template: `
            <div class="number-input-custom">
                <div class="row number-input-group">
                    <a><i class="fas fa-minus number-input-control" @click="$emit('decrement')"></i></a>
                    <input type="number" class="number-input" :value="value" disabled min="min" max="max" @input="$emit('input', $event.target.value)">
                    <a><i class="fas fa-plus number-input-control" @click="$emit('increment')"></i></a>
                </div>
                <div class="row justify-content-center"><small v-html="title"></small></div>
            </div>
        `,
        computed: {
            value() {
                return this.initial < 0 ? 0 : this.initial;
            }
        },
    })
</script>
@endsection