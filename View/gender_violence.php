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