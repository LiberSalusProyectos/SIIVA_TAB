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
            $realized = saveFamilyRecordData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveFamilyRecordData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=familyRecord'); exit;
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
                        <i class="fas fa-users custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo FAMILY_RECORD_NAME; ?></h4>
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

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-3 mb-3">
                    <div class="col-12">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">1) Lugar de nacimiento</span>
                    </div>

                    <div class="col-12 col-sm-12 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="birth_state" placeholder="Estado" />
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="birth_place" placeholder="Localidad" />
                        </div>
                    </div>

                    <div class="col-12">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">2) Lugar de residencia</span>
                    </div>

                    <div class="col-12 col-sm-12 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="residence_state" placeholder="Estado" />
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="residence_place" placeholder="Localidad" />
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">3) Padece o padeció</span>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">Hipertensión arterial
                                <input type="checkbox" <?php if ($result[0]["hypertension"]!=0)  { echo 'checked="true"'; } ?> name="hypertension" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">Diabetes mellitus
                                <input type="checkbox" <?php if ($result[0]["diabetes"]!=0)  { echo 'checked="true"'; } ?> name="diabetes" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-4 ml-5 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">Cardiopatías</span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">a) Infarto agudo al miocardio
                                <input type="checkbox" <?php if ($result[0]["heart_attack"]!=0)  { echo 'checked="true"'; } ?> name="heart_attack" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">b) Arritmias cardiacas
                                <input type="checkbox" <?php if ($result[0]["cardiac_arrhythmia"]!=0)  { echo 'checked="true"'; } ?> name="cardiac_arrhythmia" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">c) Insuficiencia cardiaca
                                <input type="checkbox" <?php if ($result[0]["heart_failure"]!=0)  { echo 'checked="true"'; } ?> name="heart_failure" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">d) Otra
                                <input type="checkbox" <?php if ($result[0]["heart_other"]!=0)  { echo 'checked="true"'; } ?> name="heart_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <!-- <label for="localidad" class="text-royal-blue bold-font float-left custom-form-label-element">d) Otro</label> -->
                            <input type="text" class="form-control custom-input" name="heart_other_desc" placeholder="¿Cuál?" />
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">Asma
                                <input type="checkbox" <?php if ($result[0]["asthma"]!=0)  { echo 'checked="true"'; } ?> name="asthma" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">Obesidad
                                <input type="checkbox" <?php if ($result[0]["obesity"]!=0)  { echo 'checked="true"'; } ?> name="obesity" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">Dislipidemia
                                <input type="checkbox" <?php if ($result[0]["dyslipidemia"]!=0)  { echo 'checked="true"'; } ?> name="dyslipidemia" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-4 ml-5 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">Cancer</span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">a) Mama
                                <input type="checkbox" <?php if ($result[0]["breast_cancer"]!=0)  { echo 'checked="true"'; } ?> name="breast_cancer" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">b) Cérvico-Uterino
                                <input type="checkbox" <?php if ($result[0]["cervical_cancer"]!=0)  { echo 'checked="true"'; } ?> name="cervical_cancer" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">c) Próstata
                                <input type="checkbox" <?php if ($result[0]["prostate_cancer"]!=0)  { echo 'checked="true"'; } ?> name="prostate_cancer" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">d) Leucemia
                                <input type="checkbox" <?php if ($result[0]["leukemia"]!=0)  { echo 'checked="true"'; } ?> name="leukemia" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">e) Otro
                                <input type="checkbox" <?php if ($result[0]["cancer_other"]!=0)  { echo 'checked="true"'; } ?> name="cancer_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <!-- <label for="localidad" class="text-royal-blue bold-font float-left custom-form-label-element">d) Otro</label> -->
                            <input type="text" class="form-control custom-input" name="cancer_other_desc" placeholder="¿Cuál?" />
                        </div>
                    </div>

                    <div class="col-12 mt-4 ml-5 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">Enfermedades Psiquiátricas</span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">a) Ansiedad - Depresión
                                <input type="checkbox" <?php if ($result[0]["anxiety_depression"]!=0)  { echo 'checked="true"'; } ?> name="anxiety_depression" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">b) Trastornos alimenticios
                                <input type="checkbox" <?php if ($result[0]["eating_disorders"]!=0)  { echo 'checked="true"'; } ?> name="eating_disorders" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">c) Esquizofrenia
                                <input type="checkbox" <?php if ($result[0]["schizophrenia"]!=0)  { echo 'checked="true"'; } ?> name="schizophrenia" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">d) Otra
                                <input type="checkbox" <?php if ($result[0]["psychiatric_other"]!=0)  { echo 'checked="true"'; } ?> name="psychiatric_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <!-- <label for="localidad" class="text-royal-blue bold-font float-left custom-form-label-element">d) Otro</label> -->
                            <input type="text" class="form-control custom-input" name="psychiatric_other_desc" placeholder="¿Cuál?" />
                        </div>
                    </div>

                    <div class="col-12 mt-4 ml-5 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">Enfermedades Oculares</span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">a) Glaucoma
                                <input type="checkbox" <?php if ($result[0]["glaucoma"]!=0)  { echo 'checked="true"'; } ?> name="glaucoma" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">b) Ametropias (Miopía e Hipermetropía)
                                <input type="checkbox" <?php if ($result[0]["ametropia"]!=0)  { echo 'checked="true"'; } ?> name="ametropia" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">c) Cataratas
                                <input type="checkbox" <?php if ($result[0]["waterfalls"]!=0)  { echo 'checked="true"'; } ?> name="waterfalls" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">d) Otra
                                <input type="checkbox" <?php if ($result[0]["eye_other"]!=0)  { echo 'checked="true"'; } ?> name="eye_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <!-- <label for="localidad" class="text-royal-blue bold-font float-left custom-form-label-element">d) Otro</label> -->
                            <input type="text" class="form-control custom-input" name="eye_other_desc" placeholder="¿Cuál?" />
                        </div>
                    </div>

                    <div class="col-12 mt-4 ml-5 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">Enfermedades Endócrinas</span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">a) Hipertiroidismo
                                <input type="checkbox" <?php if ($result[0]["hyperthyroidism"]!=0)  { echo 'checked="true"'; } ?> name="hyperthyroidism" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">b) Hipotiroidismo
                                <input type="checkbox" <?php if ($result[0]["hypothyroidism"]!=0)  { echo 'checked="true"'; } ?> name="hypothyroidism" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">c) Enfermedad de Cushing
                                <input type="checkbox" <?php if ($result[0]["cushing"]!=0)  { echo 'checked="true"'; } ?> name="cushing" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">d) Otra
                                <input type="checkbox" <?php if ($result[0]["endocrine_other"]!=0)  { echo 'checked="true"'; } ?> name="endocrine_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <!-- <label for="localidad" class="text-royal-blue bold-font float-left custom-form-label-element">d) Otro</label> -->
                            <input type="text" class="form-control custom-input" name="endocrine_other_desc" placeholder="¿Cuál?" />
                        </div>
                    </div>

                    <div class="col-12 mt-4 ml-5 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">Enfermedades Gineco-Obstétrico</span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">a) Preeclampsia y Eclampsia
                                <input type="checkbox" <?php if ($result[0]["preeclampsia"]!=0)  { echo 'checked="true"'; } ?> name="preeclampsia" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">b) Síndrome de Ovario Poliquístico
                                <input type="checkbox" <?php if ($result[0]["cystic_ovary"]!=0)  { echo 'checked="true"'; } ?> name="cystic_ovary" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">c) Diabetes Gestacional
                                <input type="checkbox" <?php if ($result[0]["gestational_diabetes"]!=0)  { echo 'checked="true"'; } ?> name="gestational_diabetes" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">d) Otra
                                <input type="checkbox" <?php if ($result[0]["gynecological_other"]!=0)  { echo 'checked="true"'; } ?> name="gynecological_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <!-- <label for="localidad" class="text-royal-blue bold-font float-left custom-form-label-element">d) Otro</label> -->
                            <input type="text" class="form-control custom-input" name="gynecological_other_desc" placeholder="¿Cuál?" />
                        </div>
                    </div>

                    <div class="col-12 mt-4 ml-5 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">Enfermedades Neurológicas</span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">a) Enfermedad de Parkinson
                                <input type="checkbox" <?php if ($result[0]["parkinson"]!=0)  { echo 'checked="true"'; } ?> name="parkinson" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">b) Epilepsia
                                <input type="checkbox" <?php if ($result[0]["epilepsy"]!=0)  { echo 'checked="true"'; } ?> name="epilepsy" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">c) Enfermedad de Alzheimer
                                <input type="checkbox" <?php if ($result[0]["alzheimer"]!=0)  { echo 'checked="true"'; } ?> name="alzheimer" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">d) Otra
                                <input type="checkbox" <?php if ($result[0]["neurological_other"]!=0)  { echo 'checked="true"'; } ?> name="neurological_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <!-- <label for="localidad" class="text-royal-blue bold-font float-left custom-form-label-element">d) Otro</label> -->
                            <input type="text" class="form-control custom-input" name="neurological_other_desc" placeholder="¿Cuál?" />
                        </div>
                    </div>

                    <div class="col-12 mt-4 ml-5 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">Enfermedades infecto-contagiosas</span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">a) Tuberculosis
                                <input type="checkbox" <?php if ($result[0]["tuberculosis"]!=0)  { echo 'checked="true"'; } ?> name="tuberculosis" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">b) VIH/SIDA
                                <input type="checkbox" <?php if ($result[0]["sida"]!=0)  { echo 'checked="true"'; } ?> name="sida" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">c) Sífilis
                                <input type="checkbox" <?php if ($result[0]["syphilis"]!=0)  { echo 'checked="true"'; } ?> name="syphilis" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">d) Otra
                                <input type="checkbox" <?php if ($result[0]["infectious_other"]!=0)  { echo 'checked="true"'; } ?> name="infectious_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <!-- <label for="localidad" class="text-royal-blue bold-font float-left custom-form-label-element">d) Otro</label> -->
                            <input type="text" class="form-control custom-input" name="infectious_other_desc" placeholder="¿Cuál?" />
                        </div>
                    </div>

                    <div class="col-12 mt-4 ml-5 mb-4">
                       <span class="text-royal-blue bold-font float-left custom-form-label-element">Enfermedades Genéticas</span>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">a) Síndrome de Down
                                <input type="checkbox" <?php if ($result[0]["down_syndrome"]!=0)  { echo 'checked="true"'; } ?> name="down_syndrome" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">b) Cretinismo o Acromegalia (Enanismo o Gigantismo)
                                <input type="checkbox" <?php if ($result[0]["cretinism_acromegaly"]!=0)  { echo 'checked="true"'; } ?> name="cretinism_acromegaly" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">c) Hemofilias
                                <input type="checkbox" <?php if ($result[0]["hemophilia"]!=0)  { echo 'checked="true"'; } ?> name="hemophilia" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4 col-md-5 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue bold-font">d) Otra
                                <input type="checkbox" <?php if ($result[0]["genetic_other"]!=0)  { echo 'checked="true"'; } ?> name="genetic_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <!-- <label for="localidad" class="text-royal-blue bold-font float-left custom-form-label-element">d) Otro</label> -->
                            <input type="text" class="form-control custom-input" name="genetic_other_desc" placeholder="¿Cuál?" />
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="other_diseases" class="text-royal-blue bold-font float-left custom-form-label-element">4) Otras enfermedades</label>
                            <textarea class="form-control custom-textarea" name="other_diseases" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="death_age" class="text-royal-blue bold-font float-left custom-form-label-element">5) Edad de fallecimiento</label>
                            <input type="number" class="form-control custom-input" name="death_age" min="0" />
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="death_cause" class="text-royal-blue bold-font float-left custom-form-label-element">6) Causa de muerte</label>
                            <input type="text" class="form-control custom-input" name="death_cause" />
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label for="observations" class="text-royal-blue bold-font float-left custom-form-label-element">7) Observaciones</label>
                            <textarea class="form-control custom-textarea" name="observations" rows="3"></textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="offset-0 offset-lg-3 offset-md-2 offset-sm-2 col-12 col-sm-8 col-md-8 col-lg-6 vertical-margin-bottom">
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