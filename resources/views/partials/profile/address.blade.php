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

                    <select class="custom-select address-form-input" v-model="direccion.provincia" @change="getDepartamentos">
                        <option selected disabled>Selecciona una provincia</option>
                        <option v-for="(provincia, index) in provincias" :value="provincia" :key="index">@{{provincia.nombre}}</option>
                    </select>
                    <select class="custom-select address-form-input" v-model="direccion.departamento" @change="getLocalidades">
                        <option selected disabled>Selecciona un departamento</option>
                        <option v-for="(dpto, index) in departamentos" :value="dpto" :key="index">@{{dpto.nombre}}</option>
                    </select>
                    <select class="custom-select address-form-input" v-model="direccion.localidad">
                        <option selected disabled>Selecciona una localidad</option>
                        <option v-for="(localidad, index) in localidades" :value="localidad" :key="index">@{{localidad.nombre}}</option>
                    </select>
                    <div class="row m-0 address-form-input">
                        <input type="text" v-model="direccion.calle" placeholder="Calle" class="form-control col-md-8 address-form-input">
                        <input type="text" v-model="direccion.altura" placeholder="Nº" class="form-control col-md-2 address-form-input">
                        <input type="text" v-model="direccion.piso" placeholder="Dpto" class="form-control col-md-2 address-form-input">
                    </div>
                    <div class="row m-0 address-form-inpu">
                        <input type="text" class="form-control col-md-12 address-form-input" v-model="direccion.postal_code" placeholder="Código postal">
                    </div>
                    <textarea class="col-12 form-control" cols="30" rows="2" v-model="direccion.indicator" placeholder="Indicaciones adicionales"></textarea>
                    <div class="row m-0 address-search-btn">
                        <button type="reset" @click="resetForm" class="btn btn-link rojo pr-0">Reset</button>
                        <button type="button" @click="edit ? editAddress(direccion.id) : createAddress()" class="btn btn-link"><i class="fas fa-save mr-3"></i>Guardar</button>
                    </div>
                </form>

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
                <ul class="list-group address-list" v-if="user_address.length > 0">
                    <li class="list-group-item" v-for="(address, index) in user_address" :key="index">
                        <div class="address-item row m-0">
                            <i class="address-item-icon fas fa-map-marker-alt col-2"></i>
                            <div class="address-description col-7 col-md-7">
                                <p class="m-0">@{{capitalize(address.street) + ' ' + address.number}} @{{address.apartment != null ? ' - ' + address.apartment : ''}}</p>
                                <small>@{{address.locality.nombre}}, @{{address.province_department.nombre}}, @{{address.province.nombre}}</small>
                                <small>(@{{address.postal_code}})</small>
                            </div>
                            <a class="col-1" @click="select('address-form', address)" href="#"><i class="far fa-edit verde"></i></a>
                            <a href="#" class="col-1" @click="deleteAddress(address.id)"><i class="fas fa-times rojo"></i></a>
                        </div>
                    </li>
                </ul>
                <div v-else>
                    <p>No tienes cargada ninguna dirección</p>
                </div>
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
                    provincia: 'Selecciona una provincia',
                    departamento: 'Selecciona una departamento',
                    localidad: 'Selecciona una localidad',
                },
                user_address: [],
                edit: false,
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
            select(page, address = null) {

                if (address != null) {
                    this.direccion.calle = address.street;
                    this.direccion.indicator = address.indications || "";
                    this.direccion.altura = address.number;
                    this.direccion.piso = address.apartment;
                    this.direccion.provincia = address.province;
                    this.direccion.departamento = address.province_department;
                    this.direccion.localidad = address.locality;
                    this.direccion.postal_code = address.postal_code;
                    this.direccion.id = address.id;
                    this.getProvincias();
                    setTimeout(() => {
                        this.getDepartamentos();
                    }, 500);
                    setTimeout(() => {
                        this.getLocalidades();
                    }, 500);
                    this.edit = true;
                } else {
                    this.edit = false;
                    this.resetForm();
                }
                this.selectedPage = null;
                this.selectedPage = page;
                this.refresh++;
            },
            getProvincias: function() {
                var me = this;
                axios.get('https://apis.datos.gob.ar/georef/api/provincias?campos=id,nombre')
                    .then(function(response) {
                        response.data.provincias.map(function(province) {
                            me.provincias.push(province);
                        });
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            getDepartamentos: function() {
                var me = this;
                axios.get('https://apis.datos.gob.ar/georef/api/departamentos?provincia=' + me.direccion.provincia.id + '&campos=id,nombre&max=100')
                    .then(function(response) {
                        me.departamentos = [];
                        me.localidades = [];
                        response.data.departamentos.map(function(dpto) {
                            me.departamentos.push(dpto);
                        });
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            getLocalidades: function() {
                var me = this;
                axios.get('https://apis.datos.gob.ar/georef/api/localidades?departamento=' + me.direccion.departamento.id + '&max=1000&campos=id,nombre')
                    .then(function(response) {
                        me.localidades = [];
                        response.data.localidades.map(function(locality) {
                            me.localidades.push(locality);
                        });
                        console.log(response);

                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            getDireccion: function() {
                var me = this;
                axios.get('https://apis.datos.gob.ar/georef/api/direcciones?localidad=' + me.direccion.localidad.id + '&direccion=' + me.address)
                    .then(function(response) {
                        me.direccion.api = response.data;
                        me.search = true;
                        console.log(response);
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            resetForm: function() {
                this.direccion.altura = '';
                this.direccion.piso = '';
                this.direccion.calle = '';
                this.direccion.postal_code = '';
                this.direccion.indicator = '';
                this.direccion.departamento = 'Selecciona una departamento';
                this.direccion.localidad = 'Selecciona una localidad';
                this.direccion.provincia = 'Selecciona una provincia';
            },
            createAddress() {
                var me = this;
                axios({
                        method: 'post',
                        url: '/profile/location/',
                        data: {
                            postal_code: me.direccion.postal_code,
                            street: me.direccion.calle.trim(),
                            indicator: me.direccion.indicator.trim(),
                            number: String(me.direccion.altura).trim(),
                            apartment: me.direccion.piso.trim(),
                            province: JSON.stringify(me.direccion.provincia),
                            province_department: JSON.stringify(me.direccion.departamento),
                            locality: JSON.stringify(me.direccion.localidad),
                        }
                    })
                    .then(function(response) {
                        console.log(response);
                        me.getUserAddress();
                        me.select('address-list');
                        me.resetForm();
                        swal("Creado correctamente", '', 'success');
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            editAddress(id) {
                var me = this;
                axios({
                        method: 'put',
                        url: '/profile/location/' + id,
                        data: {
                            postal_code: me.direccion.postal_code,
                            street: me.direccion.calle.trim(),
                            indicator: me.direccion.indicator.trim(),
                            number: String(me.direccion.altura).trim(),
                            apartment: me.direccion.piso ? me.direccion.piso : '',
                            province: JSON.stringify(me.direccion.provincia),
                            province_department: JSON.stringify(me.direccion.departamento),
                            locality: JSON.stringify(me.direccion.localidad),
                        }
                    })
                    .then(function(response) {
                        console.log(response);
                        me.getUserAddress();
                        me.select('address-list');
                        me.resetForm();
                        swal("Modificado correctamente", '', 'success');
                    })
                    .catch(function(error) {
                        console.log(error.response);
                    });
            },
            deleteAddress(id) {
                swal({
                        title: "¿Eliminar dirección?",
                        text: "Una vez borrada, no podrás recuperar la información!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            var me = this;
                            axios.delete('/profile/location/' + id)
                                .then(function(response) {
                                    console.log(response);
                                    me.getUserAddress();
                                    swal("Eliminado correctamente", '', 'success');
                                })
                                .catch(function(error) {
                                    console.log(error);
                                });
                        } else {

                        }
                    });
            },
            getUserAddress: function() {
                var me = this;
                this.user_address = [];
                axios.get('/profile/location')
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
            capitalize(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

        },
        created() {
            this.getProvincias();
            this.getUserAddress();
        },
    });
</script>

@endsection
@section('script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection