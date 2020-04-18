<div class="card my-3 col-12 col-md-12 col-lg-7">
    <div class="card-body">
        <div class="row mb-2">
            <a @click="select('address-list')" class="col-1"><i class="fas fa-arrow-left"></i></a>
            <h4 class="col-10">Agregar direccion</h4>
        </div>
        <form action="" v-on:submit.prevent>

            <select class="custom-select address-form-input" v-model="provincia" @change="getDepartamentos">
                <option selected disabled>Selecciona una provincia</option>
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
                <input type="text" v-model="direccion.calle" placeholder="Calle" class="form-control col-md-8 address-form-input" v-model="address">
                <input type="text" v-model="direccion.altura" placeholder="Nº" class="form-control col-md-2 address-form-input" v-model="address">
                <input type="text" v-model="direccion.piso" placeholder="Dpto" class="form-control col-md-2 address-form-input" v-model="address">
            </div>
            <div class="row m-0 address-search-btn">
                <button type="reset" @click="resetForm" class="btn btn-link rojo pr-0">Reset</button>
                <button type="button" @click="getDireccion" class="btn btn-link"><i class="fas fa-search mr-3"></i>Buscar</button>
            </div>
        </form>


        <section v-if="search">
            <div class="list-group address-matches m-0">
                <div class="list-group-item list-group-item-action m-0" v-for="(direccion, index) in direccion.api.direcciones" :key="index">
                    <div class="row address-list-item">
                        <i class="far fa-building col-2"></i>
                        <p class="col-8 m-0 p-0">@{{direccion.nomenclatura}} @{{direccion.piso}}</p>
                        <a href="#" class="btn btn-link col-2 p-0 m-0"><i class="far fa-save address-btn-save verde"></i></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>