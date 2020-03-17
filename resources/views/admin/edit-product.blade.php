@extends('admin.admin-template')
@section('page-title', 'Editar producto')
@section('css', '/css/admin/product.css')
@section('content')

<form class="form-margin text-center rounded my-2 border border-light p-5 col-xl-6 offset-lg-3 col-lg-6 justify-content-center z-depth-1-half" enctype="multipart/form-data" method="post" action="{{action('ProductController@editProduct', ['id' => $product->id])}}">
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

            <div class="">
                <label for="category">Categoría</label>
                <select class='form-control' name="category_id" id="category_id">
                    <option value="1">Anillos</option>
                    <option value="2">Pulseras</option>
                    <option value="3">Aros</option>
                    <option value="4">Alhajas</option>
                </select>
            </div>

            <div class="">
                <label for="material">Material</label>
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-4 d-flex justify-content-center">
                            <label class='font-weight-light my-auto' for="Oro">
                                <h6 class='p-0 my-auto'>Oro:  </h6>
                            </label>
                            <input type="radio" class='ml-2' name="material_id" id="" value="1" checked>
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


            <!-- description number -->
            <div class="">
                <label for="description">Descripción</label>
                <textarea id="description" class="form-control" rows='3' cols='15' aria-describedby="descriptionHelpBlock" name="description" value="{{ $product->description }}">{{ $product->description }} </textarea>
                
            </div>
            <div class="">
                <label for="photo">Fotos:</label>
                <div class="container my-4">
                    <div class="row text-left">
                        @foreach($product['photos'] as $photo)
                        <div class="col-4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center">
                                        <img src="/storage/products/{{$photo['path']}}" alt="" class='img-circle shadow admin-prod-img' style="width: 6rem">
                                    </div>
                                    <div class="col-12 text-center">
                                        <a class='bg-rojo text-white font-weight-bold py-2 px-3 rounded' href='/admin/delete-photo/{{$photo["path"]}}'>Borrar</a>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    <input type="file" id="photos" name="photos[]" multiple>
                </div>
            </div>
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

            <!-- Sign up button -->
            <button class="btn bg-verde my-4 text-white" type="submit" >ACTUALIZAR PRODUCTO</button>
            
        </form>
        <!-- Sign Up form -->
   


@endsection