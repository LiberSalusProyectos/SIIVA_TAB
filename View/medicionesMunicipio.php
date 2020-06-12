<?php include_once("user_auth.php"); include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("header_references.php"); ?>

  <style>
    .contenedor {
      transform: translate(0, 50px);
    }
    .texto {
      transform: rotate(270deg);
      transform-origin: center;
    }
    .marco {
      box-shadow: 0px 0px 10px #00000040;
      border: 3px solid #06AACA;
      border-radius: 12px;
      opacity: 1;
    }
    .propiedad {
      font-size: 16px;
      color: #C3BFBF;
    }
    .contenido {
      font-size: 20px;
      color: #0074B0;
    }
    .nombre {
      font-size: 16px;
      color: #7A8183;
    }
    .btn-1 {
      color: white;
      border: none;
      background-color: #1939BC;
      border-radius: 10px;
      font-weight: bold;
      height: 54px;
    }
    .btn-2 {
      color: white;
      border: none;
      background-color: #DC0E3E;
      border-radius: 10px;
      font-weight: bold;
      height: 54px;
    }
    .btn-3 {
      color: white;
      border: none;
      background-color: #00B0B0;
      border-radius: 10px;
      font-weight: bold;
      height: 54px;
    }
    .btn-4 {
      color: white;
      border: none;
      background-color: #0074B0;
      border-radius: 10px;
      font-weight: bold;
      height: 54px;
    }
    .btn-5 {
      color: white;
      border: none;
      background-color: #B05800;
      border-radius: 10px;
      font-weight: bold;
      height: 54px;
    }
    .btn-6 {
      color: white;
      border: none;
      background-color: #2F3430;
      border-radius: 10px;
      font-weight: bold;
      height: 54px;
    }
    .boton-1 {
      box-shadow: 0px 0px 10px #00000040;
      border: 3px solid #1D3EB9;
      border-radius: 14px;
      opacity: 1;
    }
    .boton-2 {
      box-shadow: 0px 0px 10px #00000040;
      border: 3px solid #DC0E3E;
      border-radius: 14px;
      opacity: 1;
    }
    .boton-3 {
      box-shadow: 0px 0px 10px #00000040;
      border: 3px solid #00B0B0;
      border-radius: 14px;
      opacity: 1;
    }
    .boton-4 {
      box-shadow: 0px 0px 10px #00000040;
      border: 3px solid #0074B0;
      border-radius: 14px;
      opacity: 1;
    }
    .boton-5 {
      box-shadow: 0px 0px 10px #00000040;
      border: 3px solid #B05800;
      border-radius: 14px;
      opacity: 1;
    }
    .boton-6 {
      box-shadow: 0px 0px 10px #00000040;
      border: 3px solid #2F3430;
      border-radius: 14px;
      opacity: 1;
    }
    tarjeta: {
      border-radius: 14px;
    }
  </style>
  <script>
    $(document).ready(function () {

      var index = "<?php echo sizeof($dependants); ?>";
      $(".toggle").click(function (e) {
        var _this = this;
        if(jQuery(e.target).is('button')){
          $("[id^=tarjeta_]:not(#tarjeta_" + this.name ).hide(250)
          $("#tarjeta_" + this.name).toggle(250)

          $.ajax({
            url:"dashboard.php?" + $.param({ municipio: _this.name }),
            method:"GET",
            contentType:false,
            cache:false,
            processData:false,
            success:function(resp){
              var data = JSON.parse(resp);
              var total = data.total ? data.total : 0;
              var total_perc = data.total_perc ? data.total_perc : 0;
              $("#cant_" + _this.name).html('<span class="text-warning">'+total+'</span>')
              $("#perc_" + _this.name).html('<span class="text-warning">'+parseFloat(total_perc).toFixed(2)+'%</span>')
            }
          })
        } else {
          $("[id^=tarjeta_]:not(#tarjeta_" + this.id ).hide(250)
          $("#tarjeta_" + this.id).toggle(250)

          $.ajax({
            url:"dashboard.php",
            method:"GET",
            url:"dashboard.php?" + $.param({ municipio: _this.id }),
            contentType:false,
            cache:false,
            processData:false,
            success:function(resp){
              var data = JSON.parse(resp);
              var total = data.total ? data.total : 0;
              var total_perc = data.total_perc ? data.total_perc : 0;
              $("#cant_" + _this.id).html('<span class="text-warning">'+total+'</span>')
              $("#perc_" + _this.id).html('<span class="text-warning">'+parseFloat(total_perc).toFixed(2)+'%</span>')
            }
          })
        }
      })
    })
    function myFunction(index) {
      $("#dep_" + index).remove();
    }
  </script>
