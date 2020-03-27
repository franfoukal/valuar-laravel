@extends('profile')
@section('section')
<address-manager inline-template>
    <section v-if="selectedPage=='address-form'" class="animated fadeInRight faster">
        <div class="card my-3 col-12 col-md-12 col-lg-7">
            <div class="card-body">
                <div class="row mb-2">
                    <a @click="select('address-list')" class="col-1"><i class="fas fa-arrow-left"></i></a>
                    <h4 class="col-10">Agregar direccion</h4>
                </div>
                <form action="" v-on:submit.prevent>

                    <select class="custom-select address-form-input" v-model="provincia" @change="getDepartamentos">
                        <option selected disabled>Selecciona una provincia</option>
                        <option v-for="(provincia, index) in provincias" :value="provincia" :key="index">@{{provincia.nombre}}</option>
                    </select>
                    <select class="custom-select address-form-input" v-model="departamento" @change="getLocalidades">
                        <option selected disabled>Selecciona un departamento</option>
                        <option v-for="(dpto, index) in departamentos" :value="dpto" :key="index">@{{dpto.nombre}}</option>
                    </select>
                    <select class="custom-select address-form-input" v-model="localidad">
                        <option selected disabled>Selecciona una localidad</option>
                        <option v-for="(localidad, index) in localidades" :value="localidad" :key="index">@{{localidad.nombre}}</option>
                    </select>
                    <div class="row m-0 address-form-input">
                        <input type="text" v-model="direccion.calle" placeholder="Calle" class="form-control col-md-8 address-form-input">
                        <input type="text" v-model="direccion.altura" placeholder="Nº" class="form-control col-md-2 address-form-input">
                        <input type="text" v-model="direccion.piso" placeholder="Dpto" class="form-control col-md-2 address-form-input">
                    </div>
                    <textarea class="col-12 form-control" cols="30" rows="2" v-model="direccion.indicator" placeholder="Indicaciones adicionales"></textarea>
                    <div class="row m-0 address-search-btn">
                        <button type="reset" @click="resetForm" class="btn btn-link rojo pr-0">Reset</button>
                        <button type="button" @click="getDireccion" class="btn btn-link"><i class="fas fa-search mr-3"></i>Buscar</button>
                    </div>
                </form>


                <section v-if="search">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action m-0" v-for="(direccion, index) in direccion.api.direcciones">
                            <div class="row address-list-item">
                                <i class="far fa-building col-2"></i>
                                <div class="col-8">
                                    <p class="m-0 p-0">@{{direccion.nomenclatura}}</p>
                                    <small class="d-block col-12 m-0 p-0">Piso: @{{direccion.piso}} </small>
                                    <small class="d-block col-12 m-0 p-0">@{{indications}}</small>
                                </div>
                                <a href="#" class="btn btn-link col-2 p-0 m-0"><i class="far fa-save address-btn-save verde"></i></a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section v-else class="animated fadeIn">
        <div class="card col-12 col-md-12 col-lg-7">
            <div class="card-body">
                <div class="row address-card-heading">
                    <h4 class="address-card-title m-0">Direcciones</h4>
                    <a href="#" class="address-card-add-btn" @click="select('address-form')"><i class="fas fa-plus"></i></a>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="address-item row m-0">
                            <i class="address-item-icon fas fa-map-marker-alt col-2"></i>
                            <div class="address-description col-7 col-md-7">
                                <p class="m-0">Lorem ipsum dolor sit amet.</p>
                                <small>Lorem, ipsum.</small>
                            </div>
                            <a class="col-1" @click="select('address-form')" href="#"><i class="far fa-edit verde"></i></a>
                            <a href="#" class="col-1" @click="saludo('eliminar')"><i class="fas fa-times rojo"></i></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</address-manager>


<script type="application/javascript">
    Vue.component('address-manager', {
        data() {
            return {
                selectedPage: '',
                refresh: 0,
                provincias: [],
                departamentos: [],
                localidades: [],
                direccion: {
                    calle: '',
                    indicator: '',
                    altura: '',
                    piso: '',
                    completa: '',
                    api: '',
                },
                provincia: 'Selecciona una provincia',
                departamento: 'Selecciona una departamento',
                localidad: 'Selecciona una localidad',
                search: false,
                isMobile: ''
            }
        },
        computed: {
            address() {
                this.direccion.completa = this.direccion.calle + ' ' + this.direccion.altura + ' ' + this.direccion.piso;
                return this.direccion.completa;
            },
            isMobileComp: function() {
                return window.matchMedia("(max-width: 768px)").matches;
            },
            indications() {
                return this.direccion.indicator ? this.direccion.indicator : '';
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
                axios.get('https://apis.datos.gob.ar/georef/api/direcciones?localidad=' + me.localidad.id + '&direccion=' + me.address)
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
            resetForm: function() {
                this.direccion.altura = '';
                this.direccion.piso = '';
                this.direccion.calle = '';
                this.departamento = 'Selecciona una departamento';
                this.localidad = 'Selecciona una localidad';
            }
        },
        created() {
            this.getProvincias();
        },

    });
</script>

@endsection