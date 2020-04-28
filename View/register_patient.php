<?php include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header_references_auth.php");

    if ($_SESSION['id_role'] > 3) {
      header('Location: error.php');
      exit();
    }

    if (sizeof($_POST)>0) {
      if(isset($_POST["search"])){
        $search = $_POST["search"];
        $result = getPatientData($linkDB, $search);
        $dependants = $result;
        unset($dependants[0]);
      }
      if ($_POST["form_answered"]=="true") {
        $updated = updatePatientData($linkDB, $_POST, $_SESSION["id_user"]);

        if ($updated) {
          header('Location: home.php'); exit;
        }
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
      }
    }
    ?>

  <script>
    $(document).ready(function () {
      var date_input = $('.birthdate'); //our date input has the name "date"
      var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
      var options = {
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
        language: 'es',
      };
      date_input.datepicker(options);

      var index = "<?php echo sizeof($dependants); ?>";
      $("#add").click( function(){
        $("#root").append("<div id='dep_"+index+"' class='row ml-1 mr-1'><div class='col-12'><button onclick='myFunction("+index+")' type='button' class='btn btn-danger float-right'>Eliminar</button></div><div class='col-12 col-sm-12 col-md-6 col-lg-4 m-0'><div class='form-group'><label for='name' class='text-royal-blue bold-font float-left custom-form-label-element'>Nombre</label><input type='text' class='form-control custom-input' name='dependants["+index+"][name]' required /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-4 m-0'><div class='form-group'><label for='firstLastName' class='text-royal-blue bold-font float-left custom-form-label-element'>Apellido Paterno</label><input type='text' class='form-control custom-input' name='dependants["+index+"][firstLastName]' required /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-4 m-0'><div class='form-group'><label for='secondLastName' class='text-royal-blue bold-font float-left custom-form-label-element'>Apellido Materno</label><input type='text' class='form-control custom-input' name='dependants["+index+"][secondLastName]' required /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='form-group'><label for='name' class='text-royal-blue bold-font float-left custom-form-label-element'>CURP</label><input type='text' class='form-control custom-input' name='dependants["+index+"][curp]'pattern='([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[0-9A-Z]{5})' /></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='row'><div class='col-12'><label class='text-royal-blue bold-font float-left custom-form-label-element'>Fecha de nacimiento</label></div></div><div class='row'><div class='col-12'><input class='form-control custom-input birthdate' name='dependants["+index+"][birthdate]' autocomplete='off' /></div></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='form-group'><label for='genre' class='text-royal-blue bold-font float-left custom-form-label-element'>Género</label><select class='form-control custom-input-select' name='dependants["+index+"][genre]' required><option selected disabled>SELECCIONAR</option><option value='MASCULINO'>MASCULINO</option><option value='FEMENINO'>FEMENINO</option></select></div></div><div class='col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0'><div class='form-group'><label for='familyRole'class='text-royal-blue bold-font float-left custom-form-label-element'>Parentesco</label><select class='form-control custom-input' name='dependants["+index+"][familyRole]' required><option selected disabled>SELECCIONAR</option><option value='ESPOSO'>ESPOSO</option><option value='ESPOSA'>ESPOSA</option><option value='HIJO'>HIJO</option><option value='HIJA'>HIJA</option><option value='PADRE'>PADRE</option><option value='MADRE'>MADRE</option><option value='NIETO'>NIETO</option><option value='NIETA'>NIETA</option></select></div></div><div class='offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider'></div></div>");
        
        var date_input = $('.birthdate'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
          format: 'yyyy-mm-dd',
          container: container,
          todayHighlight: true,
          autoclose: true,
          language: 'es',
        };
        date_input.datepicker(options);
        
        index++;
      })
    })
    function myFunction(index) {
      $("#dep_"+index).remove();
    }
  </script>
</head>

