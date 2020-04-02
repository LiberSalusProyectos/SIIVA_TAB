<?php include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header_references_auth.php");

    if ($_SESSION['id_role'] > 3) {
        header('Location: error.php');
        exit();
    }

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
            $realized = saveVitalSignData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveVitalSignData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=vitalSign'); exit;
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
                        <i class="fas fa-stethoscope custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo VITAL_SIGN_NAME; ?></h4>
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
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-5 text-center">
                        <span class="text-royal-blue bold-font custom-form-label-element">
                            SIGNOS VITALES Y SMATOMETRÍA
                        </span>
                    </div>
                    <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="blood_pressure" class="text-royal-blue bold-font float-left custom-form-label-element">1) Presión arterial</label>
                            <input type="text" class="form-control custom-input" name="blood_pressure" value="<?php echo utf8_encode($result[0]["blood_pressure"]); ?>" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="heart_rate" class="text-royal-blue bold-font float-left custom-form-label-element">2) Frecuencia cardiaca</label>
                            <input type="number" class="form-control custom-input" name="heart_rate" value="<?php echo utf8_encode($result[0]["heart_rate"]); ?>" min="0" step="1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="breathe_rate" class="text-royal-blue bold-font float-left custom-form-label-element">3) Frecuencia respiratoria</label>
                            <input type="number" class="form-control custom-input" name="breathe_rate" value="<?php echo utf8_encode($result[0]["breathe_rate"]); ?>" min="0" step="1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="temperature" class="text-royal-blue bold-font float-left custom-form-label-element">4) Temperatura</label>
                            <input type="number" class="form-control custom-input" name="temperature" value="<?php echo utf8_encode($result[0]["temperature"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="glucose" class="text-royal-blue bold-font float-left custom-form-label-element">5) Glucosa</label>
                            <input type="number" class="form-control custom-input" name="glucose" value="<?php echo utf8_encode($result[0]["glucose"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="weight" class="text-royal-blue bold-font float-left custom-form-label-element">6) Peso</label>
                            <input type="number" class="form-control custom-input" name="weight" value="<?php echo utf8_encode($result[0]["weight"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="height" class="text-royal-blue bold-font float-left custom-form-label-element">7) Talla</label>
                            <input type="number" class="form-control custom-input" name="height" value="<?php echo utf8_encode($result[0]["height"]); ?>"  min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="body_mass" class="text-royal-blue bold-font float-left custom-form-label-element">8) IMC</label>
                            <input type="number" class="form-control custom-input" name="body_mass" value="<?php echo utf8_encode($result[0]["body_mass"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="body_fat" class="text-royal-blue bold-font float-left custom-form-label-element">9) % Grasa corporal</label>
                            <input type="number" class="form-control custom-input" name="body_fat" value="<?php echo utf8_encode($result[0]["body_fat"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="arm_perimeter" class="text-royal-blue bold-font float-left custom-form-label-element">10) Perímetro de brazo</label>
                            <input type="number" class="form-control custom-input" name="arm_perimeter" value="<?php echo utf8_encode($result[0]["arm_perimeter"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="abdomen_perimeter" class="text-royal-blue bold-font float-left custom-form-label-element">11) Perímetro de abdomen</label>
                            <input type="number" class="form-control custom-input" name="abdomen_perimeter" value="<?php echo utf8_encode($result[0]["abdomen_perimeter"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="capillary_refill" class="text-royal-blue bold-font float-left custom-form-label-element">12) Llenado cápilar</label>
                            <input type="number" class="form-control custom-input" name="capillary_refill" value="<?php echo utf8_encode($result[0]["capillary_refill"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="saturation" class="text-royal-blue bold-font float-left custom-form-label-element">13) Saturación</label>
                            <input type="number" class="form-control custom-input" name="saturation" value="<?php echo utf8_encode($result[0]["saturation"]); ?>" min="0" step="1" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                        <span class="text-royal-blue bold-font custom-form-label-element">
                            ESTUDIOS DE LABORATORIO
                        </span>
                    </div>
                    <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="glycated_hemoglobin" class="text-royal-blue bold-font float-left custom-form-label-element">1) Hemoglobina glucosilada</label>
                            <input type="number" class="form-control custom-input" name="glycated_hemoglobin" value="<?php echo utf8_encode($result[0]["glycated_hemoglobin"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="glucose_lab" class="text-royal-blue bold-font float-left custom-form-label-element">2) Glucosa</label>
                            <input type="number" class="form-control custom-input" name="glucose_lab" value="<?php echo utf8_encode($result[0]["glucose_lab"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="creatinine" class="text-royal-blue bold-font float-left custom-form-label-element">3) Creatinina</label>
                            <input type="number" class="form-control custom-input" name="creatinine" value="<?php echo utf8_encode($result[0]["creatinine"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="cholesterol" class="text-royal-blue bold-font float-left custom-form-label-element">4) Colesterol</label>
                            <input type="number" class="form-control custom-input" name="cholesterol" value="<?php echo utf8_encode($result[0]["cholesterol"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="triglycerides" class="text-royal-blue bold-font float-left custom-form-label-element">5) Trigliceridos</label>
                            <input type="number" class="form-control custom-input" name="triglycerides" value="<?php echo utf8_encode($result[0]["triglycerides"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label for="prostatic_antigen" class="text-royal-blue bold-font float-left custom-form-label-element">6) Antígeno prostático</label>
                            <input type="number" class="form-control custom-input" name="prostatic_antigen" value="<?php echo utf8_encode($result[0]["prostatic_antigen"]); ?>" min="0" step="0.1" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">7) Prueba de VIH
                                <input type="checkbox" <?php if ($result[0]["sida"]!=0)  { echo 'checked="true"'; } ?> name="sida" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">8) Prueba de Sífilis
                                <input type="checkbox" <?php if ($result[0]["syphilis"]!=0)  { echo 'checked="true"'; } ?> name="syphilis" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
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