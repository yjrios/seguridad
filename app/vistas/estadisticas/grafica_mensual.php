<?php 
     require_once '../../../config/conexion.php'; 
     require_once '../../includes/funciones.php';
     require_once '../../consultas/estadisticas/mensual.php';

     setlocale(LC_TIME,"es_ES.UTF-8");$messtring=date('%B');//sin importancia
     $mes = $_POST['mesa'];//
     $mes_actual=date('m');
     $ano=  $_POST['ano'];//$ano=date('Y')
     $sede=3;
     $cantidades= array();
     $empresas1=conseguirEmpresas($conexion,$sede);


    if (!empty($empresas1)) {
      while ($empresa = mysqli_fetch_assoc($empresas1) ) {
               $acumulador=0;$contador=0;$inasistencias=0;$matricula=0;;
               $asistencias=empresaestadistica($conexion,$empresa['id'],$mes,$ano);
              if (!empty($asistencias)) {
                while ($asistencia = mysqli_fetch_assoc($asistencias) ) {
                    $acumulador+=$asistencia['asistencia'];
                    $matricula=$asistencia['matricula'];
                    $contador++;
                    if ($mes == $mes_actual ) {
                      if ($asistencia['fecha'] <= date('Y-m-d') ) {
                          $inasistencias+=($asistencia['matricula']-$asistencia['asistencia']);
                      }
                    }else{
                       $inasistencias+=($asistencia['matricula']-$asistencia['asistencia']);
                    }   
                }
              }
                    
        $cantidades['asistencias'][]=$acumulador;
        $cantidades['inasistencias'][]=$inasistencias;
        $cantidades['esperado'][]=($matricula*$contador);
      }
    } 
?>

<script src="../js/highcharts/data.js"></script>
<script src="../js/highcharts/export-data.js"></script>

<script src="../js/highcharts/highcharts.js"></script>
<script src="../js/highcharts/exporting.js"></script>

<script src="../js/highcharts/data.js"></script>

   

    <div id="container" style="width: 1000px;min-width: 310px; height: 400px; margin: 0 auto;">
    </div>

<div class="d-flex justify-content-around">
 <table id="datatable">
    <thead>
        <tr>
            <th></th>
            <th>Asistencias<span style="visibility: hidden;">&nbsp;&nbsp;</span></th>
            <th>Inasistencias<span style="visibility: hidden;">&nbsp;&nbsp;</span></th>
            <th>Esperada en el Mes<span style="visibility: hidden;">&nbsp;</span></th>
        </tr>
    </thead>
    <tbody>

    <?php
    $sede = 3;
    $empresas=conseguirEmpresas($conexion,$sede);
    //crear_asistencia($conexion);  
    if (!empty($empresas)) {
      $contador2=0;
      while ($empresa = mysqli_fetch_assoc($empresas) ) {
    ?>    
        <tr>
            <td class="empresat"><?=$empresa['nombre']?><?=$empresa['detalle']?></td>
            <th class="datot" style="color: #2789e5;"><?=$cantidades['asistencias'][$contador2]?></td>
            <th class="datot" style="color: #0d233a;"><?=$cantidades['inasistencias'][$contador2]?></td>
            <th class="datot" style="color: #21b700;"><?=$cantidades['esperado'][$contador2]?></td>
        </tr>
    
    <?php 
      $contador2++;
      }
    }
    ?>

    </tbody>
  </table></div>
 
 <div class="pull-right" style="position: relative;">
  <button class="btn btn-success oculto-impresion" onclick="window.print()"><span class="glyphicon glyphicon-print"></span> IMPRIMIR</button>
  </div>

<script type="text/javascript">
  Highcharts.setOptions({
    colors: ['#7cb5ec', '#0d233a', '#90ed7d', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
  });
  Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
             
        credits: {
             enabled: false
        },
        chart: {
            type: 'column'
        },
        title: {
            text: 'Evaluacion de asistencia del mes de '+$('#mesa option:selected').text()+''
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Asistencias'
            }
        },
        /*xAxis: {
          type: 'category',
          labels: {
              rotation: -45,
              style: {
                  fontSize: '13px',
                  fontFamily: 'Verdana, sans-serif'
              }
          }
        },*/ // para formatear nombres de la grafica
        /*plotOptions: {
          series: {
              dataLabels: {
                  enabled: true,
                  color: '#FFFFFF',
                  y: 10, // 10 pixels down from the top
                  style: {
                    fontSize: '5px',
                    fontFamily: 'Verdana, sans-serif'
                  }
              }
          }
        },*/ // para mostrar valor en el cilindro de la grafica
        tooltip: {
            formatter: function () {

                if (this.series.color == "#0d233a") {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' Inasistencias de ' + this.point.name;
                }
                if (this.series.color == "#7cb5ec") {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' Asistencias de ' + this.point.name;
                }
                if (this.series.color == "#90ed7d") {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' Programada para ' + this.point.name;
                }
            }
        },

    });    

</script>