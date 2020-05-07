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
            $realized = saveYoungLifestyleData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveYoungLifestyleData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=youngLifestyle'); exit;
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
                        <i class="fas fa-child custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo YOUNG_LIFESTYLE_NAME; ?></h4>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">1) ¿Normalmente a la semana, consumo algún alimento al levantarme?</span>
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
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="wake_food" <?php if ($result[0]["wake_food"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="wake_food" <?php if ($result[0]["wake_food"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
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
                        <span class="text-royal-blue bold-font custom-form-label-element">2) ¿Normalmente a la semana con qué frecuencia consumo alimentos con conservadores artificiales?</span>
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
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="chemical_food" <?php if ($result[0]["chemical_food"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="chemical_food" <?php if ($result[0]["chemical_food"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
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
                        <label class="container regular-font text-royal-blue">a) 6 veces o más
                            <input type="radio" name="food_times" <?php if ($result[0]["food_times"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 4 o 5 veces
                            <input type="radio" name="food_times" <?php if ($result[0]["food_times"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 3 veces
                            <input type="radio" name="food_times" <?php if ($result[0]["food_times"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 1 o 2 veces
                            <input type="radio" name="food_times" <?php if ($result[0]["food_times"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) No siempre como diario
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
                        <span class="text-royal-blue bold-font custom-form-label-element">4) Frecuentemente consume alimentos hechos fuera de casa</span>
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
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="fast_food" <?php if ($result[0]["fast_food"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="fast_food" <?php if ($result[0]["fast_food"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
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
                        <span class="text-royal-blue bold-font custom-form-label-element">5) Durante las comidas en casa acostumbra a consumir alimentos fritos (Antojitos)</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">6) Respeta el horario establecido para las comidas</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">7) Continúo comiendo después de quedar satisfecho.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">8) Considero que mi dieta es balanceada</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">9) Como para sentirme bien o tranquilizarme</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="eat_pleasure" <?php if ($result[0]["eat_pleasure"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="eat_pleasure" <?php if ($result[0]["eat_pleasure"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="eat_pleasure" <?php if ($result[0]["eat_pleasure"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="eat_pleasure" <?php if ($result[0]["eat_pleasure"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="eat_pleasure" <?php if ($result[0]["eat_pleasure"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">10) Cuando compro alimentos reviso las etiquetas en los alimentos para conocer sus ingredientes</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="check_labels" <?php if ($result[0]["check_labels"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="check_labels" <?php if ($result[0]["check_labels"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="check_labels" <?php if ($result[0]["check_labels"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="check_labels" <?php if ($result[0]["check_labels"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="check_labels" <?php if ($result[0]["check_labels"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="text-royal-blue bold-font custom-form-label-element">12) Realizo actividades físicas de recreo como caminar, nadar, jugar futbol o ciclismo de 20 a 30min en la semana.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">13) La frecuencia con la que hago actividad física a la semana.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">14) Si realizas ejercicio, consideras que el tiempo invertido es el suficiente.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="sport_active" <?php if ($result[0]["sport_active"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="sport_active" <?php if ($result[0]["sport_active"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="sport_active" <?php if ($result[0]["sport_active"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="sport_active" <?php if ($result[0]["sport_active"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="sport_active" <?php if ($result[0]["sport_active"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="text-royal-blue bold-font custom-form-label-element">15) El número de veces que acudo a servicios médicos.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">16) Autoexploro físicamente mi cuerpo para detectar cambios.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="body_explore" <?php if ($result[0]["body_explore"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="body_explore" <?php if ($result[0]["body_explore"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="body_explore" <?php if ($result[0]["body_explore"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="body_explore" <?php if ($result[0]["body_explore"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="body_explore" <?php if ($result[0]["body_explore"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">17) Me realizo exámenes médicos de rutina (biometría hemática, examen general de orina, química sanguínea, perfil de lípidos, entre otros)</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">18) ¿Con que frecuencia te checas la presión arterial?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Cada 3 meses o menos
                            <input type="radio" name="blood_pressure" <?php if ($result[0]["blood_pressure"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Cada 3 a 6 meses
                            <input type="radio" name="blood_pressure" <?php if ($result[0]["blood_pressure"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Cada 7 meses al año
                            <input type="radio" name="blood_pressure" <?php if ($result[0]["blood_pressure"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Cada 1 o 2 años
                            <input type="radio" name="blood_pressure" <?php if ($result[0]["blood_pressure"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) 1 vez cada 2 años o más
                            <input type="radio" name="blood_pressure" <?php if ($result[0]["blood_pressure"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">19) Acudo a servicios con el dentista.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">20) ¿Has acudido con él a consulta con psicología?</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">¿Y nutrición?</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">21) Cuando me enfermo me automedico.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="self_medicate" <?php if ($result[0]["self_medicate"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="self_medicate" <?php if ($result[0]["self_medicate"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="self_medicate" <?php if ($result[0]["self_medicate"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="self_medicate" <?php if ($result[0]["self_medicate"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="self_medicate" <?php if ($result[0]["self_medicate"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">22) Durante el último año ¿usted se enfermó?</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">23) Busco información confiable sobre cuidados de la salud (Revistas, programas de salud, conferencias o exposiciones)</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="search_information" <?php if ($result[0]["search_information"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="search_information" <?php if ($result[0]["search_information"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="search_information" <?php if ($result[0]["search_information"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="search_information" <?php if ($result[0]["search_information"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="search_information" <?php if ($result[0]["search_information"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">24) Le pregunto a otro médico u otra opción cuando no estoy de acuerdo con el.</span>
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
                        EVALUACIÓN DEL MANEJO DEL ESTRÉS
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">25) Me tomo mi tiempo para relajarme.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="relax_time" <?php if ($result[0]["relax_time"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="relax_time" <?php if ($result[0]["relax_time"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="relax_time" <?php if ($result[0]["relax_time"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="relax_time" <?php if ($result[0]["relax_time"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="relax_time" <?php if ($result[0]["relax_time"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">26) Soy consciente de las causas que me producen estrés o ansiedad.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="stress_causes" <?php if ($result[0]["stress_causes"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="stress_causes" <?php if ($result[0]["stress_causes"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="stress_causes" <?php if ($result[0]["stress_causes"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="stress_causes" <?php if ($result[0]["stress_causes"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="stress_causes" <?php if ($result[0]["stress_causes"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">27) Durante el día siento que el estrés afecta mis actividades cotidianas.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="stress_impact" <?php if ($result[0]["stress_impact"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="stress_impact" <?php if ($result[0]["stress_impact"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="stress_impact" <?php if ($result[0]["stress_impact"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="stress_impact" <?php if ($result[0]["stress_impact"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="stress_impact" <?php if ($result[0]["stress_impact"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">28) Utilizo técnicas o métodos para controlar el estrés.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="stress_control_methods" <?php if ($result[0]["stress_control_methods"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="stress_control_methods" <?php if ($result[0]["stress_control_methods"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="stress_control_methods" <?php if ($result[0]["stress_control_methods"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="stress_control_methods" <?php if ($result[0]["stress_control_methods"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="stress_control_methods" <?php if ($result[0]["stress_control_methods"]=="e")  { echo 'checked="true"'; } ?> value="e" />
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
                        <span class="text-royal-blue bold-font custom-form-label-element">29) Tengo una persona con quien me siento en confianza para hablar.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="confident" <?php if ($result[0]["confident"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="confident" <?php if ($result[0]["confident"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">30) Me siento solo a pesar de estar acompañado.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="feeling_alone" <?php if ($result[0]["feeling_alone"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="feeling_alone" <?php if ($result[0]["feeling_alone"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">31) Tengo dificultad para relacionarme con las demás personas.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="difficulty_relating" <?php if ($result[0]["difficulty_relating"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="difficulty_relating" <?php if ($result[0]["difficulty_relating"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">32) Critico a los demás por sus éxitos.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="criticize" <?php if ($result[0]["criticize"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="criticize" <?php if ($result[0]["criticize"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">33) Evito dar opiniones por temor al rechazo, burlo o que otras personas me ignoren.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="no_opinion" <?php if ($result[0]["no_opinion"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="no_opinion" <?php if ($result[0]["no_opinion"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">34) Me gusta expresar afecto a personas cercanas a mi.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="tofeel_affection" <?php if ($result[0]["tofeel_affection"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="tofeel_affection" <?php if ($result[0]["tofeel_affection"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">35) Me gusta recibir muestras de afecto de personas cercanas a mi.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="affection_taste" <?php if ($result[0]["affection_taste"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="affection_taste" <?php if ($result[0]["affection_taste"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">36) Prefiero trabajar solo.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="alone_prefer" <?php if ($result[0]["alone_prefer"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="alone_prefer" <?php if ($result[0]["alone_prefer"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        EVALUACIÓN DE AUTOACEPTACIÓN
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">37) Me quiero a mí mismo.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="love_me" <?php if ($result[0]["love_me"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="love_me" <?php if ($result[0]["love_me"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">38) Considero que mi vida tiene un propósito.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="purpose_life" <?php if ($result[0]["purpose_life"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="purpose_life" <?php if ($result[0]["purpose_life"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">39) Soy entusiasta y optimista sobre aspectos de mi vida.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="enthusiast" <?php if ($result[0]["enthusiast"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="enthusiast" <?php if ($result[0]["enthusiast"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">40) Tengo metas a largo plazo.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="long_term_goals" <?php if ($result[0]["long_term_goals"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="long_term_goals" <?php if ($result[0]["long_term_goals"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">41) Soy realista en las metas que me propongo.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="realistic_goals" <?php if ($result[0]["realistic_goals"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="realistic_goals" <?php if ($result[0]["realistic_goals"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">42) En el último año, considero que he cumplido mis metas.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="fulfilled_goals" <?php if ($result[0]["fulfilled_goals"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="fulfilled_goals" <?php if ($result[0]["fulfilled_goals"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">43) Soy consciente de mis capacidades y debilidades personales.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="capacity_debility" <?php if ($result[0]["capacity_debility"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="capacity_debility" <?php if ($result[0]["capacity_debility"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">44) Considero que mis errores me han hecho crecer como persona.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="mistakes" <?php if ($result[0]["mistakes"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="mistakes" <?php if ($result[0]["mistakes"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        EVALUACIÓN DE TIEMPO LIBRE
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">45) Durante la semana dedico tiempo a actividades de recreación.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="recreation" <?php if ($result[0]["recreation"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="recreation" <?php if ($result[0]["recreation"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="recreation" <?php if ($result[0]["recreation"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="recreation" <?php if ($result[0]["recreation"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="recreation" <?php if ($result[0]["recreation"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">46) Cuando decides quedarte en casa a escuchar música, ver televisión o jugar videojuegos, ¿Cuántas horas al día le dedica a estas actividades?</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 15 a 30 minutos
                            <input type="radio" name="entertainment_time" <?php if ($result[0]["entertainment_time"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 31 minutos a 1 hora
                            <input type="radio" name="entertainment_time" <?php if ($result[0]["entertainment_time"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 1 a 2 horas
                            <input type="radio" name="entertainment_time" <?php if ($result[0]["entertainment_time"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 2 a 5 horas
                            <input type="radio" name="entertainment_time" <?php if ($result[0]["entertainment_time"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Más de 5 horas
                            <input type="radio" name="entertainment_time" <?php if ($result[0]["entertainment_time"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">47) Durante la semana consumo alcohol (Cerveza, licor, vino, vodka)</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="alcohol" <?php if ($result[0]["alcohol"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="alcohol" <?php if ($result[0]["alcohol"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="alcohol" <?php if ($result[0]["alcohol"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="alcohol" <?php if ($result[0]["alcohol"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="alcohol" <?php if ($result[0]["alcohol"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">48) Durante la semana consumo tabaco (Cigarro, pipa, masticable, cigarro electrónico)</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="cigar" <?php if ($result[0]["cigar"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="cigar" <?php if ($result[0]["cigar"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="cigar" <?php if ($result[0]["cigar"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="cigar" <?php if ($result[0]["cigar"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="cigar" <?php if ($result[0]["cigar"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">49) Durante la semana dedico tiempo para realizar actividades recreativas con la familia.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="recreational_activities" <?php if ($result[0]["recreational_activities"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="recreational_activities" <?php if ($result[0]["recreational_activities"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="recreational_activities" <?php if ($result[0]["recreational_activities"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="recreational_activities" <?php if ($result[0]["recreational_activities"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="recreational_activities" <?php if ($result[0]["recreational_activities"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-2 text-center">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        EVALUACIÓN DEL SUEÑO
                    </span>
                </div>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">50) En el último mes, duermo por lo regular.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Menos de 3 horas
                            <input type="radio" name="time_sleep" <?php if ($result[0]["time_sleep"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) De 3 a 5 horas
                            <input type="radio" name="time_sleep" <?php if ($result[0]["time_sleep"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) De 5 a 7 horas
                            <input type="radio" name="time_sleep" <?php if ($result[0]["time_sleep"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) De 7 a 9 horas
                            <input type="radio" name="time_sleep" <?php if ($result[0]["time_sleep"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Más de 9 horas
                            <input type="radio" name="time_sleep" <?php if ($result[0]["time_sleep"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">51) En el último mes, tengo problemas para dormir dentro de la primera hora después de acostarme.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="insomnia" <?php if ($result[0]["insomnia"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="insomnia" <?php if ($result[0]["insomnia"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="insomnia" <?php if ($result[0]["insomnia"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="insomnia" <?php if ($result[0]["insomnia"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="insomnia" <?php if ($result[0]["insomnia"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">52) En el último mes, me despierto durante la noche o madrugada.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="wake_midnight" <?php if ($result[0]["wake_midnight"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="wake_midnight" <?php if ($result[0]["wake_midnight"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="wake_midnight" <?php if ($result[0]["wake_midnight"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="wake_midnight" <?php if ($result[0]["wake_midnight"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="wake_midnight" <?php if ($result[0]["wake_midnight"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">53) En el último mes, me siento cansado o somnoliento durante el día.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="drowsiness" <?php if ($result[0]["drowsiness"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="drowsiness" <?php if ($result[0]["drowsiness"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="drowsiness" <?php if ($result[0]["drowsiness"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="drowsiness" <?php if ($result[0]["drowsiness"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="drowsiness" <?php if ($result[0]["drowsiness"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">54) En el último mes, me he despertado durante la noche por no poder respirar bien.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="shortness_breath" <?php if ($result[0]["shortness_breath"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="shortness_breath" <?php if ($result[0]["shortness_breath"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="shortness_breath" <?php if ($result[0]["shortness_breath"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="shortness_breath" <?php if ($result[0]["shortness_breath"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="shortness_breath" <?php if ($result[0]["shortness_breath"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">55) En el último mes, me han dicho que toso o ronco intensamente mientras duermo.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="cough_snore" <?php if ($result[0]["cough_snore"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="cough_snore" <?php if ($result[0]["cough_snore"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="cough_snore" <?php if ($result[0]["cough_snore"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="cough_snore" <?php if ($result[0]["cough_snore"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="cough_snore" <?php if ($result[0]["cough_snore"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">56) En el último mes, he tenido pesadillas o "malos sueños".</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="nightmare" <?php if ($result[0]["nightmare"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="nightmare" <?php if ($result[0]["nightmare"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="nightmare" <?php if ($result[0]["nightmare"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="nightmare" <?php if ($result[0]["nightmare"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="nightmare" <?php if ($result[0]["nightmare"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">57) En el último mes, por la noche siento que mis propios pensamientos no me dejan dormir.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="thoughts" <?php if ($result[0]["thoughts"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="thoughts" <?php if ($result[0]["thoughts"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="thoughts" <?php if ($result[0]["thoughts"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="thoughts" <?php if ($result[0]["thoughts"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="thoughts" <?php if ($result[0]["thoughts"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">58) En el último mes, tomo medicamentos u otras sustancias o remedios para poder dormir.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="sleeping_pills" <?php if ($result[0]["sleeping_pills"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="sleeping_pills" <?php if ($result[0]["sleeping_pills"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="sleeping_pills" <?php if ($result[0]["sleeping_pills"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="sleeping_pills" <?php if ($result[0]["sleeping_pills"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="sleeping_pills" <?php if ($result[0]["sleeping_pills"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">59) Consumo café, bebidas energéticas, tabaco o hago ejercicio después de las 19:00 (7pm) horas.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="energy_drink" <?php if ($result[0]["energy_drink"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="energy_drink" <?php if ($result[0]["energy_drink"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="energy_drink" <?php if ($result[0]["energy_drink"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="energy_drink" <?php if ($result[0]["energy_drink"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="energy_drink" <?php if ($result[0]["energy_drink"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">60) El número de veces que me baño al día.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">61) Acostumbro lavarme las manos antes de comer o después de ir al baño.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">62) La frecuencia con la que me lavo los dientes es:</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">63) Hago uso de hilo dental.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">64) Cambio el cepillo de dientes que uso.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">65) Acostumbro a usar desodorante natural y/o artificial.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="deodorant" <?php if ($result[0]["deodorant"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="deodorant" <?php if ($result[0]["deodorant"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="deodorant" <?php if ($result[0]["deodorant"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="deodorant" <?php if ($result[0]["deodorant"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="deodorant" <?php if ($result[0]["deodorant"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">66) Tiendo a cambiar mi ropa interior.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Nunca
                            <input type="radio" name="underwear" <?php if ($result[0]["underwear"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Casi nunca
                            <input type="radio" name="underwear" <?php if ($result[0]["underwear"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) A veces
                            <input type="radio" name="underwear" <?php if ($result[0]["underwear"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Casi siempre
                            <input type="radio" name="underwear" <?php if ($result[0]["underwear"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Siempre
                            <input type="radio" name="underwear" <?php if ($result[0]["underwear"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-2">
                        <span class="text-royal-blue bold-font custom-form-label-element">67) En el último mes, me he cortado las uñas de las manos y de los pies.</span>
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
                        <span class="text-royal-blue bold-font custom-form-label-element">68) Cambio regularmente la toalla que uso.</span>
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