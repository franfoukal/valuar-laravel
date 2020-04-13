@extends('admin.admin-template')
@section('page-title', 'Cupones & Vouchers')
@section('css', '/css/admin/product.css')
@section('content')

<voucher inline-template>
    <div class="container pb-5 col-12 col-md-9 col-lg-8">
        <section v-if="view=='list'" :key="refresh">
            <div class="card col-12 col-lg-11 text-center">
                <div class="card-header voucher">
                    <div class="row m-0 p-0">
                        <h5 class="">Cupones</h4>
                            <button class="btn btn-secondary" @click="changeView('form')">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                Agregar
                            </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive voucher-list text-center col-12">
                        <thead class="thead-dark">
                            <tr>
                                <th>id</th>
                                <th>Código</th>
                                <th>Válido desde</th>
                                <th>Válido hasta</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(voucher, index) in vouchers.data" :key="index">
                                <td>@{{voucher.id}}</td>
                                <td>@{{voucher.code}}</td>
                                <td>@{{voucher.valid_since}}</td>
                                <td>@{{voucher.valid_to}}</td>
                                <td>@{{voucher.type}}</td>
                                <td>@{{voucher.type == 'voucher' ? '$' + voucher.value : Math.floor(voucher.value*100) + '%'}}</td>
                                <td>
                                    <div class="row m-0 p-0 justify-content-around">
                                        <!-- <a href="#"><i class="far fa-edit verde"></i></a> -->
                                        <a href="#" @click.prevent="modalDelete(voucher.id)"><i class="far fa-trash-alt rojo"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination m-0">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous" @click.prevent="listVouchers(vouchers.current_page > 1 ? vouchers.current_page-1 : vouchers.first_page)">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item" v-for="(num, index) in vouchers.last_page" :class="index+1 == vouchers.current_page ? 'active' : ''"><a class="page-link" href="#" @click.prevent="listVouchers(index+1)">@{{index+1}}</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next" @click.prevent="listVouchers(vouchers.current_page < vouchers.last_page ? vouchers.current_page+1 : vouchers.last_page)">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </section>

        <section v-else-if="view=='form'">
            <div class="card">
                <div class="card-header">
                    <div class="row m-0 p-0 align-items-center">
                        <a href="#" @click.prevent="changeView('list')"><i class="fas fa-arrow-left mr-3 voucher-form-back-arrow noche"></i></a>
                        <h5 class="">@{{action == 'create' ? 'Crear ' : 'Editar '}} voucher</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert" role="alert" :class="voucher.response.success ? 'alert-success' : 'alert-danger'" v-if="voucher.response.done">
                        @{{voucher.response.msg}}
                    </div>
                    <form action="" class="form row">
                        <div class="form-group col-12 col-md-6">
                            <label for="inputDateSince" class="voucher-form-label">Válido desde</label>
                            <input type="date" class="form-control" id="inputDateSince" v-model="voucher.valid_since">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="inputDateFrom" class="voucher-form-label">Válido hasta</label>
                            <input type="date" class="form-control" id="inputDateFrom" v-model="voucher.valid_to">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="selectType" class="voucher-form-label">Seleccionar tipo</label>
                            <select class="form-control" id="selectType" v-model="voucher.type">
                                <option value="discount">Descuento</option>
                                <option value="voucher">Voucher</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-md-6 voucher-form-q-selector">
                            <number-input title="Cantidad a crear" :initial="voucher.units" min=0 v-model="voucher.units" @increment="voucher.units++" @decrement="voucher.units > 1 ?  voucher.units-- : null" class=""></number-input>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="valueInput" class="voucher-form-label">Valor</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" v-if="voucher.type == 'voucher'">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" min="0" :max="voucher.type == 'discount' ? 100 : 1000000000" class="form-control" id="valueInput" v-model="voucher.value">
                                <div class="input-group-append" v-if="voucher.type == 'discount'">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <button @click.prevent="createVouchers" type="submit" class="btn btn-primary col-12 bg-verde bd-verde">Crear</button>
                    </form>
                </div>
            </div>
        </section>

    </div>
</voucher>

<script type="application/javascript">
    Vue.component('voucher', {
        data() {
            return {
                vouchers: [],
                links: '',
                headers: [],
                view: 'list',
                voucher: {
                    units: 1,
                    type: 'discount',
                    value: 0,
                    response: {
                        done: false,
                        success: undefined,
                        msg: undefined
                    }
                },
                action: 'create',
                refresh: 0
            }
        },
        methods: {
            listVouchers(page) {
                var me = this;
                this.refresh++;
                axios.get('/admin/voucher?page=' + page)
                    .then(function(response) {
                        console.log(response);
                        me.vouchers = response.data.vouchers;
                        me.links = response.data.links;
                        me.headers = Object.keys(response.data.vouchers.data[0]);
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            createVouchers() {
                var me = this;
                var form = new FormData();
                form.set('valid_to', this.voucher.valid_to);
                form.set('valid_since', this.voucher.valid_since);
                form.set('units', this.voucher.units);
                form.set('type', this.voucher.type);
                form.set('value', this.voucherValue);

                axios({
                        url: '/admin/voucher',
                        method: 'post',
                        data: form,
                    })
                    .then(function(response) {
                        console.log(response);
                        me.listVouchers(me.vouchers.current_page);
                        me.voucher.response.msg = response.data.msg;
                        me.voucher.response.success = true;
                    })
                    .catch(function(error) {
                        console.log(error.response.data);
                        me.voucher.response.msg = error.response.data.message;
                        me.voucher.response.success = false;
                    })
                    .then(function() {
                        me.voucher.response.done = true;
                        setTimeout(function() {
                            me.voucher.response.done = false;
                        }, 3000);
                    });
            },
            deleteVoucher(id) {
                var me = this;
                axios({
                        url: '/admin/voucher/' + id,
                        method: 'delete',
                    })
                    .then(function(response) {
                        console.log(response);
                        me.listVouchers(me.vouchers.current_page);
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            changeView(view) {
                this.view = view;
            },
            modalDelete(id) {
                if (confirm('¿Eliminar voucher?')) {
                    this.deleteVoucher(id);
                }
            }
        },
        computed: {
            voucherValue() {
                if (this.voucher.type == 'discount') {
                    return this.voucher.value / 100;
                } else {
                    return this.voucher.value;
                }
            }
        },
        mounted() {
            this.listVouchers(1);
        },
    });


    Vue.component('number-input', {
        props: ['title', 'min', 'max', 'initial'],
        template: `
            <div class="number-input-custom">
                <div class="row justify-content-center"><small v-html="title"></small></div>
                <div class="row number-input-group">
                    <a><i class="fas fa-minus number-input-control" @click="$emit('decrement')"></i></a>
                    <input type="number" class="number-input" :value="value" min="min" max="max" @input="$emit('input', $event.target.value)">
                    <a><i class="fas fa-plus number-input-control" @click="$emit('increment')"></i></a>
                </div>
            </div>`,

        computed: {
            value() {
                return this.initial < 0 ? 0 : this.initial;
            }
        },
    })
</script>

@endsection