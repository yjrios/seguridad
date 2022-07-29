<?php  
require_once('../../../config/conexion.php');
include('../../includes/funciones.php');

$id_u = $_SESSION['sesion']['id']; 
$sede = $_SESSION['sesion']['id_sede'];
$empresas=conseguirEmpresas2($conexion);
?>

	  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Inicio</a>
        <span class="breadcrumb-item active"> Configuración </span>        
      </nav>


      <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
			    <h3 class="">Asistencia de Vigilantes</h3> <hr><br>

         <form class="formulario_asistencia" name="formulario_asistencia" id="formulario_asistencia">
        	  <div class="row d-flex justify-content-center">
            
      			    <div class="col-lg-4">
                 <h6 >Seleccione Mes</h6>
                  <select class="form-control form-control-sm" id="meses" name="meses">
                    <option value="0">Seleccione ...</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                  </select>
                </div><br>

                <div class="col-lg-4">
                  <h6 >Año</h6>
                  <select class="form-control form-control-sm"  id="ano" name="ano">
                	 <option value="<?= date('Y') ?>"> <?= date('Y') ?> </option>
                  </select>
                </div><br>
  
            </div>
              <br>

              <div class="row d-flex justify-content-center">
                  <div class="col-lg-6 col-sm-8">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6"><h6>Empresa</h6><hr></div>
                        <div class="col-lg-3 col-sm-3"><h6>Matricula</h6><hr></div>
                        
                    </div>

                  </div>
              </div>

               <div class="row d-flex justify-content-center">
                  <div class="col-lg-6 col-sm-8">

                      <?php while ($empresa = mysqli_fetch_assoc($empresas) ) { ?>
                      <div class="row">

                        <div class="col-lg-6 col-sm-6">
                          <p><strong><?=$empresa['nombre']?> <?=$empresa['detalle']?></strong></p>
                        </div>

                        <div class="col-lg-2 col-sm-2">
                           <input type="number" name="<?=$empresa['id']?>" id="<?=$empresa['id']?>" class="form-control form-control-sm">
                        </div>

                      </div>   <br>
                      <?php } ?>

                  </div>
               </div>
        
               <div class="row d-flex justify-content-center">

                  <div class="col-lg-2 col-sm-3">
                      <input class="btn btn-success btn-sm" type="button" id="btngenerar" value="Guardar">
    	            </div>

    	            <div class="col-lg-2 col-sm-3">
                      <input class="btn btn-error btn-sm" type="button" id="btncancelar" value="Cancelar">
    	            </div>

               </div>
         </form>
        </div>
      </div>
<script  src="../js/configuracion/asistencia.js" type="text/javascript"></script>