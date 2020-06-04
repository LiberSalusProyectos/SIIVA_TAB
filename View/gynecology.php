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
            $realized = saveGynecologyData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveGynecologyData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=gynecology'); exit;
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
    <script>
        $(document).ready(function () {
            var date_input = $('.date'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'yyyy-mm-dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
                language: 'es',
            };
            date_input.datepicker(options);
        })
    </script>
</head>

<body id="bootstrap_overrides">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <?php include("navigator.php"); ?>
    <div class="container-fluid">

        <div class="row custom-vertical-padding">
            <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
                <button class="btn my-2 my-sm-0 custom-btn-disabled" type="submit">
                    <span>
                        <i class="fas fa-venus custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo GYNECOLOGY_NAME; ?></h4>
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
                <div class="row">
                    <div class="col-12 text-center">
                        <span class="text-royal-blue bold-font custom-form-label-element">
                            ATENCIÓN MÉDICA
                        </span>
                    </div>
                    <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>1. </strong>FUMARATO FERROSO
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Antes del embarazo
                                <input type="checkbox" <?php if ($result[0]["ferrous_fumarate_a"]!=0)  { echo 'checked="true"'; } ?> name="ferrous_fumarate_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) 1er Trimestre
                                <input type="checkbox" <?php if ($result[0]["ferrous_fumarate_b"]!=0)  { echo 'checked="true"'; } ?> name="ferrous_fumarate_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) 2do Trimestre
                                <input type="checkbox" <?php if ($result[0]["ferrous_fumarate_c"]!=0)  { echo 'checked="true"'; } ?> name="ferrous_fumarate_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) 3er Trimestre
                                <input type="checkbox" <?php if ($result[0]["ferrous_fumarate_d"]!=0)  { echo 'checked="true"'; } ?> name="ferrous_fumarate_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>2. </strong>ÁCIDO FOLICO
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Antes del embarazo
                                <input type="checkbox" <?php if ($result[0]["folic_acid_a"]!=0)  { echo 'checked="true"'; } ?> name="folic_acid_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) 1er Trimestre
                                <input type="checkbox" <?php if ($result[0]["folic_acid_b"]!=0)  { echo 'checked="true"'; } ?> name="folic_acid_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) 2do Trimestre
                                <input type="checkbox" <?php if ($result[0]["folic_acid_c"]!=0)  { echo 'checked="true"'; } ?> name="folic_acid_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) 3er Trimestre
                                <input type="checkbox" <?php if ($result[0]["folic_acid_d"]!=0)  { echo 'checked="true"'; } ?> name="folic_acid_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>3. </strong>MULTIVITAMINICOS
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Antes del embarazo
                                <input type="checkbox" <?php if ($result[0]["multivitamins_a"]!=0)  { echo 'checked="true"'; } ?> name="multivitamins_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) 1er Trimestre
                                <input type="checkbox" <?php if ($result[0]["multivitamins_b"]!=0)  { echo 'checked="true"'; } ?> name="multivitamins_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) 2do Trimestre
                                <input type="checkbox" <?php if ($result[0]["multivitamins_c"]!=0)  { echo 'checked="true"'; } ?> name="multivitamins_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) 3er Trimestre
                                <input type="checkbox" <?php if ($result[0]["multivitamins_d"]!=0)  { echo 'checked="true"'; } ?> name="multivitamins_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>4. </strong>PRUEBA DE VIH
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Antes del embarazo
                                <input type="checkbox" <?php if ($result[0]["hiv_test_a"]!=0)  { echo 'checked="true"'; } ?> name="hiv_test_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) 1er Trimestre
                                <input type="checkbox" <?php if ($result[0]["hiv_test_b"]!=0)  { echo 'checked="true"'; } ?> name="hiv_test_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) 2do Trimestre
                                <input type="checkbox" <?php if ($result[0]["hiv_test_c"]!=0)  { echo 'checked="true"'; } ?> name="hiv_test_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) 3er Trimestre
                                <input type="checkbox" <?php if ($result[0]["hiv_test_d"]!=0)  { echo 'checked="true"'; } ?> name="hiv_test_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>5. </strong>PRUEBA DE SIFILIS
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Antes del embarazo
                                <input type="checkbox" <?php if ($result[0]["syphilis_test_a"]!=0)  { echo 'checked="true"'; } ?> name="syphilis_test_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) 1er Trimestre
                                <input type="checkbox" <?php if ($result[0]["syphilis_test_b"]!=0)  { echo 'checked="true"'; } ?> name="syphilis_test_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) 2do Trimestre
                                <input type="checkbox" <?php if ($result[0]["syphilis_test_c"]!=0)  { echo 'checked="true"'; } ?> name="syphilis_test_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) 3er Trimestre
                                <input type="checkbox" <?php if ($result[0]["syphilis_test_d"]!=0)  { echo 'checked="true"'; } ?> name="syphilis_test_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>6. </strong>PLATICAS DE CUIDADO DE RECIEN NACIDO
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Antes del embarazo
                                <input type="checkbox" <?php if ($result[0]["newborn_care_a"]!=0)  { echo 'checked="true"'; } ?> name="newborn_care_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) 1er Trimestre
                                <input type="checkbox" <?php if ($result[0]["newborn_care_b"]!=0)  { echo 'checked="true"'; } ?> name="newborn_care_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) 2do Trimestre
                                <input type="checkbox" <?php if ($result[0]["newborn_care_c"]!=0)  { echo 'checked="true"'; } ?> name="newborn_care_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) 3er Trimestre
                                <input type="checkbox" <?php if ($result[0]["newborn_care_d"]!=0)  { echo 'checked="true"'; } ?> name="newborn_care_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>7. </strong>PLATICAS PARA AMAMANTAR
                        </span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Antes del embarazo
                                <input type="checkbox" <?php if ($result[0]["breast_feed_a"]!=0)  { echo 'checked="true"'; } ?> name="breast_feed_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) 1er Trimestre
                                <input type="checkbox" <?php if ($result[0]["breast_feed_b"]!=0)  { echo 'checked="true"'; } ?> name="breast_feed_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) 2do Trimestre
                                <input type="checkbox" <?php if ($result[0]["breast_feed_c"]!=0)  { echo 'checked="true"'; } ?> name="breast_feed_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) 3er Trimestre
                                <input type="checkbox" <?php if ($result[0]["breast_feed_d"]!=0)  { echo 'checked="true"'; } ?> name="breast_feed_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mt-2 text-center">
                        <span class="text-royal-blue bold-font custom-form-label-element">
                            PLANIFICACIÓN FAMILIAR
                        </span>
                    </div>
                    <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>8. </strong>¿Edad ideal para casarse?</label>
                            <input type="text" class="form-control custom-input" name="get_married" value="<?php echo utf8_encode($result[0]["get_married"]); ?>" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>9. </strong>¿Número de hijos que planea tener?</label>
                            <input type="text" class="form-control custom-input" name="children_plan" value="<?php echo utf8_encode($result[0]["children_plan"]); ?>" />
                        </div>
                    </div>

                    <div class="col-xl-5">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>10. </strong>¿Número de hijos actualmente?</label>
                            <input type="text" class="form-control custom-input" name="children_current" value="<?php echo utf8_encode($result[0]["children_current"]); ?>" />
                        </div>
                    </div>

                    <div class="col-xl-7">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>11. </strong>¿Conoce algún método de planificación familiar? ¿Cuál?</label>
                            <input type="text" class="form-control custom-input" name="planning_method" value="<?php echo utf8_encode($result[0]["planning_method"]); ?>" />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font"><strong>12. </strong>¿Cuenta con alguién para llevarla al médico en caso de urgencia?
                                <input type="checkbox" <?php if ($result[0]["transporter"]!=0)  { echo 'checked="true"'; } ?> name="transporter" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">PARENTESCO</label>
                            <input type="text" class="form-control custom-input" name="relationship" value="<?php echo utf8_encode($result[0]["relationship"]); ?>" />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font"><strong>13. </strong>¿Cuenta con transporte para trasladarse al médico?
                                <input type="checkbox" <?php if ($result[0]["transport"]!=0)  { echo 'checked="true"'; } ?> name="transport" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6 mt-2">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">TIPO DE VEHÍCULO</label>
                            <input type="text" class="form-control custom-input" name="vehicle_type" value="<?php echo utf8_encode($result[0]["vehicle_type"]); ?>" />
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>14. </strong>¿Ante una urgencia que servicio médico usa por lo regular?</label>
                            <input type="text" class="form-control custom-input" name="medical_service" value="<?php echo utf8_encode($result[0]["medical_service"]); ?>" />
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>15. </strong>¿Cuantas consultas realiza al año para odontología?</label>
                            <input type="text" class="form-control custom-input" name="odontology" value="<?php echo utf8_encode($result[0]["odontology"]); ?>" />
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 mt-2 text-center">
                        <span class="text-royal-blue bold-font custom-form-label-element">
                            ANTECEDENTE GINECO-OBSTÉTRICO
                        </span>
                    </div>
                    <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>16. </strong>FUR</label>
                            <input type="text" class="form-control custom-input" name="fur" value="<?php echo utf8_encode($result[0]["fur"]); ?>" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>17. </strong>IVSA</label>
                            <input type="text" class="form-control custom-input" name="ivsa" value="<?php echo utf8_encode($result[0]["ivsa"]); ?>" />
                        </div>
                    </div>

                    <div class="col-12 mt-2 mb-2">
                        <label class="text-royal-blue regular-font"><strong>18. </strong>Número de embarazos</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-royal-blue regular-font">Parto</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control custom-input" name="childbirth" value="<?php echo utf8_encode($result[0]["childbirth"]); ?>" min="0" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-royal-blue regular-font">Cesarea</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control custom-input" name="caesarean" value="<?php echo utf8_encode($result[0]["caesarean"]); ?>" min="0" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-royal-blue regular-font">Abortos</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control custom-input" name="abortion" value="<?php echo utf8_encode($result[0]["abortion"]); ?>" min="0" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2 mb-2">
                        <label class="text-royal-blue regular-font"><strong>19. </strong>Hijos Vivos/Muertos</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Vivos</label>
                            <input type="number" class="form-control custom-input" name="children_live" value="<?php echo utf8_encode($result[0]["children_live"]); ?>" min="0" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Muertos</label>
                            <input type="number" class="form-control custom-input" name="children_dead" value="<?php echo utf8_encode($result[0]["children_dead"]); ?>" min="0" />
                        </div>
                    </div>

                    <div class="col-12 mt-2 mb-2">
                        <label class="text-royal-blue regular-font"><strong>20. </strong>Peso al nacer de hijo de</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Menor peso(Kg)</label>
                            <input type="number" class="form-control custom-input" name="min_weight" value="<?php echo utf8_encode($result[0]["min_weight"]); ?>" step="0.1" min="0" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Mayor peso(Kg)</label>
                            <input type="number" class="form-control custom-input" name="max_weight" value="<?php echo utf8_encode($result[0]["max_weight"]); ?>" step="0.1" min="0" />
                        </div>
                    </div>

                    <div class="col-12 mt-2 mb-2">
                        <label class="text-royal-blue regular-font"><strong>21. </strong>Autoexploración mamaria</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Hallazgo manual</label>
                            <input type="text" class="form-control custom-input" name="self_manual" value="<?php echo utf8_encode($result[0]["self_manual"]); ?>" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Hallazgo imagen</label>
                            <input type="text" class="form-control custom-input" name="self_image" value="<?php echo utf8_encode($result[0]["self_image"]); ?>" />
                        </div>
                    </div>

                    <div class="col-12 mt-2 mb-2">
                        <label class="text-royal-blue regular-font"><strong>22. </strong>Exploración mamaria en unidad de salud</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Hallazgo manual</label>
                            <input type="text" class="form-control custom-input" name="exam_manual" value="<?php echo utf8_encode($result[0]["exam_manual"]); ?>" />
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Hallazgo imagen</label>
                            <input type="text" class="form-control custom-input" name="exam_image" value="<?php echo utf8_encode($result[0]["exam_image"]); ?>" />
                        </div>
                    </div>

                    <label class="col-sm-4 col-form-label text-royal-blue regular-font"><strong>23. </strong>Inicio de menopausia(edad)</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control custom-input" name="menopausia" value="<?php echo utf8_encode($result[0]["menopausia"]); ?>" />
                    </div>

                    <div class="col-12 mt-2 mt-2">
                        <label class="text-royal-blue regular-font"><strong>24. </strong>Mastografía</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-royal-blue regular-font">Fecha</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $result[0]["mammography_date"]; ?>" class="form-control custom-input date" name="mammography_date" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-royal-blue regular-font">Resultado</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control custom-input" name="mammography_result" value="<?php echo utf8_encode($result[0]["mammography_result"]); ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2 mt-2">
                        <label class="text-royal-blue regular-font"><strong>25. </strong>Densitometría</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-royal-blue regular-font">Fecha</label>
                            <div class="col-sm-9">
                                <input value="<?php echo $result[0]["densitometry_date"]; ?>" class="form-control custom-input date" name="densitometry_date" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label text-royal-blue regular-font">Resultado</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control custom-input" name="densitometry_result" value="<?php echo utf8_encode($result[0]["densitometry_result"]); ?>" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-3 offset-md-2 offset-sm-2 col-12 col-sm-8 col-md-8 col-lg-6 vertical-margin-bottom mt-4">
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