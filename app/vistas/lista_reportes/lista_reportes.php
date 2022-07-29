 <?php
require_once('../../../config/conexion.php');
include('../../includes/funciones.php');


$id_u = $_SESSION['sesion']['id']; 
$usuarios=usuarios($conexion);  
$usuarios2=usuarios($conexion);  
$usuarios3=usuarios($conexion);  
 
?>
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Inicio</a>
        <span class="breadcrumb-item active"> Lista de Reportes</span>        
      </nav>

      <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
        


          <h6 class="card-body-title">Reportes</h6> 
          <img align="right" src="" style="width: 100px;margin-bottom: 10px">

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
              <div class="row">

                <div class="col-lg-3">
                  <h6 >Seleccione Personal</h6>
                  <div class="input-group">
                    <select class="form-control form-control-sm" required id="usuario" name="usuario">
                          <option value="0">Seleccione ...</option>
                          <option value="-1">Todos</option>
                          <?php  while ($usuario = mysqli_fetch_assoc($usuarios) ) :  ?>
                            <option value="<?=$usuario['id']?>"><?=$usuario['nombre']?></option>
                          <?php endwhile; ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-2">
                  <h6 >Desde</h6>
                  <div class="input-group">
                    <input type="date" class="form-control form-control-sm" name="txtfecha" id="txtfecha">
                  </div>
                </div>

                <div class="col-lg-2">
                  <h6 >Hasta</h6>
                  <div class="input-group">
                    <input type="date" class="form-control form-control-sm" name="txtfinal" id="txtfinal">
                  </div>
                </div>

                <div class="col-lg-2">
                  <h6>&nbsp;</h6>
                  <div class="input-group">
                    <button class="btn btn-success btn-sm" id="btndiario">Consultar</button>
                  </div>
                </div>

              </div>
                 <hr>
                  <table id="dt_diarios" class="table display  nowrap table-sm  compact" style="width: 100%">
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
                  <div class="row">

                <div class="col-lg-3">
                  <h6 >Seleccione Personal</h6>
                  <div class="input-group">
                    <select class="form-control form-control-sm" required id="usuarioE" name="usuarioE">
                          <option value="0">Seleccione ...</option>
                          <option value="-1">Todos</option>
                          <?php  while ($usuario = mysqli_fetch_assoc($usuarios2) ) :  ?>
                            <option value="<?=$usuario['id']?>"><?=$usuario['nombre']?></option>
                          <?php endwhile; ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-2">
                  <h6 >Desde</h6>
                  <div class="input-group">
                    <input type="date" class="form-control form-control-sm" name="txtfechaE" id="txtfechaE">
                  </div>
                </div>

                <div class="col-lg-2">
                  <h6 >Hasta</h6>
                  <div class="input-group">
                    <input type="date" class="form-control form-control-sm" name="txtfinalE" id="txtfinalE">
                  </div>
                </div>

                <div class="col-lg-2">
                  <h6>&nbsp;</h6>
                  <div class="input-group">
                    <button class="btn btn-success btn-sm" id="btnevento">Consultar</button>
                  </div>
                </div>

              </div>
                <hr>
                  <table id="dt_eventos" class="table display  nowrap table-sm  compact" style="width: 100%">
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
                  <div class="row">

                <div class="col-lg-3">
                  <h6 >Seleccione Personal</h6>
                  <div class="input-group">
                    <select class="form-control form-control-sm" required id="usuarioR" name="usuarioR">
                          <option value="0">Seleccione ...</option>
                          <option value="-1">Todos</option>
                          <?php  while ($usuario = mysqli_fetch_assoc($usuarios3) ) :  ?>
                            <option value="<?=$usuario['id']?>"><?=$usuario['nombre']?></option>
                          <?php endwhile; ?>
                    </select>
                  </div>
                </div>

                <div class="col-lg-2">
                  <h6 >Desde</h6>
                  <div class="input-group">
                    <input type="date" class="form-control form-control-sm" name="txtfechaR" id="txtfechaR">
                  </div>
                </div>

                <div class="col-lg-2">
                  <h6 >Hasta</h6>
                  <div class="input-group">
                    <input type="date" class="form-control form-control-sm" name="txtfinalR" id="txtfinalR">
                  </div>
                </div>

                <div class="col-lg-2">
                  <h6>&nbsp;</h6>
                  <div class="input-group">
                    <button class="btn btn-success btn-sm" id="btnriesgo">Consultar</button>
                  </div>
                </div>

              </div><hr>
                
                 <table id="dt_riesgos" class="table display nowrap table-sm compact" style="width: 100%">
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


          <div class="table-wrapper">
         
          </div><!-- table-wrapper -->
        </div><!-- card -->
      </div>



    <script src="../js/lista_reportes/lista_reportes.js"></script>