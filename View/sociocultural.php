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
            $realized = saveSocioculturalData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveSocioculturalData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=socioCultural'); exit;
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
                        <i class="fas fa-futbol custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo SOCIOCULTURAL_NAME; ?></h4>
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
                            Se toman decisiones para cosas importantes de la familia.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="decisions" <?php if ($result[0]["decisions"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="decisions" <?php if ($result[0]["decisions"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="decisions" <?php if ($result[0]["decisions"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="decisions" <?php if ($result[0]["decisions"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="decisions" <?php if ($result[0]["decisions"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>2. </strong>
                            En mi casa predomina la armonía.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="harmony" <?php if ($result[0]["harmony"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="harmony" <?php if ($result[0]["harmony"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="harmony" <?php if ($result[0]["harmony"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="harmony" <?php if ($result[0]["harmony"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="harmony" <?php if ($result[0]["harmony"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>3. </strong>
                            En mi casa cada uno cumple con sus responsabilidades.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="responsibility" <?php if ($result[0]["responsibility"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="responsibility" <?php if ($result[0]["responsibility"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="responsibility" <?php if ($result[0]["responsibility"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="responsibility" <?php if ($result[0]["responsibility"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="responsibility" <?php if ($result[0]["responsibility"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>4. </strong>
                            Las manifestaciones de cariño forman parte de nuestra vida cotidiana.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="sweetie" <?php if ($result[0]["sweetie"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="sweetie" <?php if ($result[0]["sweetie"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="sweetie" <?php if ($result[0]["sweetie"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="sweetie" <?php if ($result[0]["sweetie"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="sweetie" <?php if ($result[0]["sweetie"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>5. </strong>
                            Nos expresamos sin insinuaciones, de forma clara y directa.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="point_blank" <?php if ($result[0]["point_blank"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="point_blank" <?php if ($result[0]["point_blank"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="point_blank" <?php if ($result[0]["point_blank"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="point_blank" <?php if ($result[0]["point_blank"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="point_blank" <?php if ($result[0]["point_blank"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>6. </strong>
                            Podemos aceptar los defectos de los demás y sobrellevarlos.						</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="defects" <?php if ($result[0]["defects"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="defects" <?php if ($result[0]["defects"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="defects" <?php if ($result[0]["defects"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="defects" <?php if ($result[0]["defects"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="defects" <?php if ($result[0]["defects"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>7. </strong>
                            Tomamos en consideración las experiencias de otras familias ante situaciones difíciles.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="experience" <?php if ($result[0]["experience"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="experience" <?php if ($result[0]["experience"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="experience" <?php if ($result[0]["experience"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="experience" <?php if ($result[0]["experience"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="experience" <?php if ($result[0]["experience"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>8. </strong>
                            Cuando alguno de la familia tiene un problema, los demás lo ayudan.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="support" <?php if ($result[0]["support"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="support" <?php if ($result[0]["support"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="support" <?php if ($result[0]["support"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="support" <?php if ($result[0]["support"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="support" <?php if ($result[0]["support"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>9. </strong>
                            Se distribuyen las tareas de forma que nadie está sobrecargado.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="tasks" <?php if ($result[0]["tasks"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="tasks" <?php if ($result[0]["tasks"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="tasks" <?php if ($result[0]["tasks"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="tasks" <?php if ($result[0]["tasks"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="tasks" <?php if ($result[0]["tasks"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>10. </strong>
                            Las costumbres familiares pueden modificarse ante determinadas situaciones.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="habits" <?php if ($result[0]["habits"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="habits" <?php if ($result[0]["habits"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="habits" <?php if ($result[0]["habits"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="habits" <?php if ($result[0]["habits"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="habits" <?php if ($result[0]["habits"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>11. </strong>
                            Podemos conversar diversos temas sin temor.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="converse" <?php if ($result[0]["converse"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="converse" <?php if ($result[0]["converse"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="converse" <?php if ($result[0]["converse"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="converse" <?php if ($result[0]["converse"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="converse" <?php if ($result[0]["converse"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>12. </strong>
                            Ante una situación familiar difícil, somos capaces de buscar ayuda en otras personas.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="look_help" <?php if ($result[0]["look_help"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="look_help" <?php if ($result[0]["look_help"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="look_help" <?php if ($result[0]["look_help"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="look_help" <?php if ($result[0]["look_help"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="look_help" <?php if ($result[0]["look_help"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>13. </strong>
                            Los intereses y necesidad de cada cual son respetados por el núcleo familiar.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="respect" <?php if ($result[0]["respect"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="respect" <?php if ($result[0]["respect"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="respect" <?php if ($result[0]["respect"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="respect" <?php if ($result[0]["respect"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="respect" <?php if ($result[0]["respect"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6 mb-2">
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>14. </strong>
                            Nos demostramos el cariño que nos tenemos.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI NUNCA
                                        <input type="radio" name="show_affection" <?php if ($result[0]["show_affection"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">POCAS VECES
                                        <input type="radio" name="show_affection" <?php if ($result[0]["show_affection"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">A VECES
                                        <input type="radio" name="show_affection" <?php if ($result[0]["show_affection"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="show_affection" <?php if ($result[0]["show_affection"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="show_affection" <?php if ($result[0]["show_affection"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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