@extends('template')
@section('title', 'Registro')
@section('main-content')
<div class="jumbotron z-depth-5 bg-image-collar">
    <div class="row mx-0 form-padding">
        <!-- Sign Up form -->
        <form class="form-margin text-center rounded my-5 bg-white border border-light p-5 col-xl-6 offset-lg-3 col-lg-6 justify-content-center z-depth-1-half" method="post" action="{{action('Auth\RegisterController@register')}}">
            @csrf
            <p class="h2 mb-4">Registrate</p>

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
                    <div class="md-form">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required>
                        <label for="name">Nombre</label>
                    </div>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <div class="md-form">
                        <input type="text" id="surname" name="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname')}}" required>
                        <label for="surname">Apellido</label>
                    </div>
                </div>
            </div>

            <!-- E-mail -->
            <div class="md-form mt-0">
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                <label for="email">E-mail</label>
            </div>

            <!-- Password -->
            <div class="md-form">
                <input type="password" id="password" class="form-control" aria-describedby="passwordHelpBlock" name="password" required>
                <label for="password">Contraseña</label>

            </div>
            <div class="md-form">
                <input type="password" id="passwordConfirm" class="form-control" aria-describedby="passwordHelpBlock" name="password_confirmation" required>
                <label for="passwordConfirm">Confirmar contraseña</label>
                <small id="passwordHelpBlock" class="form-text text-muted mb-4">
                    Mínimo 8 caracteres, 1 número y 1 caracter especial.
                </small>
            </div>

            <!-- Phone number -->
            <div class="md-form">
                <input type="number" id="phone" class="form-control" aria-describedby="phoneHelpBlock" name="phone" value="{{old('phone')}}">
                <label for="phone">Número de teléfono</label>
                <small id="phoneHelpBlock" class="form-text text-muted mb-4">
                    Opcional
                </small>
            </div>
            <!-- Sign up button -->
            <button class="btn bg-verde btn-block my-4 text-white" type="submit" style="width:80%;margin:auto">Registrate</button>

            <!-- Remember me -->
            <div class="custom-control custom-checkbox mb-4">
                <input type="checkbox" class="custom-control-input" id="rememberMe" name="rememberMe">
                <label class="custom-control-label" for="rememberMe">Recordar usuario</label>
            </div>
            



            <!-- Terms of service -->
            <p>
                Al clickear
                <em>Registrate</em> aceptas nuestros
                <a href="FAQ" target="_blank">términos de servicio</a>
            </p>
        </form>
        <!-- Sign Up form -->
    </div>
</div>
@endsection