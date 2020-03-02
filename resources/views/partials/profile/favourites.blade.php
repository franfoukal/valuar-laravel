<div class="container-fluid favs">
    <div class="container">
        <div class="row address-card-heading">
            <h4 class="address-card-title m-0">Favoritos</h4>
        </div>
        <div class="row">
            @foreach(Auth::user()->favourites as $product)
            <div class="col-12 col-md-6 col-lg-3">
                @include('partials.single-product',
                [
                'name' => $product->name,
                'material' => $product->material,
                'price' => $product->price,
                'id' => $product->id,
                'photo' => isset($product->firstPhoto['path']) ? $product->firstPhoto['path'] : 'img/products/prod-1.png',
                'index' => $loop->index,
                'isAuth' => Auth::check()
                ])
            </div>
                @endforeach
            </div>
        </div>
    </div>