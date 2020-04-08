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
            $realized = saveGeriatricDepressionData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveGeriatricDepressionData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=geriatricDepression'); exit;
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
                        <i class="fas fa-hourglass-end custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo GERIATRIC_DEPRESSION_NAME; ?></h4>
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
                ¿Está básicamente satisfecho con su vida?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="satisfied" <?php if ($result[0]["satisfied"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="satisfied" <?php if ($result[0]["satisfied"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>2. </strong> ¿Ha renunciado a
                muchas de sus actividades y pasatiempos?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="giveup_hobby" <?php if ($result[0]["giveup_hobby"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="giveup_hobby" <?php if ($result[0]["giveup_hobby"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>3. </strong> ¿Siente que su vida
                está vacía?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="empty_life" <?php if ($result[0]["empty_life"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="empty_life" <?php if ($result[0]["empty_life"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>4. </strong> ¿Se encuentra a
                menudo aburrido? </span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="boredom" <?php if ($result[0]["boredom"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="boredom" <?php if ($result[0]["boredom"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>5. </strong> ¿Se encuentra alegre
                y optimista, con buen ánimo casi todo el tiempo?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="optimism" <?php if ($result[0]["optimism"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="optimism" <?php if ($result[0]["optimism"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>6. </strong> ¿Teme que le vaya a
                pasar algo malo?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="fear" <?php if ($result[0]["fear"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="fear" <?php if ($result[0]["fear"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>7. </strong> ¿Se siente feliz,
                contento la mayor parte del tiempo?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="happiness" <?php if ($result[0]["happiness"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="happiness" <?php if ($result[0]["happiness"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>8. </strong> ¿Se siente a menudo
                desamparado, desvalido, indeciso?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="abandonment" <?php if ($result[0]["abandonment"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="abandonment" <?php if ($result[0]["abandonment"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>9. </strong>¿Prefiere quedarse en
                casa que acaso salir y hacer cosas nuevas?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="at_home" <?php if ($result[0]["at_home"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="at_home" <?php if ($result[0]["at_home"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>10. </strong>¿Le da la impresión
                de que tiene más fallos de memoria que los demás?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="memory_loss" <?php if ($result[0]["memory_loss"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="memory_loss" <?php if ($result[0]["memory_loss"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>11. </strong>¿Cree que es
                agradable estar vivo?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="love_forlife" <?php if ($result[0]["love_forlife"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="love_forlife" <?php if ($result[0]["love_forlife"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>12. </strong>¿Se le hace duro
                empezar nuevos proyectos?</span>
            </div>
            <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="start_difficult" <?php if ($result[0]["start_difficult"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                    </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                    <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="start_difficult" <?php if ($result[0]["start_difficult"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>13. </strong>¿Se siente lleno de
                    energía?</span>
                </div>
                <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="full_energy" <?php if ($result[0]["full_energy"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                        </label>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="full_energy" <?php if ($result[0]["full_energy"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>14. </strong>¿Siente que su
                    situación es angustiosa, desesperada?</span>
                </div>
                <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="anxiety" <?php if ($result[0]["anxiety"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                        </label>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="anxiety" <?php if ($result[0]["anxiety"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                <span class="instructions-paragraph regular-font text-royal-blue"><strong>15. </strong>¿Cree que la
                    mayoría de la gente vive económicamente mejor que usted?</span>
                </div>
                <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label class="container regular-font text-royal-blue">SI
                        <input type="radio" name="economy" <?php if ($result[0]["economy"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                        <span class="radiomark"></span>
                        </label>
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label class="container regular-font text-royal-blue">NO
                        <input type="radio" name="economy" <?php if ($result[0]["economy"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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