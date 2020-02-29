@extends('admin.admin-template')
@section('page-title', 'Agregar Producto')
@section('css', '/css/admin/product.css')
@section('content')

<form class="form-margin text-center rounded my-2 border border-light p-5 col-xl-6 offset-lg-3 col-lg-6 justify-content-center z-depth-1-half" enctype="multipart/form-data" method="post" action="{{action('ProductController@addProduct')}}">
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
                    <!-- Nombre -->
                    <div class="">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" >
                    </div>
                </div>
                <div class="col-6">

                    <!-- Precio -->
                    <div class="">
                        <label for="price">Precio</label>
                        <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" >                           
                    </div>
                </div>
            </div>

            <!--Código de barras -->
            <div class="">
                <label for="barcode">Código</label>
                <input type="number" id="barcode" class="form-control @error('barcode') is-invalid @enderror" name="barcode" value="{{ old('barcode') }}" >
            </div>
            
            <div class="">
                <label for="category">Categoría</label>
                <select class='form-control' name="category_id" id="category_id">
                    <option selected value="1">Anillos</option>
                    <option value="2">Pulseras</option>
                    <option value="3">Aros</option>
                    <option value="4">Alhajas</option>
                </select>
            </div>
            <!--  Material   -->
            <div class="">
                <label for="material">Material</label>
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-4 d-flex justify-content-center">
                            <label class='font-weight-light my-auto' for="Oro">
                                <h6 class='p-0 my-auto'>Oro:  </h6>
                            </label>
                            <input type="radio" class='ml-2' name="material_id" id="" value="1">
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <label class='font-weight-light my-auto' for="Plata">
                                <h6 class='p-0 my-auto'>Plata:</h6>
                            </label>
                            <input type="radio" class='ml-2' name="material_id" id="" value='2'>
                        </div>
                        <div class="col-4 d-flex justify-content-center">
                            <label class='font-weight-light my-auto' for="Acero">
                                <h6 class='p-0 my-auto'> Acero</h6>
                            </label>
                            <input type="radio" class='ml-2' name='material_id' value='3'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <label for="Stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}">
            </div>
            <!-- Foto -->

            <div class="">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <label for="photos">Fotos</label>
                        </div>
                        <div class="col-12">
                            <input type="file" id="photos" name="photos[]" multiple>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Descripción -->
            <div class="">
                <label for="description">Descripción</label>
                <textarea id="description" class="form-control" rows='3' cols='15' aria-describedby="descriptionHelpBlock" name="description" value="{{ old('description') }}">{{ old('description') }} </textarea>
            </div>
            <!-- Proucto activo -->
            <div class="">
                <label for="active">Producto activo</label>
                <div class="container">
                    <div class="row">
                        <div class="col-6 d-flex justify-content-center">
                            <label class='font-weight-light my-auto' for="Si">
                                <h6 class='p-0 my-auto'>Si</h6>
                            </label>
                            <input type="radio" class='ml-2' name="active" id="active" value="1" checked>
                        </div>
                        <div class="col-6 d-flex justify-content-center">
                            <label class='font-weight-light my-auto' for="No">
                                <h6 class='p-0 my-auto'>No</h6>
                            </label>
                            <input type="radio" class='ml-2' name="active" id="active" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn bg-verde mt-2 mb-4 text-white" type="submit" >AGREGAR PRODUCTO</button>
            
        </form>
        <!-- Sign Up form -->
   


@endsection