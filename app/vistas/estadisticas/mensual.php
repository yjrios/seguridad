

<div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
        	<img class="imgt" style="width: 300px; display: none;" src="../img/logoreporte.png">
			 <center><h3>Reporte mensual de Asistencia de Vigilantes</h3></center><hr class="oculto-impresion">
				 
         <form class="" name="formulario_asistencia" id="formulario_asistencia">
        	  <div class="row d-flex justify-content-center">
            
      			<div class="col-lg-4 oculto-impresion">
                 <h6 class="oculto-impresion">Seleccione Mes</h6>
                  <select class="form-control form-control-sm" id="mesa" name="mesa">
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
                  <h6 class="oculto-impresion">Año</h6>
                  <select class="form-control form-control-sm oculto-impresion"  id="ano" name="ano">
                	 <option value="<?= date('Y') ?>"> <?= date('Y') ?> </option>
                  </select>
                </div><br>
  
            </div>
        </form>
        
        <div id="reporte" class="reporte">
       
		</div><!-- sl-pagebody -->

    </div>
</div>

<script src="../js/estadisticas/mensual.js"></script> 
