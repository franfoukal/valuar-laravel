<div class="@php echo isset($fav) ? $fav : 'col-12 col-md-4 col-lg-3' @endphp">
    <div class="product" id="sp{{$index}}">
        <div class="card bg-white p-1 px-2">
            <div class="row">
                <div class="col-5 col-md-12">
                    <div class="list-item text-center mb-3">
                        <a href="/product/{{$id}}">
                            <img class='list-img rounded-lg' src="{{$photo}}" alt="">
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
                                <p class=' mb-1 text-muted font-weight-light'>Material: {{$material}}</p>
                                <!-- PONER MATERIAL -->
                                <p class='h6 mb-0 text-muted font-weight-light'>Incrustación: Diamante</p>
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
                    <form action="/valuar/product/add-to-cart" method="post">
                        <input name="cart" type="hidden" value=''>
                        <button name="agregar" type="submit" class='btn bg-verde text-white w-100 mx-auto'>Añadir al carrito</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="application/javascript">
    new Vue({
        el: '#sp{{$index}}',
        data: {
            fav: false,
            auth: "{{$isAuth == 1 ? 1 : 0}}" == 1 ? true : false,
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
                axios.post('/product/fav/{{$id}}')
                    .then(function(response) {
                        console.log(response);
                        window.location.reload()
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
            removeFromFav() {
                if (!this.auth) {
                    return;
                }
                axios.delete('/product/fav/{{$id}}')
                    .then(response => {
                        console.log(response);
                        window.location.reload()
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
                axios.post("/product/isfav/{{$id}}/{{Auth::check() ? Auth::user()->id : ''}}")
                    .then(function(response) {
                        me.fav = response.data;
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            },
        },
        mounted() {
            this.isFav();
        },
    });
</script>