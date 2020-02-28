<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <a @click="select('address-list')" class="col-1"><i class="fas fa-arrow-left"></i></a>
            <h4 class="col-10">Agregar direccion</h4>
        </div>
        <form action="" v-on:submit.prevent>

            <select class="custom-select address-form-input" v-model="provincia" @change="getDepartamentos">
                <option disabled>Selecciona una provincia</option>
                <option v-for="(provincia, index) in provincias" :value="provincia" :key="index">@{{provincia.nombre}}</option>
            </select>
            <select class="custom-select address-form-input" v-model="departamento" @change="getLocalidades">
                <option selected disabled>Selecciona un departamento</option>
                <option v-for="(dpto, index) in departamentos" :value="dpto" :key="index">@{{dpto.nombre}}</option>
            </select>
            <select class="custom-select address-form-input" v-model="localidad">
                <option selected disabled>Selecciona una localidad</option>
                <option v-for="(localidad, index) in localidades" :value="localidad" :key="index">@{{localidad.nombre}}</option>
            </select>
            <div class="row m-0 address-form-input">
                <input type="text" v-model="direccion.calle" placeholder="Calle" class="form-control col-8" v-model="address">
                <input type="text" v-model="direccion.altura" placeholder="Nº" class="form-control col-2" v-model="address">
                <input type="text" v-model="direccion.piso" placeholder="Dpto" class="form-control col-2" v-model="address">
            </div>
            <button type="button" @click="getDireccion" class="btn btn-link">Buscar</button>
        </form>


        <section v-if="search">
            <div class="list-group">
                <a class="list-group-item list-group-item-action row m-0" v-for="(direccion, index) in direccion.api.direcciones" :key="index">
                    <i class="far fa-building col-3"></i>
                    <p class="col-8 m-0">@{{direccion.nomenclatura}} @{{direccion.piso}}</p>
                    <i class="far fa-building col-1"></i>
                </a>
            </div>
        </section>
    </div>
</div>