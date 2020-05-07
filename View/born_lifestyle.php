<?php include_once("index_auth.php"); include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header_references.php");

    // $_SESSION["id_user"] = 1;
    //var_dump($_SESSION);
    //var_dump($_SESSION["email"]);
    //$_SESSION["id_user"] = 1;
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    if (sizeof($_POST)>0) {
      $result = getModuleData($linkDB, $_POST["module"], $_POST["id_patient"]);
      //var_dump($result);

      if ($_POST["form_answered"]=="true") {
          if ($result[0]["id_data"] != "") {
            $realized = saveBornLifestyleData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveBornLifestyleData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=bornLifestyle'); exit;
          }
      }

      $result = getModuleData($linkDB, $_POST["module"], $_POST["id_patient"]);
    } else {
      header('Location: index.php'); exit;
    }

    //echo "<pre>";
    //var_dump($result);
    //echo "</pre>";


   ?>
  </head>

<body id="bootstrap_overrides">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <?php include("navigator.php"); ?>
    <div class="container-fluid">

        <div class="row custom-vertical-padding">
            <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
                <button class="btn my-2 my-sm-0 custom-btn-disabled" type="submit">
                    <span>
                        <i class="fas fa-baby-carriage custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo BORN_LIFESTYLE_NAME; ?></h4>
                    </span>
                </button>
            </div>
        </div>

        <div class="row">
      <form method="POST">
        <input type="hidden" name="module" value="<?php echo $_POST['module']; ?>">
        <input type="hidden" name="id_patient" value="<?php echo $_POST['id_patient']; ?>">
        <input type="hidden" name="form_answered" value="true">

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <section class="instructions vertical-margin-bottom">
                    <p class="instructions-paragraph regular-font text-royal-blue">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse odio felis, venenatis
                        volutpat
                        pellentesque at, iaculis eu nulla. Integer iaculis ipsum mauris, a mattis tortor ultrices
                        tempor. Maecenas
                        non malesuada elit, id condimentum turpis. Maecenas condimentum lacus eget vulputate euismod.
                        Cras sed
                        pellentesque arcu. Proin imperdiet commodo sagittis. Proin quam elit, mattis sed dolor sed,
                        tempus elementum
                        eros. Quisque sollicitudin lectus tellus.
                    </p>
                </section>
            </div>

            <div class="offset-0 offset-lg-3 offset-md-2 offset-sm-2 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
                <h2 class="text-royal-blue bold-font custom-full-name-big vertical-margin-bottom"><?php echo utf8_encode($result[0]["firstLastName"]." ".$result[0]["secondLastName"]." ".$result[0]["name"]); ?></h2>
                </h2>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-5">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">1) A cuantas consultas acudió durante su control parental</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1 a 3 consultas
                            <input type="radio" name="consultations" <?php if ($result[0]["consultations"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 4 a 5 consultas
                            <input type="radio" name="consultations" <?php if ($result[0]["consultations"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 6 a 7 consultas
                            <input type="radio" name="consultations" <?php if ($result[0]["consultations"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Más de 8 consultas
                            <input type="radio" name="consultations" <?php if ($result[0]["consultations"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) No asistió
                            <input type="radio" name="consultations" <?php if ($result[0]["consultations"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">2) Presento alguna complicación durante su embarazo</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Amenaza de aborto
                            <input type="radio" name="pregnancy_complication" <?php if ($result[0]["pregnancy_complication"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Preclampsia (Presión arterial alta)
                            <input type="radio" name="pregnancy_complication" <?php if ($result[0]["pregnancy_complication"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Eclampsia
                            <input type="radio" name="pregnancy_complication" <?php if ($result[0]["pregnancy_complication"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Diabetes gestacional
                            <input type="radio" name="pregnancy_complication" <?php if ($result[0]["pregnancy_complication"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Amenaza de parto pretérmino
                            <input type="radio" name="pregnancy_complication" <?php if ($result[0]["pregnancy_complication"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">3) Tipo de resolución de embarazo</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Parto
                            <input type="radio" name="pregnancy_resolution" <?php if ($result[0]["pregnancy_resolution"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Cesárea
                            <input type="radio" name="pregnancy_resolution" <?php if ($result[0]["pregnancy_resolution"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="pregnancy_resolution_desc" class="text-royal-blue bold-font float-left custom-form-label-element">Mencione el motivo de la cesárea</label>
                            <input type="text" class="form-control custom-input" name="pregnancy_resolution_desc" value="<?php echo utf8_encode($result[0]["pregnancy_resolution_desc"]); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">4) Cuanto duro su embarazo</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) < de 7 meses
                            <input type="radio" name="pregnancy_duration" <?php if ($result[0]["pregnancy_duration"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 8-9 meses
                            <input type="radio" name="pregnancy_duration" <?php if ($result[0]["pregnancy_duration"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) > 9 meses
                            <input type="radio" name="pregnancy_duration" <?php if ($result[0]["pregnancy_duration"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">5) Cual fue el peso de su hijo al nacer en gramos</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) < de 2500 gramos
                            <input type="radio" name="baby_weight" <?php if ($result[0]["baby_weight"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 2500-3000 gramos
                            <input type="radio" name="baby_weight" <?php if ($result[0]["baby_weight"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) > 4000 gramos
                            <input type="radio" name="baby_weight" <?php if ($result[0]["baby_weight"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">6) Que tipo de lactancia tuvo su bebe</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Materna exclusiva (solo pecho)
                            <input type="radio" name="lactation_type" <?php if ($result[0]["lactation_type"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Fórmula láctea
                            <input type="radio" name="lactation_type" <?php if ($result[0]["lactation_type"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Mixta (materna y fórmula)
                            <input type="radio" name="lactation_type" <?php if ($result[0]["lactation_type"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="lactation_desc" class="text-royal-blue bold-font float-left custom-form-label-element">Mencione la fórmula</label>
                            <input type="text" class="form-control custom-input" name="lactation_desc" value="<?php echo utf8_encode($result[0]["lactation_desc"]); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">7) En caso de lactancia materna exclusiva, cuanto tiempo duro la etapa</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) < de 3 meses
                            <input type="radio" name="lactation_duration" <?php if ($result[0]["lactation_duration"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 4-6 meses
                            <input type="radio" name="lactation_duration" <?php if ($result[0]["lactation_duration"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) > de 6 meses
                            <input type="radio" name="lactation_duration" <?php if ($result[0]["lactation_duration"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">8) En caso de presentar alergia seleccione y especifique cual</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Lácteos
                            <input type="radio" name="baby_allergy" <?php if ($result[0]["baby_allergy"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Alimentos de origen animal
                            <input type="radio" name="baby_allergy" <?php if ($result[0]["baby_allergy"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Vegetales (frutas y verduras)
                            <input type="radio" name="baby_allergy" <?php if ($result[0]["baby_allergy"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Cereales
                            <input type="radio" name="baby_allergy" <?php if ($result[0]["baby_allergy"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Azúcares
                            <input type="radio" name="baby_allergy" <?php if ($result[0]["baby_allergy"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">9) Se realizó tamiz neonatal</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="tamiz_neonatal" <?php if ($result[0]["tamiz_neonatal"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="tamiz_neonatal" <?php if ($result[0]["tamiz_neonatal"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tamiz_neonatal_desc" class="text-royal-blue bold-font float-left custom-form-label-element">Mencione el resultado</label>
                            <input type="text" class="form-control custom-input" name="tamiz_neonatal_desc" value="<?php echo utf8_encode($result[0]["tamiz_neonatal_desc"]); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row pt-4">
                    <div class="col-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">Edad (meses)</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue bold-font custom-form-label-element">Actividad</span>
                    </div>
                    <div class="col-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">Si</span>
                    </div>
                    <div class="col-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">No</span>
                    </div>
                    <div class="col-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">No aplica</span>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">1</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Sigue la luz</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_one" <?php if ($result[0]["table_one"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_one" <?php if ($result[0]["table_one"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_one" <?php if ($result[0]["table_one"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Distingue a la madre</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_two" <?php if ($result[0]["table_two"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_two" <?php if ($result[0]["table_two"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_two" <?php if ($result[0]["table_two"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">2</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Sonrie</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_three" <?php if ($result[0]["table_three"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_three" <?php if ($result[0]["table_three"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_three" <?php if ($result[0]["table_three"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Junta las manos</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_four" <?php if ($result[0]["table_four"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_four" <?php if ($result[0]["table_four"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_four" <?php if ($result[0]["table_four"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">3</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Sostiene la cabeza</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_five" <?php if ($result[0]["table_five"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_five" <?php if ($result[0]["table_five"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_five" <?php if ($result[0]["table_five"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">4</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Lleva objetos a la boca</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_six" <?php if ($result[0]["table_six"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_six" <?php if ($result[0]["table_six"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_six" <?php if ($result[0]["table_six"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">5</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Gira sobre su abdomén</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_seven" <?php if ($result[0]["table_seven"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_seven" <?php if ($result[0]["table_seven"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_seven" <?php if ($result[0]["table_seven"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">6</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Se sostiene sentado</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eight" <?php if ($result[0]["table_eight"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eight" <?php if ($result[0]["table_eight"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eight" <?php if ($result[0]["table_eight"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Balbucea</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_nine" <?php if ($result[0]["table_nine"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_nine" <?php if ($result[0]["table_nine"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_nine" <?php if ($result[0]["table_nine"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">7</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Sostiene cuchara, sonajas</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_ten" <?php if ($result[0]["table_ten"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_ten" <?php if ($result[0]["table_ten"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_ten" <?php if ($result[0]["table_ten"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Dice monosílabos (Ma, Pa)</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eleven" <?php if ($result[0]["table_eleven"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eleven" <?php if ($result[0]["table_eleven"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eleven" <?php if ($result[0]["table_eleven"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">8</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Toma objetos con índice y pulgar</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twelve" <?php if ($result[0]["table_twelve"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twelve" <?php if ($result[0]["table_twelve"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twelve" <?php if ($result[0]["table_twelve"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">9</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Se sienta solo</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_thirteen" <?php if ($result[0]["table_thirteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_thirteen" <?php if ($result[0]["table_thirteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_thirteen" <?php if ($result[0]["table_thirteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">10</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Gatea</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fourteen" <?php if ($result[0]["table_fourteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fourteen" <?php if ($result[0]["table_fourteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fourteen" <?php if ($result[0]["table_fourteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">11</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Se sostiene o da pasos con ayuda</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fifteen" <?php if ($result[0]["table_fifteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fifteen" <?php if ($result[0]["table_fifteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fifteen" <?php if ($result[0]["table_fifteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">12</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Camina</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_sixteen" <?php if ($result[0]["table_sixteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_sixteen" <?php if ($result[0]["table_sixteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_sixteen" <?php if ($result[0]["table_sixteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-3 offset-md-2 offset-sm-2 col-12 col-sm-8 col-md-8 col-lg-6 vertical-margin-bottom mt-5">
                <center>
                    <button class="btn my-2 my-sm-0 custom-btn-save" type="submit">
                        <span class="text-white bold-font custom-btn-save-text">Guardar</span>
                    </button>
                </center>
            </div>

        </div>

    </div>
</body>

</html>