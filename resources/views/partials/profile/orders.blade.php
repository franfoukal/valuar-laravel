@extends('profile')
@section('title', 'Carrito')
@section('styles')
<link rel="stylesheet" href="{{asset('css/files/user-orders.css')}}">
<link rel="stylesheet" href="{{asset('css/files/order.css')}}">
@endsection
@section('section')
<orders inline-template>

    <div class="container-fluid">
        <h2 class="mb-5">Órdenes de compra</h2>
        <div class="container" v-if="view=='list'">
            <hr class="h-separator">
            <ul class="clearlist order-list" v-if="orders.length > 0">
                <li v-for="(order, index) in orders" class="p-0">
                    <div class="row m-0 py-2 px-2 align-items-center justify-content-around">
                        <a @click.prevent="selectOrder(order)" href="#"><i class="far fa-eye align-self-center"></i></a>
                        <div class="text-center">
                            <p class="m-0">@{{order.order_name}}</p>
                        </div>
                        <div class="text-center">
                            <small class="noche">Pago</small>
                            <div class="alert rounded-pill m-0 px-2 py-0" role="alert" style="line-height: 1rem" :class="getStatusColor(order.mercadopago_info.collection_status)">
                                <small>@{{order.mercadopago_info.collection_status}}</small>
                            </div>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-truck"></i>
                        </div>
                        <p class="m-0 verde">$@{{order.billing_info.total}}</p>
                    </div>
                    <hr class="h-separator">
                </li>
            </ul>
            <div v-else> No has comprado nada!</div>
        </div>

        <!-- --------------- -->

        <div class="container" v-if="view=='order'">
            <div class="card p-4 col-lg-8">
                <div class="row clear">
                    <a @click.prevent="selectView('list')"><i class="fas fa-arrow-left order-card-back-arrow"></i></a>
                    <h4 class="m-0 ml-3">@{{selected.order_name}}</h4>
                </div>
                <div class="row mt-3 clear">
                    <ul class="clearlist col-12 col-md-6 col-lg-6">
                        <li>
                            <p class="clear"><b>Fecha: </b> @{{selected.created_at}}</p class="clear">
                        </li>
                        <li class="row clear">
                            <p class="clear">
                                <b>Pago: </b>
                                <span class="mx-2 alert rounded-pill m-0 px-2 py-0" role="alert" style="line-height: 1rem" :class="getStatusColor(selected.mercadopago_info.collection_status)">
                                    <small>@{{selected.mercadopago_info.collection_status}}</small>
                                </span>
                            </p>
                        </li>
                        <li class="row clear align-items-center">
                            <b>Envío: </b>
                            <span class="mx-2 alert alert-danger rounded-pill m-0 px-2 py-0" role="alert" style="line-height: 1rem">
                                <small>Pendiente</small>
                            </span>
                            <i class="fas fa-info-circle ml-3 text-danger"></i>
                        </li>
                        <li class="my-4">
                            <div class="card p-2 dashed col-10">
                                <h4 class="verde">Resumen</h4>
                                <ul class="clearlist p-3">
                                    <li class="row clear justify-content-around align-items-baseline">
                                        <small class="clear">Productos</small>
                                        <span class="order-total-separator"></span>
                                        <small class="clear">$@{{selected.billing_info.subtotal}}</small>
                                    </li>
                                    <li class="row clear justify-content-around align-items-baseline">
                                        <small class="clear">Envío</small>
                                        <span class="order-total-separator"></span>
                                        <small class="clear">$@{{selected.billing_info.envio}}</small>
                                    </li>
                                    <li class="row clear justify-content-around align-items-baseline">
                                        <small class="clear">Descuento</small>
                                        <span class="order-total-separator"></span>
                                        <small class="clear">-$@{{selected.billing_info.descuento}}</small>
                                    </li>
                                    <li class="mt-3 row clear justify-content-around align-items-baseline">
                                        <b class="clear">Total</b>
                                        <span class="order-total-separator"></span>
                                        <b class="clear">$@{{selected.billing_info.total}}</b>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="clear col-12 col-md-6">
                        <b class="d-block mb-2">Detalle:</b>
                        <div v-for="(product, index) in selected.product_list" class="row clear align-items-center p-2">
                            <img :src="product.first_photo != null ? '/storage/products/' + product.first_photo.path  : '' " alt="Sin foto" class="col-2 col-md-3selected.billing_info. col-lg-2 p-0 m-0 order-prod-img rounded-circle bd-verde shadow-sm">
                            <div class="clear ml-3 order-product-name">
                                <p class="clear">@{{product.name}}</p>
                                <small><b>Talle:</b>@{{product.size}}</small>
                            </div>
                            <span class="order-total-separator mt-1"></span>
                            <p class="clear verde">@{{product.units}}x $@{{product.price}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</orders>

<script type="application/javascript">
    Vue.component('orders', {
        data() {
            return {
                orders: [],
                view: 'list',
                selected: {}
            }
        },
        methods: {
            async getOrders() {
                let me = this;

                await axios.get('/orders/get')
                    .then(response => {
                        let parsedData = JSON.parse(response.data.orders);
                        let nestedData = [];
                        parsedData.forEach(element => {
                            element.billing_info = JSON.parse(element.billing_info);
                            element.shipping_info = JSON.parse(element.shipping_info);
                            element.mercadopago_info = JSON.parse(element.mercadopago_info);
                            element.product_list = JSON.parse(element.product_list);
                            element.order_name = "U{{Auth::user()->id}}OC" + element.id;
                            nestedData.push(element);
                        });
                        console.log(nestedData);
                        me.orders = nestedData;
                    })
                    .catch(error => {
                        console.log(error.response);

                    });
            },
            getStatusColor(status) {
                switch (status) {
                    case "approved":
                        return "alert-success"
                        break;
                    case "in_process":
                        return "alert-danger"
                        break;
                    case "rejected":
                        return "alert-danger"
                        break;
                }
            },
            selectView(view) {
                this.view = view;
            },
            selectOrder(order) {
                this.selected = order;
                this.selectView('order');
            }
        },
        computed: {

        },
        created() {
            this.getOrders();
        },
    });
</script>
@endsection