@extends('template')
@section('title', 'Login')
@section('main-content')
<div class="jumbotron bg-image-collar z-depth-5">
    <div class="row mx-0 form-padding">
        <!-- Default form login -->
        <form class="text-center form-margin rounded bg-white border border-light p-5 my-4 col-xl-6 offset-xl-3 col-lg-12 justify-content-center z-depth-1-half" method="POST" action="">

            <p class="h2 mb-4">Iniciar sesión</p>

            <!-- Email -->
            <div class="md-form">
                <input type="email" id="email" class="form-control" name="email" value="" required>
                <label for="email">E-mail</label>
            </div>

            <!-- Password -->
            <div class="md-form">
                <input type="password" id="password" class="form-control" name='password' required>
                <label for="password">Contraseña</label>
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

            <p>
                <!-- Forgot password -->
                <a href="forgottenPassword">¿Olvidaste tu contaseña?</a>
            </p>
            <!-- Register -->
            <p>¿No sos miembro?
                <a href="signup">Registrate acá</a>
            </p>

        </form>
        <!-- Default form login -->
    </div>
</div>

@endsection