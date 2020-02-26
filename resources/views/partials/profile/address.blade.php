 <main id="sd">
     <div class="card">
         <div class="card-body">
             <div class="row address-card-heading">
                 <h4 class="address-card-title m-0">Direcciones</h4>
                 <a href="#" class="address-card-add-btn" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i></a>
             </div>
             <ul class="list-group">
                 <li class="list-group-item">
                     <div class="address-item row m-0">
                         <i class="address-item-icon fas fa-map-marker-alt col-2"></i>
                         <div class="address-description col-8">
                             <p class="m-0">Lorem ipsum dolor sit amet.</p>
                             <small>Lorem, ipsum.</small>
                         </div>
                         <a class="col-1" href="#"><i class="far fa-edit verde"></i></a>
                         <a href="#" class="col-1"><i class="fas fa-times rojo"></i></a>
                     </div>
                     <!-- <button @click.prevent='saludo'>Test @{{address}}</button> -->
                 </li>

             </ul>
         </div>
     </div>

     <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Save changes</button>
                 </div>
             </div>
         </div>
     </div>
</main>

 <script type="application/javascript">
     var address = new Vue({
         el: '#sd',
         data: {
             province: '',
             department: '',
             address: 'hola'
         },
         computed: {

         },
         methods: {
             getProvince: function() {
                 var me = this;
                 axios.get('https://apis.datos.gob.ar/georef/api/provincias')
                     .then(function(response) {
                         // handle success
                         console.log(response);
                     })
                     .catch(function(error) {
                         // handle error
                         console.log(error);
                     })
                     .then(function() {
                         // always executed
                     });
             },
             saludo: function() {
                 console.log("hola");
             }
         },
         mounted() {
            //   this.getProvince();
         },
     });
 </script>