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
            $realized = saveHopelessData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveHopelessData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=hopeless'); exit;
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
                        <i class="fas fa-burn custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo HOPELESS_NAME; ?></h4>
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
                            Espero el futuro con esperanza y entusiasmo.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="hope" <?php if ($result[0]["hope"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="hope" <?php if ($result[0]["hope"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>2. </strong>Puedo darme por
                            vencido, renunciar, ya que no puedo hacer mejor las cosas por mí mismo.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="renounce" <?php if ($result[0]["renounce"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="renounce" <?php if ($result[0]["renounce"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>3. </strong>Cuando las cosas van
                            mal me alivia saber que las cosas no pueden permanecer tiempo así.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="relief" <?php if ($result[0]["relief"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="relief" <?php if ($result[0]["relief"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>4. </strong> No puedo imaginar
                            cómo será mi vida en 10 años.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="imagine" <?php if ($result[0]["imagine"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="imagine" <?php if ($result[0]["imagine"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>5. </strong>Tengo bastante tiempo
                            para poder hacer las cosas que quisiera poder hacer.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="have_time" <?php if ($result[0]["have_time"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="have_time" <?php if ($result[0]["have_time"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>6. </strong>En el futuro, espero
                            conseguir lo que me pueda interesar.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="future" <?php if ($result[0]["future"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="future" <?php if ($result[0]["future"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>7. </strong>Mi futuro me parece
                            oscuro.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="dark_future" <?php if ($result[0]["dark_future"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="dark_future" <?php if ($result[0]["dark_future"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>8. </strong>Espero más cosas
                            buenas de la vida que lo que la gente suele conseguir por término medio.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="expect_good" <?php if ($result[0]["expect_good"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="expect_good" <?php if ($result[0]["expect_good"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>9. </strong>No logro hacer que las
                            cosas cambien, y no existen razones para creer que pueda en el futuro.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="cant_change" <?php if ($result[0]["cant_change"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="cant_change" <?php if ($result[0]["cant_change"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>10. </strong>Mis pasadas
                            experiencias me han preparado bien para mi futuro.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="experiences" <?php if ($result[0]["experiences"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="experiences" <?php if ($result[0]["experiences"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>11. </strong>Todo lo que puedo ver
                            por delante de mí es más desagradable que agradable.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="unpleasant_future" <?php if ($result[0]["unpleasant_future"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="unpleasant_future" <?php if ($result[0]["unpleasant_future"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>12. </strong>No espero conseguir
                            lo que realmente deseo.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="expect_anything" <?php if ($result[0]["expect_anything"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="expect_anything" <?php if ($result[0]["expect_anything"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>13. </strong>Cuando miro hacia el
                            futuro, espero que seré más feliz de lo que soy ahora.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="happy_future" <?php if ($result[0]["happy_future"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="happy_future" <?php if ($result[0]["happy_future"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>14. </strong>Las cosas no marchan
                            como yo quisiera.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="things_wrong" <?php if ($result[0]["things_wrong"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="things_wrong" <?php if ($result[0]["things_wrong"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>15. </strong>Tengo una gran
                            confianza en el futuro.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="expect_future" <?php if ($result[0]["expect_future"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="expect_future" <?php if ($result[0]["expect_future"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>16. </strong>Nunca consigo lo que
                            deseo, por lo que es absurdo desear cualquier cosa.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="not_want" <?php if ($result[0]["not_want"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="not_want" <?php if ($result[0]["not_want"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>17. </strong>Es muy improbable que
                            pueda lograr una satisfacción real en el futuro.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="satisfaction" <?php if ($result[0]["satisfaction"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="satisfaction" <?php if ($result[0]["satisfaction"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>18. </strong>El futuro me parece
                            vago e incierto.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="uncertain_future" <?php if ($result[0]["uncertain_future"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="uncertain_future" <?php if ($result[0]["uncertain_future"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>19. </strong>Espero más bien
                            épocas buenas que malas.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="good_times" <?php if ($result[0]["good_times"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="good_times" <?php if ($result[0]["good_times"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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
                        <span class="instructions-paragraph regular-font text-royal-blue"><strong>20. </strong>No merece la pena que
                            intente conseguir algo que desee, porque probablemente no lo lograré.</span>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-12 col-xl-6">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">VERDADERO
                                        <input type="radio" name="dont_try" <?php if ($result[0]["dont_try"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                                        <span class="radiomark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="container regular-font text-royal-blue">FALSO
                                        <input type="radio" name="dont_try" <?php if ($result[0]["dont_try"]=="0")  { echo 'checked="true"'; } ?> value="0" />
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