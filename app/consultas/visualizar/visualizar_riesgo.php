<?php  require_once ('../../../config/conexion.php');
    
$id=$_GET['id'];

$sql_riesgo="SELECT rr.id AS numero, u.nombre AS usuario , u.cargo, e.nombre AS empresa,e.detalle, rr.fecha_apertura as fecha, c.nombre as tipo ,rr.nom_dirigido as para, rr.cargo_dirigido as cargop, e.foto, rr.evidencia, rr.id_clasificacion as clasificacion, rr.analisis_e_s as analisis, rr.recomendaciones, rr.acciones,u.cedula

FROM usuarios u, empresas e , reporte_riesgos rr , det_condicion dc, condicion c, clasificacion cl
 WHERE u.id=rr.id_usuarios_de
         AND rr.id_empresas=e.id 
         AND rr.id=dc.id_reporte
         AND dc.id_condicion=c.id
         AND rr.id_clasificacion=cl.id
         AND rr.id=$id ";

  
//YEISON
$sql_adjuntos = "SELECT files FROM adjuntos_riesgos WHERE id_reporte = $id";
//YEISON

  $consulta_reporte = mysqli_query($conexion,$sql_riesgo);
  //echo mysqli_error($conexion);
  $consulta_reporte2 = mysqli_query($conexion,$sql_riesgo);
  $consulta_reporte3 = mysqli_query($conexion,$sql_riesgo);
 //YEISON
  $consulta_adjuntos = mysqli_query($conexion, $sql_adjuntos);
  $adjuntos = mysqli_fetch_assoc($consulta_adjuntos);
  $files = explode(",",$adjuntos['files']);
//YEISON
  $reporte = mysqli_fetch_assoc($consulta_reporte);

  $sql_clasificacion="SELECT * FROM `clasificacion` WHERE id='".$reporte['clasificacion']."'";
  $consulta_clasificacion = mysqli_query($conexion, $sql_clasificacion);

  $tipo="";
  $coma="";
  $cont=0;

  //while para cantidad de enventos ocurridos
 $reporte2 = mysqli_fetch_assoc($consulta_reporte2);
 

if ($reporte2['evidencia']== 0) { 
  $evidencia= "No existen envidencias fotograficas de los riesgos presentados";
}else{ 
    $evidencia = "<strong>Si existen envidencias fotograficas de los riesgos presentados</strong>";
    }

  $numero=$reporte['numero'];
  $imagen="../../".$reporte['foto'];

  $fecha_n=$reporte['fecha'];
  $obj =  date_create_from_format('Y-m-d', $fecha_n);
  $fecha = date_format($obj, "d-m-Y");


  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>REPORTE DE RIESGOS </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" >
    <style type="text/css">
        
body {
 
  background: #525659; 

}

.pagina{
    background: #ffffff; 
}
.panel{
   
    border: 0;
    border: 1px solid #bebebe;
  
}
        
        .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}

@media print{
    .oculto-impresion, .oculto-impresion *{
      display: none !important;
    }

    .pull-right {
    float: right !important;
  }
   .pull-center {
    float: center !important;
  }
}

div.margen{
        
        border: 3px solid #ececec;
        border-top-width: 3px;
        border-bottom-width: 3px;
        padding-top: 10px ;
        padding-right: 10px ;
        padding-bottom:0px ;
        padding-left: 10px;  
       
    }
.lista{
margin: 0;
padding: 10px 10px 10px 30px;
display: inline-block;
background-repeat: no-repeat;
background-size: 30px;
}

@page { size: auto;  margin: 4mm; }

    </style>
</head>
<body>

