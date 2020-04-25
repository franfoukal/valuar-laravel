@extends('template')
@section('title', 'Orden')
@section('styles')
<link rel="stylesheet" href="{{asset('css/files/order.css')}}">
@endsection
@section('main-content')

<order inline-template>
    <div class="bg-crema">
        <main class="container py-4 p-md-5 order-container">
            <div class="order-grid-wrapper">
                <div class="order-box o-1 card dashed p-4 p-lg-5">

                    <h4 class="m-0 verde">Tu compra</h4>
                    <small class="mb-3 ml-1">(3 articulos)</small>

                    <ul class="order-product-list list-group list-group-flush">
                        <li class="list-group-item" v-for="(product, index) in cart" :key="index">
                            <div class="order-list-item row m-0 p-0">
                                <img :src="product.first_photo.path != undefined ? '/storage/products/' + product.first_photo.path  : '' " alt="" class="col-3 col-md-2 col-lg-2 p-0 m-0 order-prod-img rounded-circle bd-verde shadow-sm">
                                <div class="col-5 col-md-4">
                                    <h5 class="clear">@{{product.name}}</h5>
                                    <small class="clear d-block ml-1">Talle: @{{product.size}}</small>
                                </div>
                                <div class="row clear justify-content-around align-items-end py-3 col-4 col-md-6">
                                    <p class="clear ml-auto mr-3">@{{product.units}} x</p>
                                    <div class="text-center">
                                        <small class="d-block clear">Unitario</small>
                                        <p class="clear order-list-price">$@{{product.price}}</p>
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>

                    <a href="/cart" class="btn text-white mt-4 bg-verde">Modificar carrito</a>
                </div>
                <div class="order-box o-2 card p-4">
                    <h4 class="verde">Envío</h4>
                    <div class="alert p-0 m-0 bg-gris bd-piel" role="alert">
                        <div class="row clear align-items-center justify-content-between" v-if="user_address.length > 0">
                            <a class="row clear p-3 rounded " type="button" id="dropdownMenuButton12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="order-address">
                                    <p class="clear trim-word">@{{address.street + ' ' + address.number}} @{{address.apartment != null ? ' - ' + address.apartment : ''}}</p>
                                    <small class="d-block trim-word">@{{address.locality.nombre}}, @{{address.province_department.nombre}}, @{{address.province.nombre}}</small>
                                    <small class="col-12 m-0 clear">(@{{address.postal_code}})</small>
                                </div>
                                <i href="#" class="d-block dropdown-toggle noche align-self-center ml-3"></i>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton12">
                                <h6 class="dropdown-header mb-2">Direcciones</h6>
                                <div v-for="(address, index) in user_address" :key="index">
                                    <a class="dropdown-item" href="#" @click.prevent="selectAddress(address)">
                                        <p class="m-0 trim-word">@{{address.street + ' ' + address.number}} @{{address.apartment != null ? ' - ' + address.apartment : ''}}</p>
                                        <small class="d-block trim-word">@{{address.locality.nombre}}, @{{address.province_department.nombre}}, @{{address.province.nombre}}</small>
                                        <small>(@{{address.postal_code}})</small>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                </div>
                                <div class="dropdown-item" href="#">
                                    <a href="/profile/address" class="btn btn-link rojo ml-auto clear pt-3">Editar direcciones</a>
                                </div>

                            </div>
                        </div>

                        <div v-else class="p-3">
                            <small>No cargaste ninguna dirección</small>
                            <a href="/profile/address" class="btn btn-link rojo ml-auto clear pt-3">Editar direcciones</a>
                        </div>

                    </div>
                    <div class="row clear align-items-baseline mt-3" v-if="user_address.length > 0">
                        <p>Envío a domicilio</p>
                        <span class="order-total-separator"></span>
                        <p>$@{{tarifa}}</p>
                    </div>
                </div>
                <div class="order-box o-3 card p-4">
                    <h4 class="verde">Voucher</h4>
                    <div v-if="Object.keys(voucher).length > 0" class="row clear align-items-baseline">
                        <p class="clear">@{{voucher.code}}</p>
                        <span class="order-total-separator"></span>
                        <p v-if="voucher.type == 'discount'" class="clear">@{{(voucher.value*100).toFixed(2)}}%</p>
                        <p v-else class="clear">$@{{voucher.value}}</p>
                        <a @click.prevent="deleteVoucher" href="#" class="ml-2"><i class="fas fa-trash rojo"></i> </a>
                    </div>
                    <div v-else class="row clear">
                        <p>No cargaste ninún voucher</p>
                    </div>
                </div>
                <div class="order-box o-4 card p-4 dashed">
                    <h4 class="verde">Resumen</h4>
                    <ul class="clearlist p-3">
                        <li class="row clear justify-content-around align-items-baseline">
                            <small class="clear">Productos</small>
                            <span class="order-total-separator"></span>
                            <small class="clear">$@{{totalProducts}}</small>
                        </li>
                        <li class="row clear justify-content-around align-items-baseline">
                            <small class="clear">Envío</small>
                            <span class="order-total-separator"></span>
                            <small class="clear">$@{{tarifa}}</small>
                        </li>
                        <li class="row clear justify-content-around align-items-baseline">
                            <small class="clear">Descuento</small>
                            <span class="order-total-separator"></span>
                            <small class="clear">-$@{{totalVoucher}}</small>
                        </li>
                        <li class="mt-3 row clear justify-content-around align-items-baseline">
                            <b class="clear">Total</b>
                            <span class="order-total-separator"></span>
                            <b class="clear">$@{{total}}</b>
                        </li>
                    </ul>
                    <button @click="createOrder" class="btn bg-verde text-white">Pagar</button>
                    <!-- <form action="/procesar-pago" method="POST">
                        <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js" data-preference-id="12">
                        </script>
                    </form> -->
                </div>
            </div>
        </main>
    </div>
