   @extends('template')
   @section('title', 'FAQ')
   @section('main-content')
   <div class="row m-0">
     <div class="col-12 col-xl-6 col-lg-12 col-md-12 bg-image-collar z-depth-1-half" style="background-attachment:fixed">
       <div class="bg-white rounded" style="margin:5rem 10% 10%;padding:5%;">
         <div class="text-center">
           <h2>Preguntas Frecuentes</h2>
           <h3 class="text-muted">F.A.Q</h3>
           <p>Si tu pregunta no se encuentra en está página recordá que podés contactarnos por <a href="contacto.html"><i>Contacto</i></a>.</p>
         </div>
         <!-- Text -->
         <ul class='clearlist'>
           <li>
             <h5><i class="fas fa-phone"></i> Llamanos</h5>
           </li>
           <li>
             <a href="tel:08001112233"><i class="fas fa-phone"></i> 0-800-111-2233</a>
           </li>
           <li>
             <h5><i class="fas fa-envelope"></i> Soporte general</h5>
           </li>
           <li>
             <a href="mailto:valuarfullgroup@email.com"><i class="fas fa-envelope"></i> valuarfullgroup@email.com</a>
           </li>
         </ul>
       </div>
     </div>
     <div class="col-12 col-xl-6 col-lg-12 col-md-12 d-flex py-4 bg-white">
       <!-- PREGUNTAS -->
       <!--Accordion wrapper-->
       <div class="mt-5 accordion md-accordion mx-3" id="accordionEx1" role="tablist" aria-multiselectable="true">
         <!-- Accordion card -->
         <div class="card">
           <!-- Card header -->
           <div class="card-header p-3" role="tab" id="titulo1">
             <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#pregunta1" aria-expanded="false" aria-controls="pregunta1" style="color:black">
               <h5 class="mb-0">
                 ¿Cómo puedo saber cuándo y a qué hora llegará mi compra? <i class="fas fa-angle-down rotate-icon"></i>
               </h5>
             </a>
           </div>
           <!-- Card body -->
           <div id="pregunta1" class="collapse" role="tabpanel" aria-labelledby="titulo1" data-parent="#accordionEx1">
             <div class="card-body bg-white">
               Podes hacer el seguimiento de tu despacho con el número de orden de despacho que se encuentra en el ticket de tu compra. Ahí vas a encontrar toda la información necesaria para saber cuándo van a llegar tus productos.<a href="#pregunta1"> Seguimiento de despacho</a>.
             </div>
           </div>
         </div>
         <!-- Accordion card -->
         <!-- Accordion card -->
         <div class="card">
           <!-- Card header -->
           <div class="card-header p-3" role="tab" id="titulo2">
             <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#pregunta2" aria-expanded="false" aria-controls="pregunta2" style="color:black">
               <h5 class="mb-0">
                 ¿Puedo cambiar la fecha o dirección de mi despacho? <i class="fas fa-angle-down rotate-icon"></i>
               </h5>
             </a>
           </div>
           <!-- Card body -->
           <div id="pregunta2" class="collapse" role="tabpanel" aria-labelledby="titulo21" data-parent="#accordionEx1">
             <div class="card-body bg-white">
               Por su seguridad, una vez realizada la compra no es posible realizar un cambio de dirección.
             </div>
           </div>
         </div>
         <!-- Accordion card -->
         <!-- Accordion card -->
         <div class="card">
           <!-- Card header -->
           <div class="card-header p-3" role="tab" id="titulo3">
             <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#pregunta3" aria-expanded="false" aria-controls="pregunta3" style="color:black">
               <h5 class="mb-0">
                 ¿Qué pasa si mi compra no llegó en la fecha que debería? <i class="fas fa-angle-down rotate-icon"></i>
               </h5>
             </a>
           </div>
           <!-- Card body -->
           <div id="pregunta3" class="collapse" role="tabpanel" aria-labelledby="titulo3" data-parent="#accordionEx1">
             <div class="card-body bg-white">
               Si el producto no ha llegado en la fecha pactada, podes hacer el seguimiento a través de <a href="#pregunta1">Seguimiento de despacho</a>, enviando un correo a <a href="mailto:valuarfullgroup@email.com">valuarfullgroup@email.com</a> o llamando a Servicio al Cliente <a href="tel:08001112233"></i> 0-800-111-2233</a>.
             </div>
           </div>
         </div>
         <!-- Accordion card -->
         <!-- Accordion card -->
         <div class="card">
           <!-- Card header -->
           <div class="card-header p-3" role="tab" id="titulo4">
             <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#pregunta4" aria-expanded="false" aria-controls="pregunta4" style="color:black">
               <h5 class="mb-0">
                 ¿Qué pasa si mi producto no entra en el ascensor o mi edificio no tiene ascensor? <i class="fas fa-angle-down rotate-icon"></i>
               </h5>
             </a>
           </div>
           <!-- Card body -->
           <div id="pregunta4" class="collapse" role="tabpanel" aria-labelledby="titulo4" data-parent="#accordionEx1">
             <div class="card-body bg-white">
               Para ambos casos, nosotros subimos por las escaleras el producto hasta el 5to piso sin costo.
             </div>
           </div>
         </div>
         <!-- Accordion card -->
         <!-- Accordion card -->
         <div class="card">
           <!-- Card header -->
           <div class="card-header p-3" role="tab" id="titulo5">
             <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#pregunta5" aria-expanded="false" aria-controls="pregunta5" style="color:black">
               <h5 class="mb-0">
                 ¿Qué hago si no llegaron todos los productos que compré? <i class="fas fa-angle-down rotate-icon"></i>
               </h5>
             </a>
           </div>
           <!-- Card body -->
           <div id="pregunta5" class="collapse" role="tabpanel" aria-labelledby="titulo5" data-parent="#accordionEx1">
             <div class="card-body bg-white">
               Si compras más de un producto, existe la posibilidad de que los recibas en despachos y fechas diferentes. Revisa la boleta o solicitud de compras las fechas correspondientes o llamanos al Servicio al Cliente al<a href="tel:08001112233"></i> 0-800-111-2233</a>.
             </div>
           </div>
         </div>
         <!-- Accordion card -->
         <!-- Accordion card -->
         <div class="card">
           <!-- Card header -->
           <div class="card-header p-3" role="tab" id="titulo6">
             <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#pregunta6" aria-expanded="false" aria-controls="pregunta6" style="color:black">
               <h5 class="mb-0">
                 ¿Cuándo puedo ir a buscar mi producto si compro con retiro en tienda? <i class="fas fa-angle-down rotate-icon"></i>
               </h5>
             </a>
           </div>
           <!-- Card body -->
           <div id="pregunta6" class="collapse" role="tabpanel" aria-labelledby="titulo6" data-parent="#accordionEx1">
             <div class="card-body bg-white">
               Tenes que esperar a recibir un email que te confirme que ya podes retirar tu compra. Posterior a este email, tenes 3 días para ir a retirar tu compra. Lo podes hacer a cualquier hora mientras el local esté abierto. Si por alguna razón no pudiste retirarlo en ese plazo, llama a Servicio al Cliente<a href="tel:08001112233"></i> 0-800-111-2233</a>. De acuerdo a la disponibilidad del producto en el momento, se entregarán posibles alternativas.
             </div>
           </div>
         </div>
         <!-- Accordion card -->


       </div>
       <!-- Accordion wrapper -->
     </div>
   </div>

   @endsection