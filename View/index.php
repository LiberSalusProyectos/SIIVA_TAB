<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include("header_references_auth.php");
    if ($_SESSION['id_role'] > 3) {
      header('Location: error.php');
      exit();
    }
  ?>
  </head>
<style>
  .rdy {
    background-color: #009688 !important;
  }
  .enP {
    background-color: #FF5722 !important;
  }
  .html {
    background-color: #00BCD4 !important;
  }
</style>
<body id="bootstrap_overrides">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <?php include("navigator.php"); ?>
  <div class="container-fluid">

    <div class="row custom-vertical-padding">
      <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
        <form action="register_patient.php" method="POST">
          <button class="btn my-2 my-sm-0 custom-btn-identify" type="submit">
            <span>
              <i class="fas fa-user-friends custom-identify-icon icon-behind"></i>
              <h4 class="text-white bold-font text-forward">PACIENTES</h4>
            </span>
          </button>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=historiaClinica">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-coins custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2">HISTORIA CLÍNICA</h2>
              </span>
            </button>
          </a>
        </center>
      </div>
    </div>
  </div>
</body>

</html>