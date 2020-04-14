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
            $realized = saveHealthCareData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveHealthCareData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=healthCare'); exit;
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
                        <i class="fas fa-user-md custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo HEALTH_CARE_NAME; ?></h4>
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
                            Me asusta mi enfermedad.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="scare" <?php if ($result[0]["scare"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="scare" <?php if ($result[0]["scare"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="scare" <?php if ($result[0]["scare"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="scare" <?php if ($result[0]["scare"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>2. </strong>Se me hace difícil enfrentarme con mis actuales síntomas.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="confront" <?php if ($result[0]["confront"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="confront" <?php if ($result[0]["confront"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="confront" <?php if ($result[0]["confront"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="confront" <?php if ($result[0]["confront"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>3. </strong>Soy incapaz de controlar mi enfermedad.
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="take_control" <?php if ($result[0]["take_control"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="take_control" <?php if ($result[0]["take_control"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="take_control" <?php if ($result[0]["take_control"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="take_control" <?php if ($result[0]["take_control"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>4. </strong>Si tengo una recaída, no puedo hacer nada para evitarlo.
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="relapse" <?php if ($result[0]["relapse"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="relapse" <?php if ($result[0]["relapse"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="relapse" <?php if ($result[0]["relapse"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="relapse" <?php if ($result[0]["relapse"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>5. </strong>Siempre ha existido algo malo en mí como persona (que ha causado esta enfermedad).
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="bad_inside" <?php if ($result[0]["bad_inside"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="bad_inside" <?php if ($result[0]["bad_inside"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="bad_inside" <?php if ($result[0]["bad_inside"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="bad_inside" <?php if ($result[0]["bad_inside"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>6. </strong>Yo soy esencialmente normal: mi enfermedad es como cualquier otra.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="normal" <?php if ($result[0]["normal"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="normal" <?php if ($result[0]["normal"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="normal" <?php if ($result[0]["normal"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="normal" <?php if ($result[0]["normal"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>7. </strong>Hay algo en mi personalidad que causa mi enfermedad.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="personality" <?php if ($result[0]["personality"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="personality" <?php if ($result[0]["personality"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="personality" <?php if ($result[0]["personality"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="personality" <?php if ($result[0]["personality"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>8. </strong>Hay algo en mí que es responsable de mi enfermedad.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="something_inside" <?php if ($result[0]["something_inside"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="something_inside" <?php if ($result[0]["something_inside"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="something_inside" <?php if ($result[0]["something_inside"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="something_inside" <?php if ($result[0]["something_inside"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>9. </strong>Siempre necesitaré los cuidados de un equipo de profesionales.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="professionals" <?php if ($result[0]["professionals"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="professionals" <?php if ($result[0]["professionals"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="professionals" <?php if ($result[0]["professionals"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="professionals" <?php if ($result[0]["professionals"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>10. </strong>Soy capaz de muy pocas cosas como consecuencia de mi enfermedad.
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="competent" <?php if ($result[0]["competent"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="competent" <?php if ($result[0]["competent"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="competent" <?php if ($result[0]["competent"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="competent" <?php if ($result[0]["competent"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>11. </strong>Mi enfermedad es demasiado delicada como para dejar de trabajar o mantener un trabajo.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="can_work" <?php if ($result[0]["can_work"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="can_work" <?php if ($result[0]["can_work"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="can_work" <?php if ($result[0]["can_work"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="can_work" <?php if ($result[0]["can_work"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>12. </strong>Estoy avergonzado por mi enfermedad.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="ashamed" <?php if ($result[0]["ashamed"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="ashamed" <?php if ($result[0]["ashamed"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="ashamed" <?php if ($result[0]["ashamed"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="ashamed" <?php if ($result[0]["ashamed"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>13. </strong>Me juzgan por mi enfermedad.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="judge_me" <?php if ($result[0]["judge_me"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="judge_me" <?php if ($result[0]["judge_me"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="judge_me" <?php if ($result[0]["judge_me"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="judge_me" <?php if ($result[0]["judge_me"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>14. </strong>Puedo hablar a la mayoría de la gente sobre mi enfermedad.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="can_talk" <?php if ($result[0]["can_talk"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="can_talk" <?php if ($result[0]["can_talk"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="can_talk" <?php if ($result[0]["can_talk"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="can_talk" <?php if ($result[0]["can_talk"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>15. </strong>La sociedad necesita mantener apartada a la gente, que como yo tiene esta enfermedad
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="draw_away" <?php if ($result[0]["draw_away"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="draw_away" <?php if ($result[0]["draw_away"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="draw_away" <?php if ($result[0]["draw_away"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="draw_away" <?php if ($result[0]["draw_away"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>16. </strong>La gente como yo debe de ser controlada por servicios psiquiátricos.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="psychiatric" <?php if ($result[0]["psychiatric"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="psychiatric" <?php if ($result[0]["psychiatric"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="psychiatric" <?php if ($result[0]["psychiatric"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="psychiatric" <?php if ($result[0]["psychiatric"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>17. </strong>Yo siempre he estado mentalmente bien.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="well_mentally" <?php if ($result[0]["well_mentally"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="well_mentally" <?php if ($result[0]["well_mentally"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="well_mentally" <?php if ($result[0]["well_mentally"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="well_mentally" <?php if ($result[0]["well_mentally"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>18. </strong>Yo siempre he tenido una enfermedad mental.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">a) Muy de acuerdo.
                                        <input type="radio" name="mental_illness" <?php if ($result[0]["mental_illness"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">b) De acuerdo.
                                        <input type="radio" name="mental_illness" <?php if ($result[0]["mental_illness"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">c) En desacuerdo.
                                        <input type="radio" name="mental_illness" <?php if ($result[0]["mental_illness"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">d) Muy en desacuerdo.
                                        <input type="radio" name="mental_illness" <?php if ($result[0]["mental_illness"]=="d")  { echo 'checked="true"'; } ?> value="d" />
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