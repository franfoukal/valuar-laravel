@extends('profile')
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.css" crossorigin="anonymous">

@endsection
@section('section')
<div class=" col-12 col-md-10 col-lg-7" id="edit-user">

    <h2 class="mb-4">Configuración de usuario</h2>

    <form method="POST" action="/user/{{Auth::user()->id}}/edit">
        @csrf
        <div class="col-12 my-4">
            @if($errors)
            <div class='rounded bg-rojo text-white'>
                @foreach ($errors->all() as $error)
                <div class="py-2 px-3">
                    {{ $error }}
                </div>
                @endforeach
            </div>
            @endif
        </div>


        <ul class="clearlist">

            <li class="item-list">
                <div class="row m-0 profile-user-item-list">
                    <p class="col-3 col-md-3 col-lg-2">Nombre:</p>
                    <div v-if="modify.name" class="row animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <p class="col-10">{{Auth::user()->name}}</p>
                        <a class="col-2" @click="modifyToogle('name')"><i class="fas fa-pen"></i></a>
                    </div>

                    <div v-else class="row align-items-center animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <input type="text" name="name" class="col-10 form-control form-control-sm" placeholder="Nombre" value="{{Auth::user()->name}}">
                        <a class="col-2" @click="modifyToogle('name')"><i class="fas fa-times rojo"></i></a>
                    </div>
                </div>
            </li>

            <li class="item-list">
                <div class="row m-0 profile-user-item-list">
                    <p class="col-3 col-md-3 col-lg-2">Apellido:</p>
                    <div v-if="modify.surname" class="row animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <p class="col-10">{{Auth::user()->surname}}</p>
                        <a class="col-2" @click="modifyToogle('surname')"><i class="fas fa-pen"></i></a>
                    </div>

                    <div v-else class="row align-items-center animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <input type="text" name="surname" class="col-10 form-control form-control-sm" placeholder="Apellido" value="{{Auth::user()->surname}}">
                        <a class="col-2" @click="modifyToogle('surname')"><i class="fas fa-times rojo"></i></a>
                    </div>
                </div>
            </li>

            <li class="item-list">
                <div class="row m-0 profile-user-item-list">
                    <p class="col-3 col-md-3 col-lg-2">Email:</p>
                    <div v-if="modify.email" class="row animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <p class="col-10">{{Auth::user()->email}}</p>
                        <a class="col-2" @click="modifyToogle('email')"><i class="fas fa-pen"></i></a>
                    </div>

                    <div v-else class="row align-items-center animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <input type="text" name="email" class="col-10 form-control form-control-sm" placeholder="Email" value="{{Auth::user()->email}}">
                        <a class="col-2" @click="modifyToogle('email')"><i class="fas fa-times rojo"></i></a>
                    </div>
                </div>
            </li>

            <li class="item-list">
                <div class="row m-0 profile-user-item-list">
                    <p class="col-3 col-md-3 col-lg-2">Phone:</p>
                    <div v-if="modify.phone" class="row animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <p class="col-10">{{Auth::user()->phone}}</p>
                        <a class="col-2" @click="modifyToogle('phone')"><i class="fas fa-pen"></i></a>
                    </div>

                    <div v-else class="row align-items-center animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <input type="text" name="phone" class="col-10 form-control form-control-sm" placeholder="Telefono" value="{{Auth::user()->phone}}">
                        <a class="col-2" @click="modifyToogle('phone')"><i class="fas fa-times rojo"></i></a>
                    </div>
                </div>
            </li>

        </ul>
        <div class="container">
            <button v-if="onEdit" type="submit" class="btn btn-sm btn-primary col-12 mt-4">Guardar cambios</button>
        </div>
    </form>

    <hr>
    <h4>Zona de peligro</h4>
    <a class="btn bg-rojo btn-sm col-12" data-toggle="modal" data-target="#exampleModal">Cambiar contraseña</a>
    <a class="btn bg-noche btn-sm col-12" data-toggle="modal" data-target="#exampleModal">Borrar Usuario</a>

    <!-- Modal -->
    <div class=" modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control form-control-sm" type="text" placeholder="Contraseña actual">
                    <input class="form-control form-control-sm" type="text" placeholder="Contraseña nueva">
                    <input class="form-control form-control-sm" type="text" placeholder="Confirmar nueva contraseña">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-rojo btn-sm text-white" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-sm bg-verde text-white">
                        <i class="fas fa-save"></i>
                        Cambiar
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('change-avatar')
<div class="profile-user-edit-img row">
    <button id="btn-edit-avatar" type="button" class="btn btn-sm rounded-circle p-3  bg-rojo crema" data-toggle="modal" data-target="#imgModal">
        <div class="row profile-user-btn-cont p-0 m-0 far fa-edit "></div>
    </button>
    <label for="btn-edit-avatar" class="m-0 p-0 profile-user-btn-text">Cambiar</label>
</div>


<!-- Modal -->
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imgModalLabel">Cambiar imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/profile/user/edit-photo" method="post" enctype="multipart/form-data" id="form-img">
                    @csrf
                    <div id="">
                        <div id="main-cropper"></div>
                        <a class="button actionUpload">
                            <input type="file" id="upload" accept="image/*" name="user_profile" id="user_profile_img">
                        </a>

                    </div>

                    <!-- <input type="hidden" name="user_profile" id="user_profile_img"> -->
                    <button id="#upload-result" class="btn col-12 mt-4 bg-verde">Guardar cambios</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let userEdit = new Vue({
        el: '#edit-user',
        data: {
            modify: {
                name: true,
                surname: true,
                email: true,
                phone: true,
            },

            onEdit: false
        },
        methods: {
            modifyToogle(field) {
                this.modify[field] = !this.modify[field];
                this.onEditMode();
            },
            onEditMode() {
                var me = this;
                for (const key in me.modify) {
                    if (me.modify[key] == false) {
                        this.onEdit = true;
                        return;
                    } else {
                        this.onEdit = false;
                    }
                }
            },
            submitData() {
                var me = this;
                for (const key in me.modify) {
                    me.modify[key] = false;
                }
            }
        },
        computed: {

        },
        watch: {},
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.js"></script>
<script>
    var basic = $('#main-cropper').croppie({
        viewport: {
            width: 250,
            height: 250,
            type: 'circle'
        },
        boundary: {
            width: 300,
            height: 300
        },
    });

    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#main-cropper').croppie('bind', {
                    url: e.target.result
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.actionUpload input').on('change', function() {
        readFile(this);
    });


    $('#upload-result').on('click', function(ev) {
        basic.croppie('result', {
            type: 'canvas',
            size: 'original',
            circle: true
        }).then(function(resp) {
            $('#user_profile_img').val(resp);
            $('#form-img').submit();
        });
    });
</script>
@endsection