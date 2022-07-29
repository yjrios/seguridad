<?php 
     require_once '../../../config/conexion.php';
     require_once '../../includes/funciones.php';
     $sede = $_SESSION['sesion']['id_sede'];
?>

      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">Inicio</a>
        <span class="breadcrumb-item active">Empresas</span>
      </nav>  
      <div class="sl-pagebody">
        <div class="row row-sm">

<?php
    $empresas=buscarempresas($conexion,$sede);
    //crear_asistencia($conexion);
  if (!empty($empresas)){
    while ($empresa = mysqli_fetch_assoc($empresas) ) {
?>
<!-- CUADRO DE LAS EMPRESAS -->
                 <div class="col-sm-4 col-xl-3" id="cuadro">
                  <div class="card pd-20 bg-secondary">
                    <div class="d-flex justify-content-between align-items-center mg-b-10">
                      <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"> <?=$empresa['nombre']?> </h6>
                      <a href="" class="tx-white-8 hover-white"></a>
                    </div><!--card-header -->
                    <div class="d-flex align-items-center justify-content-between">
                      <img id="foto" src="<?=$empresa['foto']?>" height="70">
                      <a href="#"  class="btnreport" id_e="<?=$empresa['id']?>" nombre="<?=$empresa['nombre'];?>" ><h4 class="mg-b-0 tx-white tx-lato tx-bold pull-right"><?=$empresa['nombre'];?> </h4><h6 class="mg-b-0 tx-white tx-lato tx-bold pull-right"><small><?=$empresa['detalle'];?></small></h6></a>
                    </div> <!--card-body -->
                    
                  </div><!-- card  -->
                </div><!-- col-3 -->
                <br>  
<!-- CUADRO DE LAS EMPRESAS -->
<?php 
      }
   }else {
?>
        </div>
       <div>
        <div class="card pd-20 pd-sm-40">
          <center><h3>Error en el servidor <?/*=$_SESSION['meses'][date('n')-1];*/?></h3>
          </center>
          <p style="text-align: center;"><small>Comuniquese con el administrador del sistema para abrir el mes</small></p>
        </div> 

<?php 
  }
?>



            
        <!-- </div> -->
      </div><!-- row -->
      <div class="row row-sm mg-t-20"></div><!-- row -->	



<script src="../js/eventos.js"></script> 