@extends('template')
@section('title', 'Login')
@section('main-content')
<div class="jumbotron bg-image-collar z-depth-5">
    <div class="row mx-0 form-padding">
        <!-- Default form login -->
        <form class="text-center form-margin rounded bg-white border border-light p-5 my-4 col-xl-6 offset-xl-3 col-lg-12 justify-content-center z-depth-1-half" method="POST" >
            @csrf
            <p class="h2 mb-4">{{__('Iniciar sesión')}}</p>
                    @if($errors)
                        <div class='rounded bg-rojo'>
                            @foreach ($errors->all() as $error)
                                <div class="py-2">
                                    {{ 'Usuario o contraseña incorrecta' }}
                                </div>
                            @endforeach
                        </div>
                    @endif
            <div class="col-12 form-errors py-1">
                <p class="text-center my-auto">
                    Email o contraseña erróneos
                </p>
            </div>

            <!-- Email -->
            <div class="md-form">
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="" required>
                <label for="email">{{__('E-mail')}}</label>
            </div>

            <!-- Password -->
            <div class="md-form">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name='password' required>
                <label for="password">{{__('Contraseña')}}</label>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex justify-content-around">
                <div>
                    <!-- Remember me -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="rememberMe" name="rememberMe">
                        <label class="custom-control-label" for="rememberMe">Recordar usuario</label>
                    </div>
                </div>
            </div>

            <!-- Sign in button -->
            <button class="btn bg-verde btn-block my-4 text-white" type="submit" style="width:80%;margin:auto">Enviar</button>
            @if (route::has('password.request'))
            <p>
                <!-- Forgot password -->
                <a href="{{ route('password.request') }}">¿Olvidaste tu contaseña?</a>
            </p>
            @endif
            <!-- Register -->
            <p>¿No sos miembro?
                <a href="signup">Registrate acá</a>
            </p>

        </form>
        <!-- Default form login -->
    </div>
</div>
<script src="/js/login.js"></script>
@endsection