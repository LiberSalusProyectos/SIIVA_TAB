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
                        <i class="fas fa-random custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo ETS_NAME; ?></h4>
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>0. </strong>Género
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">Hombre
                                        <input type="radio" name="genre" <?php if ($result[0]["gender"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">Mujer
                                        <input type="radio" name="genre" <?php if ($result[0]["gender"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">No Binario
                                        <input type="radio" name="genre" <?php if ($result[0]["gender"]=="c")  { echo 'checked="true"'; } ?> value="c" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>1. </strong>¿A que edad inicio su vida sexual?
                        </span>
                    </div>
                    <input type="text" name="starts_activity" value="<?php echo $result[0]['starts_activity']; ?>" class="form-control custom-input" />
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>2. </strong>Orientación sexual
                        </span>
                    </div>
                    <input type="text" name="sexual_orientation" value="<?php echo utf8_encode($result[0]['sexual_orientation']); ?>" class="form-control custom-input" />
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>3. </strong>No. de parejas sexuales
                        </span>
                    </div>
                    <input type="text" name="couples" value="<?php echo $result[0]['couples']; ?>" class="form-control custom-input" />
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>4. </strong> ¿Conoce qué es el sexo seguro?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="safe_sex" <?php if ($result[0]["safe_sex"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="safe_sex" <?php if ($result[0]["safe_sex"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>5. </strong>¿Utiliza algún método anticonceptivo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="contraceptives" <?php if ($result[0]["contraceptives"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="contraceptives" <?php if ($result[0]["contraceptives"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>6. </strong>¿Conoce el uso correcto del condón?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="condom" <?php if ($result[0]["condom"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="condom" <?php if ($result[0]["condom"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>7. </strong>¿Ha mantenido relaciones sexuales con sexo indistinto a su preferencia?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="intercourse" <?php if ($result[0]["intercourse"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="intercourse" <?php if ($result[0]["intercourse"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>8. </strong>¿Ha estado expuesto a alguna ETS?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="ets_exposed" <?php if ($result[0]["ets_exposed"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="ets_exposed" <?php if ($result[0]["ets_exposed"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>9. </strong>¿Llevo tratamiento y seguimiento médico?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="medical_treatment" <?php if ($result[0]["medical_treatment"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="medical_treatment" <?php if ($result[0]["medical_treatment"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>10. </strong>¿Se ha realizado prueba rápida de VIH durante una consulta médica?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="vih_test" <?php if ($result[0]["vih_test"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="vih_test" <?php if ($result[0]["vih_test"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>11. </strong>¿Se ha realizado Papanicolaou en el último año?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="pap_smear" <?php if ($result[0]["pap_smear"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="pap_smear" <?php if ($result[0]["pap_smear"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            ¿Cuál fue su resultado?
                        </span>
                    </div>
                    <input type="text" name="pap_smear_result" value="<?php echo utf8_encode($result[0]['pap_smear_result']); ?>" class="form-control custom-input" />
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>12. </strong>¿Cuántos y que tipos de enfermedades sexuales conoce?
                        </span>
                    </div>
                    <input type="text" name="knowledge" value="<?php echo utf8_encode($result[0]['knowledge']); ?>" class="form-control custom-input" />
                </div>
            </div>
            
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-2">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>13. </strong>¿Conoce cuáles son las formas de transmisión de ETS?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="ways_transmit" <?php if ($result[0]["ways_transmit"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="ways_transmit" <?php if ($result[0]["ways_transmit"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>14. </strong>¿Ha recibido platicas de ETS?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="talks" <?php if ($result[0]["talks"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="talks" <?php if ($result[0]["talks"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>15. </strong>¿Conoce los síntomas del VIH?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="vih_symptom" <?php if ($result[0]["vih_symptom"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="vih_symptom" <?php if ($result[0]["vih_symptom"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>16. </strong>¿Sabe a dónde acudir para valoración y tratamiento del VIH?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SI
                                        <input type="radio" name="vih_clinic" <?php if ($result[0]["vih_clinic"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NO
                                        <input type="radio" name="vih_clinic" <?php if ($result[0]["vih_clinic"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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