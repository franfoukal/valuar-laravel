@extends('admin.admin-template')
@section('page-title', 'Agregar Usuario')
@section('css', '/css/admin/product.css')
@section('content')

        <form class="form-margin text-center rounded my-2 border border-light p-1 col-xl-6 offset-lg-3 col-lg-6 justify-content-center z-depth-1-half" method="post" action="{{action('AdminController@addUser')}}">
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
                <div class="col">
                    <!-- First name -->
                    <div class="">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="">
                        <label for="surname">Apellido</label>
                        <input type="text" id="surname" name="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname')}}" required>
                    </div>
                </div>
            </div>

            <!-- E-mail -->
            <div class=" mt-0">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div class="">
                <label for="password">Contraseña</label>
                <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" name="password" required>
            </div>
            <div class="">
                <label for="passwordConfirm">Confirmar contraseña</label>
                <input type="password" id="passwordConfirm" class="form-control" aria-describedby="passwordHelpBlock" name="password_confirmation" required>
                <small id="passwordHelpBlock" class="form-text text-muted mb-4">
                    Mínimo 8 caracteres, 1 número y 1 caracter especial.
                </small>
            </div>

            <!-- Phone number -->
            <div class="">
                <label for="phone">Número de teléfono</label>
                <input type="number" id="phone" class="form-control" aria-describedby="phoneHelpBlock" name="phone" value="{{old('phone')}}">
                <small id="phoneHelpBlock" class="form-text text-muted ">
                    Opcional
                </small>
            </div>

            <!-- Role -->
            <div class="">
            <label for="role">Tipo de usuario</label>
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <h6>Administrador </h6><input type="radio" name="role" id="1" value="1">
                        </div>
                        <div class="col-6">
                            <h6>Cliente </h6>
                            <input type='radio' name='role' id='2' value='2'>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- Sign up button -->
            <button class="btn bg-verde my-2 text-white" type="submit" >AGREGAR USUARIO</button>
           
        </form>
        <!-- Sign Up form -->
    </div>
</div>

@endsection