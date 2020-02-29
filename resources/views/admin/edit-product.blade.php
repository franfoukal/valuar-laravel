@extends('admin.admin-template')
@section('page-title', 'Editar producto')
@section('css', '/css/admin/product.css')
@section('content')

<form class="form-margin text-center rounded my-2 border border-light p-5 col-xl-6 offset-lg-3 col-lg-6 justify-content-center z-depth-1-half" method="post" action="{{action('ProductController@editProduct', ['id' => $product->id])}}">
            @csrf
            
            <div class="form-row">
                <div class="col-12">
                    @if($errors)
                        <div class='rounded bg-rojo'>
                            @foreach ($errors->all() as $error)
                                <div class="py-2">
                                    {{ $error }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="col-6">
                    <!-- First name -->
                    <div class="">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $product->name }}" >
                    </div>
                </div>
                <div class="col-6">
                    <!-- Last name -->
                    <div class="">
                        <label for="price">Precio</label>
                        <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}" >                           
                    </div>
                </div>
            </div>

            <!-- E-mail -->
            <div class="">
                <label for="barcode">Código</label>
                <input type="number" id="barcode" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ $product->barcode }}" >
            </div>
            

            <!-- description number -->
            <div class="">
                <label for="description">Descripción</label>
                <textarea id="description" class="form-control" rows='3' cols='15' aria-describedby="descriptionHelpBlock" name="description" value="{{ $product->description }}">{{ $product->description }} </textarea>
                
            </div>
            <!-- Sign up button -->
            <button class="btn bg-verde mb-4 text-white" type="submit" >ACTUALIZAR PRODUCTO</button>
            
        </form>
        <!-- Sign Up form -->
   


@endsection