@extends('profile')
@section('section')
<div class="container-fluid favs">
    <div class="container">
        <div class="row address-card-heading">
            <h4 class="address-card-title m-0">Favoritos</h4>
        </div>
        <div class="row">
            @forelse(Auth::user()->favourites as $product)
            @component('partials.single-product',
            [
            'name' => $product->name,
            'material' => $product->material->name,
            'price' => $product->price,
            'id' => $product->id,
            'photo' => isset($product->firstPhoto['path']) ? $product->firstPhoto['path'] : 'prod-1.png',
            'index' => $loop->index,
            'isAuth' => Auth::check(),
            'fav' => 'col-12 col-md-6 col-lg-3'
            ])
            @endcomponent
            @empty
            <i class="fas fa-heart fav-empty-list-icon rojo col-3 col-md-2 col-lg-1"></i>
            <h2 class="col-8 fav-empty-list-text">Todavía no has agregado favoritos!</h2>
            @endforelse
        </div>
    </div>
</div>
@endsection