</order>

<script type="application/javascript">
    Vue.component('order', {
        data() {
            return {

                user_address: [],
                tarifa: 0,
                address: {},
                voucher: {},
                cart: [],
            }
        },
        methods: {
            async getCotizacion() {
                let me = this;
                await axios.post('/checkout/cotizarEnvio', {
                        postal_code: me.address.postal_code,
                        weight: 0.1,
                        volume: 125,
                        value: 2000
                    })
                    .then((response) => {
                        console.log(response);
                        me.tarifa = response.data.tarifa;
                    })
                    .catch((error) => {
                        console.log(error.response);
                    });
            },
            getCart() {
                let me = this;
                axios.get('/cart/get')
                    .then((response) => {
                        me.cart = response.data.cart;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            async getUserAddress() {
                var me = this;
                this.user_address = [];
                await axios.get('/profile/location')
                    .then(function(response) {
                        console.log(response);
                        response.data.locations.map((location) => {
                            location.province = JSON.parse(location.province);
                            location.province_department = JSON.parse(location.province_department);
                            location.locality = JSON.parse(location.locality);
                            me.user_address.push(location);
                        });
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            selectAddress(address) {
                this.address = address;
                this.getCotizacion();
            },
            loadVoucher() {
                if (localStorage.getItem('voucher-code') != null) {
                    this.voucher.code = localStorage.getItem('voucher-code');
                    this.voucher.type = localStorage.getItem('voucher-type');
                    this.voucher.value = localStorage.getItem('voucher-value');
                    this.voucher.value = parseFloat(this.voucher.value).toFixed(2);
                }
            },
            capitalize(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            },
            deleteVoucher() {
                swal({
                        title: "¿Eliminar voucher?",
                        text: "Para cargar otro, vuelve al carrito",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.localStorage.removeItem('voucher-code');
                            window.localStorage.removeItem('voucher-value');
                            window.localStorage.removeItem('voucher-type');
                            this.voucher = {};
                        } else {

                        }
                    });
            },

            // METHODS FOR ORDER CREATION
            createOrder() {
                this.address.tarifa = this.tarifa;
                let me = this;

                axios.post('/order', {
                        shipping_info: JSON.stringify(me.address),
                        billing_info: JSON.stringify(me.billingInfo),
                        product_list: JSON.stringify(me.cart),
                        payment_method: 'mercadopago',
                    })
                    .then((response) => {
                        console.log(response);
                        window.location.href = response.data;
                    })
                    .catch(error => {
                        console.log(error.response);

                    });
            },

        },
        computed: {
            totalProducts() {
                return this.cart.reduce((sum, product) => {
                    return sum + (product.price * product.units);
                }, 0);
            },
            totalVoucher() {
                if (Object.keys(this.voucher).length > 0) {
                    if (this.voucher.type == "discount") {
                        return (parseFloat(this.voucher.value) * this.totalProducts).toFixed(2);
                    } else {
                        return parseFloat(this.voucher.value).toFixed(2);
                    }
                } else {
                    return 0;
                }
            },

            total() {
                return (this.totalProducts - this.totalVoucher + parseFloat(this.tarifa)).toFixed(2);
            },

            billingInfo() {
                return {
                    voucher: this.voucher,
                    descuento: this.totalVoucher,
                    envio: this.tarifa,
                    subtotal: this.totalProducts,
                    total: this.total
                }
            }

        },
        async created() {
            this.getCart();
            this.loadVoucher();
            await this.getUserAddress().then(() => {
                if (this.user_address.length > 0) {
                    this.selectAddress(this.user_address[0]);
                }
            });
        },
    });
</script>
@endsection
@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection