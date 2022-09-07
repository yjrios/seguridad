 <?php
require_once('../../../config/conexion.php');
include('../../includes/funciones.php');

$id = $_REQUEST['id_e'];
$_SESSION['sesion']['id_empresa'] = $id; //creamos esta variable para usarla en cualquier pagina 
$id_u = $_SESSION['sesion']['id']; 
$sede = $_SESSION['sesion']['id_sede'];

$empresa = empresa($conexion,$id); 
if ($dato = mysqli_fetch_assoc($empresa) ) {
  $nombre = $dato['nombre'];
  $detalle = $dato['detalle'];
  $foto = $dato['foto'];
}
$fecha=fecha($conexion);
?>

      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Inicio</a>
        <span class="breadcrumb-item active" id="empresa" > <?= $nombre ?>  <?=$detalle?></span>        
      </nav>

      <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
      

          <div class="row">
            <div class="col-sm-2">
              <div style="text-align: left;" >
                  <img class="pagina" align="" src="<?= $foto ?>" style="width: 100px;">   
              </div>
            </div>
            <div class="col-sm-8 d-flex justify-content-center align-items-center">
              <h4 class="" >Reportes de "<?= $nombre ?> <?=$detalle?>"</h4> 
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-lg">
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
             
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
             
            </div><!-- col -->
          </div><!-- row -->

          <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
            <div class="card">
              <div class="card-header" role="tab" id="headingOne">
                <h6 class="mg-b-0">
                   <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="tx-gray-900 transition">

                 Lista de reportes Diarios <i class="fa fa-plus pull-right"></i> 
                  </a>
                </h6>
              </div><!-- card-header -->

              <div id="collapseOne" class="collapse " role="tabpanel" aria-labelledby="headingOne">
                <div class="card-body">
                  <button class="pull-right btn btn-success btn-sm" data-toggle="modal" data-target="#modaldiario" >Nuevo Reporte</button><br><hr>
                  <table id="dt_diarios" class="table display compact" style="width: 100%">
                    <thead>
                      <tr> 
                        <th class="wd-15p"> Nro de Registro</th>
                        <th class="wd-15p"> Elaborado por</th>
                        <th class="wd-15p">Empresa</th>
                        <th class="wd-15p">Fecha</th>
                        <th class="wd-15p">Actividad</th>
                        <th class="wd-15p">Acciones</th>
                      </tr>

                    </thead>
                    <tbody>
           
                    </tbody>
                  </table>   
                  <hr>

                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" role="tab" id="headingTwo">
                <h6 class="mg-b-0">
                  <a class="collapsed transition" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Lista de reportes de Evento <i class="fa fa-plus pull-right"></i> 
                  </a>
                </h6>
              </div>
              <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="card-body">
                  <button class="pull-right btn btn-success btn-sm" data-toggle="modal" data-target="#modalevento">Nuevo Reporte</button><br><hr>
                  <table id="dt_eventos" class="table display compact" style="width: 100%">
                    <thead>
                      <tr> 
                        <th class="wd-15p"> Nro de Registro</th>
                        <th class="wd-15p"> Elaborado por</th>
                        <th class="wd-15p">Empresa</th>
                        <th class="wd-15p">Fecha</th>
                        <th class="wd-15p">Evento</th>
                        <th class="wd-15p">Acciones</th>
                      </tr>

                    </thead>
                    <tbody>
           
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" role="tab" id="headingThree">
                <h6 class="mg-b-0">
                  <a class="collapsed transition" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Lista de reportes de Riesgo <i class="fa fa-plus pull-right"></i> 
                  </a>
                </h6>
              </div>
              <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="card-body">
                  <button class="pull-right btn btn-success btn-sm" data-toggle="modal" data-target="#modalriesgo">Nuevo Reporte</button><br><hr>
                 <table id="dt_riesgos" class="table display  nowrap table-sm  compact" style="width: 100%">
                    <thead>
                      <tr> 
                        <th class="wd-15p"> Nro de Registro</th>
                        <th class="wd-15p"> Elaborado por</th>
                        <th class="wd-15p">Empresa</th>
                        <th class="wd-15p">Fecha</th>
                        <th class="wd-15p">Tipo</th>
                        <th class="wd-15p">Acciones</th>
                      </tr>

                    </thead>
                    <tbody>
           
                    </tbody>
                  </table> 
                </div>
              </div><!-- collapse -->
            </div><!-- card -->
            
          </div><!-- accordion -->
        <br>

<!-- --------------------------------------VIGILANTES ------------------------------------>
          <div class="row">
            <div class="col-sm-2">
              <div>
                   
              </div>
            </div>
            <div class="col-sm-8 d-flex justify-content-center align-items-center">
              <h4 class="" >Asistencia de Vigilantes</h4> 
            </div>
          </div>
<?php
    $empresas=conseguirEmpresas($conexion,$sede);
    //crear_asistencia($conexion);  
    if (!empty($empresas)) {
      //while ($empresa = mysqli_fetch_assoc($empresas) ) {
        
    
?>

          <br>
          <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
            <div class="card">
              <div class="card-header" role="tab" id="headingThree">
                <h6 class="mg-b-0">
                  <a class="collapsed transition" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapseThree">
                  Control de Asistencia de Vigilantes <i class="fa fa-plus pull-right"></i> 
                  </a>
                </h6>
              </div>
              <div id="collapsefour" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="card-body">
                  
                  <form class="form" id="form_asistencia" enctype="multipart/form-data">
                    <div class="row">
                      <div style="text-align: left;"  >
                        <img class="pagina" align="" src="../img/listado.png" style="width: 50px;height:50px"> 
                      </div>
                      <div class="col-sm-1 d-flex justify-content-center align-items-center">
                        <div class="input-group">
                        <h6>Fecha:</h6>
                        </div>
                      </div><!-- col-4 -->

                      <div class="col-sm-3 d-flex justify-content-center align-items-center">
                        <div class="input-group">
                          <input type="date" class="form-control form-control-sm" name="fecha" id="fecha" value="<?=$dato['fecha']?>" max="<?=$dato['fecha']?>" min='<?=$fecha?>'>
                        </div>
                      </div>

                      <div class="col-sm-1 d-flex justify-content-left align-items-center">
                           <h6>Asistencia:</h6>
                      </div>

                      <div class="col-sm-1 d-flex justify-content-left align-items-center">
                     
                        <select class="form-control form-control-sm " id="vigilantes" name="vigilantes">
                          <option value="0" selected>0</option>
                        </select>
                      </div>

                      <div class="col-sm-2 d-flex justify-content-left align-items-center" id="matr_esperada">
                        <h6 >/ <?=$dato['matricula']?> Vigilantes</h6>
                      </div>
  
                      <div class="col-sm-1 d-flex justify-content-center align-items-center">
                       <input class="pull-right btn btn-success btn-sm" type="button" id="btnguardarA" value="Guardar">
                      </div>
                    </div> 
                  </form>

                </div>
              </div><!-- collapse -->
            </div><!-- card -->
          </div>

<?php 
}else {
?>
        <div class="card pd-20 pd-sm-40">
          <center><h3>No existe asistencia creada para el mes de <?=$_SESSION['meses'][date('n')-1];?></h3>
          </center>
          <p style="text-align: center;"><small>Comuniquese con el administrador del sistema para abrir el mes</small></p>
        </div>

<?php 
  }
?>        



<!-- --------------------------------------VIGILANTES ------------------------------------>
          <div class="table-wrapper aqui">
         
          </div><!-- table-wrapper -->
          

        </div><!-- card -->
      </div>

  


<!--MODAL NUEVO REPORTE DIARIO -->


 <!-- LARGE MODAL -->
        <div id="modaldiario" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <div class="col-lg-4">
                  <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">NUEVO Reporte de actividades</h5>
                </div>
                <div class="col-lg-6">
                   <h5><?=$nombre?> <?=$detalle?></h5><img width="30px" src="">
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20">
                   




  <form class="form" name="form_diario" id="form_diario" enctype="multipart/form-data">
    <div id="wizard1">

            <section>
           
          <div class="row">
            
            <div class="col-sm-3">
              <div class="input-group">
                <h6>FECHA DE EMISION:</h6>
              </div>
            </div><!-- col-4 -->

             <div class="col-lg-2">
              <div class="input-group">
               <input type="date" class="form-control form-control-sm" name="txtfecha" id="txtfecha">
              </div>
             </div><!-- col-4 -->

            <div class="col-sm-6">
              <div class="input-group">
              </div>

            </div><!-- col-4 -->
            <div class="col-sm-1">
              <div class="input-group">
              </div>
            </div><!-- col-4 -->
            
          </div><!-- row -->
          <hr>
            
             <div class="row">
            <div class="col-lg-4">
              <h6 >ENCARGADO DE LA UNIDAD</h6>
              <div class="input-group">
             
                <input type="text" name="txtdirigido" id="txtdirigido" class="form-control form-control-sm" placeholder="Nombre">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <h6 >CARGO</h6>
              <div class="input-group">
               
                <input type="text" name="txtcargo" id="txtcargo" class="form-control form-control-sm" placeholder="Cargo">
              
              </div>
            </div><!-- col-4 -->
           
          </div><!-- row -->

            </section>
          <hr>
            <h6>ACTIVIDAD REALIZADA EN LA UNIDAD</h6>
            <section>
             <table class="table table-bordered table-sm">
                    <?php 
                      $contador=1;
                      $sucesos = listasucceso($conexion); 
                      while ($items = mysqli_fetch_array($sucesos)): 
                        if ($contador==1) {
                            ?>
                           <tr>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>"><span><?=$items['nombre'] ?></span>
                                   </label>
                              </td>

                            <?php
                          $contador=$contador+1;
                        }else if ($contador==4) {
                           ?>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>"><span><?=$items['nombre'] ?></span>
                                  </label>
                              </td>
                          </tr>
                             <?php
                           $contador=1;
                        }else{
                          ?>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>"><span><?=$items['nombre'] ?></span>
                                  </label>
                              </td>
                          <?php
                           $contador=$contador+1;
                        }
                      endwhile; ?> 
                </table>
                
             <hr>
          <div class="row">
            <div class="col-lg-2">
              <label class="text">ESTUVO ACOMPAÑADO:
              </label>
            </div><!-- col-3 -->
            <div class="col-lg-2 ">
               <label class="rdiobox">
                <input name="rdioacompanante" id="si" type="radio" checked value="SI">
                <span>Si</span>
              </label>

            </div><!-- col-3 -->
            <div class="col-lg-1 ">
                <label class="rdiobox">
                <input name="rdioacompanante" type="radio" value="NO">
                <span>No</span>
              </label>
            </div><!-- col-3 -->
              <div class="col-lg-4 mg-t-20 mg-lg-t-0">
            <input type="text"  class="form-control form-control-sm" placeholder="Ingrese acompañante" name="txtacompanante" id="txtacompanante">
            </div><!-- col-3 -->
          </div><!-- row -->
          
           <hr>

            </section>
            <h6>ESPECIFIQUE LAS ACTIVIDADES REALIZADAS:</h6>
            <section>
             <textarea class="form-control" name="txtactividades" id="txtactividades"></textarea>
            </section><br>
            
            <!-- ################################### Mejoras YEISON ################################## -->
            <h6>AÑADIR ADJUNTOS:</h6>
            <section>
              <div class="col-lg-2 col-md-2">
                <input type="file" name="filed[]" id="filed" multiple>
              </div>
            </section><br>
            <!-- ################################### Mejoras YEISON ################################## -->

            <div class="row">
              <div class="col-lg-4 col-md-4 mx-auto"></div>
              <div class="col-lg-2 col-md-2 mx-auto">
                <a href="#" role="button" class="pull-right btn btn-primary btn-sm" id="btncancelar" name="btncancelar">Cancelar</a>
              </div>
              <div class="col-lg-3 col-md-3 mx-auto">
                <a href="#" role="button" class="btn btn-primary btn-sm" id="btnenviar" name="btnenviar">Enviar Reporte</a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 mx-auto"></div>
            </div>
            
    </div>
  </form>

              </div><!-- modal-body -->
              
            </div>
          </div><!-- modal-dialog -->
</div><!-- modal -->

<!--MODAL EDITAR REPORTE DIARIO -->


 <!-- LARGE MODAL -->
        <div id="modaldiariomod" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <div class="col-lg-4">
                  <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="editardiario">EDITAR Reporte de actividades</h5>
                </div>
                <div class="col-lg-6">
                   <h5><?=$nombre?> <?=$detalle?></h5><img width="30px" src="">
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20">
                   




  <form class="form" name="form_diariomod" id="form_diariomod" enctype="multipart/form-data">
    <div id="wizard1"> 

            <section>
           
          <div class="row">
            
            <div class="col-sm-2">
              <div class="input-group">
                <h6>FECHA DE EMISION:</h6>
                <input class="form-control form-control-sm" name="controldiario" id="controldiario" type="text" hidden >
              </div>
            </div><!-- col-4 -->

             <div class="col-lg-2">
              <div class="input-group">
               <input type="text" class="form-control form-control-sm" name="txtfechamod" id="txtfechamod" disabled>
              </div>
             </div><!-- col-4 -->

            <div class="col-sm-6">
              <div class="input-group">
              </div>

            </div><!-- col-4 -->
            <div class="col-sm-1">
              <div class="input-group">
              </div>
            </div><!-- col-4 -->
            
          </div><!-- row -->
          <hr>
            
             <div class="row">
            <div class="col-lg-4">
              <h6 >ENCARGADO DE LA UNIDAD</h6>
              <div class="input-group">
             
                <input type="text" name="txtdirigidomod" id="txtdirigidomod" class="form-control form-control-sm" placeholder="Nombre">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <h6 >CARGO</h6>
              <div class="input-group">
               
                <input type="text" name="txtcargomod" id="txtcargomod" class="form-control form-control-sm" placeholder="Cargo">
              
              </div>
            </div><!-- col-4 -->
           
          </div><!-- row -->

            </section>
          <hr>
            <h6>ACTIVIDAD REALIZADA EN LA UNIDAD (NO SE PUEDE EDITAR)</h6>
            <section>
             <table class="table table-bordered table-sm">
                    <?php 
                      $contador=1;
                      $sucesos = listasucceso($conexion); 
                      while ($items = mysqli_fetch_array($sucesos)): 
                        if ($contador==1) {
                            ?>
                           <tr>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>" disabled><span><?=$items['nombre'] ?></span>
                                   </label>
                              </td>

                            <?php
                          $contador=$contador+1;
                        }else if ($contador==4) {
                           ?>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>" disabled><span><?=$items['nombre'] ?></span>
                                  </label>
                              </td>
                          </tr>
                             <?php
                           $contador=1;
                        }else{
                          ?>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>" disabled><span><?=$items['nombre'] ?></span>
                                  </label>
                              </td>
                          <?php
                           $contador=$contador+1;
                        }
                      endwhile; ?>
                </table>
                
             <hr>
          <div class="row">
            <div class="col-lg-2">
              <label class="text">ESTUVO ACOMPAÑADO:
              </label>
            </div><!-- col-3 -->
            <div class="col-lg-2 ">
               <label class="rdiobox">
                <input class="si" name="rdioacompanantemod" id="si" type="radio" value="SI"  >
                <span>Si</span>
              </label>

            </div><!-- col-3 -->
            <div class="col-lg-1 ">
                <label class="rdiobox">
                <input class="no" name="rdioacompanantemod" id="no" type="radio" value="NO" >
                <span>No</span>
              </label>
            </div><!-- col-3 -->
              <div class="col-lg-4 mg-t-20 mg-lg-t-0">
            <input type="text"  class="form-control form-control-sm" placeholder="Ingrese acompañante" name="txtacompanantemod" id="txtacompanantemod">
            </div><!-- col-3 -->
          </div><!-- row -->
          
           <hr>

            </section>
             <h6>ESPECIFIQUE LAS ACTIVIDADES REALIZADAS:</h6>
            <section>
             <textarea class="form-control" name="txtactividadesmod" id="txtactividadesmod"></textarea>
            </section><br>
            
            <!-- ################################### Mejoras YEISON ################################## -->
            <h6>ARCHIVOS ADJUNTADOS:</h6>
            <section>
              <div class="col-lg-12 col-md-12">
                <ul id="listaModDia">

                </ul>
              </div>
            </section><br>
            <h6>AÑADIR ADJUNTOS:</h6>
            <section>
              <div class="col-lg-2 col-md-2">
                <input type="file" name="filemd[]" id="filemd" multiple>
              </div>
            </section><br>
            <!-- ################################### Mejoras YEISON ################################## -->

            <div class="row">
              <div class="col-lg-4 col-md-4 mx-auto"></div>
              <div class="col-lg-2 col-md-2 mx-auto">
              <a href="#" role="button" class="pull-right btn btn-primary btn-sm" id="btncancelarmod" name="btncancelarmod">Cancelar</a>
              </div>
              <div class="col-lg-3 col-md-3 mx-auto">
              <a href="#" role="button" class="btn btn-primary btn-sm" id="btnenviarmod" name="btnenviarmod">Actualizar Reporte</a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 mx-auto"></div>
            </div>

    </div>
  </form>


              </div><!-- modal-body -->
              
            </div>
          </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- ---------------------------------------------------------------------------------------------------------- -->

<!--MODAL NUEVO REPORTE DE EVENTO -->
 <!-- LARGE MODAL -->
        <div id="modalevento" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <div class="col-lg-4">
                  <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">NUEVO Reporte de EVENTO</h5>
                </div>
                <div class="col-lg-6">
                   <h5><?=$nombre?> <?=$detalle?></h5><img width="30px" src="">
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20">
                  


  <form class="form" name="form_evento" id="form_evento" enctype="multipart/form-data">
    <div id="wizard1">

            <section>
           
                <div class="row">
            <div class="col-sm-3">
              <div class="input-group">
             
              <h6>FECHA DE EMISION:</h6>
              </div>
            </div><!-- col-4 -->
             <div class="col-lg-2">
              <div class="input-group">
             
               <input type="date" class="form-control form-control-sm" name="txtfechaE" id="txtfechaE">
              </div>
            </div><!-- col-4 -->
            
          </div><!-- row -->
          <hr>
      
             <div class="row">
            <div class="col-lg-4">
              <h6 >JEFE DE DPTO (DIPCP)</h6>
              <div class="input-group">
             
                <input type="text" name="txtdirigidoE" id="txtdirigidoE" class="form-control form-control-sm" placeholder="Nombre">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <h6 >CARGO</h6>
              <div class="input-group">
               
                <input type="text" name="txtcargoE" id="txtcargoE" class="form-control form-control-sm" placeholder="Cargo">
              
              </div>
            </div><!-- col-4 -->
           
          </div><!-- row -->

            </section>
          <hr>
            <h6>TIPO DE EVENTO</h6>
            <section>
             <table class="table table-bordered table-sm">
                    <?php 
                      $contador=1;
                      $eventos = listaevento($conexion); 
                      while ($items = mysqli_fetch_array($eventos)): 
                        if ($contador==1) {
                            ?>
                           <tr>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>" onclick="aparecer(<?=$items['id']?>)"><span><?=$items['nombre'] ?></span>
                                   </label><textarea class="<?=$items['id']?> form-control form-control-sm b" type="" name="itemstext[]" hidden status='0' placeholder="Ingrese detalles del suceso" ></textarea>
                              </td>

                            <?php
                          $contador=$contador+1;
                        }else if ($contador==4) {
                           ?>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>" onclick="aparecer(<?=$items['id']?>)"><span><?=$items['nombre'] ?></span>
                                  </label><textarea class="<?=$items['id']?> form-control form-control-sm b" type="" name="itemstext[]" hidden status='0' placeholder="Ingrese detalles del suceso" ></textarea>
                              </td>
                          </tr>
                             <?php
                           $contador=1;
                        }else{
                          ?>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>" onclick="aparecer(<?=$items['id']?>)"><span><?=$items['nombre'] ?></span>
                                  </label><textarea class="<?=$items['id']?> form-control form-control-sm b" type="" name="itemstext[]" hidden status='0' placeholder="Ingrese detalles del suceso"></textarea>
                              </td>
                          <?php
                           $contador=$contador+1;
                        }
                      endwhile; ?> 
                </table>
                
             <hr>
          <div class="row">
            <div class="col-lg-4">
              <label class="text">EVIDENCIA FOTOGRAFICA DEL EVENTO (HECHO):
              </label>
            </div><!-- col-3 -->
            <div class="col-lg-2 ">
               <label class="rdiobox">
                <input name="rdioevidencia" id="siE" type="radio" checked value="SI">
                <span>Si</span>
              </label>

            </div><!-- col-3 -->
            <div class="col-lg-1 ">
                <label class="rdiobox">
                <input name="rdioevidencia" type="radio" value="NO">
                <span>No</span>
              </label>
            </div><!-- col-3 -->
              
          </div><!-- row -->
          
           <hr>

             <h6>ACTUACION DE ORGANISMOS DE ESTADO U OTROS</h6><br>
             <div class="row">

                <div class="col-lg-2">                  
                  <label class="ckbox">
                      <input id="pl" type="checkbox" class="a" name="itemsorg[]" value="1"><span>POLICIA ESTATAL</span>
                  </label>
                </div>

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input id="pn" type="checkbox" class="a" name="itemsorg[]" value="2"><span>PNB</span>
                  </label>
                </div>

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input id="gn" type="checkbox" class="a" name="itemsorg[]" value="3"><span>GNB</span>
                  </label>
                </div>

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input id="ci" type="checkbox" class="a" name="itemsorg[]" value="4"><span>CICPC</span>
                  </label>
                </div>

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input id="bo" type="checkbox" class="a" name="itemsorg[]" value="5"><span>BOMBEROS</span>
                  </label>
                </div> 

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input id="ot" type="checkbox" class="a" name="itemsorg[]" value="6"><span>OTROS</span>
                  </label>
                </div><!-- col-4 -->

             </div><!-- row -->
             <br>
            </section>
             
             <h6>DETALLES DE ACTUACION DE LOS ORGANISMOS: </h6>
            <section>
             <textarea class="form-control" name="txtorganismo" id="txtorganismo"></textarea>
            </section><br>

             <h6>ACCIONES CORRECTIVAS IMPLEMENTADAS: </h6>
            <section>
             <textarea class="form-control" name="txtacciones" id="txtacciones"></textarea>
            </section><br>

            <h6>RECOMENDACIONES: </h6>
            <section>
             <textarea class="form-control" name="txtrecomendaciones" id="txtrecomendaciones"></textarea>
            </section><br>
            
            <!-- ################################### Mejoras YEISON ################################## -->
            <h6>AÑADIR ADJUNTOS:</h6>
            <section>
              <div class="col-lg-2 col-md-2">
                <input type="file" name="fileev[]" id="fileev" multiple>
              </div>
            </section><br>
            <!-- ################################### Mejoras YEISON ################################## -->

            <div class="row">
              <div class="col-lg-4 col-md-4 mx-auto"></div>
              <div class="col-lg-2 col-md-2 mx-auto">
              <a href="#" role="button" class="pull-right btn btn-primary btn-sm" id="btncancelarE" name="btncancelarE">Cancelar</a>
              </div>
              <div class="col-lg-3 col-md-3 mx-auto">
              <a href="#" role="button" class="btn btn-primary btn-sm" id="btnenviarE" name="btnenviarE">Enviar Reporte</a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 mx-auto"></div>
            </div>

          </div>
   </form>


              </div><!-- modal-body -->
              
            </div>
          </div><!-- modal-dialog -->
</div><!-- modal -->

<!--MODAL editar REPORTE DE EVENTO -->
 <!-- LARGE MODAL -->
        <div id="modaleventomod" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
                <div class="col-lg-4">
                  <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="editareventomod">Editar Reporte de eventos</h5>
                </div>
                <div class="col-lg-6">
                   <h5><?=$nombre?> <?=$detalle?></h5><img width="30px" src="">
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20">
                  


  <form class="form" name="form_eventomod" id="form_eventomod" enctype="multipart/form-data">
    <div id="wizard1"> 

            <section>
           
                <div class="row">
            <div class="col-sm-3">
              <div class="input-group">
             
              <h6>FECHA DE EMISION:</h6>
              <input class="form-control form-control-sm" name="controlevento" id="controlevento" type="text" hidden >
              </div>
            </div><!-- col-4 -->
             <div class="col-lg-2">
              <div class="input-group">
                <input type="text" class="form-control form-control-sm" name="txtfechamod2" id="txtfechamod2" disabled>
              </div>
            </div><!-- col-4 -->
            
          </div><!-- row -->
          <hr>
      
             <div class="row">
            <div class="col-lg-4">
              <h6 >JEFE DE DPTO (DIPCP)</h6>
              <div class="input-group">
             
                <input type="text" name="txtdirigidoEmod" id="txtdirigidoEmod" class="form-control form-control-sm" placeholder="Nombre">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <h6 >CARGO</h6>
              <div class="input-group">
               
                <input type="text" name="txtcargoEmod" id="txtcargoEmod" class="form-control form-control-sm" placeholder="Cargo">
              
              </div>
            </div><!-- col-4 -->
           
          </div><!-- row -->

            </section>
          <hr>
            <h6>TIPO DE EVENTO</h6>
            <section>
             <table class="table table-bordered table-sm">
                    <?php 
                      $contador=1;
                      $eventos = listaevento($conexion); 
                      while ($items = mysqli_fetch_array($eventos)): 
                        if ($contador==1) {
                            ?>
                           <tr>
                              <td><label class="ckbox">
                                  <input disabled type="checkbox" class="a" name="items[]" value="<?=$items['id']?>" onclick="aparecer(<?=$items['id']?>)"><span><?=$items['nombre'] ?></span>
                                   </label><textarea class="<?=$items['id']?> form-control form-control-sm" type="" name="itemstext[]" hidden status='0' placeholder="Ingrese detalles del suceso"></textarea>
                              </td>

                            <?php
                          $contador=$contador+1;
                        }else if ($contador==4) {
                           ?>
                              <td><label class="ckbox">
                                  <input disabled type="checkbox" class="a" name="items[]" value="<?=$items['id']?>" onclick="aparecer(<?=$items['id']?>)"><span><?=$items['nombre'] ?></span>
                                  </label><textarea class="<?=$items['id']?> form-control form-control-sm" type="" name="itemstext[]" hidden status='0' placeholder="Ingrese detalles del suceso"></textarea>
                              </td>
                          </tr>
                             <?php
                           $contador=1;
                        }else{
                          ?>
                              <td><label class="ckbox">
                                  <input disabled type="checkbox" class="a" name="items[]" value="<?=$items['id']?>" onclick="aparecer(<?=$items['id']?>)"><span><?=$items['nombre'] ?></span>
                                  </label><textarea class="<?=$items['id']?> form-control form-control-sm" type="" name="itemstext[]" hidden status='0' placeholder="Ingrese detalles del suceso"></textarea>
                              </td>
                          <?php
                           $contador=$contador+1;
                        }
                      endwhile; ?> 
                </table>
                
             <hr>
          <div class="row">
            <div class="col-lg-4">
              <label class="text">EVIDENCIA FOTOGRAFICA DEL EVENTO (HECHO):
              </label>
            </div><!-- col-3 -->
            <div class="col-lg-2 ">
               <label class="rdiobox">
                <input class='siE' name="rdioevidenciamod" id="siE" type="radio" value="SI">
                <span>Si</span>
              </label>

            </div><!-- col-3 -->
            <div class="col-lg-1 ">
                <label class="rdiobox">
                <input class='noE' name="rdioevidenciamod" id="noE" type="radio" value="NO">
                <span>No</span>
              </label>
            </div><!-- col-3 -->
              
          </div><!-- row -->
          
           <hr>

             <h6 >ACTUACION DE ORGANISMOS DE ESTADO U OTROS</h6><br>
             <div class="row">

                <div class="col-lg-2">                  
                  <label class="ckbox">
                      <input type="checkbox" class="a" name="itemsorg[]" value="1" disabled><span>POLICIA ESTATAL</span>
                  </label>
                </div>

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input type="checkbox" class="a" name="itemsorg[]" value="2" disabled><span>PNB</span>
                  </label>
                </div>

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input type="checkbox" class="a" name="itemsorg[]" value="3" disabled><span>GNB</span>
                  </label>
                </div>

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input type="checkbox" class="a" name="itemsorg[]" value="4" disabled><span>CICPC</span>
                  </label>
                </div>

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input type="checkbox" class="a" name="itemsorg[]" value="5" disabled><span>BOMBEROS</span>
                  </label>
                </div> 

                <div class="col-lg-2">    
                  <label class="ckbox">
                      <input type="checkbox" class="a" name="itemsorg[]" value="6" disabled><span>OTROS</span>
                  </label>
                </div><!-- col-4 -->

             </div><!-- row -->
             <br>
            </section>
             
             <h6>DETALLES DE ACTUACION DE LOS ORGANISMOS: </h6>
            <section>
             <textarea class="form-control" name="txtorganismomod" id="txtorganismomod"></textarea>
            </section><br>

             <h6>ACCIONES CORRECTIVAS IMPLEMENTADAS: </h6>
            <section>
             <textarea class="form-control" name="txtaccionesmod" id="txtaccionesmod"></textarea>
            </section><br>

            <h6>RECOMENDACIONES: </h6>
            <section>
             <textarea class="form-control" name="txtrecomendacionesmod" id="txtrecomendacionesmod"></textarea>
            </section><br>

            <!-- ################################### Mejoras YEISON ################################## -->
            <h6>ARCHIVOS ADJUNTADOS:</h6>
            <section>
              <div class="col-lg-12 col-md-12">
                <ul id="listaModEve">

                </ul>
              </div>
            </section><br>
            <h6>AÑADIR ADJUNTOS:</h6>
            <section>
              <div class="col-lg-2 col-md-2">
                <input type="file" name="filemev[]" id="filemev" multiple>
              </div>
            </section><br>
            <!-- ################################### Mejoras YEISON ################################## -->

            <div class="row">
              <div class="col-lg-4 col-md-4 mx-auto"></div>
              <div class="col-lg-2 col-md-2 mx-auto">
              <a href="#" role="button" class="pull-right btn btn-primary btn-sm" id="btncancelarEmod" name="btncancelarEmod">Cancelar</a>
              </div>
              <div class="col-lg-3 col-md-3 mx-auto">
              <a href="#" role="button" class="btn btn-primary btn-sm" id="btnenviarEmod" name="btnenviarEmod">Actualizar Reporte</a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 mx-auto"></div>
            </div>
          </div>
   </form>


              </div><!-- modal-body -->
              
            </div>
          </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- ---------------------------------------------------------------------------------------------------------- -->

<!--MODAL NUEVO REPORTE DE RIESGOS -->
 <!-- LARGE MODAL -->
        <div id="modalriesgo" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
               <div class="col-lg-4">
                  <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">NUEVO Reporte de Riesgos</h5>
                </div>
                <div class="col-lg-6">
                   <h5><?=$nombre?> <?=$detalle?></h5><img width="30px" src="">
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20">
                  


  <form class="form" name="form_riesgo" id="form_riesgo" enctype="multipart/form-data">
    <div id="wizard1"> 

            <section>
           
                <div class="row">
            <div class="col-sm-3">
              <div class="input-group">
             
              <h6>FECHA DE EMISION:</h6>
              </div>
            </div><!-- col-4 -->
             <div class="col-lg-2">
              <div class="input-group">
             
               <input type="date" class="form-control form-control-sm" name="txtfechaR" id="txtfechaR">
              </div>
            </div><!-- col-4 -->
            
          </div><!-- row -->
          <hr>
     
             <div class="row">
            <div class="col-lg-4">
              <h6 >ENCARGADO DE LA UNIDAD</h6>
              <div class="input-group">
             
                <input type="text" name="txtdirigidoR" id="txtdirigidoR" class="form-control form-control-sm" placeholder="Nombre">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <h6 >CARGO</h6>
              <div class="input-group">
               
                <input type="text" name="txtcargoR" id="txtcargoR" class="form-control form-control-sm" placeholder="Cargo">
              
              </div>
            </div><!-- col-4 -->
           
          </div><!-- row -->

            </section>
          <hr>
            <h6>TIPO DE RIESGO</h6>
            <section>
             <table class="table table-bordered table-sm">
                    <?php 
                      $contador=1;
                      $eventos = listacondicion($conexion); 
                      while ($items = mysqli_fetch_array($eventos)): 
                        if ($contador==1) {
                            ?>
                           <tr>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>"><span><?=$items['nombre'] ?></span>
                                   </label>
                              </td>

                            <?php
                          $contador=$contador+1;
                        }else if ($contador==4) {
                           ?>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>"><span><?=$items['nombre'] ?></span>
                                  </label>
                              </td>
                          </tr>
                             <?php
                           $contador=1;
                        }else{
                          ?>
                              <td><label class="ckbox">
                                  <input type="checkbox" class="a" name="items[]" value="<?=$items['id']?>"><span><?=$items['nombre'] ?></span>
                                  </label>
                              </td>
                          <?php
                           $contador=$contador+1;
                        }
                      endwhile; ?> 
                </table>
                
             <hr>
          <div class="row">
            <div class="col-lg-4">
              <label class="text">EVIDENCIA FOTOGRAFICA DEL RIESGO :
              </label>
            </div><!-- col-3 -->
            <div class="col-lg-2 ">
               <label class="rdiobox">
                <input name="rdioevidenciaR" type="radio" checked value="1">
                <span>Si</span>
              </label>

            </div><!-- col-3 -->
            <div class="col-lg-1 ">
                <label class="rdiobox">
                <input name="rdioevidenciaR" type="radio" value="0">
                <span>No</span>
              </label>
            </div><!-- col-3 -->
              
          </div><!-- row -->
          
           <hr>

             <h6 >EVALUACIÓN Y CLASIFICACIÓN DEL RIESGO</h6><br>
             <div class="row">

                <div class="col-lg-3">                  
                  <label class="rdiobox">
                      <input id="l" type="radio" class="a" name="rdioevaluacion" value="1" ><span>LEVE</span>
                  </label>
                </div>

                <div class="col-lg-3">    
                  <label class="rdiobox">
                      <input id="m" type="radio" class="a" name="rdioevaluacion" value="2" ><span>MODERADO</span>
                  </label>
                </div>

                <div class="col-lg-3">    
                  <label class="rdiobox">
                      <input id="a" type="radio" class="a" name="rdioevaluacion" value="3" ><span>ALTO</span>
                  </label>
                </div>

                <div class="col-lg-3">    
                  <label class="rdiobox">
                      <input id="mu" type="radio" class="a" name="rdioevaluacion" value="4" ><span>MUY ALTO</span>
                  </label>
                </div>

             </div><!-- row -->
             <br>
            </section>
             
             <h6>ANÁLISIS DE LA EVALUACIÓN DEL RIESGO : </h6>
            <section>
             <textarea class="form-control" name="txtanalisis" id="txtanalisis"></textarea>
            </section><br>

             <h6>RECOMENDACIONES: </h6>
            <section>
             <textarea class="form-control" name="txtrecomendacionesR" id="txtrecomendacionesR"></textarea>
            </section><br>

            <h6>ACCIONES EJECUTADAS : </h6>
            <section>
             <textarea class="form-control" name="txtaccionesR" id="txtaccionesR"></textarea>
            </section><br>
            
            <!-- ################################### Mejoras YEISON ################################## -->
            <h6>AÑADIR ADJUNTOS:</h6>
            <section>
              <div class="col-lg-2 col-md-2">
                <input type="file" name="filer[]" id="filer" multiple>
              </div>
            </section><br>
            <!-- ################################### Mejoras YEISON ################################## -->

            <div class="row">
              <div class="col-lg-4 col-md-4 mx-auto"></div>
              <div class="col-lg-2 col-md-2 mx-auto">
              <a href="#" role="button" class="pull-right btn btn-primary btn-sm" id="btncancelarR" name="btncancelarR">Cancelar</a>
              </div>
              <div class="col-lg-3 col-md-3 mx-auto">
              <a href="#" role="button" class="btn btn-primary btn-sm" id="btnenviarR" name="btnenviarR">Enviar Reporte</a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 mx-auto"></div>
            </div>

          </div>
   </form>


              </div><!-- modal-body -->
              
            </div>
          </div><!-- modal-dialog -->
</div><!-- modal -->

<!--MODAL EDITAR REPORTE DE RIESGOS -->
 <!-- LARGE MODAL -->
        <div id="modalriesgomod" class="modal fade">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
              <div class="modal-header pd-x-20">
               <div class="col-lg-4">
                  <h5 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold" id="editariesgo">EDITAR Reporte de Riesgos</h5>
                </div>
                <div class="col-lg-6">
                   <h5><?=$nombre?> <?=$detalle?></h5><img width="30px" src="">
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body pd-20">
                  


  <form class="form" name="form_riesgomod" id="form_riesgomod" enctype="multipart/form-data">
    <div id="wizard1"> 

            <section>
           
                <div class="row">
            <div class="col-sm-3">
              <div class="input-group">
             
              <h6>FECHA DE EMISION:</h6>
              <input class="form-control form-control-sm" name="controlriesgo" id="controlriesgo" type="text" hidden >
              </div>
            </div><!-- col-4 -->
             <div class="col-lg-2">
              <div class="input-group">
             
               <input type="text" class="form-control form-control-sm" name="txtfechaRmod2" id="txtfechaRmod2" disabled>
              </div>
            </div><!-- col-4 -->
            
          </div><!-- row -->
          <hr>
     
             <div class="row">
            <div class="col-lg-4">
              <h6 >ENCARGADO DE LA UNIDAD</h6>
              <div class="input-group">
             
                <input type="text" name="txtdirigidoRmod" id="txtdirigidoRmod" class="form-control form-control-sm" placeholder="Nombre">
              </div>
            </div><!-- col-4 -->
            <div class="col-lg-4 mg-t-20 mg-lg-t-0">
              <h6 >CARGO</h6>
              <div class="input-group">
               
                <input type="text" name="txtcargoRmod" id="txtcargoRmod" class="form-control form-control-sm" placeholder="Cargo">
              
              </div>
            </div><!-- col-4 -->
           
          </div><!-- row -->

            </section>
          <hr>
            <h6>TIPO DE RIESGO</h6>
            <section>
             <table class="table table-bordered table-sm">
                    <?php 
                      $contador=1;
                      $eventos = listacondicion($conexion); 
                      while ($items = mysqli_fetch_array($eventos)): 
                        if ($contador==1) {
                            ?>
                           <tr>
                              <td><label class="ckbox">
                                  <input disabled type="checkbox" class="a" name="items[]" value="<?=$items['id']?>"><span><?=$items['nombre'] ?></span>
                                   </label>
                              </td>

                            <?php
                          $contador=$contador+1;
                        }else if ($contador==4) {
                           ?>
                              <td><label class="ckbox">
                                  <input disabled type="checkbox" class="a" name="items[]" value="<?=$items['id']?>"><span><?=$items['nombre'] ?></span>
                                  </label>
                              </td>
                          </tr>
                             <?php
                           $contador=1;
                        }else{
                          ?>
                              <td><label class="ckbox">
                                  <input disabled type="checkbox" class="a" name="items[]" value="<?=$items['id']?>"><span><?=$items['nombre'] ?></span>
                                  </label>
                              </td>
                          <?php
                           $contador=$contador+1;
                        }
                      endwhile; ?> 
                </table>
                
             <hr>
          <div class="row">
            <div class="col-lg-4">
              <label class="text">EVIDENCIA FOTOGRAFICA DEL RIESGO :
              </label>
            </div><!-- col-3 -->
            <div class="col-lg-2 ">
               <label class="rdiobox">
                <input class="siR" name="rdioevidenciaRmod" type="radio" value="1">
                <span>Si</span>
              </label>

            </div><!-- col-3 -->
            <div class="col-lg-1 ">
                <label class="rdiobox">
                <input class="noR" name="rdioevidenciaRmod" type="radio" value="0">
                <span>No</span>
              </label>
            </div><!-- col-3 -->
              
          </div><!-- row -->
          
           <hr>

             <h6 >EVALUACIÓN Y CLASIFICACIÓN DEL RIESGO</h6><br>
             <div class="row">

                <div class="col-lg-3">                  
                  <label class="rdiobox">
                      <input class='leve' type="radio" class="a" name="rdioevaluacionmod" value="1" ><span>LEVE</span>
                  </label>
                </div>

                <div class="col-lg-3">    
                  <label class="rdiobox">
                      <input class='moderado' type="radio" class="a" name="rdioevaluacionmod" value="2" ><span>MODERADO</span>
                  </label>
                </div>

                <div class="col-lg-3">    
                  <label class="rdiobox">
                      <input class='alto' id="a" type="radio" class="a" name="rdioevaluacionmod" value="3" ><span>ALTO</span>
                  </label>
                </div>

                <div class="col-lg-3">    
                  <label class="rdiobox">
                      <input class='muy_alto' type="radio" class="a" name="rdioevaluacionmod" value="4" ><span>MUY ALTO</span>
                  </label>
                </div>

             </div><!-- row -->
             <br>
            </section>
             
             <h6>ANÁLISIS DE LA EVALUACIÓN DEL RIESGO : </h6>
            <section>
             <textarea class="form-control" name="txtanalisismod" id="txtanalisismod"></textarea>
            </section><br>

             <h6>RECOMENDACIONES: </h6>
            <section>
             <textarea class="form-control" name="txtrecomendacionesRmod" id="txtrecomendacionesRmod"></textarea>
            </section><br>

            <h6>ACCIONES EJECUTADAS : </h6>
            <section>
             <textarea class="form-control" name="txtaccionesRmod" id="txtaccionesRmod"></textarea>
            </section><br>

            <!-- ################################### Mejoras YEISON ################################## -->
            <h6>ARCHIVOS ADJUNTADOS:</h6>
            <section>
              <div class="col-lg-12 col-md-12">
                <ul id="listaModRies">

                </ul>
              </div>
            </section><br>
            <h6>AÑADIR ADJUNTOS:</h6>
            <section>
              <div class="col-lg-2 col-md-2">
                <input type="file" name="filemr[]" id="filemr" multiple>
              </div>
            </section><br>
            <!-- ################################### Mejoras YEISON ################################## -->

           <div class="row">
              <div class="col-lg-4 col-md-4 mx-auto"></div>
              <div class="col-lg-2 col-md-2 mx-auto">
              <a href="#" role="button" class="pull-right btn btn-primary btn-sm" id="btncancelarRmod" name="btncancelarRmod">Cancelar</a>
              </div>
              <div class="col-lg-3 col-md-3 mx-auto">
              <a href="#" role="button" class="btn btn-primary btn-sm" id="btnenviarRmod" name="btnenviarRmod">Actualizar Reporte</a>
              </div>
              <div class="col-lg-3 col-md-3 col-sm-12 mx-auto"></div>
            </div>

          </div>
   </form>


              </div><!-- modal-body -->
              
            </div>
          </div><!-- modal-dialog -->
</div><!-- modal -->


    <script src="../lib/jquery-ui/jquery-ui.js"></script>
    <script src="../lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../lib/highlightjs/highlight.pack.js"></script>
    <script src="../lib/jquery.steps/jquery.steps.js"></script>
    <script src="../js/reportar/reportar.js"></script>
    <script src="../js/seefiles.js"></script>
