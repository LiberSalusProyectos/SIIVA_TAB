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
    div[id^='d_']{
      -webkit-transition: margin-left 0.5s ease;
      -moz-transition: margin-left 0.5s ease;
      -o-transition: margin-left 0.5s ease;
      transition: margin-left 0.5s ease;
    }
    div[id^='t_']{
      -webkit-transition: all 0.5s ease;
      -moz-transition: all 0.5s ease;
      -o-transition: all 0.5s ease;
      transition: all 0.5s ease;
    }
  </style>
  <script>
    $(document).ready(function () {

      var index = "<?php echo sizeof($dependants); ?>";
      $(".toggle").click(function (e) {
        var _this = this;

        // var element = $("[id^=t_]")
        // element.addClass(['col-sm-6', 'col-md-6', 'col-lg-4', 'col-xl-3'])
        // element.removeClass(['col-sm-12', 'col-md-12', 'col-lg-8', 'col-xl-6'])

        if(jQuery(e.target).is('button')){
          $("[id^=tarjeta_]:not(#tarjeta_" + this.name ).hide(250)
          $("#tarjeta_" + this.name).toggle(250)
        } else {
          $("[id^=tarjeta_]:not(#tarjeta_" + this.id ).hide(250)
          $("#tarjeta_" + this.id).toggle(250)

          $.ajax({
            method:"GET",
            url:"dashboard.php?" + $.param({ municipio: _this.id }),
            contentType:false,
            cache:false,
            processData:false,
            success:function(resp){
              var data = JSON.parse(resp);
              var total = data.total ? data.total : 0;
              var cant = data.patient_cant ? data.patient_cant : 0;
              var cont = data.cont ? data.cont : 0;
              var total_perc = data.total_perc ? data.total_perc : 0;
              $("#cant_" + _this.id).html('<span class="text-warning">'+total+'</span>')
              $("#perc_" + _this.id).html('<span class="text-warning">'+parseFloat(total_perc).toFixed(2)+'%</span>')

              $("span[id=d_perc]").text(parseFloat(total_perc).toFixed(2)+'%')
              $("span[id=d_cant]").text(cant)
              $("span[id=d_total]").text(total)
              $("span[id=d_cont]").text(cont)

              $("span[id=d_1]").text(data.familyrecord)
              $("span[id=d_2]").text(data.dass21)
              $("span[id=d_3]").text(data.environment)
              $("span[id=d_4]").text(data.geriatricdepression)
              $("span[id=d_5]").text(data.zarittscale)
              $("span[id=d_6]").text(data.ets)
              $("span[id=d_7]").text(data.sociocultural)
              $("span[id=d_8]").text(data.diabetes)
              $("span[id=d_9]").text(data.hypertension)
              $("span[id=d_10]").text(data.bornlifestyle)
              $("span[id=d_11]").text(data.childlifestyle)
              $("span[id=d_12]").text(data.younglifestyle)
              $("span[id=d_13]").text(data.babylifestyle)
              $("span[id=d_14]").text(data.gynecology)
              $("span[id=d_15]").text(data.healthcare)
              $("span[id=d_16]").text(data.vitalsign)
              $("span[id=d_17]").text(data.genderviolence)
              $("span[id=d_18]").text(data.childvaccination)
              $("span[id=d_19]").text(data.youngvaccination)
              $("span[id=d_20]").text(data.adultvaccination)
              $("span[id=d_21]").text(data.eldervaccination)
              $("span[id=d_22]").text(data.hopeless)

              var bcontent = $("#button-dc")
              var bdetail = $("#button-detail")
              var button_title = ''
              var button_class = ''
              var btn_class = ''
              switch(_this.id) {
                case 'balancan':
                  button_title = 'BALANCÁN'
                  button_class = 'boton-1'
                  btn_class = 'btn-1'
                  break;
                case 'cardenas':
                  button_title = 'CÁRDENAS'
                  button_class = 'boton-2'
                  btn_class = 'btn-2'
                  break;
                case 'centla':
                  button_title = 'CENTLA'
                  button_class = 'boton-3'
                  btn_class = 'btn-3'
                  break;
                case 'centro':
                  button_title = 'CENTRO'
                  button_class = 'boton-4'
                  btn_class = 'btn-4'
                  break;
                case 'comalcalco':
                  button_title = 'COMALCALCO'
                  button_class = 'boton-2'
                  btn_class = 'btn-2'
                  break;
                case 'cunduacan':
                  button_title = 'CUNDUACÁN'
                  button_class = 'boton-2'
                  btn_class = 'btn-2'
                  break;
                case 'zapata':
                  button_title = 'EMILIANO ZAPATA'
                  button_class = 'boton-1'
                  btn_class = 'btn-1'
                  break;
                case 'huimanguillo':
                  button_title = 'HUIMANGUILLO'
                  button_class = 'boton-2'
                  btn_class = 'btn-2'
                  break;
                case 'jalapa':
                  button_title = 'JALAPA'
                  button_class = 'boton-5'
                  btn_class = 'btn-5'
                  break;
                case 'jalpa':
                  button_title = 'JALPA DE MÉNDEZ'
                  button_class = 'boton-4'
                  btn_class = 'btn-4'
                  break;
                case 'jonuta':
                  button_title = 'JONUTA'
                  button_class = 'boton-3'
                  btn_class = 'btn-3'
                  break;
                case 'macuspana':
                  button_title = 'MACUSPANA'
                  button_class = 'boton-3'
                  btn_class = 'btn-3'
                  break;
                case 'nacajuca':
                  button_title = 'NACAJUCA'
                  button_class = 'boton-2'
                  btn_class = 'btn-2'
                  break;
                case 'paraiso':
                  button_title = 'PARAÍSO'
                  button_class = 'boton-2'
                  btn_class = 'btn-2'
                  break;
                case 'tacotalpa':
                  button_title = 'TACOTALPA'
                  button_class = 'boton-5'
                  btn_class = 'btn-5'
                  break;
                case 'teapa':
                  button_title = 'TEAPA'
                  button_class = 'boton-5'
                  btn_class = 'btn-5'
                  break;
                case 'tenosique':
                  button_title = 'TENOSIQUE'
                  button_class = 'boton-1'
                  btn_class = 'btn-1'
                  break;
                case 'otros':
                  button_title = 'OTROS'
                  button_class = 'boton-4'
                  btn_class = 'btn-4'
                  break;
                default:
                  button_title = 'TOTAL'
                  button_class = 'boton-6'
                  btn_class = 'btn-6'
              }

              bdetail.removeClass()
              bcontent.removeClass()
              bdetail.addClass(button_class)
              bcontent.addClass([btn_class, 'btn-lg', 'btn-block', 'toggled'])
              bcontent.html('<p style="text-align: center;">'+button_title+'</p>')
            }
          })
        }
      })

      $(".detail").click(function (e) {
        var _this = this;
        var card = $("#d_card")
        var board = $("#d_board")
        var element = $("[id^=t_]")

        card.show()

        board.removeClass('col-12')
        board.addClass('col-sm-6')

        $("#tarjeta_" + this.name).toggle(250)

        element.removeClass(['col-sm-6', 'col-md-6', 'col-lg-12', 'col-xl-3'])
        element.addClass(['col-sm-12', 'col-md-12', 'col-lg-12', 'col-xl-6'])
      })

      $(".toggled").click(function (e) {
        var _this = this;
        var card = $("#d_card")
        var board = $("#d_board")
        var element = $("[id^=t_]")

        card.toggle()
        board.toggleClass('col-12')
        board.toggleClass('col-sm-6')

        element.toggleClass(['col-sm-6', 'col-md-6', 'col-lg-12', 'col-xl-3'])
        element.toggleClass(['col-sm-12', 'col-md-12', 'col-lg-12', 'col-xl-6'])
      })

      $(".toggles").click(function (e) {
        var _this = this;
        var bcontent = $("#button-dc")
        bcontent.html('<p style="text-align: center;">'+this.id.toUpperCase()+'</p>')
      })
    })
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
          <div id="d_card" class="col-sm-6 mt-0 mb-3" style="display: none;">
            <div id="button-detail" class="boton-6">
              <div id="button-dc" style="cursor: pointer;" class="btn-6 btn-lg btn-block toggled">
                <!-- Aqui se inserta el titulo del boton -->
              </div>
              <div style="text-align: center;padding: 10px;">
                <div class="row">
                  <div class="col-md-4" style="text-align: right;">
                    <span class="text-primary">Poclación cubierta:</span><br />
                    <span id="d_perc" class="text-warning">Cargando...</span>
                  </div>
                  <div class="col-md-4" style="text-align: right;">
                    <div class="row">
                      <div class="col-6">
                        <span id="d_cont" class="text-warning">Cargando...</span><br />
                        <span id="d_cant" class="text-warning">Cargando...</span>
                      </div>
                      <div class="col-6">
                        <span class="text-primary"> Encuestados</span><br />
                        <span class="text-primary"> Habitantes</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4" style="text-align: right;">
                    <span class="text-primary">Cantidad de encuestas</span><br />
                    <span id="d_total" class="text-warning">Cargando...</span>
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-10" style="text-align: left;">
                    <span class="text-primary">Antecedentes Familiares.</span><br />
                    <span class="text-primary">DASS-21.</span><br />
                    <span class="text-primary">Medio ambiente.</span><br />
                    <span class="text-primary">Depresión geriátrica.</span><br />
                    <span class="text-primary">Escala de Zarit.</span><br />
                    <span class="text-primary">Enfermedades de transmisión sexual.</span><br />
                    <span class="text-primary">Cuestionario socio-cultural.</span><br />
                    <span class="text-primary">Diabetes mellitus.</span><br />
                    <span class="text-primary">Hipertensión Arterial Sistémica.</span><br />
                    <span class="text-primary">Estilo de vida personal de [0-1] años.</span><br />
                    <span class="text-primary">Estilo de vida personal de [6-12] años.</span><br />
                    <span class="text-primary">Estilo de vida personal de [12+] años.</span><br />
                    <span class="text-primary">Estilo de vida personal de [1-5] años.</span><br />
                    <span class="text-primary">Ginecología.</span><br />
                    <span class="text-primary">PBIQ.</span><br />
                    <span class="text-primary">Signos vitales + Laboratorio.</span><br />
                    <span class="text-primary">Violencia de género.</span><br />
                    <span class="text-primary">Esquema de vacunación de [0-9] años.</span><br />
                    <span class="text-primary">Esquema de vacunación de [10-19] años.</span><br />
                    <span class="text-primary">Esquema de vacunación de [20-59] años.</span><br />
                    <span class="text-primary">Esquema de vacunación de [60+] años.</span><br />
                    <span class="text-primary">Desesperanza de Beck.</span>
                  </div>
                  <div class="col-2" style="text-align: right;">
                    <span id="d_1" class="text-primary">Cargando...</span><br />
                    <span id="d_2" class="text-primary">Cargando...</span><br />
                    <span id="d_3" class="text-primary">Cargando...</span><br />
                    <span id="d_4" class="text-primary">Cargando...</span><br />
                    <span id="d_5" class="text-primary">Cargando...</span><br />
                    <span id="d_6" class="text-primary">Cargando...</span><br />
                    <span id="d_7" class="text-primary">Cargando...</span><br />
                    <span id="d_8" class="text-primary">Cargando...</span><br />
                    <span id="d_9" class="text-primary">Cargando...</span><br />
                    <span id="d_10" class="text-primary">Cargando...</span><br />
                    <span id="d_11" class="text-primary">Cargando...</span><br />
                    <span id="d_12" class="text-primary">Cargando...</span><br />
                    <span id="d_13" class="text-primary">Cargando...</span><br />
                    <span id="d_14" class="text-primary">Cargando...</span><br />
                    <span id="d_15" class="text-primary">Cargando...</span><br />
                    <span id="d_16" class="text-primary">Cargando...</span><br />
                    <span id="d_17" class="text-primary">Cargando...</span><br />
                    <span id="d_18" class="text-primary">Cargando...</span><br />
                    <span id="d_19" class="text-primary">Cargando...</span><br />
                    <span id="d_20" class="text-primary">Cargando...</span><br />
                    <span id="d_21" class="text-primary">Cargando...</span><br />
                    <span id="d_22" class="text-primary">Cargando...</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="d_board" class="col-12">
            <div class="row">
              <div id="t_balancan" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
                <div class="boton-1">
                  <div id="balancan" style="cursor: pointer;" class="btn-1 btn-lg btn-block toggle">
                    <p style="text-align: center;">BALANCÁN</p>
                  </div>
                  <div id="tarjeta_balancan" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                    <span class="text-primary">Cantidad de encuestas:</span><br />
                    <div id="cant_balancan" class="text-muted">Cargando...</div>
                    <span class="text-primary">Población cubierta:</span><br />
                    <div id="perc_balancan" class="text-muted">Cargando...</div>
                    <div class="mt-2">
                      <button name="balancan" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                      <button name="balancan" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_cardenas" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="cardenas" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_centla" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="centla" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_centro" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="centro" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_comalcalco" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="comalcalco" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_cunduacan" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="cunduacan" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_zapata" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="zapata" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_huimanguillo" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="huimanguillo" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_jalapa" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="jalapa" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_jalpa" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="jalpa" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_jonuta" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="jonuta" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_macuspana" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="macuspana" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_nacajuca" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="nacajuca" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_paraiso" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="paraiso" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_tacotalpa" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="tacotalpa" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_teapa" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="teapa" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_tenosique" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="tenosique" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_otros" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
                <div class="boton-4">
                  <div id="otros" style="cursor: pointer;" class="btn-4 btn-lg btn-block toggle">
                    <p style="text-align: center;">OTROS</p>
                  </div>
                  <div id="tarjeta_otros" style="display: none;text-align: center;padding: 10px;" class="tarjeta">
                    <span class="text-primary">Cantidad de encuestas:</span><br />
                    <div id="cant_otros" class="text-muted">Cargando...</div>
                    <span class="text-primary">Población cubierta:</span><br />
                    <div id="perc_otros" class="text-muted">Cargando...</div>
                    <div>
                      <button name="otros" class="btn toggle"><i class="fas fa-chevron-circle-up text-danger"></i><span class="text-muted"> Cerrar</span></button>
                      <button name="otros" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div id="t_total" class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
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
                      <button name="total" class="btn detail"><span class="text-muted">Ver detalle </span><i class="fas fa-chevron-circle-right text-success"></i></button>
                    </div>
                  </div>
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