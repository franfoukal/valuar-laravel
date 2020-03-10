@extends('admin.admin-template')
@section('page-title', 'Ventas')
@section('css', '/css/admin/product.css')
@section('content')
<div class="row mb-4">
    <div class="col-12 col-md-4">
        <div class="bg-white my-2">
            <div class="container">
                <div class="row">
                    <div class="col-12 py-1">
                        <h2 class='font-weight-light mb-0'>Total ventas:</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h2 class='font-weight-bold'>$ {{$totalIncome}}</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h4 class='font-weight-light'>Numero de ventas: <span class='font-weight-bold'>{{$totalSells}}</span></h4>
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
                        <h2 class='font-weight-light mb-0'>Total con impuestos:</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h2 class='font-weight-bold'>$ {{$totalWithTaxes}}</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h4 class='font-weight-light'>Impuestos promedio:<span class='font-weight-bold'>% 21</span></h4>
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
                        <h2 class='font-weight-light mb-0'>Total con intereses:</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h2 class='font-weight-bold'>$ {{$totalWithInterests}}</h2>
                    </div>
                    <div class="col-12 py-1">
                        <h4 class='font-weight-light'>Interés promedio:<span class='font-weight-bold'>% 21</span></h4>
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
</div>

<main class="container col-12 col-md-8">

    <div class="row admin-top-list-controls">
        <div class="admin-prod-back-btn col-2 col-md-1 mb-3">
            <a href="/admin/sells"><i class="fas fa-times rojo"></i></a>
        </div>
        <form action="" method="get" class="col-10 col-md-8">
            @csrf
            <div class="col-12 col-md-8 mb-3 p-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend3">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" name="search" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3" required>
                </div>
            </div>
        </form>
        
    </div>

    <ul class="list-group">
        @foreach($sells as $sell)
        <li class="list-group-item">
            <div class="row admin-prod-item">
                <div class="col-4 col-md-8">
                    <h5 class="admin-prod-name">{{Product::where('id', $sell->product_id)->name}}</h5>
                </div>
                <a href="/admin/order/{{$sell->id}}" class="col-4 col-md-2 verde">
                    Ver <i class="far fa-edit"></i>
                </a>
            </div>
        </li>
        @endforeach
    </ul>
    
</main>
@endsection