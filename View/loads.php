<?php include_once("admin_auth.php"); include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("header_references.php");?>
    <style>

    </style>
    <script>
      $(document).ready(function(){
        $(":file").filestyle({
          placeholder: "Selecciona un archivo de Excel",
          htmlIcon: '<span class="fas fa-file-excel"></span>',
          text: " Buscar...",
          btnClass: "btn-secondary"
        });

        $('form[name$="load_excel_form"]').on('submit', function(event){
          event.preventDefault();

          const data = new FormData(this);
          const element = $('button[name$="'+data.get('id')+'"]')
      
          element.prop("disabled", true);
          // add spinner to button
          element.html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...`
          );
      
          $.ajax({
            url:"api/upload.php",
            method:"POST",
            data:data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
              element.prop("disabled", false);
              // add spinner to button
              element.html(
                `Actualizar`
              );
              // $('#excel_area').html(data);
              // $('table').css('width','100%');
            }
          })
        });
      });
    </script>
  </head>

  <body id="bootstrap_overrides">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <?php include("admin_navigator.php"); ?>
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

      <!-- <div class="row">
        <div class="offset-sm-1 col-sm-10">
          <div class="table-responsive">
            <span id="message"></span>
            <form method="post" id="load_excel_form" enctype="multipart/form-data">
              <table class="table">
                <tr>
                  <td width="50%"><input type="file" /></td>
                  <td width="25%" align="right"></td>
                  <td width="25%">
                    <button type="submit" name="load" class="btn btn-primary">
                      Cargar
                    </button>
                  </td>
                </tr>
              </table>
            </form>
          </div>
        </div>
        <div class="offset-sm-1 col-sm-10">
          <div id="excel_area"></div>
        </div>
      </div> -->
  
      <div class="row">
        <div class="offset-sm-1 col-sm-10">
          <?php $updateData = getDetailUpdateData($linkDB); ?>
          <table class="table">
            <thead class="thead-dark">
              <tr class="section-title text-center">
                <th scope="col">#</th>
                <th scope="col">Módulo</th>
                <!-- <th scope="col">Detalle</th> -->
                <th scope="col">Estado</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < sizeof($updateData); $i++) { ?>
                <tr>
                <form method="post" name="load_excel_form" enctype="multipart/form-data">
                  <th scope="row" class="text-center"><?php echo $i+1; ?></th>
                  <td>
                    <?php echo utf8_encode($updateData[$i]["section_name"]); ?>
                    <input type="file" name="select_excel" required />
                    <input type="hidden" name="id" value="<?php echo $i; ?>">
                  </td>
                  <!-- <td>
                    <ul class="lista-detalle">
                      <li>Registros actualizados: <label><?php echo $updateData[$i]["found_number"]; ?></label> </li>
                      <li>Registros totales: <label><?php echo $updateData[$i]["fail_number"]; ?></label> </li>
                      <li>Registros no hallados: <label><?php echo $updateData[$i]["success_number"]; ?></label> </li>
                    </ul>
                  </td> -->
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
                      <!-- <button class="btn btn-success update_js" data-id="<?php echo($updateData[$i]["id_data"]); ?>">
                        Actualizar
                      </button> -->
                      <button type="submit" name="<?php echo $i; ?>" class="btn btn-success">
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
                </form>
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
  </body>
</html>
