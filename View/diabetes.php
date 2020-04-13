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
            $realized = saveETSData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveETSData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=ets'); exit;
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
                        <i class="fas fa-dna custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo DIABETES_NAME; ?></h4>
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
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>1. </strong>
                            Tengo diabetes mellitus</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="anxious" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>2. </strong> Suelo tener mucha sed
                            durante el día sin importar beba agua o no</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="tension" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="tension" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>3. </strong> He notado que orino
                            más veces que las demás personas</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="fears" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="fears" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>4. </strong> He perdido peso sin
                            explicación aparente</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="insomnia" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="insomnia" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>5. </strong>Considero que consumo
                            demasiados alimentos durante todo el día</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="cognitive" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="cognitive" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>6. </strong> Me he tomado los
                            niveles de glucosa para conocerlo</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="mood" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="mood" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>7. </strong>Acudo con regularidad
                            al médico</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" value="4" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>8. </strong>Tomo mi medicamento
                            según las indicaciones del médico</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" value="4" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>9. </strong>Me he sentido mal
                            cuando me tomo mis medicamentos</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" value="4" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>10. </strong>He revisado mis pies
                            para detectar heridas o cambios en el aspecto de la piel</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" value="4" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>11. </strong>He notado cambios en
                            mi visión</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" value="4" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>12. </strong>Siento que mis
                            heridas cicatrizan muy lento</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" value="4" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>13. </strong>Llevo una dieta
                            adecuada a mi enfermedad</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" value="4" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>14. </strong>He notado cambios en
                            mi peso después de iniciado mi tratamiento</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" value="4" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>15. </strong>¿Dónde acudo a mis
                            consultas de control?</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" value="4" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>16. </strong> ¿Consumo medicina
                            naturista?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="mood" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="mood" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-3 offset-md-2 offset-sm-2 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
                <p class="text-liber-salus-blue text-center custom-full-name-big half-vertical-margin-top">
                    Cuestionario de riesgo de diabetes.
                </p>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>1. </strong>¿Qué edad
                            tiene?</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Menos de 40 años (0 puntos)
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) 40-49 años (1 punto)
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) 50-59 años (2 puntos)
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) 60 años o más (3 puntos)
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>2. </strong>¿Es usted hombre o
                            mujer?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Hombre (1 punto)
                                        <input type="radio" name="mood" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) Mujer (0 puntos)
                                        <input type="radio" name="mood" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>3. </strong> Si es mujer, ¿tuvo
                            alguna vez diabetes gestacional (glucosa/azúcar alta durante el embarazo)?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI (1 punto)
                                        <input type="radio" name="mood" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO (0 puntos)
                                        <input type="radio" name="mood" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>4. </strong> ¿Tiene familiares
                            (mamá, papá, hermano, hermana) que padecen diabetes?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI (1 punto)
                                        <input type="radio" name="mood" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO (0 puntos)
                                        <input type="radio" name="mood" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>5. </strong> ¿Alguna vez le ha
                            dicho un profesional de salud que tiene presión arterial alta (o hipertensión)?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI (1 punto)
                                        <input type="radio" name="mood" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO (0 puntos)
                                        <input type="radio" name="mood" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>6. </strong> ¿Realiza algún tipo
                            de actividad física?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI (1 punto)
                                        <input type="radio" name="mood" value="0" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO (0 puntos)
                                        <input type="radio" name="mood" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>7. </strong>¿Cuál es su peso?
                            (Anote el puntaje correspondiente a su peso según la tabla a la derecha.)</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a (0 puntos)
                                        <input type="radio" name="anxious" value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) (1 punto)
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) (2 puntos)
                                        <input type="radio" name="anxious" value="2" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) (3 puntos)
                                        <input type="radio" name="anxious" value="3" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
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