<?php include_once("user_auth.php"); include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("header_references.php");

    $result = getDetailByTownshipData($linkDB);
    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";

  ?>

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
      background-color: #1939BC;
      box-shadow: 0px 0px 10px #00000040;
      border-radius: 12px;
      font-weight: bold;
      height: 54px;
    }
    .btn-2 {
      color: white;
      background-color: #DC0E3E;
      box-shadow: 0px 0px 10px #00000040;
      border-radius: 12px;
      font-weight: bold;
      height: 54px;
    }
    .btn-3 {
      color: white;
      background-color: #00B0B0;
      box-shadow: 0px 0px 10px #00000040;
      border-radius: 12px;
      font-weight: bold;
      height: 54px;
    }
    .btn-4 {
      color: white;
      background-color: #0074B0;
      box-shadow: 0px 0px 10px #00000040;
      border-radius: 12px;
      font-weight: bold;
      height: 54px;
    }
    .btn-5 {
      color: white;
      background-color: #B05800;
      box-shadow: 0px 0px 10px #00000040;
      border-radius: 12px;
      font-weight: bold;
      height: 54px;
    }
    .btn-6 {
      color: white;
      background-color: #2F3430;
      box-shadow: 0px 0px 10px #00000040;
      border-radius: 12px;
      font-weight: bold;
      height: 54px;
    }
  </style>
  <script>
    $(document).ready(function () {
      var date_input = $('.birthdate'); //our date input has the name "date"
      var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
      var options = {
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
        language: 'es',
      };
      date_input.datepicker(options);

      var index = "<?php echo sizeof($dependants); ?>";
      $("#add").click(function () {
        $("#root").append("<div id='dep_" + index + "' class='row ml-1 mr-1'><div class='col-12'><button onclick='myFunction(" + index + ")' type='button' class='btn btn-danger float-right'>Eliminar</button></div><div class='col-12 col-sm-12 col-md-6 col-lg-4 m-0'><div class='form-group'><label for='name' class='text-royal-blue bold-font float-left custom-form-label-element'>Nombre</label><input type='text' class='form-control custom-input' name='dependants[" + index + "][name]' required /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-4 m-0'><div class='form-group'><label for='firstLastName' class='text-royal-blue bold-font float-left custom-form-label-element'>Apellido Paterno</label><input type='text' class='form-control custom-input' name='dependants[" + index + "][firstLastName]' required /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-4 m-0'><div class='form-group'><label for='secondLastName' class='text-royal-blue bold-font float-left custom-form-label-element'>Apellido Materno</label><input type='text' class='form-control custom-input' name='dependants[" + index + "][secondLastName]' required /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='form-group'><label for='name' class='text-royal-blue bold-font float-left custom-form-label-element'>CURP</label><input type='text' class='form-control custom-input' name='dependants[" + index + "][curp]'pattern='([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[0-9A-Z]{5})' /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='row'><div class='col-12'><label class='text-royal-blue bold-font float-left custom-form-label-element'>Fecha de nacimiento</label></div></div><div class='row'><div class='col-12'><input class='form-control custom-input birthdate' name='dependants[" + index + "][birthdate]' /></div></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='form-group'><label for='genre' class='text-royal-blue bold-font float-left custom-form-label-element'>Género</label><select class='form-control custom-input-select' name='dependants[" + index + "][genre]' required><option selected disabled>SELECCIONAR</option><option value='MASCULINO'>MASCULINO</option><option value='FEMENINO'>FEMENINO</option></select></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='form-group'><label for='familyRole'class='text-royal-blue bold-font float-left custom-form-label-element'>Parentesco</label><select class='form-control custom-input' name='dependants[" + index + "][familyRole]' required><option selected disabled>SELECCIONAR</option><option value='ESPOSO'>ESPOSO</option><option value='ESPOSA'>ESPOSA</option><option value='HIJO'>HIJO</option><option value='HIJA'>HIJA</option><option value='PADRE'>PADRE</option><option value='MADRE'>MADRE</option><option value='NIETO'>NIETO</option><option value='NIETA'>NIETA</option></select></div></div><div class='offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider'></div></div>");
        index++;
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
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-1 btn-lg btn-block">BALANCÁN</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-2 btn-lg btn-block">CÁRDENAS</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-3 btn-lg btn-block">CENTLA</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-4 btn-lg btn-block">CENTRO</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-2 btn-lg btn-block">COMALCALCO</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-2 btn-lg btn-block">CUNDUACÁN</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-1 btn-lg btn-block">EMILIANO ZAPATA</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-2 btn-lg btn-block">HUIMANGUILLO</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-5 btn-lg btn-block">JALAPA</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-4 btn-lg btn-block">JALPA DE MÉNDEZ</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-3 btn-lg btn-block">JONUTA</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-3 btn-lg btn-block">MACUSPANA</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-4 btn-lg btn-block">NACAJUCA</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-2 btn-lg btn-block">PARAÍSO</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-5 btn-lg btn-block">TACOTALPA</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-5 btn-lg btn-block">TEAPA</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-1 btn-lg btn-block">TENOSIQUE</button>
          </div>
          <div class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4">
            <button type="button" class="btn btn-6 btn-lg btn-block">TOTAL</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>