<body id="bootstrap_overrides">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <?php include("navigator.php"); ?>
  <div class="container-fluid">
    <div class="row">
      <form method="POST">
        <input type="hidden" name="id" value="<?php echo $result[0]["id"]; ?>">
        <input type="hidden" name="familiyReference" value="<?php echo $result[0]["familiyReference"]; ?>">
        <input type="hidden" name="form_answered" value="true">
        <div class="offset-1 offset-sm-1 offset-md-1 offset-lg-1 col-10 col-sm-10 col-md-10 col-lg-10">

          <div class="row text-center">
            <div class="col-12 col-sm-12">
              <h2 class="text-royal-blue bold-font custom-title">
                Pacientes
              </h2>
            </div>
          </div>

          <div class="row register-patient-form p-2 text-center">
            <div class="col-12 mt-5">
              <span class="text-royal-blue bold-font custom-form-label-element">
                Datos del afiliado
              </span>
            </div>
            <div class="offset-1 offset-sm-2 col-10 col-sm-8 mb-4 divider"></div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 m-0">
              <div class="form-group">
                <label for="numero_afiliacion" class="text-royal-blue bold-font float-left custom-form-label-element">Número de afiliación</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["affiliationNumber"]); ?>" class="form-control custom-input" name="affiliationNumber" required readonly />
              </div>
            </div>
            <div class="col-0 col-sm-0 col-md-6 col-lg-8 col-xl-9 m-0"></div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 m-0">
              <div class="form-group">
                <label for="curp" class="text-royal-blue bold-font float-left custom-form-label-element">CURP</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["curp"]); ?>" class="form-control custom-input" name="curp"
                  pattern="([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[0-9A-Z]{5})" />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 m-0">
              <div class="form-group">
                <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Nombre</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["name"]); ?>" class="form-control custom-input" name="name" required />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 m-0">
              <div class="form-group">
                <label for="firstLastName"
                  class="text-royal-blue bold-font float-left custom-form-label-element">Apellido Paterno</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["firstLastName"]); ?>" class="form-control custom-input" name="firstLastName" required />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 m-0">
              <div class="form-group">
                <label for="secondLastName"
                  class="text-royal-blue bold-font float-left custom-form-label-element">Apellido Materno</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["secondLastName"]); ?>" class="form-control custom-input" name="secondLastName" required />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 m-0">
              <div class="form-group">
                <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">Edad</label>
                <input type="number" value="<?php echo utf8_encode($result[0]["age"]); ?>" class="form-control custom-input" name="age" required readonly />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-0 mb-3">
              <div class="row">
                <div class="col-12">
                  <label class="text-royal-blue bold-font float-left custom-form-label-element text-truncate">Fecha de nacimiento</label>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <input value="<?php echo $result[0]["birthdate"]; ?>" class="form-control custom-input birthdate" name="birthdate" autocomplete="off" />
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-3 m-0">
              <div class="form-group">
                <label for="genre" class="text-royal-blue bold-font float-left custom-form-label-element">Género</label>
                <select class="form-control custom-input-select" name="genre" required>
                  <option <?php if(!isset($result)) echo " selected "; ?> disabled>SELECCIONAR</option>
                  <option <?php if($result[0]['genre']=="MASCULINO") echo " selected "; ?> value="MASCULINO">MASCULINO</option>
                  <option <?php if($result[0]['genre']=="FEMENINO") echo " selected "; ?> value="FEMENINO">FEMENINO</option>
                </select>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 m-0">
              <div class="form-group">
                <label for="phone_number" class="text-royal-blue bold-font float-left custom-form-label-element">Número de teléfono</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["phone_number"]); ?>" class="form-control custom-input" name="phone_number" />
              </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-5 mb-2">
              <span class="text-royal-blue bold-font custom-form-label-element">
                Beneficiarios
              </span>
            </div>

            <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>

            <?php $index = 0; foreach (!isset($result) ? [] : $dependants as $key=>$dependent){ ?>
              <input type="hidden" name="<?php echo "dependants[".$index."][id]"; ?>" value="<?php echo $dependent["id"]; ?>">
              <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                <div class="form-group">
                  <label for="name"
                    class="text-royal-blue bold-font float-left custom-form-label-element">Nombre</label>
                  <input type="text" value="<?php echo utf8_encode($dependent["name"]); ?>" class="form-control custom-input" name="<?php echo "dependants[".$index."][name]"; ?>" required />
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                <div class="form-group">
                  <label for="firstLastName"
                    class="text-royal-blue bold-font float-left custom-form-label-element">Apellido Paterno</label>
                  <input type="text" value="<?php echo utf8_encode($dependent["firstLastName"]); ?>" class="form-control custom-input" name="<?php echo "dependants[".$index."][firstLastName]"; ?>" required />
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-4 m-0">
                <div class="form-group">
                  <label for="secondLastName"
                    class="text-royal-blue bold-font float-left custom-form-label-element">Apellido Materno</label>
                  <input type="text" value="<?php echo utf8_encode($dependent["secondLastName"]); ?>" class="form-control custom-input" name="<?php echo "dependants[".$index."][secondLastName]"; ?>" required />
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0">
                <div class="form-group">
                  <label for="name" class="text-royal-blue bold-font float-left custom-form-label-element">CURP</label>
                  <input type="text" value="<?php echo utf8_encode($dependent["curp"]); ?>" class="form-control custom-input" name="<?php echo "dependants[".$index."][curp]"; ?>"
                    pattern="([A-Z]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[HM](AS|BC|BS|CC|CL|CM|CS|CH|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[0-9A-Z]{5})" />
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0">
                <div class="row">
                  <div class="col-12">
                    <label class="text-royal-blue bold-font float-left custom-form-label-element">Fecha de nacimiento</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <input value="<?php echo $dependent["birthdate"]; ?>" class="form-control custom-input birthdate" name="<?php echo "dependants[".$index."][birthdate]"; ?>" autocomplete="off" />
                  </div>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0">
                <div class="form-group">
                  <label for="genre" class="text-royal-blue bold-font float-left custom-form-label-element">Género</label>
                  <select class="form-control custom-input-select" value="<?php echo utf8_encode($dependent["genre"]); ?>" required>
                    <option <?php if(!isset($dependent['genre'])) echo " selected "; ?> disabled>SELECCIONAR</option>
                    <option <?php if($dependent['genre']=="MASCULINO") echo " selected "; ?> value="MASCULINO">MASCULINO</option>
                    <option <?php if($dependent['genre']=="FEMENINO") echo " selected "; ?> value="FEMENINO">FEMENINO</option>
                  </select>
                </div>
              </div>
              <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 m-0">
                <div class="form-group">
                  <label for="familyRole"
                    class="text-royal-blue bold-font float-left custom-form-label-element">Parentesco</label>
                  <select class="form-control custom-input" name="<?php echo "dependants[".$index."][familyRole]"; ?>" required>
                    <option <?php if(!isset($dependent['familyRole'])) echo " selected "; ?> disabled>SELECCIONAR</option>
                    <option <?php if($dependent['familyRole']=="ESPOSO") echo " selected "; ?> value="ESPOSO">ESPOSO</option>
                    <option <?php if($dependent['familyRole']=="ESPOSA") echo " selected "; ?> value="ESPOSA">ESPOSA</option>
                    <option <?php if($dependent['familyRole']=="HIJO") echo " selected "; ?> value="HIJO">HIJO</option>
                    <option <?php if($dependent['familyRole']=="HIJA") echo " selected "; ?> value="HIJA">HIJA</option>
                    <option <?php if($dependent['familyRole']=="PADRE") echo " selected "; ?> value="PADRE">PADRE</option>
                    <option <?php if($dependent['familyRole']=="MADRE") echo " selected "; ?> value="MADRE">MADRE</option>
                    <option <?php if($dependent['familyRole']=="NIETO") echo " selected "; ?> value="NIETO">NIETO</option>
                    <option <?php if($dependent['familyRole']=="NIETA") echo " selected "; ?> value="NIETA">NIETA</option>
                  </select>
                </div>
              </div>

              <?php if ($index !== sizeof($dependants)) {?>
                <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>
              <?php }?>
            <?php $index++;}?>

            <div id="root"></div>

            <?php if (isset($result)) {?>
              <div class="col-12">
                <button id="add" type="button" class="btn btn-primary">Agregar</button>
              </div>
            <?php }?>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-5 mb-2">
              <span class="text-royal-blue bold-font custom-form-label-element">
                Domicilio
              </span>
            </div>
            <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>

            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
                <label for="calle"
                  class="text-royal-blue bold-font float-left custom-form-label-element">Calle</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["calle"]); ?>" class="form-control custom-input" name="calle" required />
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="no_ext"
                  class="text-royal-blue bold-font float-left custom-form-label-element">Núm. ext.</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["no_ext"]); ?>" class="form-control custom-input" name="no_ext" required />
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3 col-lg-3">
              <div class="form-group">
                <label for="no_int"
                  class="text-royal-blue bold-font float-left custom-form-label-element">Núm. int.</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["no_int"]); ?>" class="form-control custom-input" name="no_int" />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="colonia"
                  class="text-royal-blue bold-font float-left custom-form-label-element">Colonia</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["colonia"]); ?>" class="form-control custom-input" name="colonia" required />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="municipio"
                  class="text-royal-blue bold-font float-left custom-form-label-element">Municipio</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["municipio"]); ?>" class="form-control custom-input" name="municipio" required />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
              <div class="form-group">
                <label for="codigo_postal"
                  class="text-royal-blue bold-font float-left custom-form-label-element">Código Postal</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["codigo_postal"]); ?>" class="form-control custom-input" name="codigo_postal" required />
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="address_reference"
                  class="text-royal-blue bold-font float-left custom-form-label-element">Referencia domiciliaria</label>
                <input type="text" value="<?php echo utf8_encode($result[0]["address_reference"]); ?>" class="form-control custom-input" name="address_reference"
                  placeholder="Mencionar entre que calle esta la vivienda, o establecimiento como tienda, iglesia, escuela etc." />
              </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mt-5 mb-2">
              <span class="text-royal-blue bold-font custom-form-label-element">
                Familia
              </span>
            </div>
            <div class="offset-1 offset-sm-2 offset-md-3 col-10 col-sm-8 col-md-6 mb-4 divider"></div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="family_atmosphere" class="text-royal-blue bold-font float-left custom-form-label-element">Ambiente familiar</label>
                <textarea
                  class="form-control custom-textarea"
                  name="family_atmosphere"
                  rows="5"
                  placeholder="Describe brevemente el ambiente familiar"><?php echo utf8_encode($result[0]["family_atmosphere"]); ?></textarea>
              </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                    <label for="health_problems" class="text-royal-blue bold-font float-left custom-form-label-element">Problemas de salud de sus integrantes</label>
                    <textarea
                      class="form-control custom-textarea"
                      name="health_problems"
                      rows="5"
                      placeholder="Problemas de salud de los integrantes de la familia"><?php echo utf8_encode($result[0]["health_problems"]); ?></textarea>
                </div>
            </div>
          </div>
        </div>

        <div
          class="offset-0 offset-lg-3 offset-md-2 offset-sm-2 col-12 col-sm-8 col-md-8 col-lg-6 vertical-margin-bottom mt-4">
          <center>
            <button class="btn my-2 my-sm-0 custom-btn-save" type="submit">
              <span class="text-white bold-font custom-btn-save-text">Guardar</span>
            </button>
          </center>
        </div>
      </form>
    </div>
  </div>
</body>

</html>