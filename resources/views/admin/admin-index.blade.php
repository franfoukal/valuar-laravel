@extends('admin.admin-template')
@section('page-title', 'Panel de admin')
@section('css', '/css/admin/product.css')
@section('content')
<div class="container">
<div class="row">
    <div class="col-12 col-md-4">
        <div class="bg-white my-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 py-1">
                        <h2 class='font-weight-light mb-0'>Productos:</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h2 class='font-weight-bold'>{{$totalProducts}}</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h4 class='font-weight-light'>Productos activos: <span class='font-weight-bold'>{{$products}}</span></h4>
                    </div>
                    <div class="col-12 waves-effect py-2 admin-btn btn bg-crema">
                        <a href="/admin/products">
                            <div class="row">
                                <div class="col-10 d-flex justify-content-center">
                                    <h6 class='my-auto noche'>VER PRODUCTOS</h6>
                                </div>
                                <div class="col-2">
                                    <i class="fas fa-angle-right noche"></i>
                                </div>
                            </div>    
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="bg-white my-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 py-1">
                        <h2 class='font-weight-light mb-0'>Usuarios online:</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h2 class='font-weight-bold'>{{$usersOnline}}</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h4 class='font-weight-light'>Total de usuarios: <span class='font-weight-bold'>{{$totalUsers}}</span></h4>
                    </div>
                    <div class="col-12 waves-effect py-2 admin-btn btn bg-crema">
                        <a href="/admin/users">
                            <div class="row">
                                <div class="col-10 d-flex justify-content-center">
                                    <h6 class='my-auto noche'>VER USUARIOS ONLINE</h6>
                                </div>
                                <div class="col-2">
                                    <i class="fas fa-angle-right noche"></i>
                                </div>
                            </div>    
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="bg-white my-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 py-1">
                        <h2 class='font-weight-light mb-0'>Ventas:</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h2 class=font-weight-bold>$ {{$totalIncome}}</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h4 class='font-weight-light'>Ventas totales: <span class='font-weight-bold'>{{$orders}}</span></h4>
                    </div>
                    <div class="col-12 waves-effect py-2 admin-btn btn bg-crema">
                        <a href="/admin/sells">
                            <div class="row">
                                <div class="col-10 d-flex justify-content-center">
                                    <h6 class='my-auto noche'>VER VENTAS</h6>
                                </div>
                                <div class="col-2">
                                    <i class="fas fa-angle-right noche"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>     
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-12">
            <div class="bg-white my-2">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class='font-weight-light'>Los más vendidos:</h2>
                        </div>
                        <div class="col-12">
                            <ul class="list-group">
                            @foreach($bestSellers as $product)
                            <li class="list-group-item">
                                <div class="row admin-prod-item">
                                    <div class="col-4 col-md-2">
                                        <img src="{{$product->firstPhoto['path']}}" class="img-circle shadow admin-prod-img" alt="" style="width: 4rem">
                                    </div>
                                    <div class="col-4 col-md-8">
                                        <h5 class="admin-prod-name">{{$product->name}}</h5>
                                        <p class="admin-prod-description">Barcode: {{$product->barcode}}</p>
                                    </div>
                                    <a href="edit-product/{{$product->id}}" class="col-4 col-md-2 verde">
                                        Editar <i class="far fa-edit"></i>
                                    </a>
                                </div>
                            </li>
                            @endforeach
                            </ul>
                        </div>
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection