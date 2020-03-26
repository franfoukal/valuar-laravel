@extends('template')
@section('title', 'Lista de Productos')
@section('main-content')
<div class="container-fluid bg-crema" id="product-list">

    <div class="container bg-crema">
        <!--Banner-->

        @include('partials.prod-list-banner')

        <div class="row categorias-row bg-crema">
            <div class="col-12 my-auto bg-crema">
                <div class="bg-crema rounded mt-3">
                    <ul class='list-unstyled text-center'>
                        <li class='menu-li'>
                            <button class='btn bg-crema menu-btn dropdown-toggle' data-toggle='dropdown' type='button'>
                                Categorías
                            </button>
                            <div class="dropdown-menu">
                                <a class='dropdown-item' href="/products/filter/{{'aros'}}">Aros</a>
                                <a class='dropdown-item' href="/products/filter/{{'colgantes'}}">Colgantes</a>
                                <a class='dropdown-item' href="/products/filter/{{'anillos'}}">Anillos</a>
                                <a class='dropdown-item' href="/products/filter/{{'pulseras'}}">Pulseras</a>
                            </div>
                        </li>
                        <li class='menu-li'>
                            <button class='btn bg-crema menu-btn dropdown-toggle' data-toggle="dropdown" type="button">
                                Ordenar por:
                            </button>
                            <div class="dropdown-menu">
                                <a class='dropdown-item' href="/products">Nuevos <i class="fas fa-exclamation text-default  annimated flash infinite slow"></i></a>
                                <a class='dropdown-item' href="/products/orderBy/{{'relevantes'}}">Más relevantes</a>
                                <a class='dropdown-item' href="/products/orderBy/{{'aZ'}}">A - Z</a>
                                <a class='dropdown-item' href="/products/orderBy/{{'Za'}}">A - Z</a>
                                <a class='dropdown-item' href="/products/orderBy/{{'menorPrecio'}}">Menor Precio</a>
                                <a class='dropdown-item' href="/products/orderBy/{{'mayorPrecio'}}">Mayor Precio</a>
                            </div>
                        </li>
                        <li class='menu-li'>
                            <button class='btn bg-crema menu-btn dropdown-toggle' data-toggle="dropdown" type='button'>
                                Material:
                            </button>
                            <div class="dropdown-menu">
                                {{-- <span class='dropdown-item'>Material: </span> --}}
                                <a class='dropdown-item' href="/products/filter/{{'oro'}}">Oro</a>
                                <a class='dropdown-item' href="/products/filter/{{'plata'}}">Plata</a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li>
                        <li class='menu-li'>
                            <button class='btn bg-crema menu-btn dropdown-toggle' data-toggle="dropdown" type="button">
                                Precio:
                            </button>
                            <div class="dropdown-menu">
                                <a class='dropdown-item' href="/products/filter/{{'0_2500'}}">Hasta $2500</a>
                                <a class='dropdown-item' href="/products/filter/{{'2500_5000'}}">$2500 - $5000</a>
                                <a class='dropdown-item' href="/products/filter/{{'5000_99999'}}">Más de $5000</a>
                            </div>
                        </li>
                        <li class='menu-li'>
                            <button class='btn bg-crema menu-btn dropdown-toggle' data-toggle="dropdown" type='button'>
                                Buscar:
                            </button>
                            <div class="dropdown-menu">
                                <form action="/products/search" method="get">
                                    @csrf
                                    <div class="form-group">
                                        <div class="container ">
                                            <div class="md-form input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text md-addon">
                                                        <button type="submit" class="btn bg-verde text-white m-0 btn-sm mt-2">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" name='search' placeholder="{{ old('search') ? old('search') : 'Buscar producto' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--Lista de productos & Menu Categorias-->
        <div class="row main-row bg-crema">
            <!--Categorías de costado-->
            <nav class="col-lg-2 bg-crema rounded-lg categorias-side d-md-none d-lg-block">
                <ul class='list-unstyled my-2'>
                    <li>
                        <h5 class='my-1 cat-title noche'>
                            Buscar:
                        </h5>
                    </li>
                    <li>
                        <form action="/products/search" method="get">
                            @csrf
                            <div class="md-form">
                                <div class="container">
                                    <input type="text" class="form-control col-12" name='search' placeholder="{{ old('search') ? old('search') : 'Buscar alhajas' }}">
                                    <button type="submit" class="btn bg-verde text-white m-0 btn-sm mt-2 col-12">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                    <li>
                        <div class="divisor my-1"></div>
                    </li>
                    <li>
                        <h5 class='mb-1 noche cat-title'>Categorías: </h5>
                    </li>
                    <li>
                        <a class='noche' href="/products/filter/{{'aros'}}">
                            Aros
                        </a>
                    </li>
                    <li>
                        <a class='noche' href="/products/filter/{{'colgantes'}}">
                            Colgantes
                        </a>
                    </li>
                    <li>
                        <a class='noche' href="/products/filter/{{'anillos'}}">
                            Anillos
                        </a>
                    </li>
                    <li>
                        <a class='noche' href="/products/filter/{{'pulseras'}}">
                            Pulseras
                        </a>
                    </li>
                    <li>
                        <div class="divisor my-1"></div>
                    </li>
                    <li>
                        <h5 class='my-1 cat-title noche'>
                            Ordenar por:
                        </h5>
                    </li>
                    <li>
                        <a class='noche' href="/products">Nuevos <i class="fas fa-exclamation text-default animated flash infinite slow"></i></a>
                    </li>
                    <li>
                        <a class='noche' href="/products/orderBy/{{'relevantes'}}">Más relevantes</a>
                    </li>
                    <li>
                        <a class='noche' href="/products/orderBy/{{'aZ'}}">A - Z</a>
                    </li>
                    <li>
                        <a class='noche' href="/products/orderBy/{{'Za'}}">Z - A</a>
                    </li>
                    <li>
                        <a class='noche' href="/products/orderBy/{{'menorPrecio'}}">Menor precio</a>
                    </li>
                    <li>
                        <a class='noche' href="/products/orderBy/{{'mayorPrecio'}}">Mayor precio</a>
                    </li>
                    <li>
                        <div class="divisor my-1"></div>
                    </li>
                    <li>
                        <h5 class='my-1 cat-title noche'>
                            Material:
                        </h5>
                    </li>
                    {{-- <li>
                        <h6 class='noche'>Material: </h6>
                    </li> --}}
                    <li>
                        <a class='noche' href="/products/filter/{{'oro'}}">Oro</a>
                    </li>
                    <li>
                        <a class='noche' href="/products/filter/{{'plata'}}">Plata</a>
                    </li>
                    <li>
                        <div class="divisor my-1"></div>
                    </li>
                    <li>
                        <h5 class='my-1 cat-title noche'>
                            Precio:
                        </h5>
                    </li>
                    <li>
                        <a class='noche' href="/products/filter/{{'0_2500'}}">Hasta $2500</a>
                    </li>
                    <li>
                        <a class='noche' href="/products/filter/{{'2500_5000'}}">$2500 - $5000</a>
                    </li>
                    <li>
                        <a class='noche' href="/products/filter/{{'5000_99999'}}">Más de $5000</a>
                    </li>
                </ul>
            </nav>
            <!--Lista de productos-->
            <div class="col-12 col-lg-10">
                <div class="row">

                    @forelse($products as $product)
                    <!-- <div class="col-12 col-md-4 col-lg-3"> -->
                        @component('partials.single-product',
                        [
                        'name' => $product->name,
                        'material' => $product->material->name,
                        'price' => $product->price,
                        'id' => $product->id,
                        'photo' => isset($product->firstPhoto['path']) ? $product->firstPhoto['path'] : 'prod-1.png',
                        'index' => $loop->index,
                        'isAuth' => Auth::check()
                        ])
                        @endcomponent
                    <!-- </div> -->
                    @empty
                    <div class='container text-center'>
                        <h3 class='m-5'>Disculpe, ese producto no existe.</h3>
                        <h4 class="m-5"><a href="/products"><i class="fas fa-arrow-left"></i> Volver a productos nuevos.</a></h4>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!--Paginación de abajo-->
        <div class="col-12 d-flex justify-content-center mt-5">
            @if (!empty($products))
            {{$products->appends(request()->query())->links()}}
            @endif
        </div>
    </div>
</div>

@endsection