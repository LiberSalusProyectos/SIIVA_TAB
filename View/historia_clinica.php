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
    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";

    if (sizeof($_POST)>0) {
      $result = getModuleData($linkDB, $_POST["module"], $_POST["id_patient"]);
      //var_dump($result);

      if ($_POST["form_answered"]=="true") {
          if ($result[0]["id_data"] != "") {
            $realized = saveHistoriaClinicaData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveHistoriaClinicaData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=historiaClinica'); exit;
          }
      }

      $result = getModuleData($linkDB, $_POST["module"], $_POST["id_patient"]);
    } else {
      header('Location: home.php'); exit;
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
                        <i class="fas fa-syringe custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward">HISTORIA CLINICA</h4>
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
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center mb-2">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        ANTECEDENTES HEREDADO FAMILIARES
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">DIABETES I</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_diabetes1"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_diabetes1" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_diabetes1"]=="not")  { echo 'checked="true"'; } ?> name="herencia_diabetes1" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_diabetes1_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_diabetes1_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_diabetes1_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_diabetes1_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_diabetes1_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_diabetes1_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">DIABETES II</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_diabetes2"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_diabetes2" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_diabetes2"]=="not")  { echo 'checked="true"'; } ?> name="herencia_diabetes2" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_diabetes2_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_diabetes2_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_diabetes2_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_diabetes2_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_diabetes2_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_diabetes2_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">CARDIOPATÍA</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_cardipatia"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_cardipatia" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_cardipatia"]=="not")  { echo 'checked="true"'; } ?> name="herencia_cardipatia" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_cardipatia_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cardipatia_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_cardipatia_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cardipatia_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_cardipatia_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cardipatia_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">CÁNCER MAMA</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_cancer_mama"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_cancer_mama" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_cancer_mama"]=="not")  { echo 'checked="true"'; } ?> name="herencia_cancer_mama" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_mama_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_mama_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_mama_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_mama_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_mama_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_mama_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">CÁNCER
                            PROSTATA</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_cancer_prostata"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_cancer_prostata" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_cancer_prostata"]=="not")  { echo 'checked="true"'; } ?> name="herencia_cancer_prostata" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_prostata_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_prostata_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_prostata_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_prostata_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_prostata_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_prostata_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">CÁNCER
                            CERVICOUTRINO</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_cancer_cervico"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_cancer_cervico" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_cancer_cervico"]=="not")  { echo 'checked="true"'; } ?> name="herencia_cancer_cervico" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_cervico_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_cervico_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_cervico_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_cervico_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_cervico_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_cervico_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">CÁNCER OTRO
                            (gástrico, páncreas, pulmón, tiroides, suprarrenal, piel, neurológico)</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_cancer_otro"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_cancer_otro" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_cancer_otro"]=="not")  { echo 'checked="true"'; } ?> name="herencia_cancer_otro" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_otro_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_otro_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_otro_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_otro_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_cancer_otro_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_cancer_otro_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">ANTECEDENTES
                            PSIQUIÁTRICOS (depresión, demencia, esquizofrenia)</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_psiquiatrico"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_psiquiatrico" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_psiquiatrico"]=="not")  { echo 'checked="true"'; } ?> name="herencia_psiquiatrico" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_psiquiatrico_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_psiquiatrico_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_psiquiatrico_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_psiquiatrico_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_psiquiatrico_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_psiquiatrico_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">GLAUCOMA</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_glaucoma"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_glaucoma" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_glaucoma"]=="not")  { echo 'checked="true"'; } ?> name="herencia_glaucoma" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_glaucoma_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_glaucoma_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_glaucoma_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_glaucoma_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_glaucoma_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_glaucoma_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">ALERGIAS (asma,
                            rinitis, alimentos, polen)</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_alergia"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_alergia" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_alergia"]=="not")  { echo 'checked="true"'; } ?> name="herencia_alergia" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_alergia_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_alergia_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_alergia_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_alergia_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_alergia_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_alergia_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">GINECOOBSTRETICOS
                            (preclamsia, útero, cérvix)</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_gineco"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_gineco" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_gineco"]=="not")  { echo 'checked="true"'; } ?> name="herencia_gineco" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_gineco_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_gineco_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_gineco_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_gineco_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_gineco_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_gineco_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">GENÉTICO
                            (galactosemia, hipotiroidismo, glucosa-6-fosfato, fibrosis quística, neurofibromatosis,
                            glaucoma, fenilcetonuria, hiperplasia, suprarrenal, Alzheimer, Parkinson)</span>
                    </div>
                    <div class="offset-4 col-4 offset-sm-0 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["herencia_genetico"]=="yes")  { echo 'checked="true"'; } ?> name="herencia_genetico" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["herencia_genetico"]=="not")  { echo 'checked="true"'; } ?> name="herencia_genetico" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Madre
                                <input type="checkbox" <?php if ($result[0]["herencia_genetico_mother"]!=0)  { echo 'checked="true"'; } ?> name="herencia_genetico_mother" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Padre
                                <input type="checkbox" <?php if ($result[0]["herencia_genetico_father"]!=0)  { echo 'checked="true"'; } ?> name="herencia_genetico_father" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="checktainer regular-font text-royal-blue">Otro
                                <input type="checkbox" <?php if ($result[0]["herencia_genetico_other"]!=0)  { echo 'checked="true"'; } ?> name="herencia_genetico_other" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center mb-2">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        ANTECEDENTES PATOLÓGICOS
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">VECTOR (dengue, chikungunya, zika, garrapata)</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_vector"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_vector" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_vector"]=="not")  { echo 'checked="true"'; } ?> name="patologico_vector" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_vector_familiar"]); ?>" class="form-control custom-input" name="patologico_vector_familiar" placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">TUBERCULOSIS</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_tuberculosis"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_tuberculosis" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_tuberculosis"]=="not")  { echo 'checked="true"'; } ?> name="patologico_tuberculosis" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_tuberculosis_familiar"]); ?>" class="form-control custom-input" name="patologico_tuberculosis_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">ALRGIA/ASMA</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_asma"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_asma" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_asma"]=="not")  { echo 'checked="true"'; } ?> name="patologico_asma" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_asma_familiar"]); ?>" class="form-control custom-input" name="patologico_asma_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">INFLUENZA</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_influenza"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_influenza" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_influenza"]=="not")  { echo 'checked="true"'; } ?> name="patologico_influenza" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_influenza_familiar"]); ?>" class="form-control custom-input" name="patologico_influenza_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">VIH/SIDA</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_vih"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_vih" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_vih"]=="not")  { echo 'checked="true"'; } ?> name="patologico_vih" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_vih_familiar"]); ?>" class="form-control custom-input" name="patologico_vih_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">ETS (sífilis, chancro ,VIH, SIDA, gonorrea, herpes genital)</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_ets"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_ets" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_ets"]=="not")  { echo 'checked="true"'; } ?> name="patologico_ets" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_ets_familiar"]); ?>" class="form-control custom-input" name="patologico_ets_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">EXANTEMATICA (rubeola, Kawasaki escarlata, Eritema infeccioso, sarampión, exantema súbito, mononucleosis, purpura, varicela, sx. piemanicoba, Lyme)</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_exantematica"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_exantematica" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_exantematica"]=="not")  { echo 'checked="true"'; } ?> name="patologico_exantematica" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_exantematica_familiar"]); ?>" class="form-control custom-input" name="patologico_exantematica_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">CÁNCER</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_cancer"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_cancer" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_cancer"]=="not")  { echo 'checked="true"'; } ?> name="patologico_cancer" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_cancer_familiar"]); ?>" class="form-control custom-input" name="patologico_cancer_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">SISTÉMICA (dermatitis, renal, pulmonar, tiroides, suprarrenal, artritis)</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_sistemica"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_sistemica" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_sistemica"]=="not")  { echo 'checked="true"'; } ?> name="patologico_sistemica" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_sistemica_familiar"]); ?>" class="form-control custom-input" name="patologico_sistemica_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">CARDIOPATÍA</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_cardiopatia"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_cardiopatia" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_cardiopatia"]=="not")  { echo 'checked="true"'; } ?> name="patologico_cardiopatia" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_cardiopatia_familiar"]); ?>" class="form-control custom-input" name="patologico_cardiopatia_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">ANTECEDENTES PSIQUIÁTRICOS</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_psiquiatrico"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_psiquiatrico" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_psiquiatrico"]=="not")  { echo 'checked="true"'; } ?> name="patologico_psiquiatrico" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_psiquiatrico_familiar"]); ?>" class="form-control custom-input" name="patologico_psiquiatrico_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">NEUROLOGÍCO (Parkinson, Alzheimer)</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_neurologico"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_neurologico" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_neurologico"]=="not")  { echo 'checked="true"'; } ?> name="patologico_neurologico" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_neurologico_familiar"]); ?>" class="form-control custom-input" name="patologico_neurologico_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8 col-xl-7 mb-2">
                        <span class="text-royal-blue bold-font float-left custom-form-label-element">OFTALMOLOGICA</span>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">Si
                                <input type="radio" <?php if ($result[0]["patologico_oftalmologico"]=="yes")  { echo 'checked="true"'; } ?> name="patologico_oftalmologico" value="yes" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                        <div class="form-group">
                            <label class="container regular-font text-royal-blue">No
                                <input type="radio" <?php if ($result[0]["patologico_oftalmologico"]=="not")  { echo 'checked="true"'; } ?> name="patologico_oftalmologico" value="not" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-3">
                        <div class="form-group">
                            <input type="text" value="<?php echo utf8_encode($result[0]["patologico_oftalmologico_familiar"]); ?>" class="form-control custom-input" name="patologico_oftalmologico_familiar"
                                placeholder="¿Cual familiar?" />
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center mb-2">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        ANTECEDENTES GINECO OBSTÉTRICOS
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Inicio de menstruación</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_inicio_menstruacion"]); ?>" class="form-control custom-input" name="gineco_inicio_menstruacion" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Crecimiento de mamas</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_crecimiento_mamas"]); ?>" class="form-control custom-input" name="gineco_crecimiento_mamas" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Inicio vida sexual activa</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_inicio_vidasexual"]); ?>" class="form-control custom-input" name="gineco_inicio_vidasexual" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Núm. embarazos</label>
                            <input type="number" value="<?php echo $result[0]["gineco_embarazos"] ?>" min="0" class="form-control custom-input" name="gineco_embarazos" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Núm. hijos vivos</label>
                            <input type="number" value="<?php echo $result[0]["gineco_hijos_vivos"] ?>" min="0" class="form-control custom-input" name="gineco_hijos_vivos" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Núm. hijos nac. muertos</label>
                            <input type="number" value="<?php echo $result[0]["gineco_hijos_muertos"] ?>" min="0" class="form-control custom-input" name="gineco_hijos_muertos" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Causa del fallecimiento</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_causa_fallecimiento"]); ?>" class="form-control custom-input" name="gineco_causa_fallecimiento" />
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Parto</label>
                            <input type="number" value="<?php echo $result[0]["gineco_parto"] ?>" min="0" class="form-control custom-input" name="gineco_parto" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Cesáreas</label>
                            <input type="number" value="<?php echo $result[0]["gineco_cesarea"] ?>" min="0" class="form-control custom-input" name="gineco_cesarea" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Aborto</label>
                            <input type="number" value="<?php echo $result[0]["gineco_aborto"] ?>" min="0" class="form-control custom-input" name="gineco_aborto" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Método de planificación familiar</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_metodo_planificacion"]); ?>" class="form-control custom-input" name="gineco_metodo_planificacion" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Ritmo cada cuanto y duración</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_ritmo"]); ?>" class="form-control custom-input" name="gineco_ritmo" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Fecha ultima menstruación</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_ultima_menstruacion"]); ?>" class="form-control date-picker custom-input" name="gineco_ultima_menstruacion" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Fecha último papanicolaou</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_ultimo_papanicolaou"]); ?>" class="form-control date-picker custom-input" name="gineco_ultimo_papanicolaou" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Exploración de mamas</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_exploracion_mamas"]); ?>" class="form-control date-picker custom-input" name="gineco_exploracion_mamas" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Inicio de menopausia</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["gineco_inicio_menopausia"]); ?>" class="form-control date-picker custom-input" name="gineco_inicio_menopausia" />
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center mb-2">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        ESTADO DE SALUD ACTUAL
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <textarea class="form-control custom-textarea" name="problemas_salud" rows="5"
                                placeholder=""></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center mb-2">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        SIGNOS VITALES Y SOMATOMETRÍA
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
                <div class="row mt-3">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Tensión arterial (mmHg.)</label>
                            <input type="number" value="<?php echo $result[0]["signos_tension_arterial"] ?>" min="0" class="form-control custom-input" name="signos_tension_arterial" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Frecuencia cardiaca (lpm.)</label>
                            <input type="number" value="<?php echo $result[0]["signos_frecuencia_cardiaca"] ?>" min="0" class="form-control custom-input" name="signos_frecuencia_cardiaca" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Frecuencia respiratoria (rpm.)</label>
                            <input type="number" value="<?php echo $result[0]["signos_frecuencia_respiratoria"] ?>" min="0" class="form-control custom-input" name="signos_frecuencia_respiratoria" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Temperatura (°.)</label>
                            <input type="number" value="<?php echo $result[0]["signos_temperatura"] ?>" min="0" class="form-control custom-input" name="signos_temperatura" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Peso (Kg.)</label>
                            <input type="number" value="<?php echo $result[0]["signos_peso"] ?>" min="0" class="form-control custom-input" name="signos_peso" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Talla (cm.)</label>
                            <input type="number" value="<?php echo $result[0]["signos_talla"] ?>" min="0" class="form-control custom-input" name="signos_talla" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">IMC</label>
                            <input type="number" value="<?php echo $result[0]["signos_imc"] ?>" min="0" class="form-control custom-input" name="signos_imc" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Perímetro del brazo (cm.)</label>
                            <input type="number" value="<?php echo $result[0]["signos_perimetro_brazo"] ?>" min="0" class="form-control custom-input" name="signos_perimetro_brazo" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Perímetro abdominal (cm.)</label>
                            <input type="number" value="<?php echo $result[0]["signos_perimetro_abdominal"] ?>" min="0" class="form-control custom-input" name="signos_perimetro_abdominal" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Llenado capilar (segundos.)</label>
                            <input type="number" value="<?php echo $result[0]["signos_llenado_capilar"] ?>" min="0" class="form-control custom-input" name="signos_llenado_capilar" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Glucosa</label>
                            <input type="number" value="<?php echo $result[0]["signos_glucosa"] ?>" min="0" class="form-control custom-input" name="signos_glucosa" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Hemoglobina glucosilada</label>
                            <input type="number" value="<?php echo $result[0]["signos_hemoglobina"] ?>" min="0" class="form-control custom-input" name="signos_hemoglobina" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Colesterol</label>
                            <input type="number" value="<?php echo $result[0]["signos_colesterol"] ?>" min="0" class="form-control custom-input" name="signos_colesterol" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Exploración de campos visuales</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["signos_campos_visuales"]); ?>" class="form-control custom-input" name="signos_campos_visuales" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
                        <div class="form-group">
                            <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Exploración acústica</label>
                            <input type="text" value="<?php echo utf8_encode($result[0]["signos_acustica"]); ?>" class="form-control custom-input" name="signos_acustica" />
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="offset-0 offset-lg-3 offset-md-2 offset-sm-2 col-12 col-sm-8 col-md-8 col-lg-6 vertical-margin-bottom">
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