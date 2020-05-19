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
          htmlIcon: '<span class="fas fa-file"></span>',
          text: " Buscar...",
          btnClass: "btn-secondary"
        });

        $('form[name$="load_excel_form"]').on('submit', function(event){
          event.preventDefault();

          const data = new FormData(this);
          const element = $('button[name$="'+data.get('id_data')+'"]')
          const msg_div = $('#message_'+data.get('id_data'))
          const stat_div = $('#status_'+data.get('id_data'))
      
          element.prop("disabled", true);
          // add spinner to button
          element.html(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...`
          );

          msg_div.html(
            `<label class="text-info">Cargando datos del archivo.</label>`
          )
      
          $.ajax({
            url:"upload.php",
            method:"POST",
            data:data,
            contentType:false,
            cache:false,
            processData:false,
            timeout: 10000,
            success:function(resp){
              var data = JSON.parse(resp);
              element.prop("disabled", false);
              // add spinner to button
              if(data.success){
                msg_div.html(
                  '<label class="text-primary">' + data.message + '</label>'
                )
                stat_div.html(
                  '<label class="estado-actualizacion estado-actualizado">Actualizado</label><label class="date-style">Hace un momento</label>'
                )
              } else {
                msg_div.html(
                  '<label class="text-danger">' + data.message + '</label>'
                )
              }
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
                <i class="fas fa-cloud-upload-alt custom-identify-icon icon-behind"></i>
                <h4 class="text-white bold-font text-forward">CARGA MANUAL DE DATOS</h4>
              </span>
            </button>
          </form>
        </div>
      </div>

      <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-1 text-center">
        <span class="text-royal-blue bold-font custom-form-label-element">
          Carga de pacientes
        </span>
      </div>

      <div class="row">
        <div class="offset-sm-1 col-sm-10">
          <table class="table">
            <tbody>
                <tr>
                <form method="post" name="load_excel_form" enctype="multipart/form-data">
                  <th scope="row" class="text-center" width="10%"></th>
                  <td width="40%">
                    <input type="file" name="select_excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required />
                    <input type="hidden" name="id_data" value="0">
                  </td>
                  <td class="text-center estado-label" width="20%">
                    <div id="status_0">
                      <!-- <label class="estado-actualizacion <?php echo($status_class); ?>">Por actualizar</label>
                      <label class="date-style"><?php echo $update["last_update"]; ?></label> -->
                    </div>
                  </td>
                  <td class="text-center function-block" width="30%">
                    <div class="etapas etapa_00">
                      <!-- <button class="btn btn-success update_js" data-id="<?php echo($updateData[$i]["id_data"]); ?>">
                        Actualizar
                      </button> -->
                      <button type="submit" name="0" class="btn btn-success">
                        Actualizar
                      </button>
                    </div>
                    <div id="message_0" class="etapas"></div>
                  </td>
                </form>
                </tr>
            </tbody>
          </table>
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
              <?php foreach ($updateData as $key=>$update) { ?>
                <tr>
                <form method="post" name="load_excel_form" enctype="multipart/form-data">
                  <th scope="row" class="text-center" width="10%"><?php echo $update['id_data']; ?></th>
                  <td width="40%">
                    <input type="file" name="select_excel" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required />
                    <input type="hidden" name="id_data" value="<?php echo $update['id_data']; ?>">
                    <label class="text-secondary"><?php echo utf8_encode($update['section_name']); ?></label>
                  </td>
                  <!-- <td>
                    <ul class="lista-detalle">
                      <li>Registros actualizados: <label><?php echo $updateData[$i]["found_number"]; ?></label> </li>
                      <li>Registros totales: <label><?php echo $updateData[$i]["fail_number"]; ?></label> </li>
                      <li>Registros no hallados: <label><?php echo $updateData[$i]["success_number"]; ?></label> </li>
                    </ul>
                  </td> -->
                  <td class="text-center estado-label" width="20%">
                    <?php
                      switch ($update["status"]) {
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
                    <div id="status_<?php echo $update['id_data']; ?>">
                      <label class="estado-actualizacion <?php echo($status_class); ?>"><?php echo $label_class; ?></label>
                      <label class="date-style"><?php echo $update["last_update"]; ?></label>
                    </div>
                  </td>
                  <td class="text-center function-block" width="30%">
                    <div class="etapas etapa_00">
                      <!-- <button class="btn btn-success update_js" data-id="<?php echo($updateData[$i]["id_data"]); ?>">
                        Actualizar
                      </button> -->
                      <button type="submit" name="<?php echo $update['id_data']; ?>" class="btn btn-success">
                        Actualizar
                      </button>
                    </div>
                    <div id="message_<?php echo $update['id_data']; ?>" class="etapas"></div>
                  </td>
                </form>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </body>
</html>
