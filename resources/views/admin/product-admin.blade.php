@extends('admin.admin-template')
@section('page-title', 'Productos')
@section('css', '/css/admin/product.css')
@section('content')
<main class="container col-12 col-md-8">
    <div class="row admin-top-list-controls">
        @if(isset($success))
        <div class='col-12 rounded bg-verde py-2 mb-3'>
            {{ $success }}
        </div>
        @endif
        <div class="admin-prod-back-btn col-2 col-md-1 mb-3">
            <a href="/admin/products"><i class="fas fa-times rojo"></i></i></a>
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
        <div class="col-12 col-md-3 mb-3 admin-prod-search-btn">
            <a href="/admin/add-product" class="col-12 btn text-white bg-verde">+ Nuevo</a>
        </div>

    </div>

    <ul class="list-group">
        @foreach($products as $product)
        <li class="list-group-item">
            <div class="row admin-prod-item">
                <div class="col-4 col-md-2">
                    <img src="{{$product->firstPhoto ? '/storage/products/' . $product->firstPhoto['path'] : ''}}" class="img-circle shadow admin-prod-img" alt="Sin foto" style="width: 4rem">
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
    <br>
    <br>
    {{$products->onEachSide(1)->appends(request()->query())->links()}}
    <br>
    <br>
</main>
@endsection