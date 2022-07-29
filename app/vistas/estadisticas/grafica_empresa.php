<?php 
     require_once '../../../config/conexion.php'; 
     require_once '../../includes/funciones.php';
     require_once '../../consultas/estadisticas/por_empresa.php';

     setlocale(LC_TIME,"es_ES.UTF-8");$messtring=date('%B');//sin importancia
     $mes = $_POST['mesa2'];//
     $mes_actual=date('m');
     $ano =  $_POST['ano'];//$ano=date('Y')
     $emp = $_POST['emp'];
     $sede=3;
     $por_dia=0;
     $cantidades= array();
               $acumulador=0;$contador=0;$inasistencias=0;$matricula=0;;
               $asistencias=empresaestadistica($conexion,$emp,$mes,$ano);
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
                $por_dia=$asistencia['matricula'];   
                }
              }
                    
        $cantidades['asistencias'][]=$acumulador;
        $cantidades['inasistencias'][]=$inasistencias;
        $cantidades['esperado'][]=($matricula*$contador);
      
    
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
            <th>Diarias<span style="visibility: hidden;">&nbsp;&nbsp;</span></th>
            <th>Asistencias<span style="visibility: hidden;">&nbsp;&nbsp;</span></th>
            <th>Inasistencias<span style="visibility: hidden;">&nbsp;&nbsp;</span></th>
            <th>Esperada en el Mes<span style="visibility: hidden;">&nbsp;</span></th>
        </tr>
    </thead>
    <tbody>

    <?php
    $empresas=empresa($conexion,$emp);
    $empresa=mysqli_fetch_assoc($empresas);
    $contador2=0;
    ?>    
        <tr>
            <th class="empresat"><?=$empresa['nombre']?> (<?=$empresa['detalle']?>)</th>
            <th class="datot" style="color: #969696;"><?=$por_dia?></th>
            <th class="datot" style="color: #2789e5;"><?=$cantidades['asistencias'][$contador2]?></th>
            <th class="datot" style="color: #0d233a;"><?=$cantidades['inasistencias'][$contador2]?></th>
            <th class="datot" style="color: #21b700;"><?=$cantidades['esperado'][$contador2]?></th>
        </tr>
    <?php 
    $contador2++;
    ?>

    </tbody>
  </table></div>
 
 <div class="pull-right" style="position: relative;">
  <button class="btn btn-success oculto-impresion" onclick="window.print()"><span class="glyphicon glyphicon-print"></span> IMPRIMIR</button>
  </div>

<script type="text/javascript">
Highcharts.setOptions({
    colors: ['#969696', '#7cb5ec', '#0d233a', '#90ed7d', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4']
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
            text: 'Evaluacion de asistencia del mes de '+$('#mesa2 option:selected').text()+' por '+$('#emp option:selected').text()
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
        plotOptions: {
          series: {
              dataLabels: {
                  enabled: true,
                  color: '#000000',//FFFFFF
                 // y: 10, // 10 pixels down from the top
                  style: {
                    fontSize: '15px',
                    fontFamily: 'Arial, sans-serif'
                  }
              }
          }
        }, // para mostrar valor de la grafica

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
                if (this.series.color == "#969696") {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' Asistencias a cumplir por día (Diurno + Nocturno)';
                }
            }
        },
    });    

</script>