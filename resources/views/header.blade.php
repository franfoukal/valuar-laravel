<header id="header" class="z-depth-1-half" :class="locationLog ? 'index' : ''">
    <nav class=" navbar navbar-expand-md navbar-dark transparent home" :class="locationLog ? 'transparent' : 'bg-noche'">
        <a class="navbar-brand" href="/home"><img class="logo img-responsive" src="img/valuar-logo23.svg" alt=""></a>
        <a type="button" class="btn bg-rojo cart" href="/cart">
            <i class="fas fa-shopping-cart"></i>
            <span class="badge badge-light">4</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="/product-list">
                        <i class="fas fa-ring"></i> Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="/contact">
                        <i class="fas fa-envelope"></i> Contacto
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="/signup">
                        <i class="fas fa-user"></i> Registrate
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="/login">
                        <i class="far fa-user"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    

    <div class="jumbotron animated fadeInDown slow" v-if="locationLog">
        <div class="container ">
            <h1 class="display-3 crema text-shadow">Hey! new season is here</h1>
            <p class="text-white">Nuevos aires, nuevas influencias, todo vertido en la nueva colección. Dedicada a los intrépidos, entrá a ver lo nuevo de esta experiencia conceptual.</p>
            <p><a class="btn bg-verde waves-effect waves-light btn-lg mt-5 rounded text-white" href="/product-list" role="button">Descubrí más »</a></p>
        </div>
    </div>


</header>

<script>
    var app = new Vue({
        el: '#header',
        data: {},
        computed: {
            locationLog: function() {
                return window.location.pathname == '/home' || window.location.pathname == '/';
            }
        }
    });
</script>