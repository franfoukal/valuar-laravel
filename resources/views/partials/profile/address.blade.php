<div class="card col-12 col-md-12 col-lg-7">
    <div class="card-body">
        <div class="row address-card-heading">
            <h4 class="address-card-title m-0">Direcciones</h4>
            <a href="#" class="address-card-add-btn"><i class="fas fa-plus"></i></a>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                <div class="address-item row m-0">
                    <i class="address-item-icon fas fa-map-marker-alt col-2"></i>
                    <div class="address-description col-7 col-md-7">
                        <p class="m-0">Lorem ipsum dolor sit amet.</p>
                        <small>Lorem, ipsum.</small>
                    </div>
                    <a class="col-1" @click="select('address-form')" href="#"><i class="far fa-edit verde"></i></a>
                    <a href="#" class="col-1" @click="saludo('eliminar')"><i class="fas fa-times rojo"></i></a>
                </div>
            </li>
        </ul>
    </div>
</div>