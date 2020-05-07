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
            $realized = saveBabyLifestyleData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveBabyLifestyleData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=babyLifestyle'); exit;
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
                        <i class="fas fa-baby custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo BABY_LIFESTYLE_NAME; ?></h4>
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
                <div class="row mt-4">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-5 text-center">
                        <span class="text-royal-blue bold-font custom-form-label-element">
                            EVALUACIÓN DE HÁBITOS ALIMENTICIOS
                        </span>
                    </div>
                    <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">1) ¿Normalmente a la semana, el niño consume algún alimento al levantarse?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="wake_food" <?php if ($result[0]["wake_food"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 1 Vez
                            <input type="radio" name="wake_food" <?php if ($result[0]["wake_food"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 3 veces
                            <input type="radio" name="wake_food" <?php if ($result[0]["wake_food"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 5 veces
                            <input type="radio" name="wake_food" <?php if ($result[0]["wake_food"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="wake_food" <?php if ($result[0]["wake_food"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">2) ¿A la semana, cuantas veces consume alimentos con conservadores artificiales?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="chemical_food" <?php if ($result[0]["chemical_food"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 1 vez
                            <input type="radio" name="chemical_food" <?php if ($result[0]["chemical_food"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 3 veces
                            <input type="radio" name="chemical_food" <?php if ($result[0]["chemical_food"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 5 veces
                            <input type="radio" name="chemical_food" <?php if ($result[0]["chemical_food"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="chemical_food" <?php if ($result[0]["chemical_food"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">3) El número de veces que consume alimentos al día:</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 2 veces
                            <input type="radio" name="food_times" <?php if ($result[0]["food_times"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 3 veces
                            <input type="radio" name="food_times" <?php if ($result[0]["food_times"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 4 veces
                            <input type="radio" name="food_times" <?php if ($result[0]["food_times"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 5 veces
                            <input type="radio" name="food_times" <?php if ($result[0]["food_times"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Más de 5 veces
                            <input type="radio" name="food_times" <?php if ($result[0]["food_times"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">4) A la semana el niño, ¿cuantas veces come fuera de casa? </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="fast_food" <?php if ($result[0]["fast_food"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 1 vez
                            <input type="radio" name="fast_food" <?php if ($result[0]["fast_food"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 3 veces
                            <input type="radio" name="fast_food" <?php if ($result[0]["fast_food"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 5 veces
                            <input type="radio" name="fast_food" <?php if ($result[0]["fast_food"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="fast_food" <?php if ($result[0]["fast_food"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">5) ¿Durante las comidas en casa el niño acostumbra a consumir alimentos fritos?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="fatty_food" <?php if ($result[0]["fatty_food"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="fatty_food" <?php if ($result[0]["fatty_food"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="fatty_food" <?php if ($result[0]["fatty_food"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="fatty_food" <?php if ($result[0]["fatty_food"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="fatty_food" <?php if ($result[0]["fatty_food"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">6) Respetan el horario establecido para las comidas</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="mealtime" <?php if ($result[0]["mealtime"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="mealtime" <?php if ($result[0]["mealtime"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="mealtime" <?php if ($result[0]["mealtime"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="mealtime" <?php if ($result[0]["mealtime"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="mealtime" <?php if ($result[0]["mealtime"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">7) ¿El niño continua comiendo después de quedar satisfecho?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="overeat" <?php if ($result[0]["overeat"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="overeat" <?php if ($result[0]["overeat"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="overeat" <?php if ($result[0]["overeat"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="overeat" <?php if ($result[0]["overeat"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="overeat" <?php if ($result[0]["overeat"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">8) Considero que la dieta del niño es balanceada</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="balanced_diet" <?php if ($result[0]["balanced_diet"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="balanced_diet" <?php if ($result[0]["balanced_diet"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="balanced_diet" <?php if ($result[0]["balanced_diet"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="balanced_diet" <?php if ($result[0]["balanced_diet"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="balanced_diet" <?php if ($result[0]["balanced_diet"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">9) A la semana, ¿cuantas veces consume frutas y verduras?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="fruit_diet" <?php if ($result[0]["fruit_diet"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 1 vez
                            <input type="radio" name="fruit_diet" <?php if ($result[0]["fruit_diet"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 3 veces
                            <input type="radio" name="fruit_diet" <?php if ($result[0]["fruit_diet"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 5 veces
                            <input type="radio" name="fruit_diet" <?php if ($result[0]["fruit_diet"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="fruit_diet" <?php if ($result[0]["fruit_diet"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">10) A la semana, ¿cuantas veces consume carnes (pollo, cerdo, res)?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="meat_diet" <?php if ($result[0]["meat_diet"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 1 vez
                            <input type="radio" name="meat_diet" <?php if ($result[0]["meat_diet"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 3 veces
                            <input type="radio" name="meat_diet" <?php if ($result[0]["meat_diet"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 5 veces
                            <input type="radio" name="meat_diet" <?php if ($result[0]["meat_diet"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="meat_diet" <?php if ($result[0]["meat_diet"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        GRUPOS ALIMENTICIOS
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">11) ALIMENTACIÓN. Ordena en orden de frecuencia los grupos alimenticios en la dieta del niño del 1 al 7 en los recuadros, donde 1 sea el grupo más frecuente y 7 sea el grupo menos frecuente.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <label class="container regular-font text-royal-blue">
                            1. Lácteos y sus derivados
                        </label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select class="form-control custom-input custom-input-select" name="dairy_products">
                                <option <?php if(!isset($result[0]["dairy_products"])) echo " selected "; ?> disabled>SELECCIONAR</option>
                                <option <?php if ($result[0]["dairy_products"]=="1")  { echo 'selected="selected"'; } ?> value="1">1</option>
                                <option <?php if ($result[0]["dairy_products"]=="2")  { echo 'selected="selected"'; } ?> value="2">2</option>
                                <option <?php if ($result[0]["dairy_products"]=="3")  { echo 'selected="selected"'; } ?> value="3">3</option>
                                <option <?php if ($result[0]["dairy_products"]=="4")  { echo 'selected="selected"'; } ?> value="4">4</option>
                                <option <?php if ($result[0]["dairy_products"]=="5")  { echo 'selected="selected"'; } ?> value="5">5</option>
                                <option <?php if ($result[0]["dairy_products"]=="6")  { echo 'selected="selected"'; } ?> value="6">6</option>
                                <option <?php if ($result[0]["dairy_products"]=="7")  { echo 'selected="selected"'; } ?> value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <label class="container regular-font text-royal-blue">
                            2. Carnes, mariscos y huevos
                        </label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select class="form-control custom-input custom-input-select" name="meats">
                                <option <?php if(!isset($result[0]["meats"])) echo " selected "; ?> disabled>SELECCIONAR</option>
                                <option <?php if ($result[0]["meats"]=="1")  { echo 'selected="selected"'; } ?> value="1">1</option>
                                <option <?php if ($result[0]["meats"]=="2")  { echo 'selected="selected"'; } ?> value="2">2</option>
                                <option <?php if ($result[0]["meats"]=="3")  { echo 'selected="selected"'; } ?> value="3">3</option>
                                <option <?php if ($result[0]["meats"]=="4")  { echo 'selected="selected"'; } ?> value="4">4</option>
                                <option <?php if ($result[0]["meats"]=="5")  { echo 'selected="selected"'; } ?> value="5">5</option>
                                <option <?php if ($result[0]["meats"]=="6")  { echo 'selected="selected"'; } ?> value="6">6</option>
                                <option <?php if ($result[0]["meats"]=="7")  { echo 'selected="selected"'; } ?> value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <label class="container regular-font text-royal-blue">
                            3. Tubérculos (papa, yuca, macal, camote), frutos secos y legumbres (frijol, lentejas).
                        </label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select class="form-control custom-input custom-input-select" name="tubers">
                                <option <?php if(!isset($result[0]["tubers"])) echo " selected "; ?> disabled>SELECCIONAR</option>
                                <option <?php if ($result[0]["tubers"]=="1")  { echo 'selected="selected"'; } ?> value="1">1</option>
                                <option <?php if ($result[0]["tubers"]=="2")  { echo 'selected="selected"'; } ?> value="2">2</option>
                                <option <?php if ($result[0]["tubers"]=="3")  { echo 'selected="selected"'; } ?> value="3">3</option>
                                <option <?php if ($result[0]["tubers"]=="4")  { echo 'selected="selected"'; } ?> value="4">4</option>
                                <option <?php if ($result[0]["tubers"]=="5")  { echo 'selected="selected"'; } ?> value="5">5</option>
                                <option <?php if ($result[0]["tubers"]=="6")  { echo 'selected="selected"'; } ?> value="6">6</option>
                                <option <?php if ($result[0]["tubers"]=="7")  { echo 'selected="selected"'; } ?> value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <label class="container regular-font text-royal-blue">
                            4. Verduras y hortalizas (lechuga, repollo, espinacas)
                        </label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select class="form-control custom-input custom-input-select" name="vegetables">
                                <option <?php if(!isset($result[0]["vegetables"])) echo " selected "; ?> disabled>SELECCIONAR</option>
                                <option <?php if ($result[0]["vegetables"]=="1")  { echo 'selected="selected"'; } ?> value="1">1</option>
                                <option <?php if ($result[0]["vegetables"]=="2")  { echo 'selected="selected"'; } ?> value="2">2</option>
                                <option <?php if ($result[0]["vegetables"]=="3")  { echo 'selected="selected"'; } ?> value="3">3</option>
                                <option <?php if ($result[0]["vegetables"]=="4")  { echo 'selected="selected"'; } ?> value="4">4</option>
                                <option <?php if ($result[0]["vegetables"]=="5")  { echo 'selected="selected"'; } ?> value="5">5</option>
                                <option <?php if ($result[0]["vegetables"]=="6")  { echo 'selected="selected"'; } ?> value="6">6</option>
                                <option <?php if ($result[0]["vegetables"]=="7")  { echo 'selected="selected"'; } ?> value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <label class="container regular-font text-royal-blue">   
                            5. Frutas
                        </label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select class="form-control custom-input custom-input-select" name="fruits">
                                <option <?php if(!isset($result[0]["fruits"])) echo " selected "; ?> disabled>SELECCIONAR</option>
                                <option <?php if ($result[0]["fruits"]=="1")  { echo 'selected="selected"'; } ?> value="1">1</option>
                                <option <?php if ($result[0]["fruits"]=="2")  { echo 'selected="selected"'; } ?> value="2">2</option>
                                <option <?php if ($result[0]["fruits"]=="3")  { echo 'selected="selected"'; } ?> value="3">3</option>
                                <option <?php if ($result[0]["fruits"]=="4")  { echo 'selected="selected"'; } ?> value="4">4</option>
                                <option <?php if ($result[0]["fruits"]=="5")  { echo 'selected="selected"'; } ?> value="5">5</option>
                                <option <?php if ($result[0]["fruits"]=="6")  { echo 'selected="selected"'; } ?> value="6">6</option>
                                <option <?php if ($result[0]["fruits"]=="7")  { echo 'selected="selected"'; } ?> value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <label class="container regular-font text-royal-blue">
                            6. Cereales (maíz, arroz, trigo)
                        </label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select class="form-control custom-input custom-input-select" name="cereals">
                                <option <?php if(!isset($result[0]["cereals"])) echo " selected "; ?> disabled>SELECCIONAR</option>
                                <option <?php if ($result[0]["cereals"]=="1")  { echo 'selected="selected"'; } ?> value="1">1</option>
                                <option <?php if ($result[0]["cereals"]=="2")  { echo 'selected="selected"'; } ?> value="2">2</option>
                                <option <?php if ($result[0]["cereals"]=="3")  { echo 'selected="selected"'; } ?> value="3">3</option>
                                <option <?php if ($result[0]["cereals"]=="4")  { echo 'selected="selected"'; } ?> value="4">4</option>
                                <option <?php if ($result[0]["cereals"]=="5")  { echo 'selected="selected"'; } ?> value="5">5</option>
                                <option <?php if ($result[0]["cereals"]=="6")  { echo 'selected="selected"'; } ?> value="6">6</option>
                                <option <?php if ($result[0]["cereals"]=="7")  { echo 'selected="selected"'; } ?> value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8">
                        <label class="container regular-font text-royal-blue">
                            7. Grasas y azúcares (bebidas carbonatadas, dulces, galletas, frituras, pan dulce, helado, aceites, mantequilla)
                        </label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <select class="form-control custom-input custom-input-select" name="snacks">
                                <option <?php if(!isset($result[0]["snacks"])) echo " selected "; ?> disabled>SELECCIONAR</option>
                                <option <?php if ($result[0]["snacks"]=="1")  { echo 'selected="selected"'; } ?> value="1">1</option>
                                <option <?php if ($result[0]["snacks"]=="2")  { echo 'selected="selected"'; } ?> value="2">2</option>
                                <option <?php if ($result[0]["snacks"]=="3")  { echo 'selected="selected"'; } ?> value="3">3</option>
                                <option <?php if ($result[0]["snacks"]=="4")  { echo 'selected="selected"'; } ?> value="4">4</option>
                                <option <?php if ($result[0]["snacks"]=="5")  { echo 'selected="selected"'; } ?> value="5">5</option>
                                <option <?php if ($result[0]["snacks"]=="6")  { echo 'selected="selected"'; } ?> value="6">6</option>
                                <option <?php if ($result[0]["snacks"]=="7")  { echo 'selected="selected"'; } ?> value="7">7</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        EVALUACIÓN DE ACTIVIDAD FÍSICA
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">12) ¿Acudió a estimulación temprana?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="early_stimulation" <?php if ($result[0]["early_stimulation"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="early_stimulation" <?php if ($result[0]["early_stimulation"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">13) A la semana, ¿Realiza alguna actividad física con duración mínima de 20 a 30 min?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="exercise" <?php if ($result[0]["exercise"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="exercise" <?php if ($result[0]["exercise"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="exercise" <?php if ($result[0]["exercise"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="exercise" <?php if ($result[0]["exercise"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="exercise" <?php if ($result[0]["exercise"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">14) A la semana, ¿Cuántas veces realiza actividad física?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) No hago ejercicio
                            <input type="radio" name="exercise_times" <?php if ($result[0]["exercise_times"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 1 día a la semana
                            <input type="radio" name="exercise_times" <?php if ($result[0]["exercise_times"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 2 o 3 días por semana
                            <input type="radio" name="exercise_times" <?php if ($result[0]["exercise_times"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 3 a 5 días a la semana
                            <input type="radio" name="exercise_times" <?php if ($result[0]["exercise_times"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) 6 o más días a la semana
                            <input type="radio" name="exercise_times" <?php if ($result[0]["exercise_times"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">15) Si realiza ejercicio, consideras que el tiempo invertido es el suficiente</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="sport_active" <?php if ($result[0]["sport_active"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="sport_active" <?php if ($result[0]["sport_active"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        EVALUACIÓN DEL PERFIL DE RESPONSABILIDAD EN SALUD
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">16) El número de veces que acudo a servicios médicos para valoración del niño</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1 vez cada 15 días
                            <input type="radio" name="medical_times" <?php if ($result[0]["medical_times"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 1 vez cada 15 o 29 días
                            <input type="radio" name="medical_times" <?php if ($result[0]["medical_times"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 1 vez cada mes o 3 meses
                            <input type="radio" name="medical_times" <?php if ($result[0]["medical_times"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 1 vez cada 3 meses o al año
                            <input type="radio" name="medical_times" <?php if ($result[0]["medical_times"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) 1 vez cada 2 años o más
                            <input type="radio" name="medical_times" <?php if ($result[0]["medical_times"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">17) ¿Exploro fisicamente al niño para detectar cambios?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="kid_review" <?php if ($result[0]["kid_review"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="kid_review" <?php if ($result[0]["kid_review"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="kid_review" <?php if ($result[0]["kid_review"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="kid_review" <?php if ($result[0]["kid_review"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="kid_review" <?php if ($result[0]["kid_review"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">18) Le realizo exámenes médicos de rutina (biometría hemática, examen general de orina, entre otros)</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="medical_exams" <?php if ($result[0]["medical_exams"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="medical_exams" <?php if ($result[0]["medical_exams"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="medical_exams" <?php if ($result[0]["medical_exams"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="medical_exams" <?php if ($result[0]["medical_exams"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="medical_exams" <?php if ($result[0]["medical_exams"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">19) Acudo al servico de Odontologia con el niño para limpieza o algún otro tratamiento?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1 vez cada 15 días
                            <input type="radio" name="dentist" <?php if ($result[0]["dentist"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 1 vez cada 15 o 29 días
                            <input type="radio" name="dentist" <?php if ($result[0]["dentist"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 1 vez cada mes o 3 meses
                            <input type="radio" name="dentist" <?php if ($result[0]["dentist"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 1 vez cada 3 meses o al año
                            <input type="radio" name="dentist" <?php if ($result[0]["dentist"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) 1 vez cada 2 años o más
                            <input type="radio" name="dentist" <?php if ($result[0]["dentist"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">20) ¿Has acudido alguna vez a consulta de nutrición con el?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="nutrition" <?php if ($result[0]["nutrition"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="nutrition" <?php if ($result[0]["nutrition"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">¿Has acudido alguna vez a consulta de psicología con el?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="psychology" <?php if ($result[0]["psychology"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="psychology" <?php if ($result[0]["psychology"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">21) ¿Cuando se enferma el niño yo le doy medicamentos?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="previous_treatment" <?php if ($result[0]["previous_treatment"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="previous_treatment" <?php if ($result[0]["previous_treatment"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="previous_treatment" <?php if ($result[0]["previous_treatment"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="previous_treatment" <?php if ($result[0]["previous_treatment"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="previous_treatment" <?php if ($result[0]["previous_treatment"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">22) Durante el último año ¿El niño se enfermó…?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="diseases" <?php if ($result[0]["diseases"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="diseases" <?php if ($result[0]["diseases"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="diseases" <?php if ($result[0]["diseases"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="diseases" <?php if ($result[0]["diseases"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="diseases" <?php if ($result[0]["diseases"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">23) Busco información confiable sobre cuidados de la salud del niño (Revistas, programas de salud, conferencias o exposiciones)</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="childcare" <?php if ($result[0]["childcare"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="childcare" <?php if ($result[0]["childcare"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="childcare" <?php if ($result[0]["childcare"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="childcare" <?php if ($result[0]["childcare"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="childcare" <?php if ($result[0]["childcare"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">24) Le pregunto  a otro médico u otra opción cuando no estoy de acuerdo con el.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="second_opinion" <?php if ($result[0]["second_opinion"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="second_opinion" <?php if ($result[0]["second_opinion"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="second_opinion" <?php if ($result[0]["second_opinion"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="second_opinion" <?php if ($result[0]["second_opinion"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="second_opinion" <?php if ($result[0]["second_opinion"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        EVALUACIÓN DEL SOPORTE INTERPRESONAL
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">25) Cuando algo le preocupa al niño, abiertamente el expresa lo que siente?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Casi siempre
                            <input type="radio" name="say_feelings" <?php if ($result[0]["say_feelings"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Algunas veces
                            <input type="radio" name="say_feelings" <?php if ($result[0]["say_feelings"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="say_feelings" <?php if ($result[0]["say_feelings"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">26) El niño habla y ríe fuertemente.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Casi siempre
                            <input type="radio" name="speak_louder" <?php if ($result[0]["speak_louder"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Algunas veces
                            <input type="radio" name="speak_louder" <?php if ($result[0]["speak_louder"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="speak_louder" <?php if ($result[0]["speak_louder"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">27) El niño juega con otros niños.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Casi siempre
                            <input type="radio" name="play" <?php if ($result[0]["play"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Algunas veces
                            <input type="radio" name="play" <?php if ($result[0]["play"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="play" <?php if ($result[0]["play"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">28) El niño es retraido.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Casi siempre
                            <input type="radio" name="withdrawn" <?php if ($result[0]["withdrawn"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Algunas veces
                            <input type="radio" name="withdrawn" <?php if ($result[0]["withdrawn"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="withdrawn" <?php if ($result[0]["withdrawn"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">29) Le gusta compartir con su familia.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Casi siempre
                            <input type="radio" name="share_family" <?php if ($result[0]["share_family"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Algunas veces
                            <input type="radio" name="share_family" <?php if ($result[0]["share_family"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="share_family" <?php if ($result[0]["share_family"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">30) Suele estar de mal humor.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Casi siempre
                            <input type="radio" name="moodiness" <?php if ($result[0]["moodiness"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Algunas veces
                            <input type="radio" name="moodiness" <?php if ($result[0]["moodiness"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="moodiness" <?php if ($result[0]["moodiness"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">31) Prefiere trabajar solo en las actividades escolares (si aplica).</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Casi siempre
                            <input type="radio" name="work_alone" <?php if ($result[0]["work_alone"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Algunas veces
                            <input type="radio" name="work_alone" <?php if ($result[0]["work_alone"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="work_alone" <?php if ($result[0]["work_alone"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        EVALUACIÓN DE DESARROLLO Y APRENDIZAJE
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row pt-4">
                    <div class="col-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">Edad (años)</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue bold-font custom-form-label-element">Actividad</span>
                    </div>
                    <div class="col-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">Si</span>
                    </div>
                    <div class="col-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">No</span>
                    </div>
                    <div class="col-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">No aplica</span>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">1</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Camina</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_one" <?php if ($result[0]["table_one"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_one" <?php if ($result[0]["table_one"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_one" <?php if ($result[0]["table_one"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Sube escales con ayuda</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_two" <?php if ($result[0]["table_two"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_two" <?php if ($result[0]["table_two"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_two" <?php if ($result[0]["table_two"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Apila cubos</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_three" <?php if ($result[0]["table_three"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_three" <?php if ($result[0]["table_three"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_three" <?php if ($result[0]["table_three"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">2</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Corre</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_four" <?php if ($result[0]["table_four"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_four" <?php if ($result[0]["table_four"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_four" <?php if ($result[0]["table_four"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Señala partes de su cuerpo</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_five" <?php if ($result[0]["table_five"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_five" <?php if ($result[0]["table_five"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_five" <?php if ($result[0]["table_five"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Dice oraciones cortas</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_six" <?php if ($result[0]["table_six"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_six" <?php if ($result[0]["table_six"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_six" <?php if ($result[0]["table_six"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Une palabras</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_seven" <?php if ($result[0]["table_seven"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_seven" <?php if ($result[0]["table_seven"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_seven" <?php if ($result[0]["table_seven"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Pierde el apego a los padres</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eight" <?php if ($result[0]["table_eight"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eight" <?php if ($result[0]["table_eight"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eight" <?php if ($result[0]["table_eight"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">3</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Dice su apellido</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_nine" <?php if ($result[0]["table_nine"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_nine" <?php if ($result[0]["table_nine"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_nine" <?php if ($result[0]["table_nine"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Conoce su genero</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_ten" <?php if ($result[0]["table_ten"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_ten" <?php if ($result[0]["table_ten"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_ten" <?php if ($result[0]["table_ten"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Copia circulos, lineas</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eleven" <?php if ($result[0]["table_eleven"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eleven" <?php if ($result[0]["table_eleven"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eleven" <?php if ($result[0]["table_eleven"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Señala 2 imágenes iguales</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twelve" <?php if ($result[0]["table_twelve"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twelve" <?php if ($result[0]["table_twelve"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twelve" <?php if ($result[0]["table_twelve"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">4</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Copia patrones geometricos</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_thirteen" <?php if ($result[0]["table_thirteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_thirteen" <?php if ($result[0]["table_thirteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_thirteen" <?php if ($result[0]["table_thirteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Repite 4 digitos</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fourteen" <?php if ($result[0]["table_fourteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fourteen" <?php if ($result[0]["table_fourteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fourteen" <?php if ($result[0]["table_fourteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Juega con otros niños</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fifteen" <?php if ($result[0]["table_fifteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fifteen" <?php if ($result[0]["table_fifteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_fifteen" <?php if ($result[0]["table_fifteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Empiezan las rabietas</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_sixteen" <?php if ($result[0]["table_sixteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_sixteen" <?php if ($result[0]["table_sixteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_sixteen" <?php if ($result[0]["table_sixteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Salta</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_seventeen" <?php if ($result[0]["table_seventeen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_seventeen" <?php if ($result[0]["table_seventeen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_seventeen" <?php if ($result[0]["table_seventeen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row bg-tgray pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Baila</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eighteen" <?php if ($result[0]["table_eighteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eighteen" <?php if ($result[0]["table_eighteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_eighteen" <?php if ($result[0]["table_eighteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="col-2">
                        <span class="text-royal-blue regular-font custom-form-label-element">5</span>
                    </div>
                    <div class="col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Se viste solo</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_nineteen" <?php if ($result[0]["table_nineteen"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_nineteen" <?php if ($result[0]["table_nineteen"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_nineteen" <?php if ($result[0]["table_nineteen"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Utiliza tijeras</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twenty" <?php if ($result[0]["table_twenty"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twenty" <?php if ($result[0]["table_twenty"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twenty" <?php if ($result[0]["table_twenty"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Acepta reglas</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twentyone" <?php if ($result[0]["table_twentyone"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twentyone" <?php if ($result[0]["table_twentyone"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twentyone" <?php if ($result[0]["table_twentyone"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Puede contar hasta 10</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twentytwo" <?php if ($result[0]["table_twentytwo"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twentytwo" <?php if ($result[0]["table_twentytwo"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twentytwo" <?php if ($result[0]["table_twentytwo"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
                <div class="row pt-2 pb-2">
                    <div class="offset-2 col-4">
                        <span class="text-royal-blue regular-font custom-form-label-element">Expresa emociones y sentimientos</span>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twentythree" <?php if ($result[0]["table_twentythree"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twentythree" <?php if ($result[0]["table_twentythree"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                    <div class="col-2">
                        <label class="container regular-font text-royal-blue">
                            <input type="radio" name="table_twentythree" <?php if ($result[0]["table_twentythree"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        EVALUACIÓN DE HIGIENE PERSONAL
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">37) El número de veces que el niño recibe baño al día.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 2 veces al día
                            <input type="radio" name="bath_times" <?php if ($result[0]["bath_times"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 1 vez al día
                            <input type="radio" name="bath_times" <?php if ($result[0]["bath_times"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 1 vez cada 2 o 3 días
                            <input type="radio" name="bath_times" <?php if ($result[0]["bath_times"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 1 vez cada 4 o 5 días
                            <input type="radio" name="bath_times" <?php if ($result[0]["bath_times"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) 1 vez cada 6 días o más
                            <input type="radio" name="bath_times" <?php if ($result[0]["bath_times"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">38) Acostumbro lavarle las manos antes de comer o después de ir al baño.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="handwashing" <?php if ($result[0]["handwashing"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="handwashing" <?php if ($result[0]["handwashing"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="handwashing" <?php if ($result[0]["handwashing"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="handwashing" <?php if ($result[0]["handwashing"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="handwashing" <?php if ($result[0]["handwashing"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">39) La frecuencia con la que le lavo los dientes es.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Después de cada comida
                            <input type="radio" name="brush_teeth" <?php if ($result[0]["brush_teeth"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 2 veces al día
                            <input type="radio" name="brush_teeth" <?php if ($result[0]["brush_teeth"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 1 vez al día
                            <input type="radio" name="brush_teeth" <?php if ($result[0]["brush_teeth"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 1 vez cada 2 o 3 días
                            <input type="radio" name="brush_teeth" <?php if ($result[0]["brush_teeth"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) 1 vez cada 4 días o más
                            <input type="radio" name="brush_teeth" <?php if ($result[0]["brush_teeth"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">40) Haco uso de hilo dental.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="floss_use" <?php if ($result[0]["floss_use"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="floss_use" <?php if ($result[0]["floss_use"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="floss_use" <?php if ($result[0]["floss_use"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="floss_use" <?php if ($result[0]["floss_use"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="floss_use" <?php if ($result[0]["floss_use"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">41) ¿Hago el cambio del cepillo de dientes del niño cada 6 meses?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="toothbrush" <?php if ($result[0]["toothbrush"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="toothbrush" <?php if ($result[0]["toothbrush"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="toothbrush" <?php if ($result[0]["toothbrush"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="toothbrush" <?php if ($result[0]["toothbrush"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="toothbrush" <?php if ($result[0]["toothbrush"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">31) En el ultimo mes, le he cortado las uñas de las manos y de los pies al niño</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="nails_cut" <?php if ($result[0]["nails_cut"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="nails_cut" <?php if ($result[0]["nails_cut"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="nails_cut" <?php if ($result[0]["nails_cut"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="nails_cut" <?php if ($result[0]["nails_cut"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="nails_cut" <?php if ($result[0]["nails_cut"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">42) ¿Cambio regularmente la toalla que usa el niño?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="bath_towel" <?php if ($result[0]["bath_towel"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="bath_towel" <?php if ($result[0]["bath_towel"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="bath_towel" <?php if ($result[0]["bath_towel"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="bath_towel" <?php if ($result[0]["bath_towel"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="bath_towel" <?php if ($result[0]["bath_towel"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
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