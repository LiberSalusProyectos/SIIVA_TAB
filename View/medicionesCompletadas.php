<?php include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header_references_auth.php");
    if (sizeof($_POST)>0) {
      if(isset($_POST["search"])){
        $search = $_POST["search"];
        $result = getCompletedData($linkDB, $search);
        // echo "<pre>";
        // var_dump($result);
        // echo "</pre>";
      }
      if ($_POST["form_answered"]=="true") {
        $updated = updatePatientData($linkDB, $_POST, $_SESSION["id_user"]);

        if ($updated) {
          header('Location: home.php'); exit;
        }
      }
    }
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
      $("#add").click( function(){
        $("#root").append("<div id='dep_"+index+"' class='row ml-1 mr-1'><div class='col-12'><button onclick='myFunction("+index+")' type='button' class='btn btn-danger float-right'>Eliminar</button></div><div class='col-12 col-sm-12 col-md-6 col-lg-4 m-0'><div class='form-group'><label for='name' class='text-royal-blue bold-font float-left custom-form-label-element'>Nombre</label><input type='text' class='form-control custom-input' name='dependants["+index+"][name]' required /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-4 m-0'><div class='form-group'><label for='firstLastName' class='text-royal-blue bold-font float-left custom-form-label-element'>Apellido Paterno</label><input type='text' class='form-control custom-input' name='dependants["+index+"][firstLastName]' required /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-4 m-0'><div class='form-group'><label for='secondLastName' class='text-royal-blue bold-font float-left custom-form-label-element'>Apellido Materno</label><input type='text' class='form-control custom-input' name='dependants["+index+"][secondLastName]' required /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='form-group'><label for='name' class='text-royal-blue bold-font float-left custom-form-label-element'>CURP</label><input type='text' class='form-control custom-input' name='dependants["+index+"][curp]'pattern='([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[0-9A-Z]{5})' /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='row'><div class='col-12'><label class='text-royal-blue bold-font float-left custom-form-label-element'>Fecha de nacimiento</label></div></div><div class='row'><div class='col-12'><input class='form-control custom-input birthdate' name='dependants["+index+"][birthdate]' /></div></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='form-group'><label for='genre' class='text-royal-blue bold-font float-left custom-form-label-element'>Género</label><select class='form-control custom-input-select' name='dependants["+index+"][genre]' required><option selected disabled>SELECCIONAR</option><option value='MASCULINO'>MASCULINO</option><option value='FEMENINO'>FEMENINO</option></select></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='form-group'><label for='familyRole'class='text-royal-blue bold-font float-left custom-form-label-element'>Parentesco</label><select class='form-control custom-input' name='dependants["+index+"][familyRole]' required><option selected disabled>SELECCIONAR</option><option value='ESPOSO'>ESPOSO</option><option value='ESPOSA'>ESPOSA</option><option value='HIJO'>HIJO</option><option value='HIJA'>HIJA</option><option value='PADRE'>PADRE</option><option value='MADRE'>MADRE</option><option value='NIETO'>NIETO</option><option value='NIETA'>NIETA</option></select></div></div><div class='offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider'></div></div>");
        index++;
      })
    })
    function myFunction(index) {
      $("#dep_"+index).remove();
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
                    <h4 class="text-white bold-font text-forward">MEDICIONES COMPLETADAS POR FAMILIA</h4>
                </span>
            </button>
        </div>
    </div>

    <div class="row">
      <div class="offset-sm-0 offset-md-1 col-sm-12 col-md-10">

        <div class="row d-md-none">
          <div class="col-6"></div>
          <div class="col-6 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->clinicHistory as $key=>$dependent){ ?>
              <div class="d-flex justify-content-center contenedor">
                <span class="texto nombre"><?php echo $dependent['familyRole']; ?></span>
              </div>
            <?php }?>
          </div>
        </div>

        <div class="row mt-0">
          <div class="col-6 col-sm-6 col-md-5 d-flex flex-column marco">
            <span class="propiedad">IDentificador</span>
            <span class="contenido"><?php echo $result->clinicHistory[0] ? $result->clinicHistory[0]['affiliationNumber'] : 'NA'; ?></span>
            <span class="propiedad">Familia</span>
            <span class="contenido"><?php echo $result->clinicHistory[0] ? utf8_encode(ucfirst($result->clinicHistory[0]['name'])." ".ucfirst($result->clinicHistory[0]['firstLastName'])." ".ucfirst($result->clinicHistory[0]['secondLastName'])) : 'NA'; ?></span>
          </div>
          <div class="col-2 d-none d-md-block"></div>
          <div class="col-6 col-sm-6 col-md-5 d-flex">
            <?php foreach (!isset($result) ? [] : $result->clinicHistory as $key=>$dependent){ ?>
              <div class="col d-flex justify-content-center align-items-end">
                <div class="d-flex flex-column align-items-center">
                  <i class="fas fa-user h4"></i>
                  <span class="d-none d-md-block nombre"><?php echo $dependent['familyRole']; ?></span>
                </div>
              </div>
            <?php }?>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Historia Clínica</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->clinicHistory as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Entorno Social</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->environment as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Depresión</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->depresion as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Ansiedad</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->anxiety as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Violencia Intrafamiliar</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->violence as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Desesperanza</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->hopelessness as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>


        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Vacunación</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->vaccination as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Enfermedades Vector</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->vector as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Enfermedades Transmisión Sexual</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->ets as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Crónico Degenerativas</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->cronic as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">IRAS Y EDAS</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->edas as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Signos Vitales Básicos</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->vitalSign as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Evaluación Nutricional</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->nutritional as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Estudios de Laboratorio</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->laboratory as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Estudios de Gabinete</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->cabinet as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Estudios de Audiometría</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->hearing as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Tamizaje Visual</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->visual as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Ortopédico Básico</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->ortopedic as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Riesgo Cardiobascular</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->cardio as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Cáncer Cervico-Uterino</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->cancer as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Índice Barthel</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->barthel as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Depresión Geríatrica</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->geriatric as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Escala de Zaritt</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->zaritt as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider"></div>
        </div>

        <div class="row mt-1">
          <div class="col-6 col-sm-6 col-md-7 d-flex flex-column">
            <span class="text-royal-blue bold-font">Evaluación de Riesgo</span>
          </div>
          <div class="col-6 col-sm-6 col-md-5 d-flex justify-content-around">
            <?php foreach (!isset($result) ? [] : $result->risk as $key=>$dependent){ ?>
              <div class="d-flex">
                <?php echo $dependent['completed'] == 1 ? "<i class='fas fa-check-circle h4 text-success'></i>" : "<i class='fas fa-times-circle h4 text-danger'></i>"; ?>
              </div>
            <?php }?>
          </div>
          <div class="col-12 mb-1 divider mb-5"></div>
        </div>

      </div>
    </div>
  </div>
</body>

</html>