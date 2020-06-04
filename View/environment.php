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
            $realized = saveEnvironmentData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveEnvironmentData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=environment'); exit;
          }
      }

      $result = getModuleData($linkDB, $_POST["module"], $_POST["id_patient"]);
    //   var_dump($result);
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
                        <i class="fas fa-seedling custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo ENVIRONMENT_NAME; ?></h4>
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
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>1. </strong>El origen de la captación del agua proviene de:
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Pozo
                            <input type="radio" name="water_acquisition" <?php if ($result[0]["water_acquisition"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Superficial
                            <input type="radio" name="water_acquisition" <?php if ($result[0]["water_acquisition"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Manantial
                            <input type="radio" name="water_acquisition" <?php if ($result[0]["water_acquisition"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Otro
                            <input type="radio" name="water_acquisition" <?php if ($result[0]["water_acquisition"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="water_acquisition_desc" value="<?php echo utf8_encode($result[0]["water_acquisition_desc"]); ?>" placeholder="En caso de ser otro ¿cuál?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>2. </strong>¿De qué forma es almacenada el agua que usas en casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Aire libre
                            <input type="radio" name="water_store" <?php if ($result[0]["water_store"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Cubeta
                            <input type="radio" name="water_store" <?php if ($result[0]["water_store"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Tinaco
                            <input type="radio" name="water_store" <?php if ($result[0]["water_store"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Otro
                            <input type="radio" name="water_store" <?php if ($result[0]["water_store"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="water_store_desc" value="<?php echo utf8_encode($result[0]["water_store_desc"]); ?>" placeholder="En caso de ser otro ¿cuál?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>3. </strong>¿El agua en tu casa es incolora, inodora e insabora?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Color</label>
                            <input type="text" class="form-control custom-input" name="water_color" value="<?php echo utf8_encode($result[0]["water_color"]); ?>" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Olor</label>
                            <input type="text" class="form-control custom-input" name="water_odor" value="<?php echo utf8_encode($result[0]["water_odor"]); ?>" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font">Sabor</label>
                            <input type="text" class="form-control custom-input" name="water_flavor" value="<?php echo utf8_encode($result[0]["water_flavor"]); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>4. </strong>La medición de las propiedades del agua estan en el rango de:
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Turbiedad (1 UNT - 5 UNT)
                                <input type="checkbox" <?php if ($result[0]["water_quality_a"]!=0)  { echo 'checked="true"'; } ?> name="water_quality_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) PH (6.5 - 8)
                                <input type="checkbox" <?php if ($result[0]["water_quality_b"]!=0)  { echo 'checked="true"'; } ?> name="water_quality_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Gas Sulfhídrico (Presencia)
                                <input type="checkbox" <?php if ($result[0]["water_quality_c"]!=0)  { echo 'checked="true"'; } ?> name="water_quality_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) Cloro (0.2ppm - 0.5ppm)
                                <input type="checkbox" <?php if ($result[0]["water_quality_d"]!=0)  { echo 'checked="true"'; } ?> name="water_quality_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">e) Coliformes (Presencia)
                                <input type="checkbox" <?php if ($result[0]["water_quality_e"]!=0)  { echo 'checked="true"'; } ?> name="water_quality_e" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>5. </strong>¿Cuáles es el tipo de aguas residuales en tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Fosa séptica
                            <input type="radio" name="sewage_type" <?php if ($result[0]["sewage_type"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Baño/Caño
                            <input type="radio" name="sewage_type" <?php if ($result[0]["sewage_type"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>6. </strong>La contaminación atmosférica química en el aire, ¿te causa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">a) Irritación de ojos
                                <input type="radio" <?php if ($result[0]["pollution_react"]=="a")  { echo 'checked="true"'; } ?> name="pollution_react" value="a" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">b) Problemas respiratorios
                                <input type="radio" <?php if ($result[0]["pollution_react"]=="b")  { echo 'checked="true"'; } ?> name="pollution_react" value="b" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">c) Otras:
                                <input type="radio" <?php if ($result[0]["pollution_react"]=="c")  { echo 'checked="true"'; } ?> name="pollution_react" value="c" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="pollution_react_desc" value="<?php echo utf8_encode($result[0]["pollution_react_desc"]); ?>" placeholder="En caso de otra ¿cuál?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>7. </strong>¿Cuentas con alguna de las siguientes formas de contaminación física?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">a) Ruido
                                <input type="radio" <?php if ($result[0]["contamination"]=='a')  { echo 'checked="true"'; } ?> name="contamination" value="a" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">b) Vibraciones
                                <input type="radio" <?php if ($result[0]["contamination"]=='b')  { echo 'checked="true"'; } ?> name="contamination" value="b" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">c) Otras:
                                <input type="radio" <?php if ($result[0]["contamination"]=='c')  { echo 'checked="true"'; } ?> name="contamination" value="c" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="contamination_desc" value="<?php echo utf8_encode($result[0]["contamination_desc"]); ?>" placeholder="En caso de otra ¿cuál?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>8. </strong>¿Sabes de la existencia de refinerías de PEMEX u otros, cerca de tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="refinery_nearby" <?php if ($result[0]["refinery_nearby"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="refinery_nearby" <?php if ($result[0]["refinery_nearby"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>9. </strong>¿Sabes de la existencia de gasoductos de PEMEX u otros, cerca de tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="pipelines_nearby" <?php if ($result[0]["pipelines_nearby"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="pipelines_nearby" <?php if ($result[0]["pipelines_nearby"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>10. </strong>¿Sabes de alguna repercusión en la salud a causa de esto?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Anemia
                                <input type="checkbox" <?php if ($result[0]["health_impact_a"]!=0)  { echo 'checked="true"'; } ?> name="health_impact_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Leucemia
                                <input type="checkbox" <?php if ($result[0]["health_impact_b"]!=0)  { echo 'checked="true"'; } ?> name="health_impact_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Intoxicación
                                <input type="checkbox" <?php if ($result[0]["health_impact_c"]!=0)  { echo 'checked="true"'; } ?> name="health_impact_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>11. </strong>¿Sabes si cerca de tu casa transportan material peligroso?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">a) Gas
                                <input type="radio" <?php if ($result[0]["dangerous_material"]=="a")  { echo 'checked="true"'; } ?> name="dangerous_material" value="a" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">b) Gasolina
                                <input type="radio" <?php if ($result[0]["dangerous_material"]=="b")  { echo 'checked="true"'; } ?> name="dangerous_material" value="b" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">c) Residuos Industriales
                                <input type="radio" <?php if ($result[0]["dangerous_material"]=="c")  { echo 'checked="true"'; } ?> name="dangerous_material" value="c" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="container text-royal-blue regular-font">d) Otro
                                <input type="radio" <?php if ($result[0]["dangerous_material"]=="d")  { echo 'checked="true"'; } ?> name="dangerous_material" value="d" />
                                <span class="radiomark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="dangerous_material_desc" value="<?php echo utf8_encode($result[0]["dangerous_material_desc"]); ?>" placeholder="En caso de otro ¿cuál?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>12. </strong>¿Sabes de la existencia de generadores de radiación cerca de tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="radiation_nearby" <?php if ($result[0]["radiation_nearby"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="radiation_nearby" <?php if ($result[0]["radiation_nearby"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="radiation_nearby_desc" value="<?php echo utf8_encode($result[0]["radiation_nearby_desc"]); ?>" placeholder="En caso de responder si ¿cuál?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>13. </strong>¿Se realiza quema de productos o residuos peligrosos cerca de tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="burning_waste" <?php if ($result[0]["burning_waste"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="burning_waste" <?php if ($result[0]["burning_waste"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="burning_waste_desc" value="<?php echo utf8_encode($result[0]["burning_waste_desc"]); ?>" placeholder="En caso de responder si ¿cuáles?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>14. </strong>¿Sabes si existe vigilancia de la contaminación química?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="chemical_inspection" <?php if ($result[0]["chemical_inspection"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="chemical_inspection" <?php if ($result[0]["chemical_inspection"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="chemical_inspection_desc" value="<?php echo utf8_encode($result[0]["chemical_inspection_desc"]); ?>" placeholder="En caso de responder si ¿cuál?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>15. </strong>¿Conoces los contaminantes que te rodean?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="know_pollutants" <?php if ($result[0]["know_pollutants"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="know_pollutants" <?php if ($result[0]["know_pollutants"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="know_pollutants_desc" value="<?php echo utf8_encode($result[0]["know_pollutants_desc"]); ?>" placeholder="En caso de responder si ¿cuáles?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>16. </strong>¿Existe recolección de basura en tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="garbage_collection" <?php if ($result[0]["garbage_collection"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="garbage_collection" <?php if ($result[0]["garbage_collection"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="garbage_collection_desc" value="<?php echo utf8_encode($result[0]["garbage_collection_desc"]); ?>" placeholder="En caso de responder si ¿cuál?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>17. </strong>¿Quién es el personal encargado de la recolección de basura?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Gobierno
                            <input type="radio" name="collection_staff" <?php if ($result[0]["collection_staff"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Municipio
                            <input type="radio" name="collection_staff" <?php if ($result[0]["collection_staff"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Privado
                            <input type="radio" name="collection_staff" <?php if ($result[0]["collection_staff"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Yo
                            <input type="radio" name="collection_staff" <?php if ($result[0]["collection_staff"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>18. </strong>¿Sabes si existen vertederos de basura cerca de tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="dumps_nearby" <?php if ($result[0]["dumps_nearby"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="dumps_nearby" <?php if ($result[0]["dumps_nearby"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="number" class="form-control custom-input" name="dumps_nearby_number" value="<?php echo utf8_encode($result[0]["dumps_nearby_number"]); ?>" placeholder="En caso de responder si ¿cuantos?" min="0" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>19. </strong>¿Sabes si existen vertederos de residuos peligrosos cerca de tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="dangerous_residues" <?php if ($result[0]["dangerous_residues"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="dangerous_residues" <?php if ($result[0]["dangerous_residues"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="number" class="form-control custom-input" name="dangerous_residues_number" value="<?php echo utf8_encode($result[0]["dangerous_residues_number"]); ?>" placeholder="En caso de responder si ¿cuantos?" min="0" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>20. </strong>¿Cómo es la separación en la recolección de basura en tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Orgánica e Inorgánica
                            <input type="radio" name="separate_trash" <?php if ($result[0]["separate_trash"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Ninguna
                            <input type="radio" name="separate_trash" <?php if ($result[0]["separate_trash"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Otras
                            <input type="radio" name="separate_trash" <?php if ($result[0]["separate_trash"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="separate_trash_desc" value="<?php echo utf8_encode($result[0]["separate_trash_desc"]); ?>" placeholder="En caso de otra ¿cuál?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>21. </strong>¿Cuántas veces por semana se realiza la recolección de basura?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1
                            <input type="radio" name="garbage_collection_times" <?php if ($result[0]["garbage_collection_times"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 2
                            <input type="radio" name="garbage_collection_times" <?php if ($result[0]["garbage_collection_times"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 3
                            <input type="radio" name="garbage_collection_times" <?php if ($result[0]["garbage_collection_times"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Todos los días
                            <input type="radio" name="garbage_collection_times" <?php if ($result[0]["garbage_collection_times"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>22. </strong>¿Sabes de la existencia de mataderos cerca de tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="slaughterhouse_nearby" <?php if ($result[0]["slaughterhouse_nearby"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="slaughterhouse_nearby" <?php if ($result[0]["slaughterhouse_nearby"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="number" class="form-control custom-input" name="slaughterhouse_nearby_number" value="<?php echo utf8_encode($result[0]["slaughterhouse_nearby_number"]); ?>" placeholder="En caso de responder si ¿cuantos?" min="0" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>23. </strong>¿Sabes de la existencia de vertederos de basura clandestinos cerca de tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="clandestine_dump" <?php if ($result[0]["clandestine_dump"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="clandestine_dump" <?php if ($result[0]["clandestine_dump"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="number" class="form-control custom-input" name="clandestine_dump_number" value="<?php echo utf8_encode($result[0]["clandestine_dump_number"]); ?>" placeholder="En caso de responder si ¿cuantos?" min="0" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>24. </strong>¿Con qué frecuencia acuden a las actividades socioculturales de la comunidad?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1 vez al mes
                            <input type="radio" name="sociocultural_activities" <?php if ($result[0]["sociocultural_activities"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Cada 6 meses
                            <input type="radio" name="sociocultural_activities" <?php if ($result[0]["sociocultural_activities"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Cada año
                            <input type="radio" name="sociocultural_activities" <?php if ($result[0]["sociocultural_activities"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Nunca
                            <input type="radio" name="sociocultural_activities" <?php if ($result[0]["sociocultural_activities"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>25. </strong>¿Estaría dispuesto a participar en las actividades socioculturales?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="sociocultural_join" <?php if ($result[0]["sociocultural_join"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="sociocultural_join" <?php if ($result[0]["sociocultural_join"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>26. </strong>De los siguientes valores, elije 3 que describan a tu familia:
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Honestidad
                                <input type="checkbox" <?php if ($result[0]["values_a"]!=0)  { echo 'checked="true"'; } ?> name="values_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Respeto
                                <input type="checkbox" <?php if ($result[0]["values_b"]!=0)  { echo 'checked="true"'; } ?> name="values_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Amor
                                <input type="checkbox" <?php if ($result[0]["values_c"]!=0)  { echo 'checked="true"'; } ?> name="values_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) Tolerancia
                                <input type="checkbox" <?php if ($result[0]["values_d"]!=0)  { echo 'checked="true"'; } ?> name="values_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">e) Libertad
                                <input type="checkbox" <?php if ($result[0]["values_e"]!=0)  { echo 'checked="true"'; } ?> name="values_e" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">f) Humildad
                                <input type="checkbox" <?php if ($result[0]["values_f"]!=0)  { echo 'checked="true"'; } ?> name="values_f" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">g) Responsabilidad
                                <input type="checkbox" <?php if ($result[0]["values_g"]!=0)  { echo 'checked="true"'; } ?> name="values_g" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">h) Lealtad
                                <input type="checkbox" <?php if ($result[0]["values_h"]!=0)  { echo 'checked="true"'; } ?> name="values_h" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">i) Solidaridad
                                <input type="checkbox" <?php if ($result[0]["values_i"]!=0)  { echo 'checked="true"'; } ?> name="values_i" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>27. </strong>¿Realizas consumo de?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Alcohol
                                <input type="checkbox" <?php if ($result[0]["consume_of_a"]!=0)  { echo 'checked="true"'; } ?> name="consume_of_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Tabaco
                                <input type="checkbox" <?php if ($result[0]["consume_of_b"]!=0)  { echo 'checked="true"'; } ?> name="consume_of_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Drogas
                                <input type="checkbox" <?php if ($result[0]["consume_of_c"]!=0)  { echo 'checked="true"'; } ?> name="consume_of_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) Fármacos
                                <input type="checkbox" <?php if ($result[0]["consume_of_d"]!=0)  { echo 'checked="true"'; } ?> name="consume_of_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">e) Multifarmacia
                                <input type="checkbox" <?php if ($result[0]["consume_of_e"]!=0)  { echo 'checked="true"'; } ?> name="consume_of_e" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>28. </strong>¿Cuál es tu actividad laboral?</label>
                            <input type="text" class="form-control custom-input" name="work_activity" value="<?php echo utf8_encode($result[0]["work_activity"]); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-royal-blue regular-font"><strong>29. </strong>¿Qué tipos de actividades recreativas realizas?</label>
                            <input type="text" class="form-control custom-input" name="recreational_activities" value="<?php echo utf8_encode($result[0]["recreational_activities"]); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>30. </strong>¿En qué usas el tiempo libre y cuánto tiempo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Redes Sociales
                            <input type="radio" name="hobby" <?php if ($result[0]["hobby"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Videojuegos
                            <input type="radio" name="hobby" <?php if ($result[0]["hobby"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Televisión
                            <input type="radio" name="hobby" <?php if ($result[0]["hobby"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Dormir
                            <input type="radio" name="hobby" <?php if ($result[0]["hobby"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Otro
                            <input type="radio" name="hobby" <?php if ($result[0]["hobby"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="hobby_desc" value="<?php echo utf8_encode($result[0]["hobby_desc"]); ?>" placeholder="En caso de otro ¿cuál?" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="hobby_number" value="<?php echo utf8_encode($result[0]["hobby_number"]); ?>" placeholder="¿Cuanto tiempo?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>31. </strong>¿Sabe leer?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="can_read" <?php if ($result[0]["can_read"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="can_read" <?php if ($result[0]["can_read"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>32. </strong>¿Sabe escribir?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="can_write" <?php if ($result[0]["can_write"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="can_write" <?php if ($result[0]["can_write"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>33. </strong>¿Cuál es su nivel educativo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Primaria
                            <input type="radio" name="education_level" <?php if ($result[0]["education_level"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Secundaria
                            <input type="radio" name="education_level" <?php if ($result[0]["education_level"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Bachillerato
                            <input type="radio" name="education_level" <?php if ($result[0]["education_level"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Licenciatura
                            <input type="radio" name="education_level" <?php if ($result[0]["education_level"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) Doctorado
                            <input type="radio" name="education_level" <?php if ($result[0]["education_level"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>34. </strong>¿La casa donde vives se encuentra en una zona inundable?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="flood_zone" <?php if ($result[0]["flood_zone"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="flood_zone" <?php if ($result[0]["flood_zone"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>35. </strong>¿La casa donde vives se encuentra en una zona de deslizamientos?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="landslide_area" <?php if ($result[0]["landslide_area"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="landslide_area" <?php if ($result[0]["landslide_area"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>36. </strong>¿Vives en un medio?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Rural
                            <input type="radio" name="population" <?php if ($result[0]["population"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Urbano
                            <input type="radio" name="population" <?php if ($result[0]["population"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Mixto
                            <input type="radio" name="population" <?php if ($result[0]["population"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>37. </strong>¿Cuántas personas viven en tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1
                            <input type="radio" name="number_people" <?php if ($result[0]["number_people"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 2 a 3
                            <input type="radio" name="number_people" <?php if ($result[0]["number_people"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 3 a más
                            <input type="radio" name="number_people" <?php if ($result[0]["number_people"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Ninguna
                            <input type="radio" name="number_people" <?php if ($result[0]["number_people"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>38. </strong>¿Cuántas habitaciones hay en tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1
                            <input type="radio" name="number_rooms" <?php if ($result[0]["number_rooms"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 2
                            <input type="radio" name="number_rooms" <?php if ($result[0]["number_rooms"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 3
                            <input type="radio" name="number_rooms" <?php if ($result[0]["number_rooms"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) 5
                            <input type="radio" name="number_rooms" <?php if ($result[0]["number_rooms"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">e) 6 en adelante
                            <input type="radio" name="number_rooms" <?php if ($result[0]["number_rooms"]=="e")  { echo 'checked="true"'; } ?> value="e" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>39. </strong>¿Cuentas con ventilación directa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="ventilation" <?php if ($result[0]["ventilation"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="ventilation" <?php if ($result[0]["ventilation"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-sm-6">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>40. </strong>¿Cuántos metros cuadrados tiene tu casa?
                        </span>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="house_area" value="<?php echo utf8_encode($result[0]["house_area"]); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>41. </strong>¿Cuenta con agua caliente?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="hot_water" <?php if ($result[0]["hot_water"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="hot_water" <?php if ($result[0]["hot_water"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>42. </strong>¿Cuántos focos tiene en casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="spotlights" <?php if ($result[0]["spotlights"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="spotlights" <?php if ($result[0]["spotlights"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="spotlights_number" value="<?php echo utf8_encode($result[0]["spotlights_number"]); ?>" placeholder="Número de focos" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>43. </strong>¿La casa donde vive es?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Propia
                            <input type="radio" name="house_type" <?php if ($result[0]["house_type"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Alquilada
                            <input type="radio" name="house_type" <?php if ($result[0]["house_type"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Prestada
                            <input type="radio" name="house_type" <?php if ($result[0]["house_type"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) La está pagando
                            <input type="radio" name="house_type" <?php if ($result[0]["house_type"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>44. </strong>¿La casa donde vives está hecha de materiales?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Perecederos
                            <input type="radio" name="house_materials" <?php if ($result[0]["house_materials"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Duraderos
                            <input type="radio" name="house_materials" <?php if ($result[0]["house_materials"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>45. </strong>¿El suelo en su casa es de?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Piso
                            <input type="radio" name="floor_type" <?php if ($result[0]["floor_type"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Tierra
                            <input type="radio" name="floor_type" <?php if ($result[0]["floor_type"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>46. </strong>¿Existe mucha humedad en tu casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="humidity_home" <?php if ($result[0]["humidity_home"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="humidity_home" <?php if ($result[0]["humidity_home"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>47. </strong>¿Existe el uso de plaguicidas en casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="pesticides_use" <?php if ($result[0]["pesticides_use"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="pesticides_use" <?php if ($result[0]["pesticides_use"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>48. </strong>¿Existe el uso de fertilizantes en casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="fertilizers_use" <?php if ($result[0]["fertilizers_use"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="fertilizers_use" <?php if ($result[0]["fertilizers_use"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>49. </strong>¿Conoce los riesgos a la exposición de estos?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="know_risk" <?php if ($result[0]["know_risk"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="know_risk" <?php if ($result[0]["know_risk"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>50. </strong>¿A presentado a causa de la exposición?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Dermatitis
                                <input type="checkbox" <?php if ($result[0]["have_because_a"]!=0)  { echo 'checked="true"'; } ?> name="have_because_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Conjuntivitis
                                <input type="checkbox" <?php if ($result[0]["have_because_b"]!=0)  { echo 'checked="true"'; } ?> name="have_because_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Rinitis
                                <input type="checkbox" <?php if ($result[0]["have_because_c"]!=0)  { echo 'checked="true"'; } ?> name="have_because_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>51. </strong>¿Está informado de los riesgos sanitarios de su actividad laboral?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="know_work_risks" <?php if ($result[0]["know_work_risks"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="know_work_risks" <?php if ($result[0]["know_work_risks"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>52. </strong>¿Con que animales convive?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Perro
                                <input type="checkbox" <?php if ($result[0]["animals_a"]!=0)  { echo 'checked="true"'; } ?> name="animals_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Gato
                                <input type="checkbox" <?php if ($result[0]["animals_b"]!=0)  { echo 'checked="true"'; } ?> name="animals_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Vaca
                                <input type="checkbox" <?php if ($result[0]["animals_c"]!=0)  { echo 'checked="true"'; } ?> name="animals_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) Pájaro
                                <input type="checkbox" <?php if ($result[0]["animals_d"]!=0)  { echo 'checked="true"'; } ?> name="animals_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">e) Otro(s)
                                <input type="checkbox" <?php if ($result[0]["animals_e"]!=0)  { echo 'checked="true"'; } ?> name="animals_e" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="animals_desc" value="<?php echo utf8_encode($result[0]["animals_desc"]); ?>" placeholder="En caso de otro(s) ¿cuál(es)?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>53. </strong>¿Están vacunados los animales en su casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="vaccinated" <?php if ($result[0]["vaccinated"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="vaccinated" <?php if ($result[0]["vaccinated"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>54. </strong>¿Duermen en la misma habitación?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="same_room" <?php if ($result[0]["same_room"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="same_room" <?php if ($result[0]["same_room"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>55. </strong>¿Existe antecedente de pulgas?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="antecedent_fleas" <?php if ($result[0]["antecedent_fleas"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="antecedent_fleas" <?php if ($result[0]["antecedent_fleas"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>56. </strong>¿Con que roedores o insectos tiene contacto?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Ninguno
                                <input type="checkbox" <?php if ($result[0]["rodents_insects_a"]!=0)  { echo 'checked="true"'; } ?> name="rodents_insects_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Ratas
                                <input type="checkbox" <?php if ($result[0]["rodents_insects_b"]!=0)  { echo 'checked="true"'; } ?> name="rodents_insects_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Cucarachas
                                <input type="checkbox" <?php if ($result[0]["rodents_insects_c"]!=0)  { echo 'checked="true"'; } ?> name="rodents_insects_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">e) Otro(s)
                                <input type="checkbox" <?php if ($result[0]["rodents_insects_d"]!=0)  { echo 'checked="true"'; } ?> name="rodents_insects_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="rodents_insects_desc" value="<?php echo utf8_encode($result[0]["rodents_insects_desc"]); ?>" placeholder="En caso de otro(s) ¿cuál(es)?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>57. </strong>¿Cómo realiza el control de residuos de los animales en casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Recolección de basura
                            <input type="radio" name="animal_waste" <?php if ($result[0]["animal_waste"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Baño/Caño
                            <input type="radio" name="animal_waste" <?php if ($result[0]["animal_waste"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Ninguna
                            <input type="radio" name="animal_waste" <?php if ($result[0]["animal_waste"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>58. </strong>¿Conoce el nombre del mosco que transmite dengue, chinkungunya y zika?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="mosco_name" <?php if ($result[0]["mosco_name"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="mosco_name" <?php if ($result[0]["mosco_name"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>59. </strong>¿Afirma la existencia de muchos moscos en su casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="mosco_infestation" <?php if ($result[0]["mosco_infestation"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="mosco_infestation" <?php if ($result[0]["mosco_infestation"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>60. </strong>¿Sabe usted que es el dengue, chinkungunya, zika?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="know_dengue" <?php if ($result[0]["know_dengue"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="know_dengue" <?php if ($result[0]["know_dengue"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>61. </strong>¿Ha escuchado en redes sociales información con respecto al tema?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="social_networks" <?php if ($result[0]["social_networks"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="social_networks" <?php if ($result[0]["social_networks"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Nunca
                            <input type="radio" name="social_networks" <?php if ($result[0]["social_networks"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>62. </strong>¿Han padecido en casa alguna de estas enfermedades?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Dengue
                                <input type="checkbox" <?php if ($result[0]["suffer_a"]!=0)  { echo 'checked="true"'; } ?> name="suffer_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Chikungunya
                                <input type="checkbox" <?php if ($result[0]["suffer_b"]!=0)  { echo 'checked="true"'; } ?> name="suffer_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-3 m-0">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Zika
                                <input type="checkbox" <?php if ($result[0]["suffer_c"]!=0)  { echo 'checked="true"'; } ?> name="suffer_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>63. </strong>¿Conoce los síntomas y signos de estas enfermedades?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="know_signs" <?php if ($result[0]["know_signs"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="know_signs" <?php if ($result[0]["know_signs"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>64. </strong>¿Cree importante acudir al médico en sospecha de algunas de estas enfermedades?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="go_doctor" <?php if ($result[0]["go_doctor"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="go_doctor" <?php if ($result[0]["go_doctor"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>65. </strong>¿Conoce que acciones en promoción a la salud le pueden ayudar a prevenir estas enfermedades?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="prevention" <?php if ($result[0]["prevention"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="prevention" <?php if ($result[0]["prevention"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>66. </strong>¿Sabe que es el saneamiento básico en el hogar?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="basic_sanitation" <?php if ($result[0]["basic_sanitation"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="basic_sanitation" <?php if ($result[0]["basic_sanitation"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>67. </strong>¿Tiene recipientes que contengan agua dentro o fuera de su casa?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="water_containers" <?php if ($result[0]["water_containers"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="water_containers" <?php if ($result[0]["water_containers"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>68. </strong>¿Cuántas infecciones alimenticias has padecido en el año?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1 a 3
                            <input type="radio" name="food_infection" <?php if ($result[0]["food_infection"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 4 a 6
                            <input type="radio" name="food_infection" <?php if ($result[0]["food_infection"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 7 o más
                            <input type="radio" name="food_infection" <?php if ($result[0]["food_infection"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Ninguna
                            <input type="radio" name="food_infection" <?php if ($result[0]["food_infection"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>69. </strong>¿Cuántas infecciones diarreicas has padecido en el año?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1 a 3
                            <input type="radio" name="diarrheal_infection" <?php if ($result[0]["diarrheal_infection"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 4 a 6
                            <input type="radio" name="diarrheal_infection" <?php if ($result[0]["diarrheal_infection"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 7 o más
                            <input type="radio" name="diarrheal_infection" <?php if ($result[0]["diarrheal_infection"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Ninguna
                            <input type="radio" name="diarrheal_infection" <?php if ($result[0]["diarrheal_infection"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>70. </strong>¿Cuántas infecciones respiratorias has padecido en el año?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) 1 a 3
                            <input type="radio" name="respiratory_infection" <?php if ($result[0]["respiratory_infection"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) 4 a 6
                            <input type="radio" name="respiratory_infection" <?php if ($result[0]["respiratory_infection"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) 7 o más
                            <input type="radio" name="respiratory_infection" <?php if ($result[0]["respiratory_infection"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">d) Ninguna
                            <input type="radio" name="respiratory_infection" <?php if ($result[0]["respiratory_infection"]=="d")  { echo 'checked="true"'; } ?> value="d" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>71. </strong>¿Sabes si existe control y vigilancia de la emisión y extracción de gases y humo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="smoke_supervision" <?php if ($result[0]["smoke_supervision"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="smoke_supervision" <?php if ($result[0]["smoke_supervision"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>72. </strong>¿Cuáles son los principales problemas de salud en su comunidad y cuantos casos existen?
                        </span>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="community_health_problems" value="<?php echo utf8_encode($result[0]["community_health_problems"]); ?>" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>73. </strong>¿Tiene acceso a servicios de salud en su trabajo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="work_health_services" <?php if ($result[0]["work_health_services"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="work_health_services" <?php if ($result[0]["work_health_services"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            ¿De qué tipo es?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Público
                            <input type="radio" name="work_type" <?php if ($result[0]["work_type"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Privado
                            <input type="radio" name="work_type" <?php if ($result[0]["work_type"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>74. </strong>¿Tiene facilidades para el consumo de agua en su trabajo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="work_water" <?php if ($result[0]["work_water"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="work_water" <?php if ($result[0]["work_water"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            ¿Cuáles?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Botellas
                                <input type="checkbox" <?php if ($result[0]["work_water_a"]!=0)  { echo 'checked="true"'; } ?> name="work_water_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Vaso único
                                <input type="checkbox" <?php if ($result[0]["work_water_b"]!=0)  { echo 'checked="true"'; } ?> name="work_water_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Vaso individual
                                <input type="checkbox" <?php if ($result[0]["work_water_c"]!=0)  { echo 'checked="true"'; } ?> name="work_water_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) Grifo o llaves
                                <input type="checkbox" <?php if ($result[0]["work_water_d"]!=0)  { echo 'checked="true"'; } ?> name="work_water_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>75. </strong>¿Tiene facilidades de higiene en el trabajo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="work_hygiene" <?php if ($result[0]["work_hygiene"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="work_hygiene" <?php if ($result[0]["work_hygiene"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            ¿Cuáles?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Duchas
                                <input type="checkbox" <?php if ($result[0]["work_hygiene_a"]!=0)  { echo 'checked="true"'; } ?> name="work_hygiene_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Lavamanos
                                <input type="checkbox" <?php if ($result[0]["work_hygiene_b"]!=0)  { echo 'checked="true"'; } ?> name="work_hygiene_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>76. </strong>¿Tiene facilidades de vestimenta en el trabajo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="dressing_room" <?php if ($result[0]["dressing_room"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="dressing_room" <?php if ($result[0]["dressing_room"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            ¿Cuáles?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Vestidor por sexo
                                <input type="checkbox" <?php if ($result[0]["dressing_room_a"]!=0)  { echo 'checked="true"'; } ?> name="dressing_room_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Casillero individual
                                <input type="checkbox" <?php if ($result[0]["dressing_room_b"]!=0)  { echo 'checked="true"'; } ?> name="dressing_room_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>77. </strong>¿En su trabajo tiene exposición?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Fisica
                                <input type="checkbox" <?php if ($result[0]["work_exposition_a"]!=0)  { echo 'checked="true"'; } ?> name="work_exposition_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Quimica
                                <input type="checkbox" <?php if ($result[0]["work_exposition_b"]!=0)  { echo 'checked="true"'; } ?> name="work_exposition_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Otra(s)
                                <input type="checkbox" <?php if ($result[0]["work_exposition_c"]!=0)  { echo 'checked="true"'; } ?> name="work_exposition_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="work_exposition_desc" value="<?php echo utf8_encode($result[0]["work_exposition_desc"]); ?>" placeholder="En caso de otra(s) ¿cuál(es)?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>78. </strong>¿Qué riesgos presenta en su trabajo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">a) Ninguno
                                <input type="checkbox" <?php if ($result[0]["work_risk_a"]!=0)  { echo 'checked="true"'; } ?> name="work_risk_a" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">b) Exposición a químicos
                                <input type="checkbox" <?php if ($result[0]["work_risk_b"]!=0)  { echo 'checked="true"'; } ?> name="work_risk_b" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">c) Problemas respiratorios
                                <input type="checkbox" <?php if ($result[0]["work_risk_c"]!=0)  { echo 'checked="true"'; } ?> name="work_risk_c" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="checktainer text-royal-blue regular-font">d) Otros
                                <input type="checkbox" <?php if ($result[0]["work_risk_d"]!=0)  { echo 'checked="true"'; } ?> name="work_risk_d" />
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control custom-input" name="work_risk_desc" value="<?php echo utf8_encode($result[0]["work_risk_desc"]); ?>" placeholder="En caso de otra(s) ¿cuál(es)?" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>79. </strong>¿Cuenta con las herramientas necesarias para realizar el trabajo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="work_tools" <?php if ($result[0]["work_tools"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="work_tools" <?php if ($result[0]["work_tools"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>80. </strong>¿El área es la adecuada para realizar el trabajo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="suitable_area" <?php if ($result[0]["suitable_area"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="suitable_area" <?php if ($result[0]["suitable_area"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>81. </strong>¿Tiene facilidades para el uso de equipos de protección?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="protective_equipment" <?php if ($result[0]["protective_equipment"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="protective_equipment" <?php if ($result[0]["protective_equipment"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>82. </strong>¿Ha presentado acontecimientos traumáticos severos?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="severe_trauma" <?php if ($result[0]["severe_trauma"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="severe_trauma" <?php if ($result[0]["severe_trauma"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>83. </strong>¿Tiene apoyo psicosocial?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="psychosocial_support" <?php if ($result[0]["psychosocial_support"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="psychosocial_support" <?php if ($result[0]["psychosocial_support"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>84. </strong>¿Padece ansiedad en su trabajo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="anxiety_work" <?php if ($result[0]["anxiety_work"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="anxiety_work" <?php if ($result[0]["anxiety_work"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>85. </strong>¿Se ve afectado el ciclo del sueño a causa de tu trabajo?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="sleep_cycle" <?php if ($result[0]["sleep_cycle"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="sleep_cycle" <?php if ($result[0]["sleep_cycle"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            <strong>86. </strong>¿Le realizan exámenes médicos?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Si
                            <input type="radio" name="medical_tests" <?php if ($result[0]["medical_tests"]=="1")  { echo 'checked="true"'; } ?> value="1" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) No
                            <input type="radio" name="medical_tests" <?php if ($result[0]["medical_tests"]=="0")  { echo 'checked="true"'; } ?> value="0" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10 mb-4">
                <div class="row mt-4">
                    <div class="col-12 mb-4">
                        <span class="instructions-paragraph regular-font text-royal-blue">
                            ¿Cada cuánto?
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">a) Trimestral
                            <input type="radio" name="medical_tests_times" <?php if ($result[0]["medical_tests_times"]=="a")  { echo 'checked="true"'; } ?> value="a" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">b) Semestral
                            <input type="radio" name="medical_tests_times" <?php if ($result[0]["medical_tests_times"]=="b")  { echo 'checked="true"'; } ?> value="b" />
                            <span class="radiomark"></span>
                        </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="form-group">
                        <label class="container regular-font text-royal-blue">c) Anual
                            <input type="radio" name="medical_tests_times" <?php if ($result[0]["medical_tests_times"]=="c")  { echo 'checked="true"'; } ?> value="c" />
                            <span class="radiomark"></span>
                        </label>
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