<?php include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

  <head>
  <?php  include("View/header_references_auth.php");

    if ($_SESSION['id_role'] > 3) {
      header('Location: error.php');
      exit();
    }
  ?>
  </head>
<style>
  .rdy {
    background-color: #009688 !important;
  }
  .enP {
    background-color: #FF5722 !important;
  }
  .html {
    background-color: #00BCD4 !important;
  }
</style>
<body id="bootstrap_overrides">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <?php include("View/navigator.php"); ?>
  <div class="container-fluid">

    <div class="row custom-vertical-padding">
      <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
        <form action="register_patient.php" method="POST">
          <button class="btn my-2 my-sm-0 custom-btn-identify" type="submit">
            <span>
              <i class="fas fa-user-friends custom-identify-icon icon-behind"></i>
              <h4 class="text-white bold-font text-forward">CARGA MANUAL DE DATOS</h4>
            </span>
          </button>
        </form>
      </div>
    </div>

    <div class="row">
    	<div class="offset-1 col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
    		<?php $updateData = getDetailUpdateData($linkDB); ?>
    		<table class="table tabla-general">
    			<thead class="thead-dark">
    				<tr class="section-title text-center">
    					<th scope="col">#</th>
    					<th scope="col">Módulo</th>
    					<th scope="col">Detalle</th>
    					<th scope="col">Estado</th>
    					<th scope="col"></th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php for ($i=0; $i < sizeof($updateData); $i++) { ?>
    					<tr>
	    					<th scope="row" class="text-center"><?php echo $i+1; ?></th>
	    					<td><?php echo utf8_encode($updateData[$i]["section_name"]); ?></td>
	    					<td>
	    						<ul class="lista-detalle">
	    							<li>Registros actualizados: <label><?php echo $updateData[$i]["found_number"]; ?></label> </li>
	    							<li>Registros totales: <label><?php echo $updateData[$i]["fail_number"]; ?></label> </li>
	    							<li>Registros no hallados: <label><?php echo $updateData[$i]["success_number"]; ?></label> </li>
	    						</ul>
	    					</td>
	    					<td class="text-center estado-label">
	    						<?php

	    						switch ($updateData[$i]["last_update"]) {
	    							case '1':
	    								$status_class = "estado-actualizado";
	    								$label_class = "Actualizado";
	    								break;

	    							default:
	    								$status_class = "estado-no-actualizado";
	    								$label_class = "Por actualizar";
	    								break;
	    						}
	    						?>
	    						<label class="estado-actualizacion <?php echo($status_class); ?>"><?php echo $label_class; ?></label>
	    						<label class="date-style"><?php echo $updateData[$i]["last_update"]; ?></label>
	    					</td>
	    					<td class="text-center function-block">
	    						<div class="etapas etapa_00">
	    							<button class="btn btn-success update_js" data-id="<?php echo($updateData[$i]["id_data"]); ?>">
		    							Actualizar
		    						</button>
	    						</div>
	    						<div class="etapas etapa_01">
	    							<label id="typed<?php echo($updateData[$i]["id_data"]); ?>">Cargando datos del archivo</label>
	    						</div>
	    						<div class="etapas etapa_02">
	    							<label id="sumary<?php echo($updateData[$i]["id_data"]); ?>"></label>
	    						</div>
	    						<div class="etapas etapa_03">
    								<label id="load<?php echo($updateData[$i]["id_data"]); ?>"></label>
    							</div>
    							<div class="etapas etapa_04">
    								<label id="update<?php echo($updateData[$i]["id_data"]); ?>"></label>
    							</div>

	    					</td>
	    				</tr>
    				<?php } ?>
    				<tr>
    					<td>
    						<!--label id="typed2">Cargando datos del archivo</label><label class="puntos_suspensivos">.</label-->
    					</td>
    				</tr>
    			</tbody>
    		</table>
    	</div>
    </div>
  </div>
  <script>

	let reference = "#typed1";
  		var typed2 = new Typed(reference, {
		    strings: ['Analizando documento...'],
		    typeSpeed: 40,
		    backSpeed: 0,
		    fadeOut: true,
		    loop: true
		  });
  	let filas = 1342;
  	let encontrados = 131;
	let reference_2 = "#sumary1";
  		var typed3 = new Typed(reference_2, {
		strings: ['<strong>Análisis Finalizado</strong>\n `Registros identificados: 1121` \n `` \n `` \n `` \n'],
    typeSpeed: 40,
    backSpeed: 0,
    loop: false,
    onComplete: function(self) {
    		//alert();
    		self.showCursor = false;
    		console.log(self);
    		console.log(self.options);
    		},
		  });


	let reference_3 = "#load1";
  		var typed4 = new Typed(reference_3, {
		strings: ['Iniciando proceso de carga...'],
    typeSpeed: 40,
    backSpeed: 0,
    loop: false,
    onComplete: function(self) {
    		//alert();
    		self.showCursor = false;
    		console.log(self);
    		console.log(self.options);
    		},
		  });


  	$(".update_js").on("click", function() {
  		let itemIndex = $(this).attr("data-id");
  		console.log("Click en boton de " + itemIndex);
  		let reference = "#typed"+itemIndex;
  		var typed2 = new Typed(reference, {
		    strings: ['Analizando documento...'],
		    typeSpeed: 40,
		    backSpeed: 0,
		    fadeOut: true,
		    loop: true
		  });

  		var ajax_url = "ManualLoader/source.php";
  		var post_data= {};

		post_data['action']  = 'prueba';

  		$.post(
			ajax_url,
			post_data,
			function(response){
				console.log(response);
			});
  		//Etapa 01 - Carga del archivo.
  		//Etapa 02 - Despliegue del total de elementos cargados.
  		//Etapa 03 - Actualización de registro a registro.
  		//Etapa 04 - Reporte del resultado de la actualización + volver a actualizar.

  	});
  </script>
</body>

</html>