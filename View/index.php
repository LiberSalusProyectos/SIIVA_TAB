<?php include_once("Controller/resources.php"); ?>
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
          <a href="patient_pass.php?m=familyRecord">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-users custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo FAMILY_RECORD_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=dass21Scale">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-tablets custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo DASS21_SCALE_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=environment">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-seedling custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo ENVIRONMENT_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=geriatricDepression">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-hourglass-end custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo GERIATRIC_DEPRESSION_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=zarittScale">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-bath custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo ZARITT_SCALE_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=ets">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-random custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo ETS_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=socioCultural">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-comment custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo SOCIOCULTURAL_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=diabetes">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-dna custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo DIABETES_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=hypertension">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-heartbeat custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo HYPERTENSION_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=bornLifestyle">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-baby-carriage custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo BORN_LIFESTYLE_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=babyLifestyle">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-baby custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo BABY_LIFESTYLE_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=childLifestyle">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-child custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo CHILD_LIFESTYLE_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=youngLifestyle">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-male custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo YOUNG_LIFESTYLE_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=gynecology">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-venus custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo GYNECOLOGY_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=healthCare">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-user-md custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo HEALTH_CARE_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=vitalSign">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-microscope custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo VITAL_SIGN_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=genderViolence">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-venus-mars custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo GENDER_VIOLENCE_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=hopeless">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-burn custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo HOPELESS_NAME; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=childVaccination">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-eye-dropper custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo CHILD_VACCINATION; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=youngVaccination">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-syringe custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo YOUNG_VACCINATION; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=adultVaccination">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-vial custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo ADULT_VACCINATION; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3 col-xl-3">
        <center>
          <a href="patient_pass.php?m=elderVaccination">
            <button class="btn my-2 my-sm-0 custom-btn-dark" type="submit">
              <span>
                <i class="fas fa-flask custom-teeth-open-icon icon-behind"></i>
                <h2 class="text-white bold-font text-forward2"><?php echo ELDER_VACCINATION; ?></h2>
              </span>
            </button>
          </a>
        </center>
      </div>
    </div>
  </div>
</body>

</html>