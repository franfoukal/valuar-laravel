@extends('profile')
@section('section')
<div class=" col-12 col-md-10 col-lg-7" id="edit-user">
    <div class="container-fluid">
        <div class="row">
            <h2 class="col-6">Configuración de usuario</h2>
            <button  type="button" class="col-4">Guardar</button>
        </div>
    </div>


    <form action="">
        <ul class="clearlist">

            <li class="item-list">
                <div class="row m-0 profile-user-item-list">
                    <p class="col-3 col-md-3 col-lg-2">Nombre:</p>
                    <div v-if="modify.name" class="row animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <p class="col-10">{{Auth::user()->name}}</p>
                        <a class="col-2" @click="modifyToogle('name')"><i class="fas fa-pen"></i></a>
                    </div>

                    <div v-else class="row align-items-center animated fadeIn faster col-9 col-md-9 col-lg-10">
                        <input type="text" name="name" id="" class="col-10 form-control form-control-sm" placeholder="Nombre" value="{{Auth::user()->name}}">
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
                        <input type="text" name="surname" id="" class="col-10 form-control form-control-sm" placeholder="Apellido" value="{{Auth::user()->surname}}">
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
                        <input type="text" name="email" id="" class="col-10 form-control form-control-sm" placeholder="Email" value="{{Auth::user()->email}}">
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
                        <input type="text" name="phone" id="" class="col-10 form-control form-control-sm" placeholder="Telefono" value="{{Auth::user()->phone}}">
                        <a class="col-2" @click="modifyToogle('phone')"><i class="fas fa-times rojo"></i></a>
                    </div>
                </div>
            </li>
        </ul>

    </form>

    <hr>

</div>
@endsection
@section('change-avatar')
<div class="profile-user-edit-img row">
    <button id="btn-edit-avatar" type="button" class="btn btn-sm rounded-circle p-3  bg-rojo crema">
        <div class="row profile-user-btn-cont p-0 m-0 far fa-edit "></div>
    </button>
    <label for="btn-edit-avatar" class="m-0 p-0 profile-user-btn-text">Cambiar</label>
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
            editData() {

            }
        },
        computed: {

        },
        watch: {},
    });
</script>
@endsection