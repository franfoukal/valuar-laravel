@extends('template')
@section('title', 'Contact')
@section('main-content')
<div class="row m-0">
    <div class="col col-xl-6 col-lg-12 col-md-12 bg-image-collar p-0 contact-margin z-depth-1-half">
        <div class="bg-white rounded" style="margin:10% 10% 3rem;">
            <div class="iframe_container mb-4">
                <iframe class='rounded' src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1702.5818656207027!2d-64.18921807505492!3d-31.409614716810225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9432987eb069d077%3A0xf297b76f53110997!2sBar%20del%20Norte!5e0!3m2!1ses-419!2sar!4v1575644961318!5m2!1ses-419!2sar" width="500" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            <!-- Text -->
            <ul class='clearlist pl-3 pb-2'>
                <li>
                    <h5><i class="fas fa-map-marker-alt"></i> Dirección</h5>
                </li>
                <li>
                    <p>La Rioja 123, Córdoba, ARG.</p>
                    <p>Horarios 10:00 a 19:00hs.</p>
                </li>
                <li>
                    <h5><i class="fas fa-phone"></i> Llamanos</h5>
                </li>
                <li style="margin-bottom: 0.5rem;">
                    <a href="tel:08001112233"><i class="fas fa-phone"></i> 0-800-111-2233</a>
                </li>
                <li>
                    <h5><i class="fas fa-envelope"></i> Soporte general</h5>
                </li>
                <li style="margin-bottom: 0.5rem;">
                    <a href="mailto:valuarfullgroup@email.com"><i class="fas fa-envelope"></i> valuarfullgroup@email.com</a>
                </li>
            </ul>
            <!-- Text -->
        </div>
    </div>
    <div class="col-12 col-xl-6 col-lg-12 col-md-12 text-center bg-white">
        <div class="" style="margin:20%5%">
            <!-- MENSAJE -->
            <h2>Dejanos tu mensaje</h2>
            <form class="text-center" action="#!">
                <!-- Name -->
                <div class="md-form mt-3">
                    <input type="text" id="materialContactFormName" class="form-control">
                    <label for="materialContactFormName">Nombre</label>
                </div>
                <!-- E-mail -->
                <div class="md-form mt-3">
                    <input type="email" id="materialContactFormEmail" class="form-control">
                    <label for="materialContactFormEmail">E-mail</label>
                </div>
                <!--Message-->
                <div class="md-form">
                    <textarea id="materialContactFormMessage" class="form-control md-textarea" rows="3"></textarea>
                    <label for="materialContactFormMessage">Mensaje</label>
                </div>
                <!-- Send button -->
                <button class="btn text-white bg-verde btn-block" type="submit" style="width:60%; margin:auto"><strong>Enviar</strong></button>
            </form>
        </div>
    </div>
</div>
@endsection