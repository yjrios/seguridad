<?php  
require_once('../../../config/conexion.php');
include('../../includes/funciones.php');

$id_u = $_SESSION['sesion']['id']; 
$usuarios=usuarios($conexion);  
?>

	    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Inicio</a>
        <span class="breadcrumb-item active"> Configuración </span>        
      </nav>


      <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
			     <h3 class="">Permisos de Usuario</h3> <hr><br>

        	<div class="row">
        
      			<div class="col-lg-4">
                  <h6>Usuario</h6>
                  <div class="input-group">
                    <select class="form-control form-control-sm" required id="usuario" name="usuario">
                          <option value="0">Seleccione ...</option>
                          <?php  while ($usuario = mysqli_fetch_assoc($usuarios) ) :  ?>
                            <option value="<?=$usuario['id']?>"><?=$usuario['nombre']?></option>
                          <?php endwhile; ?>
                    </select>
                  </div>
                </div><br>

                <div class="col-lg-4">
                	<h6 >Sede</h6>
                	<select class="form-control form-control-sm" id="sedes">
                		<option value="0">Seleccione ...</option>
                		<option value="1">Lara</option>
                		<option value="2">Portuguesa</option>
                		<option value="3">Grupo Completo</option>
                	</select>
                </div><br>

                <div class="col-lg-4">
                	<h6 >Permisos</h6>
                	<select class="form-control form-control-sm" id="permisos">
                		<option value="0">Seleccione ...</option>
                		<option value="1">Administrador</option>
                		<option value="2">Standard</option>
                	</select>
                </div>
            </div>

               <br>
               <div class="row">

               	<div class="col-lg-5 col-sm-5"></div>

               	<div class="col-lg-1 col-sm-3">
	               	<button class="btn btn-success btn-sm" id="btnguardar">Guardar</button>
	            </div>
	            <div class="col-lg-1 col-sm-3">
	               	<button class="btn btn-error btn-sm" id="btncancelar">Cancelar</button>
	            </div>

               </div>
        </div>





<script  src="../js/configuracion/configuracion.js" type="text/javascript"></script>