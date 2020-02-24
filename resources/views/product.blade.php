@extends('template')
@section('title', 'Producto')
@section('main-content')
<div class="container-fluid bg-crema">
    <?php
    $prod = json_decode($product, true);
    ?>

    <div class="container bg-crema pt-3">
        <div class="card p-0  mb-3">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-5 my-auto">
                        <div class="card-img mx-auto">
                            <!--Carousel Wrapper-->
                            <div id="carrusel" class="carousel slide carousel-fade" data-ride="carousel">
                                <!--Indicators-->
                                <ol class="carousel-indicators">
                                    <li data-target="#carrusel" data-slide-to="0" class="active"></li>
                                    <li data-target="#carrusel" data-slide-to="1"></li>
                                    <li data-target="#carrusel" data-slide-to="2"></li>
                                </ol>
                                <!--Slides-->
                                <div class="carousel-inner" role="listbox">
                                    <!--First slide-->


                                    @foreach($product['photos'] as $photo)
                                    @if ($loop->first)
                                    <div class="carousel-item active">
                                        <img class="d-block img-fluid product-img" src="{{asset($photo['path'])}}" alt="">
                                    </div>
                                    @endif
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset($photo['path'])}}" alt="Third slide">
                                    </div>
                                    @endforeach

                                </div>
                                <!--/.Slides-->
                                <!--Controls-->
                                <a class="carousel-control-prev noche" href="#carrusel" role="button" data-slide="prev">
                                    <span class=" noche carousel-control-prev-icon waves-effect carrusel-icon" aria-hidden="true"></span>
                                    <span class="sr-only noche">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carrusel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon waves-effect carrusel-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <!--/.Controls-->
                            </div>
                            <!--/.Carousel Wrapper-->
                        </div>
                    </div>
                    <div class="col-12 col-md-7 mt-auto">
                        <div class="row mb-4">
                            <div class="col-12">
                                <h3 class='my-1 item-title card-title'>Anillo {{$product['name']}}</h3>
                                <ol class="breadcrumb font-small p-0">
                                    <li class="breadcrumb-item">
                                        <a class='' href="#">Joyas</a>
                                    </li>
                                    <li class="breadcrumb-item active">
                                        <a class='' href="#">Colgantes</a>
                                    </li>
                                </ol>
                                <p class='card-text my-1'>
                                    {{$product['description']}}
                                </p>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                                <h3 class='h3 amount plain-text my-3 mx-auto'>${{$product['price']}} <span id='precio'></span></h3>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                                <form id="buy-form" action="" method="POST">
                                    <input name="product-id" type="hidden" value="">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4 d-flex flex-direction-column justify-content-center">
                                                <label class='my-auto' for="size">
                                                    <span>Talle: </span>
                                                </label>
                                            </div>
                                            <div class="col-8 text-center">
                                                <select class='custom-select talle-select' name="size" id="size">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option class='disabled bg-noche piel' value="" disabled>S</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option class='disabled bg-noche piel' value="" disabled>M</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option class='disabled piel bg-noche piel' value="" disabled>L</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                    <option value="32">32</option>
                                                    <option value="33">33</option>
                                                    <option value="34">34</option>
                                                    <option value="35">35</option>
                                                    <option value="36">36</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row my-auto">
                                            <div class="col-4 d-flex flex-direction-column justify-content-center">
                                                <label class='my-auto' for="cantidad">
                                                    <span>Cantidad: </span>
                                                </label>
                                            </div>
                                            <div class="col-8">
                                                <div class="row mx-1 justify-content-center">
                                                    <div class="col-4 text-center px-0">
                                                        <div class='form-control waves-effect bg-crema cantidad' id='minus' onclick='resta()'>
                                                            <i class="fas fa-minus"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 px-0">
                                                        <input class='cantidad text-center px-0 h-100' min='1' type="number" name="cantidad" id="cantidad" disabled></input>
                                                    </div>
                                                    <div class="col-4 text-center px-0">
                                                        <div class='form-control waves-effect bg-crema text-center cantidad' id='plus' onclick="suma()">
                                                            <i class="fas fa-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 col-md-6 mb-2">
                                <form action="/valuar/product/add-to-cart" method="post">
                                    <input name="cart" type="hidden" value=''>
                                    <button name="agregar" type="submit" class='btn btn-block rounded text-white bg-verde bd-verde'>Añadir al carrito</button>
                                </form>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <button form="buy-form" formaction="product-buy" class='btn btn-block rounded transparent bd-verde'>Comprar ahora</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-3">
                <h4>También te puede interesar...</h4>
                <!-- INCLUIR PRODUCTOS -->
                <div class="row">
                    @foreach($recomended as $product)
                    @component('partials.single-product',
                    [
                    'name' => $product->name,
                    'material' => $product->material,
                    'price' => $product->price,
                    'id' => $product->id,
                    'photo' => isset($product->firstPhoto['path']) ? $product->firstPhoto['path'] : 'img/products/prod-1.png'
                    ])
                    @endcomponent
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src='/valuar/assets/js/product.js'></script> -->
@endsection