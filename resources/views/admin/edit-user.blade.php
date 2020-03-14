@extends('admin.admin-template')
@section('page-title', 'Editar Usuario')
@section('css', '/css/admin/product.css')
@section('content')
<form class="form-margin text-center rounded my-2 border border-light p-5 col-xl-6 offset-lg-3 col-lg-6 justify-content-center z-depth-1-half" enctype="multipart/form-data" method="post" action="{{action('AdminController@editUsers', ['id' => $user->id])}}">
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
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" >
                </div>
            </div>
            <div class="col-6">
                <!-- Last name -->
                <div class="">
                    <label for="surname">Apellido</label>
                    <input type="text" id="surname" name="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ $user->surname }}" >                           
                </div>
            </div>
        </div>
        <!-- E-mail -->
        <div class="">
            <label for="email">E-mail</label>
            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" >
        </div>
        
        <!-- Phone number -->
        <div class="">
            <label for="phone">Número de teléfono</label>
            <input type="number" id="phone" class="form-control" aria-describedby="phoneHelpBlock" name="phone" value="{{ $user->phone }}"> 
            <small id="phoneHelpBlock" class="form-text text-muted mb-4">
                Opcional
            </small>
        </div>
        <div class="">
            <label for="photo">Fotos:</label>
            <div class="container my-4">
                <div class="row text-left">
                    @if(isset($photo))
                    <div class="col-4">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 mb-3 text-center">
                                        <img src="/storage/img/users/{{$photo['path']}}" alt="" class='img-circle shadow admin-prod-img' style="width: 6rem">
                                    </div>
                                    <div class="col-12 text-center">
                                        <a class='bg-rojo text-white font-weight-bold py-2 px-3 rounded' href='/admin/delete-profile-photos/{{$user->id}}'>Borrar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    @endif
                </div>
            </div>
            <div class="col-12">
                <input type="file" id="photos" name="photos">
            </div>
        </div>
        <div class="">
            <label for="role">Tipo de usuario</label>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <h6>Administrador </h6><input type="radio" name="role" id="0" value="1">
                    </div>
                    <div class="col-6">
                        <h6>Cliente </h6>
                        <input type='radio' name='role' id='1' value='2'>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign up button -->
        <button class="btn bg-verde mb-4 text-white" type="submit" >ACTUALIZAR USUARIO</button>
        
    </form>
        <!-- Sign Up form -->
  
@endsection