<header id="header" class="z-depth-1-half" :class="locationLog ? 'index' : ''">
    <nav class=" navbar navbar-expand-md navbar-dark transparent home" :class="locationLog ? 'transparent' : 'bg-noche'">
        <a class="navbar-brand" href="/home"><img class="logo img-responsive" src="{{asset('img/valuar-logo23.svg')}}" alt=""></a>
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
                    <a class="nav-link waves-effect waves-light" href="/products">
                        <i class="fas fa-ring"></i> Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="/contact">
                        <i class="fas fa-envelope"></i> Contacto
                    </a>
                </li>
                @guest
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="{{route('register')}}">
                        <i class="fas fa-user"></i> Registrate
                    </a>
                </li>
                @endif
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="/login">
                        <i class="far fa-user"></i> Login
                    </a>
                </li>
                @endif
                @endguest
                @auth
                <li class="nav-item dropdown">
                    <a href='/profile' class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{Auth::user()->name}} 
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                        <a class="dropdown-item waves-effect waves-light" href="/profile">Mi cuenta</a>
                        @if (Auth::User()->roles_id == 0)
                        <a class='dropdown-item waves-effect waves-light' href="/admin">Panel de control</a>
                        @endif
                        <a class="dropdown-item waves-effect waves-light" 
                            href="{{url('/logout')}}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Salir
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
    

    <div class="jumbotron animated fadeInDown slow" v-if="locationLog">
        <div class="container ">
            <h1 class="display-3 crema text-shadow">Hey! new season is here</h1>
            <p class="text-white">Nuevos aires, nuevas influencias, todo vertido en la nueva colección. Dedicada a los intrépidos, entrá a ver lo nuevo de esta experiencia conceptual.</p>
            <p><a class="btn bg-verde waves-effect waves-light btn-lg mt-5 rounded text-white" href="/products" role="button">Descubrí más »</a></p>
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