@extends('profile')
@section('title', 'Carrito')
@section('styles')
<link rel="stylesheet" href="{{asset('css/files/user-orders.css')}}">
@endsection
@section('section')
<orders inline-template>

    <div class="container-fluid">
        <div class="container">
            <h2 class="mb-5">Órdenes de compra</h2>
            <hr class="h-separator">
            <ul class="clearlist order-list">
                <li v-for="(order, index) in orders" class="p-0">
                    <div class="row m-0 py-2 px-2 align-items-end justify-content-around">
                        <div class="text-center">
                            <!-- <small>@{{order.created_at}}</small> -->
                            <p class="m-0">@{{order.order_name}}</p>
                        </div>
                        <div class="text-center">
                            <small class="noche">Pago</small>
                            <div class="alert alert-danger rounded-pill m-0 px-2 py-0" role="alert" style="line-height: 1rem">
                                <small>Pendiente</small>
                            </div>
                        </div>
                        <div class="text-center">
                            <small class="noche">Envío</small>
                            <div class="alert alert-success rounded-pill m-0 px-1 py-0" role="alert" style="line-height: 1rem">
                                <small>Pendiente</small>
                            </div>
                        </div>
                        <p class="m-0 verde">$@{{order.billing_info.total}}</p>
                    </div>
                    <hr class="h-separator">
                </li>
            </ul>
        </div>
    </div>

</orders>

<script type="application/javascript">
    Vue.component('orders', {
        data() {
            return {
                orders: [],
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