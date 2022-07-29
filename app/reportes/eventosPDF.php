<?php  require_once ('../../config/conexion.php');
    
$id=$_GET['id'];
$sql_evento="SELECT re.id AS id, u.nombre AS usuario, u.cargo, e.nombre AS empresa,e.detalle as detalles, re.fecha_apertura as fecha, ev.nombre as evento, re.id as numero, e.foto AS foto, re.evidencia, de.det_evento as detalle, re.nom_dirigido as para, re.cargo_dirigido as cargop , u.cedula , re.det_actuacion_o as actuacion, re.acciones_tomadas, re.recomendaciones
      FROM empresas e ,reporte_eventos re , det_eventos de , evento ev , det_actuacion da , actuacion a , usuarios u
          where re.id_empresas=e.id 
          AND de.id_reporte=re.id
          AND de.id_evento=ev.id
          AND da.id_reporte=re.id
          AND da.id_actuacion=a.id
          AND u.id=re.id_usuarios_de
          AND re.id=$id
          GROUP BY ev.nombre";

  $sql_organismo="SELECT  a.nombre as organismo
          FROM empresas e ,reporte_eventos re , det_actuacion da , actuacion a 
          where re.id_empresas=e.id 
          AND da.id_reporte=re.id
          AND da.id_actuacion=a.id
          AND re.id=$id";
  
  
  $consulta_reporte = mysqli_query($conexion,$sql_evento);
  $consulta_reporte2 = mysqli_query($conexion,$sql_evento);
  $consulta_reporte3 = mysqli_query($conexion,$sql_evento);
  $consulta_organismo = mysqli_query($conexion, $sql_organismo);

  $eventos="";
  $fechahoy = date('d-m-Y');
  $coma="";
  $cont=0;



  $reporte = mysqli_fetch_assoc($consulta_reporte) ;

  //acompañado o no 
  if ($reporte['evidencia'] == 1) {
    $evidencia = "No hay evidencias fotograficas ";
  }else{
    $evidencia = "<strong>Si existen envidencias fotograficas del Suceso </strong>";
  }

  $numero=$reporte['numero'];
  $imagen="../".$reporte['foto'];

  $fecha_n=$reporte['fecha'];
  $obj =  date_create_from_format('Y-m-d', $fecha_n);
  $fecha = date_format($obj, "d-m-Y");


  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>REPORTE EVENTOS </title>
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
.firma{
  LINE-HEIGHT:10px;
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
@page { margin: 0;
     size: auto; }
}

@page { size: auto;  margin: 4mm; }

div.margen{
        
        border: 3px solid #ececec;
        border-top-width: 3px;
        border-bottom-width: 3px;
        padding-top: 10px ;
        padding-right: 10px ;
        padding-bottom:0px ;
        padding-left: 10px;  
       
    }

    </style>
</head>
<body>

<div class="container pagina col-lg-8 col-md-offset-2">
    <div class="row">
    <div class="col-lg-2 col-lg-push-10 col-md-2 col-md-push-0 col-sm-2 col-sm-push-0 col-xs-2 col-xs-push-0">
         <div class="pull-right"><button class="btn btn-danger oculto-impresion" onclick="window.print()"> <span class="glyphicon glyphicon-print"></span>  IMPRIMIR</button></div>
       </div>
        <div class="col-xs-12">
           
              <div class="invoice-title">
                <img style="width: 100px;text-align: right;position: absolute;" src="<?=$imagen?>">
              <center><h3>REPORTE EVENTOS</h3></center>
              <center><h4>"<?=$reporte['empresa']?> <?=$reporte['detalles']?>"</h4></center>
                
              </div>
            
            <h5 style="text-align: center;">Departamento de Investigación, Prevención y Control de Pérdidas Patrimoniales</h5>
            <hr>
            <div class="row">
                <div class="col-xs-4">
                    <address>
                   
                                 
                    <strong>Fecha de Emision: <?=$fecha?></strong><br>
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
                  
              <h5><strong> DETALLES DE LOS EVENTOS OCURRIDOS :</strong></h5>

               <table class="table table-bordered">
                <tr>
                  <?php while ($reporte2 = mysqli_fetch_assoc($consulta_reporte2) ) {  ?>
                    <td>
                      <h5 style="text-align: center;">
                        <u> <?=$reporte2['evento']?>  </u>
                      </h5>
                    </td>
                  <?php } ?>
                </tr>
              </table>

              <?php while ($reporte3 = mysqli_fetch_assoc($consulta_reporte3) ) {  ?>

                  <div class="margen">
                    <h5>
                      <u> <?=$reporte3['evento']?> : </u>
                    </h5>

                    <p> <?=$reporte3['detalle']?> </p>
                 </div>
              <?php } ?>

               <h5><strong>EVIDENCIAS FOTOGRAFICAS : </strong></h5>
                <div class="margen">
                    <ul>
                      <li>
                        <?=$evidencia?>
                      </li>
                    </ul>
                 </div>

              <h5><strong> ACTUACIÓN DE ORGANISMOS DEL ESTADO U OTROS :</strong></h5>

               <div class="margen">
                <h5>
                  <?php while ($organismo = mysqli_fetch_assoc($consulta_organismo) ) {  ?>
                         
                          <u><?=$organismo['organismo']?></u><br>
                      
                  <?php } ?>
                    </h5>
                  <p><?= nl2br($reporte['actuacion'])?></p>
               </div>
                <h5><strong>ACCIONES CORRECTIVAS: </strong></h5>
                <div class="margen">
                    <p>
                       <?=nl2br($reporte['acciones_tomadas'])?>
                     </p>
                 </div>

                <h5><strong>RECOMENDACIONES : </strong></h5>
                <div class="margen">
                    <p>
                       <?=nl2br($reporte['recomendaciones'])?>
                     </p>
                 </div>

          <div>
               <table class="table table-bordered">
                <tr>
                  <td><u><h4>Reportado por</h4></u>
                    <h6 class="firma"> Nombre y Apellido : <?=$reporte['usuario']?> </h6>
                    <h6 class="firma"> Cargo : <?=$reporte['cargo']?> </h6>
                    <h6 class="firma"> C.I : <?=$reporte['cedula']?></h6><br>
                    <h6 class="firma"> Firma : ____________________ </h6>
                  </td>
               
                  <td><u><h4>Visto Bueno</h4></u>
                    <h6 class="firma"> Nombre y Apellido : <?=$reporte['para']?></h6>
                    <h6 class="firma"> Cargo : <?=$reporte['cargop']?></h6> 
                    <h6 class="firma"> C.I : </h6><br>
                    <h6 class="firma"> Firma : ____________________ </h6>
                  </td>
                  <td><u><h4>Responsable de la Unidad</h4></u>
                    <h6 class="firma"> Nombre y Apellido : </h6>
                    <h6 class="firma"> Cargo : </h6> 
                    <h6 class="firma"> C.I : </h6><br>
                    <h6 class="firma"> Firma : ____________________ </h6>
                  </td>
                  <td><u><h4>Dpto. de Costo e Inventario</h4></u>
                    <h6 class="firma"> Nombre y Apellido : </h6>
                    <h6 class="firma"> Cargo : </h6> 
                    <h6 class="firma"> C.I : </h6><br>
                    <h6 class="firma"> Firma : ____________________ </h6>
                  </td>
                </tr>              </table>
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
