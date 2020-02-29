@extends('template')
@section('title', 'Mi Cuenta')
@section('main-content')
<main class="container-fluid" id="profile">
    <span class="d-none is-mobile"></span>
    <div class="row m-0 profile-wrapper">
        <aside class="profile-nav col-12 col-md-5 col-lg-4">
            <div class="profile-img-wrapper text-center text-md-left">
                <img src="/img/profile/profile-default.jpeg" alt="" class="profile-img shadow p-0 rounded-circle col-9 col-md-8 col-lg-6 bd-crema">
            </div>
            <div class="row profile-header">
                <h1 class="profile-name">{{ucfirst(Auth::user()->name)}}</h1>
                <a href="#" class="profile-edit-icon"><i class="fas fa-cog verde"></i></a>
            </div>
            <h5 class="profile-email">{{Auth::user()->email}}</h5>

            <nav>
                <ul class="clearlist profile-list">
                    <li class="profile-list-item" @click="select('order-list')" data-toggle="modal" data-target="#modals-mobile"><a href="#">Órdenes</a></li>
                    <li class="profile-list-item" @click="select('fav-list')" data-toggle="modal" data-target="#modals-mobile"><a href="#">Favoritos</a></li>
                    <li class="profile-list-item" @click="select('address-list')" data-toggle="modal" data-target="#modals-mobile"><a href="#">Direcciones</a></li>
                </ul>
            </nav>
        </aside>

        <div class="profile-main d-none d-md-block col-md-7 col-lg-5" :key="refresh">
            <section id="profile-address" v-if="selectedPage == 'address-list'" class="animated fadeIn">
                @include('partials.profile.address')
            </section>
            <section id="profile-ordenes" v-if="selectedPage == 'order-list'">
                ordenes
            </section>
            <section id="profile-fav" v-if="selectedPage == 'fav-list'">
                Favoritos
            </section>
            <section v-if="selectedPage=='address-form'" class="animated fadeInRight faster">
                @include('partials.profile.address-form')
            </section>
        </div>

    </div>

    <!-- MODALES -->

    <!-- <div class="profile-main modal d-md-none col-12" :key="refresh" id="modals-mobile">
        <div class="modal-body">
            <section id="profile-address" v-if="selectedPage == 'address-list'" class="animated fadeIn">
                @include('partials.profile.address')
            </section>
            <section id="profile-ordenes" v-if="selectedPage == 'order-list'">
                ordenes
            </section>
            <section id="profile-fav" v-if="selectedPage == 'fav-list'">
                Favoritos
            </section>
            <section v-if="selectedPage=='address-form'" class="animated fadeInRight faster">
                <div class="card">
                    <div class="card-body">
                        <form action="">
                            <div class="row">
                                <a @click="select('address-list')" class="col-1"><i class="fas fa-arrow-left"></i></a>
                                <h4 class="col-10">Agregar direccion</h4>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div> -->


</main>

<script type="application/javascript">
    var profile = new Vue({
        el: '#profile',
        data: {
            selectedPage: 'address-form',
            refresh: 0,
            mobile: null,
            provincias: [],
            departamentos: [],
            localidades: [],
            direccion: {
                calle: '',
                altura: '',
                piso: '',
                completa: '',
                api:''
            },
            provincia: 'Selecciona una provincia',
            departamento: 'Selecciona una departamento',
            localidad: 'Selecciona una localidad',
            search: false

        },
        computed: {
            isMobile: function() {

            },
            address: function() {
                this.completeAddress();
            }
        },
        watch: {

            address: function() {
                this.address();
            }
        },

        methods: {
            select: function(page) {
                this.selectedPage = null;
                this.selectedPage = page;
                this.refresh++;
            },
            saludo: function(msg) {
                console.log(msg);
            },
            getProvincias: function() {
                var me = this;
                axios.get('https://apis.datos.gob.ar/georef/api/provincias?campos=id,nombre')
                    .then(function(response) {
                        // handle success
                        response.data.provincias.map(function(province) {
                            me.provincias.push(province);
                        });
                        console.log(response);
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function() {
                        // always executed
                    });
            },
            getDepartamentos: function() {
                var me = this;
                axios.get('https://apis.datos.gob.ar/georef/api/departamentos?provincia=' + me.provincia.id + '&campos=id,nombre&max=100')
                    .then(function(response) {
                        // handle success
                        me.departamentos = [];
                        me.localidades = [];
                        response.data.departamentos.map(function(dpto) {
                            me.departamentos.push(dpto);
                        });
                        console.log(response);
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function() {
                        // always executed
                    });
            },
            getLocalidades: function() {
                var me = this;
                axios.get('https://apis.datos.gob.ar/georef/api/localidades?departamento=' + me.departamento.id + '&max=1000&campos=id,nombre')
                    .then(function(response) {
                        // handle success
                        me.localidades = [];
                        response.data.localidades.map(function(locality) {
                            me.localidades.push(locality);
                        });
                        console.log(response);
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function() {
                        // always executed
                    });
            },
            getDireccion: function() {
                var me = this;
                axios.get('https://apis.datos.gob.ar/georef/api/direcciones?localidad=' + me.localidad.id + '&direccion=' + me.direccion.completa)
                    .then(function(response) {
                        // handle success
                        me.direccion.api = response.data;
                        me.search = true;
                        console.log(response);
                    })
                    .catch(function(error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function() {
                        // always executed
                    });
            },
            completeAddress: function() {
                this.direccion.completa = this.direccion.calle + ' ' + this.direccion.altura + ' ' + this.direccion.piso;
            }
        },

        created() {
            this.getProvincias();
        },

    });
</script>
@endsection