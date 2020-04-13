@extends('profile')
@section('styles')
<link href="https://unpkg.com/vue-croppa/dist/vue-croppa.min.css" rel="stylesheet" type="text/css">
<script src="https://unpkg.com/vue-croppa/dist/vue-croppa.min.js"></script>
@endsection
@section('section')
<user-config inline-template>
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
</user-config>
@endsection

@section('change-avatar')

<a class="profile-img-action row m-0 p-0 bg-noche text-white" data-toggle="modal" data-target="#imgModal">
    <i class="far fa-edit mr-2"></i>
    <p class="m-0">Editar</p>
</a>

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
                    <cropper inline-template class="row m-0 p-0 justify-content-center">
                        <div>
                            <div v-if="error.exist" class="alert alert-danger" role="alert">
                                @{{error.msg}}
                            </div>
                            <croppa v-model="avatar" :prevent-white-space="true" :width="225" :height="225" @mouseup="cropImage" @touchend="cropImage" @loading-end="cropImage">
                                <img :src="previewImage" slot="initial">
                            </croppa>
                            <button @click.prevent="create" class="btn col-12 mt-4 bg-verde">Guardar cambios</button>
                        </div>
                    </cropper>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="application/javascript">
    Vue.use(Croppa);
    Vue.component('user-config', {
        data() {
            return {
                user_id: "{{Auth::User()->id}}",
                modify: {
                    name: true,
                    surname: true,
                    email: true,
                    phone: true,
                },
                onEdit: false
            }
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
            },

        },
        computed: {

        },
        watch: {},
    });
</script>



@endsection
@section('script')
<script>
    Vue.component('cropper', {
        data() {
            return {
                avatar: {},
                image: '',
                formuario: '',
                type: '',
                previewImage: "{{Auth::user()->photo ? '/storage/profile/' . Auth::user()->photo['path'] : ''}}",
                error: {
                    exist: false,
                    msg: ''
                }
            }
        },
        methods: {
            cropImage() {
                let me = this;
                this.avatar.generateBlob((blob) => {
                    me.image = blob;
                    if (blob != null) {
                        me.type = blob.type.split('/')[1];
                    }
                });
            },

            prepareForm() {
                let me = this;
                this.cropImage();
                let form = new FormData();
                form.append('avatar', me.image);
                form.append('type', me.type);
                return form;
            },

            create() {
                let me = this;
                axios({
                        method: 'post',
                        url: "/profile/user/edit-photo",
                        data: me.prepareForm(),
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(function(response) {
                        console.log(response);
                        location.reload();
                    })
                    .catch(function(error) {
                        console.log(error.response);
                        me.error.exist = true;
                        me.error.msg = error.response.data.message;
                    });
            }
        },
        computed: {
            filename() {
                return 'avatar.' + this.type;
            }
        },
    })
</script>
@endsection