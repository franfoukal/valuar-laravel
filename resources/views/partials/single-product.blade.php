<div class="@php echo isset($fav) ? $fav : 'col-12 col-md-4 col-lg-3' @endphp">
    <product inline-template class="product {{(Route::currentRouteName() == 'home') ? 'disappear' : ''}}" id="sp{{$index}}" id_prod="{{$id}}">
        <div class="card bg-white p-1 px-2">
            <div class="row">
                <div class="col-5 col-md-12">
                    <div class="list-item text-center mb-3">
                        <a href="/product/{{$id}}">
                            <img class='list-img rounded-lg' src="/storage/img/products/{{$photo}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-7 col-md-12">
                    <div class="list-item">
                        <div class="row">
                            <div class="col-12">
                                <div class="row m-0 justify-content-between align-items-start">
                                    <a href="/product/{{$id}}">
                                        <!-- PONER LINK -->
                                        <h4 class='mb-1 noche font-weight-light'>
                                            <!-- PONER NOMBRE -->
                                            {{$name}}
                                        </h4>
                                    </a>
                                    <a v-if="fav" @click="favToogle"><i class="fas fa-heart rojo"></i></a>
                                    <a v-else @click="favToogle"><i class="far fa-heart rojo"></i></a>
                                </div>
                            </div>
                            <div class='col-12 mb-1 '>
                                <p class=' mb-1 text-muted font-weight-light'>Material: {{$material ?? '-' }}</p>
                                <!-- PONER MATERIAL -->
                            </div>
                            <div class='col-12 mb-2'>
                                <h5 class='mb-0 mt-1 precio d-flex font-weight-bold'>
                                    $ {{$price}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button @click.prevent="addToCart" name="agregar" type="button" class='btn bg-verde text-white w-100 mx-auto'>Añadir al carrito</button>
                </div>
            </div>
        </div>
    </product>
</div>

@section('script')
<script type="application/javascript">
    Vue.component('product', {
        props: ['id_prod'],
        data() {
            return {
                fav: false,
                auth: "{{$isAuth == 1 ? 1 : 0}}" == 1 ? true : false,
                units: 1,
                size: 20
            }
        },
        computed: {

        },
        methods: {
            favToogle() {
                this.fav = !this.fav;
                this.fav ? this.addToFav() : this.removeFromFav();
            },
            addToFav() {
                if (!this.auth) {
                    window.location.href = "/login";
                    return;
                }
                var me = this;
                axios.post('/product/fav/' + me.id_prod)
                    .then(function(response) {
                        console.log(response);
                        me.$root.$emit('add-to-fav');
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            removeFromFav() {
                if (!this.auth) {
                    return;
                }
                var me = this;
                axios.delete('/product/fav/' + me.id_prod)
                    .then(response => {
                        console.log(response);
                        me.$root.$emit('remove-from-fav'); 
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            isFav() {
                if (!this.auth) {
                    return;
                }
                var me = this;
                axios.post("/product/isfav/" + me.id_prod + "/{{Auth::check() ? Auth::user()->id : ''}}")
                    .then(function(response) {
                        console.log(response);

                        me.fav = response.data;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            addToCart() {
                let me = this;
                axios.post("/cart/add", {
                        id: me.id_prod,
                        units: me.units,
                        size: me.size
                    })
                    .then(function(response) {
                        console.log(response);
                        me.$root.$emit('add-to-cart');
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        },
        mounted() {
            this.isFav();
            this.$root.$on('add-to-fav', () => {
                this.isFav();
            });
            this.$root.$on('remove-from-fav', () => {
                this.isFav();
            });
        },
    });
</script>
@endsection