@extends('admin.admin-template')
@section('page-title', 'Usuarios')
@section('css', '/css/admin/product.css')
@section('content')
<main class="container col-12 col-md-8">
    <div class="row admin-top-list-controls">
        <div class="admin-prod-back-btn col-2 col-md-1 mb-3">
            <a href="/admin/users"><i class="fas fa-times rojo"></i></i></a>
        </div>
        <form action="" method="get" class="col-10 col-md-8">
            @csrf
            <div class="col-12 col-md-8 mb-3 p-0">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupPrepend3">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" name="search" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3" required>
                </div>
            </div>
        </form>
        <div class="col-12 col-md-3 mb-3 admin-prod-search-btn">
            <a href="/admin/add-user" class="col-12 btn text-white bg-verde">+ Nuevo</a>
        </div>
    </div>

    <ul class="list-group">
        @foreach($allUsers as $user)
        <li class="list-group-item">
            <div class="row admin-prod-item">
                <div class="col-4 col-md-2">
                    <img src="/storage/profile/{{$user->photo['path']}}" class="img-circle shadow admin-prod-img bd-verde" alt="" style="width: 4rem">
                </div>
                <div class="col-4 col-md-8">
                    <h5 class="admin-prod-name">{{$user->name}} {{$user->surname}}</h5>
                    @if (Cache::has('user-is-online-' . $user->id))
                    <p class="m-0 font-weight-light verde">Online</p>
                    @else
                    <p class="m-0 font-weight-light rojo">Offline</p>
                    @endif
                    
                    <p class="m-0 mt-1 font-weight-light">Rol: {{$user->roles_id == 1 ? ucfirst($roles[0]->name) : ucfirst($roles[1]->name)}}</p>
                </div>
                <a href="/admin/edit-user/{{$user->id}}" class="col-4 col-md-2 verde">
                    Editar <i class="far fa-edit"></i>
                </a>
            </div>
        </li>
        @endforeach
    </ul>
    <br>
    <br>
    {{$allUsers->onEachSide(1)->appends(request()->query())->links()}}
    <br>
    <br>
</main>
@endsection