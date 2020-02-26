@extends('template')
@section('title', 'Mi Cuenta')
@section('main-content')
<main class="container-fluid" id="profile">
    <div class="row m-0 profile-wrapper">
        <aside class="profile-nav col-12 col-md-5 col-lg-4">
            <div class="profile-img-wrapper text-center text-md-left">
                <img src="/img/profile/profile-default.jpeg" alt="" class="profile-img shadow p-0 rounded-circle col-9 col-md-8 col-lg-6 bd-crema">
            </div>
            <div class="row profile-header">
                <h1 class="profile-name">{{ucfirst(Auth::user()->name)}}</h1>
                <a href="#" class="profile-edit-icon"><i class="fas fa-cog verde"></i></a>
            </div>
            <h5 class="profile-email">{{Auth::user()->email}}</h5>

            <nav>
                <ul class="clearlist profile-list">
                    <li class="profile-list-item" @click="select('ordenes')"><a href="#">Órdenes</a></li>
                    <li class="profile-list-item"><a href="#">Favoritos</a></li>
                    <li class="profile-list-item" @click="select('direcciones')"><a href="#">Direcciones</a></li>
                </ul>
            </nav>
        </aside>

        <div class="profile-main d-none d-md-block col-md-7 col-lg-5">
            <section id="profile-address" v-if="selectedPage == 'direcciones'">
                @include('partials.profile.address')
            </section>
            <section id="profile-address" v-if="selectedPage == 'ordenes'">
                ordenes
            </section>
        </div>
    </div>
</main>

<script>
    var profile = new Vue({
        el: '#profile',
        data: {
            selectedPage: 'direcciones',
        },
        computed: {

        },
        methods: {
            select: function(page) {
                this.selectedPage = page;
            }
        },
    });
</script>
@endsection