<div class="container pagina col-lg-8 col-md-offset-2">
    <div class="row">
    <div class="col-lg-2 col-lg-push-10 col-md-2 col-md-push-0 col-sm-2 col-sm-push-0 col-xs-2 col-xs-push-0">
         <!-- <div class="pull-right"><button class="btn btn-danger oculto-impresion" onclick="window.print()"> <span class="glyphicon glyphicon-print"></span>  IMPRIMIR</button></div> -->
       </div>
        <div class="col-xs-12">
           
              <div class="invoice-title">
                <img style="width: 100px;text-align: right;position: absolute;" src="<?=$imagen?>">
              <center><h3>REPORTE DE RIESGOS</h3></center>
              <center><h4>"<?=$reporte['empresa']?> <?=$reporte['detalle']?>"</h4></center>
                
              </div>
            
           <h4 style="text-align: center;"><small>Departamento de Investigación, Prevención y Control de Pérdidas Patrimoniales</small></h4>
            <hr>
            <div class="row">
                <div class="col-xs-4">
                    <address>
                   
                                 
                    <strong><span style="color: red">Fecha de Emision:</span> <?=$fecha?></strong><br>
                     <h5> <strong> Entidad: <?=$reporte['empresa']?> </strong></h5>            
                    </address>
                </div>
                <div class="col-xs-4 text-left">
                    <address>
                    
                    
                     <br>
                   
                    </address>
                </div>
                <div class="col-xs-4 text-right">
                    <address>
                   
                    <strong>Nro de control: 0000<?=$reporte['numero']?></strong><br>
                   <br>
                       
                    </address>
                </div>
            </div>
            
        </div>
    </div>
    
    <div class="row">
      <div class="col-md-12">



        <div class="panel panel-default">
                <div class="panel-heading">
                    <h5 class="panel-title"><strong><?=$reporte['empresa']?></strong></h5>
                </div>





            <div class="panel-body">
                       
              <h5><strong> DETALLES DE LOS RIEGOS PRESENTADOS :</strong></h5>
              <div class="margen">

              <table class="table table-bordered">
                <tr>
              <?php while ($reporte3 = mysqli_fetch_assoc($consulta_reporte3) ) { ?>

                  <td>
                    <h5 style="text-align: center;">
                      <u> <?=$reporte3['tipo']?>  </u>
                    </h5>
                  </td>
                 
              <?php } ?>
                </tr>
              </table>
                    <ul>
                      <li>
                        <?=$evidencia?>
                      </li>
                    </ul>
              </div>
              <h5><strong> EVALUACIÓN Y CLASIFICACIÓN DEL RIESGO :</strong></h5>
              <?php while ($clasificacion = mysqli_fetch_assoc($consulta_clasificacion) ) {  ?>
                     
                <div class="margen">
                     <p style="text-align: center">
                      <strong><?=$clasificacion['nombre']?></strong>
                    </p>
                </div>

                

              <?php } ?>
              <h5><strong>ANALISIS DE LA EVALUACION DEL RIEGO : </strong></h5>
              <div class="margen">
                <p><?=nl2br($reporte['analisis'])?></p>
              </div>
             

              <h5><strong>RECOMENDACIONES: </strong></h5>
              <div class="margen">
                <p><?=nl2br($reporte['recomendaciones'])?></p>
                
              </div>

              <h5><strong>ACCIONES EJECUTADAS : </strong></h5>
              <div class="margen">
                <p><?=nl2br($reporte['acciones'])?></p>
              </div><br>

              <!-- YEISON -->
              <h5><strong>ARCHIVOS ADJUNTOS : </strong></h5>
              <div class="margen">
                <ul style="list-style: none;">
                  <?php
                    foreach ($files as $file) {
                      $extension = explode(".",$file);
                      if($extension[1]==='png' || $extension[1]==='jpg' || $extension[1]==='jpeg'):
                  ?>
                    <li class="lista" style="background-image: url('../../../img/icono_img.png');">
                      <span><?=$file?></span>
                    </li>
                  <?php
                    elseif($extension[1]==='docx' || $extension[1]==='doc' || $extension[1]==='xls' || $extension[1]==='xlsx' || $extension[1]==='pptx' || $extension[1] ==='ppt' || $extension[1]==='pdf' || $extension[1]==='txt'):
                  ?>
                      <li class="lista" style="background-image: url('../../../img/archivo.png');">
                      <span><?=$file?></span>
                    </li>
                  <?php
                    elseif($extension[1] === 'mp4' || $extension[1] === 'mkv' || $extension[1] === 'avi' || $extension[1] === 'mov'):
                  ?>
                    <li class="lista" style="background-image: url('../../img/../camara-de-video.png');">
                      <span><?=$file?></span>
                    </li>
                  <?php
                    endif;
                    } //cierre for
                  ?>
                </ul>
              </div>
              <!-- YEISON -->


               <div>
               <table class="table table-bordered">
                <tr>
                  <td><u><h4>Reportado por</h4></u>
                    <h5> Nombre y Apellido : <?=$reporte['usuario']?> </h5>
                    <h5> Cargo : <?=$reporte['cargo']?> </h5>
                    <h5> C.I : <?=$reporte['cedula']?></h5><br>
                    <h5> Firma : ____________________ </h5>
                  </td>
               
                  <td><u><h4>Recibido por</h4></u>
                    <h5> Nombre y Apellido : <?=$reporte['para']?></h5>
                    <h5> Cargo : <?=$reporte['cargop']?></h5>
                    <h5> C.I : </h5><br>
                    <h5> Firma : ____________________ </h5>
                  </td>
                </tr>
              </table>
            </div>

          </div>
              <h4 style="text-align: center;"><small>Departamento de Investigación, Prevención y Control de Pérdidas Patrimoniales</small></h4>
      

        </div>  
      </div>
    </div>
</div>
<script src="../../js/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
