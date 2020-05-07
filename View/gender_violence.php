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
            $realized = saveGenderViolenceData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveGenderViolenceData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=genderViolence'); exit;
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
                        <i class="fas fa-venus-mars custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo GENDER_VIOLENCE_NAME; ?></h4>
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
                            Considero violencia el hecho de que me empujen aunque no me caiga.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="push_up" <?php if ($result[0]["push_up"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="push_up" <?php if ($result[0]["push_up"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="push_up" <?php if ($result[0]["push_up"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="push_up" <?php if ($result[0]["push_up"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="push_up" <?php if ($result[0]["push_up"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>2. </strong> Considero violencia el hecho de que me empujen si caigo.
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="push_down" <?php if ($result[0]["push_down"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="push_down" <?php if ($result[0]["push_down"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="push_down" <?php if ($result[0]["push_down"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="push_down" <?php if ($result[0]["push_down"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="push_down" <?php if ($result[0]["push_down"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>3.
                        </strong>Sólo es violencia cuando te golpean mucho.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="strike" <?php if ($result[0]["strike"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="strike" <?php if ($result[0]["strike"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="strike" <?php if ($result[0]["strike"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="strike" <?php if ($result[0]["strike"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="strike" <?php if ($result[0]["strike"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>4. </strong> Quien te quiere no puede pegarte.
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="wants" <?php if ($result[0]["wants"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="wants" <?php if ($result[0]["wants"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="wants" <?php if ($result[0]["wants"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="wants" <?php if ($result[0]["wants"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="wants" <?php if ($result[0]["wants"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>5. </strong>Me siento inútil cuando me golpean.
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="useless" <?php if ($result[0]["useless"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="useless" <?php if ($result[0]["useless"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="useless" <?php if ($result[0]["useless"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="useless" <?php if ($result[0]["useless"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="useless" <?php if ($result[0]["useless"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>6. </strong>Me parece normal que mi pareja me pegue si no le hace caso.                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="normal_hit" <?php if ($result[0]["normal_hit"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="normal_hit" <?php if ($result[0]["normal_hit"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="normal_hit" <?php if ($result[0]["normal_hit"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="normal_hit" <?php if ($result[0]["normal_hit"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="normal_hit" <?php if ($result[0]["normal_hit"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>7. </strong>Me ha golpeado sin motivo aparente.
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="without_reason" <?php if ($result[0]["without_reason"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="without_reason" <?php if ($result[0]["without_reason"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="without_reason" <?php if ($result[0]["without_reason"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="without_reason" <?php if ($result[0]["without_reason"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="without_reason" <?php if ($result[0]["without_reason"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>8. </strong>Antes de vivir conmigo, yo sabía que mi pareja había pegado a sus parejas anteriores.                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="violent" <?php if ($result[0]["violent"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="violent" <?php if ($result[0]["violent"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="violent" <?php if ($result[0]["violent"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="violent" <?php if ($result[0]["violent"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="violent" <?php if ($result[0]["violent"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>9. </strong>He tenido relaciones sexuales con mi pareja por la fuerza.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="forced_sex" <?php if ($result[0]["forced_sex"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="forced_sex" <?php if ($result[0]["forced_sex"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="forced_sex" <?php if ($result[0]["forced_sex"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="forced_sex" <?php if ($result[0]["forced_sex"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="forced_sex" <?php if ($result[0]["forced_sex"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>10. </strong>Accedo a tener relaciones sexuales con mi pareja para evitar los malos tratos.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="engagement_sex" <?php if ($result[0]["engagement_sex"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="engagement_sex" <?php if ($result[0]["engagement_sex"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="engagement_sex" <?php if ($result[0]["engagement_sex"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="engagement_sex" <?php if ($result[0]["engagement_sex"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="engagement_sex" <?php if ($result[0]["engagement_sex"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>11. </strong>Tengo relaciones sexuales con mi pareja por miedo.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="sex_fear" <?php if ($result[0]["sex_fear"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="sex_fear" <?php if ($result[0]["sex_fear"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="sex_fear" <?php if ($result[0]["sex_fear"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="sex_fear" <?php if ($result[0]["sex_fear"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="sex_fear" <?php if ($result[0]["sex_fear"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>12. </strong>Considero que hay malos tratos aunque no me ponga una mano encima.
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="bad_treatments" <?php if ($result[0]["bad_treatments"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="bad_treatments" <?php if ($result[0]["bad_treatments"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="bad_treatments" <?php if ($result[0]["bad_treatments"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="bad_treatments" <?php if ($result[0]["bad_treatments"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="bad_treatments" <?php if ($result[0]["bad_treatments"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>13. </strong>Él decide por mí.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="decide_4me" <?php if ($result[0]["decide_4me"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="decide_4me" <?php if ($result[0]["decide_4me"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="decide_4me" <?php if ($result[0]["decide_4me"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="decide_4me" <?php if ($result[0]["decide_4me"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="decide_4me" <?php if ($result[0]["decide_4me"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>14. </strong>Ha conseguido aislarme de mis amigos.			
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="isolates_me" <?php if ($result[0]["isolates_me"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="isolates_me" <?php if ($result[0]["isolates_me"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="isolates_me" <?php if ($result[0]["isolates_me"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="isolates_me" <?php if ($result[0]["isolates_me"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="isolates_me" <?php if ($result[0]["isolates_me"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>15. </strong>Ha intentado aislarme de mi familia.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="try_isolate" <?php if ($result[0]["try_isolate"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="try_isolate" <?php if ($result[0]["try_isolate"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="try_isolate" <?php if ($result[0]["try_isolate"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="try_isolate" <?php if ($result[0]["try_isolate"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="try_isolate" <?php if ($result[0]["try_isolate"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>16. </strong>Me siento culpable de lo que pasa.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="feel_guilty" <?php if ($result[0]["feel_guilty"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="feel_guilty" <?php if ($result[0]["feel_guilty"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="feel_guilty" <?php if ($result[0]["feel_guilty"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="feel_guilty" <?php if ($result[0]["feel_guilty"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="feel_guilty" <?php if ($result[0]["feel_guilty"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>17. </strong>Me insulta en cualquier lugar.
                            </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="insults_me" <?php if ($result[0]["insults_me"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="insults_me" <?php if ($result[0]["insults_me"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="insults_me" <?php if ($result[0]["insults_me"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="insults_me" <?php if ($result[0]["insults_me"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="insults_me" <?php if ($result[0]["insults_me"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>18. </strong>Trato de ocultar los motivos de mis “moretones”.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="bruises" <?php if ($result[0]["bruises"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="bruises" <?php if ($result[0]["bruises"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="bruises" <?php if ($result[0]["bruises"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="bruises" <?php if ($result[0]["bruises"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="bruises" <?php if ($result[0]["bruises"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>19. </strong>Siempre estoy en alerta</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="be_alert" <?php if ($result[0]["be_alert"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="be_alert" <?php if ($result[0]["be_alert"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="be_alert" <?php if ($result[0]["be_alert"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="be_alert" <?php if ($result[0]["be_alert"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="be_alert" <?php if ($result[0]["be_alert"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>20. </strong>Lo he denunciado.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="denounced" <?php if ($result[0]["denounced"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="denounced" <?php if ($result[0]["denounced"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="denounced" <?php if ($result[0]["denounced"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="denounced" <?php if ($result[0]["denounced"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="denounced" <?php if ($result[0]["denounced"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>21. </strong>Me asusta la manera en que me mira.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="look_scare" <?php if ($result[0]["look_scare"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="look_scare" <?php if ($result[0]["look_scare"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="look_scare" <?php if ($result[0]["look_scare"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="look_scare" <?php if ($result[0]["look_scare"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="look_scare" <?php if ($result[0]["look_scare"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>22. </strong>Me siento sola.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="feel_alone" <?php if ($result[0]["feel_alone"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="feel_alone" <?php if ($result[0]["feel_alone"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="feel_alone" <?php if ($result[0]["feel_alone"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="feel_alone" <?php if ($result[0]["feel_alone"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="feel_alone" <?php if ($result[0]["feel_alone"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>23. </strong>Puedo estudiar/trabajar fuera de casa.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="can_work" <?php if ($result[0]["can_work"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="can_work" <?php if ($result[0]["can_work"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="can_work" <?php if ($result[0]["can_work"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="can_work" <?php if ($result[0]["can_work"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="can_work" <?php if ($result[0]["can_work"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>24. </strong>Me impide ver a mi familia.
                        </span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="see_family" <?php if ($result[0]["see_family"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="see_family" <?php if ($result[0]["see_family"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="see_family" <?php if ($result[0]["see_family"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="see_family" <?php if ($result[0]["see_family"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="see_family" <?php if ($result[0]["see_family"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>25. </strong>Vigila lo que hago.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="watches_me" <?php if ($result[0]["watches_me"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="watches_me" <?php if ($result[0]["watches_me"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="watches_me" <?php if ($result[0]["watches_me"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="watches_me" <?php if ($result[0]["watches_me"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="watches_me" <?php if ($result[0]["watches_me"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>26. </strong>Creo que sigo “enganchada” a mi marido.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="keep_hooked" <?php if ($result[0]["keep_hooked"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="keep_hooked" <?php if ($result[0]["keep_hooked"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="keep_hooked" <?php if ($result[0]["keep_hooked"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="keep_hooked" <?php if ($result[0]["keep_hooked"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="keep_hooked" <?php if ($result[0]["keep_hooked"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>27. </strong>Me siento culpable cuando mi marido se arrepiente.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="regret_guilty" <?php if ($result[0]["regret_guilty"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="regret_guilty" <?php if ($result[0]["regret_guilty"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="regret_guilty" <?php if ($result[0]["regret_guilty"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="regret_guilty" <?php if ($result[0]["regret_guilty"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="regret_guilty" <?php if ($result[0]["regret_guilty"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>28. </strong>Me gusta cuidar mi aspecto.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="care_aspect" <?php if ($result[0]["care_aspect"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="care_aspect" <?php if ($result[0]["care_aspect"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="care_aspect" <?php if ($result[0]["care_aspect"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="care_aspect" <?php if ($result[0]["care_aspect"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="care_aspect" <?php if ($result[0]["care_aspect"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>29. </strong>Yo creo que la mujer tiene que obedecer.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="have_obey" <?php if ($result[0]["have_obey"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="have_obey" <?php if ($result[0]["have_obey"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="have_obey" <?php if ($result[0]["have_obey"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="have_obey" <?php if ($result[0]["have_obey"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="have_obey" <?php if ($result[0]["have_obey"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>30. </strong>Yo creo que las mujeres somos iguales que los hombres.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="gender_equality" <?php if ($result[0]["gender_equality"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="gender_equality" <?php if ($result[0]["gender_equality"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="gender_equality" <?php if ($result[0]["gender_equality"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="gender_equality" <?php if ($result[0]["gender_equality"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="gender_equality" <?php if ($result[0]["gender_equality"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>31. </strong>Yo creo que las mujeres no llaman a la policía porque protegen a sus maridos.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="protect_couple" <?php if ($result[0]["protect_couple"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="protect_couple" <?php if ($result[0]["protect_couple"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="protect_couple" <?php if ($result[0]["protect_couple"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="protect_couple" <?php if ($result[0]["protect_couple"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="protect_couple" <?php if ($result[0]["protect_couple"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>32. </strong>Yo creo que lo que ocurren en la familia es privado.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="private_life" <?php if ($result[0]["private_life"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="private_life" <?php if ($result[0]["private_life"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="private_life" <?php if ($result[0]["private_life"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="private_life" <?php if ($result[0]["private_life"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="private_life" <?php if ($result[0]["private_life"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>33. </strong>Yo creo que las bofetadas pueden ser necesarias</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="slap_necessary" <?php if ($result[0]["slap_necessary"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="slap_necessary" <?php if ($result[0]["slap_necessary"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="slap_necessary" <?php if ($result[0]["slap_necessary"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="slap_necessary" <?php if ($result[0]["slap_necessary"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="slap_necessary" <?php if ($result[0]["slap_necessary"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>34. </strong>Yo creo que los maltratadores son personas fracasadas.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="abuser_failed" <?php if ($result[0]["abuser_failed"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="abuser_failed" <?php if ($result[0]["abuser_failed"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="abuser_failed" <?php if ($result[0]["abuser_failed"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="abuser_failed" <?php if ($result[0]["abuser_failed"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="abuser_failed" <?php if ($result[0]["abuser_failed"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>35. </strong>Yo creo que cuando te casas es para lo bueno y lo malo</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="good_bad" <?php if ($result[0]["good_bad"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="good_bad" <?php if ($result[0]["good_bad"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="good_bad" <?php if ($result[0]["good_bad"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="good_bad" <?php if ($result[0]["good_bad"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="good_bad" <?php if ($result[0]["good_bad"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>36. </strong>Yo creo que soy capaz de realizar un proyecto de vida futuro y por mi cuenta.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="life_proyect" <?php if ($result[0]["life_proyect"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="life_proyect" <?php if ($result[0]["life_proyect"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="life_proyect" <?php if ($result[0]["life_proyect"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="life_proyect" <?php if ($result[0]["life_proyect"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="life_proyect" <?php if ($result[0]["life_proyect"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>37. </strong>Yo creo que un/a hijo/a sin padre se desarrolla completamente.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="without_father" <?php if ($result[0]["without_father"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="without_father" <?php if ($result[0]["without_father"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="without_father" <?php if ($result[0]["without_father"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="without_father" <?php if ($result[0]["without_father"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="without_father" <?php if ($result[0]["without_father"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>38. </strong>Yo creo que hay que aguantar el maltrato por los hijos.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="childrens" <?php if ($result[0]["childrens"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="childrens" <?php if ($result[0]["childrens"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="childrens" <?php if ($result[0]["childrens"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="childrens" <?php if ($result[0]["childrens"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="childrens" <?php if ($result[0]["childrens"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>39. </strong>Yo creo que mi marido no puede vivir sin mí.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="without_me" <?php if ($result[0]["without_me"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="without_me" <?php if ($result[0]["without_me"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="without_me" <?php if ($result[0]["without_me"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="without_me" <?php if ($result[0]["without_me"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="without_me" <?php if ($result[0]["without_me"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>40. </strong>Yo creo que no lo abandono porque lo quiero.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="love_him" <?php if ($result[0]["love_him"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="love_him" <?php if ($result[0]["love_him"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="love_him" <?php if ($result[0]["love_him"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="love_him" <?php if ($result[0]["love_him"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="love_him" <?php if ($result[0]["love_him"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>41. </strong>Yo creo que no lo abandono aunque me pegue porque me da pena.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="feel_sorry" <?php if ($result[0]["feel_sorry"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="feel_sorry" <?php if ($result[0]["feel_sorry"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="feel_sorry" <?php if ($result[0]["feel_sorry"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="feel_sorry" <?php if ($result[0]["feel_sorry"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="feel_sorry" <?php if ($result[0]["feel_sorry"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>42. </strong>Yo creo que la esposa tiene que aguantar lo que sea por el matrimonio.</span>
                    </div>
                    <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">NUNCA
                                        <input type="radio" name="marriage" <?php if ($result[0]["marriage"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">ALGUNAS VECES
                                        <input type="radio" name="marriage" <?php if ($result[0]["marriage"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">MUCHAS VECES
                                        <input type="radio" name="marriage" <?php if ($result[0]["marriage"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">CASI SIEMPRE
                                        <input type="radio" name="marriage" <?php if ($result[0]["marriage"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">SIEMPRE
                                        <input type="radio" name="marriage" <?php if ($result[0]["marriage"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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