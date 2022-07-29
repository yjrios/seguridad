<?php  
require_once('../../../config/conexion.php');
include('../../includes/funciones.php');

$id_u = $_SESSION['sesion']['id']; 
$sede = $_SESSION['sesion']['id_sede'];
$empresas=conseguirEmpresas2($conexion);
?>


<div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
        	<img class="imgt" style="width: 300px; display: none;" src="../img/logoreporte.png">
			 <center><h3>Reporte mensual por empresa </h3></center><hr class="oculto-impresion">
				 
         <form class="" name="formulario_asistencia" id="formulario_asistencia">
        	  <div class="row d-flex justify-content-center">
              
              <div class="col-lg-4 oculto-impresion">
              <h6 class="oculto-impresion">Seleccione Empresa</h6>
                        
                          <select class="form-control form-control-sm" id="emp" name="emp">
                            <option value="0">Seleccione ...</option>
                            <?php while ($empresa = mysqli_fetch_assoc($empresas) ) { ?> 
                            <option value="<?=$empresa['id']?>"><?=$empresa['nombre']?> <?=$empresa['detalle']?></option>
                            <?php } ?>
                          </select>
                   
                     
              </div>
            
      			<div class="col-lg-4 oculto-impresion">
                 <h6 class="oculto-impresion">Seleccione Mes</h6>
                  <select class="form-control form-control-sm" id="mesa2" name="mesa2">
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
                </div>

                <div class="col-lg-4">
                  <h6 class="oculto-impresion">Año</h6>
                  <select class="form-control form-control-sm oculto-impresion"  id="ano" name="ano">
                	 <option value="<?= date('Y') ?>"> <?= date('Y') ?> </option>
                  </select>
                </div>
  
            </div>
        </form><br><br>
        
        <div id="reporte" class="reporte">
       
		    </div><!-- sl-pagebody -->

    </div>
</div>

<script src="../js/estadisticas/por_empresa.js"></script> 
