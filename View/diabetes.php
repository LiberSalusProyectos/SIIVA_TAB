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
            $realized = saveDiabetesData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveDiabetesData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=diabetes'); exit;
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
                                        <input type="radio" name="suffer_from" <?php if ($result[0]["suffer_from"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="suffer_from" <?php if ($result[0]["suffer_from"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="thirsty" <?php if ($result[0]["thirsty"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="thirsty" <?php if ($result[0]["thirsty"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="urinate" <?php if ($result[0]["urinate"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="urinate" <?php if ($result[0]["urinate"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="lose_weight" <?php if ($result[0]["lose_weight"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="lose_weight" <?php if ($result[0]["lose_weight"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="over_eat" <?php if ($result[0]["over_eat"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="over_eat" <?php if ($result[0]["over_eat"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="glucose_check" <?php if ($result[0]["glucose_check"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="glucose_check" <?php if ($result[0]["glucose_check"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="medical_times" <?php if ($result[0]["medical_times"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="medical_times" <?php if ($result[0]["medical_times"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="anxious" <?php if ($result[0]["medical_times"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="anxious" <?php if ($result[0]["medical_times"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="anxious" <?php if ($result[0]["medical_times"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                                        <input type="radio" name="treatment" <?php if ($result[0]["treatment"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="treatment" <?php if ($result[0]["treatment"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="treatment" <?php if ($result[0]["treatment"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="treatment" <?php if ($result[0]["treatment"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="treatment" <?php if ($result[0]["treatment"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                                        <input type="radio" name="feel_bad" <?php if ($result[0]["feel_bad"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="feel_bad" <?php if ($result[0]["feel_bad"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="feel_bad" <?php if ($result[0]["feel_bad"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="feel_bad" <?php if ($result[0]["feel_bad"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="feel_bad" <?php if ($result[0]["feel_bad"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                                        <input type="radio" name="check_foot" <?php if ($result[0]["check_foot"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="check_foot" <?php if ($result[0]["check_foot"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="check_foot" <?php if ($result[0]["check_foot"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="check_foot" <?php if ($result[0]["check_foot"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="check_foot" <?php if ($result[0]["check_foot"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                                        <input type="radio" name="vision_changes" <?php if ($result[0]["vision_changes"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="vision_changes" <?php if ($result[0]["vision_changes"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="vision_changes" <?php if ($result[0]["vision_changes"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="vision_changes" <?php if ($result[0]["vision_changes"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="vision_changes" <?php if ($result[0]["vision_changes"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                                        <input type="radio" name="healing_problems" <?php if ($result[0]["healing_problems"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="healing_problems" <?php if ($result[0]["healing_problems"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="healing_problems" <?php if ($result[0]["healing_problems"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="healing_problems" <?php if ($result[0]["healing_problems"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="healing_problems" <?php if ($result[0]["healing_problems"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                                        <input type="radio" name="proper_diet" <?php if ($result[0]["proper_diet"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="proper_diet" <?php if ($result[0]["proper_diet"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="proper_diet" <?php if ($result[0]["proper_diet"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="proper_diet" <?php if ($result[0]["proper_diet"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="proper_diet" <?php if ($result[0]["proper_diet"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                                        <input type="radio" name="weight_changes" <?php if ($result[0]["weight_changes"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="weight_changes" <?php if ($result[0]["weight_changes"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="weight_changes" <?php if ($result[0]["weight_changes"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="weight_changes" <?php if ($result[0]["weight_changes"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="weight_changes" <?php if ($result[0]["weight_changes"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                                        <input type="radio" name="medical_control" <?php if ($result[0]["medical_control"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="medical_control" <?php if ($result[0]["medical_control"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="medical_control" <?php if ($result[0]["medical_control"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="medical_control" <?php if ($result[0]["medical_control"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="medical_control" <?php if ($result[0]["medical_control"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                                        <input type="radio" name="naturist" <?php if ($result[0]["naturist"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="naturist" <?php if ($result[0]["naturist"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="age" <?php if ($result[0]["age"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) 40-49 años (1 punto)
                                        <input type="radio" name="age" <?php if ($result[0]["age"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) 50-59 años (2 puntos)
                                        <input type="radio" name="age" <?php if ($result[0]["age"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) 60 años o más (3 puntos)
                                        <input type="radio" name="age" <?php if ($result[0]["age"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                                        <input type="radio" name="gender" <?php if ($result[0]["gender"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) Mujer (0 puntos)
                                        <input type="radio" name="gender" <?php if ($result[0]["gender"]=="b")  { echo 'checked="true"'; } ?> value="b" />
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
                                        <input type="radio" name="gestational_diabetes" <?php if ($result[0]["gestational_diabetes"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO (0 puntos)
                                        <input type="radio" name="gestational_diabetes" <?php if ($result[0]["gestational_diabetes"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="family" <?php if ($result[0]["family"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO (0 puntos)
                                        <input type="radio" name="family" <?php if ($result[0]["family"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="blood_pressure" <?php if ($result[0]["blood_pressure"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO (0 puntos)
                                        <input type="radio" name="blood_pressure" <?php if ($result[0]["blood_pressure"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="physical_activity" <?php if ($result[0]["physical_activity"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO (0 puntos)
                                        <input type="radio" name="physical_activity" <?php if ($result[0]["physical_activity"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                                        <input type="radio" name="weight" <?php if ($result[0]["weight"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) (1 punto)
                                        <input type="radio" name="weight" <?php if ($result[0]["weight"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) (2 puntos)
                                        <input type="radio" name="weight" <?php if ($result[0]["weight"]=="c")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) (3 puntos)
                                        <input type="radio" name="weight" <?php if ($result[0]["weight"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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