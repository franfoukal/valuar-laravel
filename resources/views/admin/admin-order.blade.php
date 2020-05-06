@extends('admin.admin-template')
@section('page-title')
@section('css', '/css/admin/product.css')
@section('content')
<!--
/*
*   
*   Trabajo en progreso.
*   
*   Zona de escombros. 
*   
*   Peligro zanja abierta.
*/
-->
<div class="row">
    <div class="col-12 col-xl-6 offset-lg-3 col-lg-6 justify-content-center z-depth-1-half bg-white mb-5">
        <div class="container-fluid px-2">
            <div class="row">
                <div class="col-12 my-2">
                    <h2 class='font-weight-bold'>Venta número: {{$order->id}}</h2>
                </div>
                <div class="col-12 my-2">
                    <h4>
                        Cliente:
                    </h4>
                </div>
                <div class="col-12 my-2">
                    <p>
                        Nombre: <span class='font-weight-bold'>{{$user['name'] . ' ' . $user['surname']}}</span>
                    </p>
                    <p>
                        Email: <span class='font-weight-bold'><a href="mailto:{{$user['email']}}">{{$user['email']}}</a></span>
                    </p>
                    <p>
                        Dirección: <span class="font-weight-bold"> {{$location['street'] . ' ' . $location['number'] . ($location['apartment'] ? $location['apartment'] : '') . ', ' . json_decode($location['province'], true)['nombre'] . '.' }} </span>
                    </p>
                    <p>
                        Código Postal: <span class='font-weight-bold'>{{$location['postal_code'] . '.'}}</span>
                    </p>

                </div>
                
                <div class="col-12 my-2">
                    
                </div>
                <div class="col-12 my-2">
                    <h4>Artículos:</h4>
                </div>
                <div class="col-12 my-2">
                    <ul class='pl-0'>
                    @foreach($articles as $article)
                        <li class='list-group-item'>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-lg-6 text-center">
                                        <img src="{{$article['first_photo'] ? '/storage/img/products/' . $article['first_photo']['path'] : ''}}" class='img-fluid order-article-img' alt="Sin foto"> 
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class='mb-0'>
                                                        Nombre: <span class='font-weight-bold'>{{$article['name']}}</span>
                                                    </p>
                                                </div>
                                                <div class="col-12">
                                                    <p class='text-muted'>
                                                        Código: {{$article['barcode']}}
                                                    </p>
                                                </div>
                                                <div class="col-12">
                                                    <p>
                                                        Cantidad: <span class='font-weight-bold'>{{$article['units']}}</span>
                                                    </p>
                                                </div>                                                                                                                
                                                <div class="col-12">
                                                    <p>
                                                        Precio unitario: <span class='font-weight-bold'>$ {{$article['price']}}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </li>
                    @endforeach
                    </ul>
                </div>
                <div class="col-12 mt-2">
                    <p class=""><span class='h5 font-weight-light mb-0'>Subtotal: </span> <span class='font-weight-bold'> $ {{$total['subtotal']}}</span></p>
                </div>
                <div class="col-12 mb-2">
                    <p><span class='h5 font-weight-light'>Vouchers: </span> <span class='font-weight-bold'> $ {{($total['descuento'] > 0) ? '-' . $total['descuento'] : 0}}</span></p>
                </div>
                <div class="col-12">
                    <p><span class='h4 font-weight-light'>Total: </span> <span class='font-weight-bold'> $ {{$total['total']}}</span></p>
                </div>
            </div>
        </div>
    
    </div>       
</div>



@endsection