</head>

<body id="bootstrap_overrides">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <?php include("user_navigator.php"); ?>
  <div class="container-fluid">
    <div class="row custom-vertical-padding">
      <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
        <button class="btn my-2 my-sm-0 custom-btn-disabled" type="submit">
          <span>
            <i class="fas fa-file custom-icon icon-behind"></i>
            <h4 class="text-white bold-font text-forward">MEDICIONES POR MUNICIPIO</h4>
          </span>
        </button>
      </div>
    </div>

    <div class="row">
      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-1">
              <div id="balancan" style="cursor: pointer;" class="btn-1 btn-lg btn-block toggle">
                <p style="text-align: center;">BALANCÁN</p>
              </div>
              <div id="tarjeta_balancan" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_balancan" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_balancan" class="text-muted">Cargando...</div>
                <div>
                  <button name="balancan" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-2">
              <div id="cardenas" style="cursor: pointer;" class="btn-2 btn-lg btn-block toggle">
                <p style="text-align: center;">CÁRDENAS</p>
              </div>
              <div id="tarjeta_cardenas" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_cardenas" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_cardenas" class="text-muted">Cargando...</div>
                <div>
                  <button name="cardenas" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-3">
              <div id="centla" style="cursor: pointer;" class="btn-3 btn-lg btn-block toggle">
                <p style="text-align: center;">CENTLA</p>
              </div>
              <div id="tarjeta_centla" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_centla" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_centla" class="text-muted">Cargando...</div>
                <div>
                  <button name="centla" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-4">
              <div id="centro" style="cursor: pointer;" class="btn-4 btn-lg btn-block toggle">
                <p style="text-align: center;">CENTRO</p>
              </div>
              <div id="tarjeta_centro" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_centro" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_centro" class="text-muted">Cargando...</div>
                <div>
                  <button name="centro" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-2">
              <div id="comalcalco" style="cursor: pointer;" class="btn-2 btn-lg btn-block toggle">
                <p style="text-align: center;">COMALCALCO</p>
              </div>
              <div id="tarjeta_comalcalco" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_comalcalco" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_comalcalco" class="text-muted">Cargando...</div>
                <div>
                  <button name="comalcalco" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-2">
              <div id="cunduacan" style="cursor: pointer;" class="btn-2 btn-lg btn-block toggle">
                <p style="text-align: center;">CUNDUACÁN</p>
              </div>
              <div id="tarjeta_cunduacan" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_cunduacan" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_cunduacan" class="text-muted">Cargando...</div>
                <div>
                  <button name="cunduacan" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-1">
              <div id="zapata" style="cursor: pointer;" class="btn-1 btn-lg btn-block toggle">
                <p style="text-align: center;">EMILIANO ZAPATA</p>
              </div>
              <div id="tarjeta_zapata" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_zapata" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_zapata" class="text-muted">Cargando...</div>
                <div>
                  <button name="zapata" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-2">
              <div id="huimanguillo" style="cursor: pointer;" class="btn-2 btn-lg btn-block toggle">
                <p style="text-align: center;">HUIMANGUILLO</p>
              </div>
              <div id="tarjeta_huimanguillo" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_huimanguillo" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_huimanguillo" class="text-muted">Cargando...</div>
                <div>
                  <button name="huimanguillo" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-5">
              <div id="jalapa" style="cursor: pointer;" class="btn-5 btn-lg btn-block toggle">
                <p style="text-align: center;">JALAPA</p>
              </div>
              <div id="tarjeta_jalapa" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_jalapa" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_jalapa" class="text-muted">Cargando...</div>
                <div>
                  <button name="jalapa" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-4">
              <div id="jalpa" style="cursor: pointer;" class="btn-4 btn-lg btn-block toggle">
                <p style="text-align: center;">JALPA DE MÉNDEZ</p>
              </div>
              <div id="tarjeta_jalpa" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_jalpa" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_jalpa" class="text-muted">Cargando...</div>
                <div>
                  <button name="jalpa" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-3">
              <div id="jonuta" style="cursor: pointer;" class="btn-3 btn-lg btn-block toggle">
                <p style="text-align: center;">JONUTA</p>
              </div>
              <div id="tarjeta_jonuta" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_jonuta" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_jonuta" class="text-muted">Cargando...</div>
                <div>
                  <button name="jonuta" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-3">
              <div id="macuspana" style="cursor: pointer;" class="btn-3 btn-lg btn-block toggle">
                <p style="text-align: center;">MACUSPANA</p>
              </div>
              <div id="tarjeta_macuspana" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_macuspana" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_macuspana" class="text-muted">Cargando...</div>
                <div>
                  <button name="macuspana" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-2">
              <div id="nacajuca" style="cursor: pointer;" class="btn-2 btn-lg btn-block toggle">
                <p style="text-align: center;">NACAJUCA</p>
              </div>
              <div id="tarjeta_nacajuca" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_nacajuca" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_nacajuca" class="text-muted">Cargando...</div>
                <div>
                  <button name="nacajuca" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-2">
              <div id="paraiso" style="cursor: pointer;" class="btn-2 btn-lg btn-block toggle">
                <p style="text-align: center;">PARAÍSO</p>
              </div>
              <div id="tarjeta_paraiso" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_paraiso" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_paraiso" class="text-muted">Cargando...</div>
                <div>
                  <button name="paraiso" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-5">
              <div id="tacotalpa" style="cursor: pointer;" class="btn-5 btn-lg btn-block toggle">
                <p style="text-align: center;">TACOTALPA</p>
              </div>
              <div id="tarjeta_tacotalpa" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_tacotalpa" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_tacotalpa" class="text-muted">Cargando...</div>
                <div>
                  <button name="tacotalpa" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-5">
              <div id="teapa" style="cursor: pointer;" class="btn-5 btn-lg btn-block toggle">
                <p style="text-align: center;">TEAPA</p>
              </div>
              <div id="tarjeta_teapa" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_teapa" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_teapa" class="text-muted">Cargando...</div>
                <div>
                  <button name="teapa" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-1">
              <div id="tenosique" style="cursor: pointer;" class="btn-1 btn-lg btn-block toggle">
                <p style="text-align: center;">TENOSIQUE</p>
              </div>
              <div id="tarjeta_tenosique" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_tenosique" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_tenosique" class="text-muted">Cargando...</div>
                <div>
                  <button name="tenosique" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
            <div class="boton-6">
              <div id="total" style="cursor: pointer;" class="btn-6 btn-lg btn-block toggle">
                <p style="text-align: center;">TOTAL</p>
              </div>
              <div id="tarjeta_total" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                <span class="text-primary">Cantidad de encuestas:</span><br />
                <div id="cant_total" class="text-muted">Cargando...</div>
                <span class="text-primary">Población cubierta:</span><br />
                <div id="perc_total" class="text-muted">Cargando...</div>
                <div>
                  <button name="total" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                  <button class="btn"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>