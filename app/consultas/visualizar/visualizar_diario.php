<?php  require_once ('../../../config/conexion.php');
require_once('../reportes/logger.php');
define('DS', DIRECTORY_SEPARATOR);
$id=$_GET['id'];

error_log(__LINE__ . ' visualizar diario');
$sql_diario="SELECT rd.id AS numero, u.nombre AS usuario, u.cargo , e.nombre AS empresa,e.detalle, rd.fecha_apertura as fecha, s.nombre as suceso, rd.acompanado acom , e.foto, rd.descripcion , rd.nom_dirigido as para, rd.cargo_dirigido as cargop, u.cedula
         FROM usuarios u, empresas e , reporte_diario rd , det_suceso ds, seceso s 
         WHERE u.id=rd.id_usuarios_de 
         AND rd.id_empresas=e.id 
         AND rd.id=ds.id_reporte 
         AND ds.id_suceso=s.id 
         AND rd.id = $id";
//YEISON
$sql_adjuntos = "SELECT * FROM adjuntos_diarios WHERE id_reporte = $id";
//YEISON 

  $consulta_reporte = mysqli_query($conexion,$sql_diario);
   
   //PARA VER EL ERROR DE UNA CONSULTA echo mysqli_error($conexion);

  $consulta_reporte2 = mysqli_query($conexion,$sql_diario);
  $consulta_reporte3 = mysqli_query($conexion,$sql_diario);

  //YEISON
  $consulta_adjuntos = mysqli_query($conexion, $sql_adjuntos);
  $adjuntos = mysqli_fetch_array($consulta_adjuntos);
  $router = $adjuntos['ruta'];
  $files = Array();
  if (substr_count($adjuntos['files'], ',', 0, strlen($adjuntos['files'])) !== 0) {
   $files = explode(",",$adjuntos['files']);
  } else {
    array_push($files, $adjuntos['files']);
  }
  //YEISON

  $reporte = mysqli_fetch_assoc($consulta_reporte) ;

  //acompañado o no 
  if ($reporte['acom'] == "" ) {
    $evidencia = "<strong> NO ESTUVO ACOMPAÑADO </strong>";
  }else{
    $evidencia = "<strong> ESTUVO ACOMPAÑADO POR : </strong> ".$reporte['acom'];
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
    <title>REPORTE DE ACTIVIDAD </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
div.litarchivos {
  border: 3px solid #ececec;
  border-top-width: 3px;
  border-bottom-width: 3px;
  padding-top: 10px ;
  padding-right: 10px ;
  padding-bottom:0px ;
  padding-left: 10px;
  margin-top: 100px;
}


.lista{
margin: 0;
padding: 10px 10px 10px 30px;
display: inline-block;
background-repeat: no-repeat;
background-size: 30px;
}

div.contenedor {
  float: left;
  align: center;
  display:inline-block;
  padding: 5px 10px 5px 10px;
  margin: 2px;
  width: 100%;
}

@page { size: auto;  margin: 4mm; }

    </style>
</head>
<body>

<div class="container pagina col-lg-8 col-md-offset-2">
    <div class="row">
    <div class="col-lg-2 col-lg-push-10 col-md-2 col-md-push-0 col-sm-2 col-sm-push-0 col-xs-2 col-xs-push-0">
         <!-- <div class="pull-right"><button class="btn btn-danger oculto-impresion" onclick="window.print()"> <span class="glyphicon glyphicon-print"></span> IMPRIMIR</button></div> -->
       </div>

        <div class="col-xs-12">
             <div class="invoice-title">
              <img style="width: 100px;position: absolute;" src="<?=$imagen?>">
              <center><h3>REPORTE DE ACTIVIDADES DIARIAS</h3></center>
              <center><h4>"<?=$reporte['empresa']?> <?=$reporte['detalle']?>"</h4></center>
              </div>
          
            <h4 style="text-align: center;"><small>Departamento de Investigación, Prevención y Control de Pérdidas Patrimoniales</small></h4>
            <hr>
            <div class="row">
                <div class="col-xs-4">
                    <address>
                   
                                 
                    <strong><span style="color: red">Fecha de Emision:</span> <?=$fecha?></strong><br>
                     <h5> <strong> Unidad de Producción: <?=$reporte['empresa']?> </strong></h5>            
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
              <table class="table table-bordered">
                <tr>
                  <?php while ($reporte2 = mysqli_fetch_assoc($consulta_reporte2) ) {  ?>
                    <td>
                      <h5 style="text-align: center;">
                        <u> <?=$reporte2['suceso']?>  </u>
                      </h5>
                    </td>
                  <?php } ?>
                </tr>
              </table>
                        
                    <hr>
                      <h5><?=$evidencia?></h5>
                    <hr>
              <h5><strong> DETALLES DE LAS ACTIVIDADES REALIZADAS :</strong></h5>
              <div class="margen">
             
                <p><?= nl2br($reporte['descripcion'])?> </p>
              </div>
              <br>
              <!-- YEISON -->
              <h5><strong>ARCHIVOS ADJUNTOS : </strong></h5>
                <!-- <div class="margen"> -->
                <div>
                  <div class="col-md-12">
                   <div class="carousel slide" id="theCarousel" data-ride="carousel">
                      <div class="carousel-inner">
                        <?php
                          error_log(__LINE__);
                          $setActive = 0;
                          $sliderHtml = '';
                          $doc = "";
                          foreach($files as $key => $item) {
                            $extension = explode(".", $item);
                            if($extension[1]==='png' || $extension[1]==='jpg' || $extension[1]==='jpeg') {
                              if(!$setActive) {
                                error_log(__LINE__ . 'SetActive');
                                $setActive = 1;
                                $imagenes = "<div class='carousel-item active contenedor'>";
                              } else {
                                $imagenes .= "<div class='carousel-item contenedor'>";
                              }
                              $imagen = 'http:'.DS.DS.'localhost'.DS.'Project'.DS.'sicong' . $adjuntos['ruta'] . $item;
                              $imagenes .= "<img src='$imagen' width='100%' height='30%'></div>";
                              error_log(__LINE__ . ' FOREACHE ' . $imagen);
                            
                            } elseif($extension[1]==='docx' || $extension[1]==='doc' || $extension[1]==='xls' || $extension[1]==='xlsx' || $extension[1]==='pptx' || $extension[1] ==='ppt' || $extension[1]==='pdf' || $extension[1]==='txt') { 
                              if ($extension[1]==='txt') {
                                $icono = 'http:'.DS.DS.'localhost'.DS.'Project'.DS.'sicong'.DS.'img'.DS.'DocTxt.png';
                              } elseif ($extension[1]==='docx' || $extension[1]==='doc') {
                                $icono = 'http:'.DS.DS.'localhost'.DS.'Project'.DS.'sicong'.DS.'img'.DS.'Word.png';
                              } elseif($extension[1]==='xls' || $extension[1]==='xlsx') {
                                $icono = 'http:'.DS.DS.'localhost'.DS.'Project'.DS.'sicong'.DS.'img'.DS.'Excel.png';
                              } elseif ($extension[1]==='xlsx' || $extension[1]==='pptx') {
                                $icono = 'http:'.DS.DS.'localhost'.DS.'Project'.DS.'sicong'.DS.'img'.DS.'PowerPoint.png';
                              } else {
                                $icono = 'http:' . DS . DS . 'localhost' . DS . 'Project' . DS . 'sicong' . DS . 'img' . DS . 'Iconopdf.png';
                              }
                              $file = 'http://localhost/Project/sicong' . $adjuntos['ruta'] . $item;
                              //$file = '..' . DS . '..' . DS . '..' . DS . $adjuntos['ruta'] . $item;
                              //$doc .= "<li class='lista'><button title='Display' onclick=window.open('$file',$item,'_blank')><span class='fa fa-eye'></span></button></li>";
                              $doc .= "<li class='lista'><a href='$file' target='_blank'><img src='$icono' widht='100%' height='50' title='$item'></img><h5>$item</h5></a></li>";
                            }
                          }
                          echo $imagenes;
                        ?>
                          <!-- //   $sliderHtml.= "</a></div></div>";
                          // } -->
                          <!-- <div class='col-xs-4'><a href='<?=$key;?>'></a></div> -->
                          <!-- </div> -->
                          <!-- echo $sliderHtml; -->
                        <!-- ?> -->
                        <!-- <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                        <a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a> -->
                      </div>
                      <a class="left carousel-control" href="#theCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                      <a class="right carousel-control" href="#theCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                      <!-- <a class="carousel-control-prev" href="#theCarousel" data-slide="prev" role="button">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                      </a>
                      <a class="carousel-control-next" href="#theCarousel" data-slide="next" role="button">
                        <i class="glyphicon glyphicon-chevron-right"></i>
                      </a> -->
                    </div>
                  </div>
                  <!-- </div> -->
                  <div>
                  <ul>
                    <?php
                      error_log(__LINE__ . ' FOREACHE II ' . gettype($doc));
                      echo $doc;

                      // foreach ($files as $item) {
                      //   error_log(__LINE__ . ' FOREACHE ' . $item);
                      //   echo $item;
                      // }
                    ?>
                  </ul>
                  </div>
                </div>
              <!-- YEISON -->
            <div >
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
        
            <hr>

            <h4 style="text-align: center;"><small>Departamento de Investigación, Prevención y Control de Pérdidas Patrimoniales</small></h4>

        </div>
           
            
        
      </div>
    </div>
</div>
<script src="../../../js/jquery-3.3.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="../../../js/slider.js"></script>
</body>
</html>