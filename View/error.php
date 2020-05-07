<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include("header_references.php");
      session_start();
      switch($_SESSION['id_role']){
        case 1:
          $home = "admin.php";
          break;
        case 2:
          $home = "user.php";
          break;
        default:
          $home = "index.php";
          break;
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
  <div class="container-fluid">

    <div class="row custom-vertical-padding">
      <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
        <h1><i class="fas fa-lock"></i> PROHIBIDO</h1>
        <p>Usted no tiene permisos para acceder a está página.</p>
        <br>
        <a href="<?php echo $home; ?>">Ir al inicio</a>
      </div>
    </div>
  </div>
</body>

</html>