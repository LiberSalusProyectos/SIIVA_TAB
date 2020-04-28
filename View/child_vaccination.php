<?php include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <?php include("header_references_auth.php");

    // $_SESSION["id_user"] = 1;
    //var_dump($_SESSION);
    //var_dump($_SESSION["email"]);
    //$_SESSION["id_user"] = 1;

    //echo "<pre>";
    //var_dump($_POST);
    //echo "</pre>";

    if (sizeof($_POST)>0) {
      $result = getModuleData($linkDB, $_POST["module"], $_POST["id_patient"]);
      //var_dump($result);

      if ($_POST["form_answered"]=="true") {
          if ($result[0]["id_data"] != "") {
            $realized = saveChildVaccinatonData($linkDB, "UPDATE", $_POST, $_SESSION["id_user"]);
          }else{
            $realized = saveChildVaccinatonData($linkDB, "INSERT", $_POST, $_SESSION["id_user"]);
          }
          if ($realized) {
            header('Location: patient_pass.php?m=childVaccination'); exit;
          }
      }

      $result = getModuleData($linkDB, $_POST["module"], $_POST["id_patient"]);
    } else {
      header('Location: home.php'); exit;
    }

    //echo "<pre>";
    //var_dump($result);
    //echo "</pre>";

   ?>
    <script>
      jQuery(document).ready(function(e) {
        jQuery('#bcg').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#bcg').toggleClass('bg-gray')
            jQuery('#bcg').toggleClass('bg-bcg')
            jQuery('#bcg_').toggle()
            jQuery('input[name="bcg"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#hepatb1').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#hepatb1').toggleClass('bg-gray')
            jQuery('#hepatb1').toggleClass('bg-hepatb')
            jQuery('#hepatb1_').toggle()
            jQuery('input[name="hepatb1"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#pentavalente1').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#pentavalente1').toggleClass('bg-gray')
            jQuery('#pentavalente1').toggleClass('bg-pentav')
            jQuery('#pentavalente1_').toggle()
            jQuery('input[name="pentavalente1"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#hepatb2').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#hepatb2').toggleClass('bg-gray')
            jQuery('#hepatb2').toggleClass('bg-hepatb')
            jQuery('#hepatb2_').toggle()
            jQuery('input[name="hepatb2"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#neumoco1').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#neumoco1').toggleClass('bg-gray')
            jQuery('#neumoco1').toggleClass('bg-neumoco')
            jQuery('#neumoco1_').toggle()
            jQuery('input[name="neumoco1"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#rotavirus2do1').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#rotavirus2do1').toggleClass('bg-gray')
            jQuery('#rotavirus2do1').toggleClass('bg-rotavirus')
            jQuery('#rotavirus2do1_').toggle()
            jQuery('input[name="rotavirus2do1"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#rotavirus3do1').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#rotavirus3do1').toggleClass('bg-gray')
            jQuery('#rotavirus3do1').toggleClass('bg-rotavirus')
            jQuery('#rotavirus3do1_').toggle()
            jQuery('input[name="rotavirus3do1"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#pentavalente2').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#pentavalente2').toggleClass('bg-gray')
            jQuery('#pentavalente2').toggleClass('bg-pentav')
            jQuery('#pentavalente2_').toggle()
            jQuery('input[name="pentavalente2"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#neumoco2').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#neumoco2').toggleClass('bg-gray')
            jQuery('#neumoco2').toggleClass('bg-neumoco')
            jQuery('#neumoco2_').toggle()
            jQuery('input[name="neumoco2"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#rotavirus2do2').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#rotavirus2do2').toggleClass('bg-gray')
            jQuery('#rotavirus2do2').toggleClass('bg-rotavirus')
            jQuery('#rotavirus2do2_').toggle()
            jQuery('input[name="rotavirus2do2"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#rotavirus3do2').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#rotavirus3do2').toggleClass('bg-gray')
            jQuery('#rotavirus3do2').toggleClass('bg-rotavirus')
            jQuery('#rotavirus3do2_').toggle()
            jQuery('input[name="rotavirus3do2"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#pentavalente3').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#pentavalente3').toggleClass('bg-gray')
            jQuery('#pentavalente3').toggleClass('bg-pentav')
            jQuery('#pentavalente3_').toggle()
            jQuery('input[name="pentavalente3"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#hepatb3').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#hepatb3').toggleClass('bg-gray')
            jQuery('#hepatb3').toggleClass('bg-hepatb')
            jQuery('#hepatb3_').toggle()
            jQuery('input[name="hepatb3"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#influenza1').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#influenza1').toggleClass('bg-gray')
            jQuery('#influenza1').toggleClass('bg-influenza')
            jQuery('#influenza1_').toggle()
            jQuery('input[name="influenza1"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#rotavirus3do3').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#rotavirus3do3').toggleClass('bg-gray')
            jQuery('#rotavirus3do3').toggleClass('bg-rotavirus')
            jQuery('#rotavirus3do3_').toggle()
            jQuery('input[name="rotavirus3do3"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#influenza2').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#influenza2').toggleClass('bg-gray')
            jQuery('#influenza2').toggleClass('bg-influenza')
            jQuery('#influenza2_').toggle()
            jQuery('input[name="influenza2"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#sarampion1').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#sarampion1').toggleClass('bg-gray')
            jQuery('#sarampion1').toggleClass('bg-sarampion')
            jQuery('#sarampion1_').toggle()
            jQuery('input[name="sarampion1"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#neumocorev').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#neumocorev').toggleClass('bg-gray')
            jQuery('#neumocorev').toggleClass('bg-neumoco')
            jQuery('#neumocorev_').toggle()
            jQuery('input[name="neumocorev"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#pentavalenteref').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#pentavalenteref').toggleClass('bg-gray')
            jQuery('#pentavalenteref').toggleClass('bg-pentav')
            jQuery('#pentavalenteref_').toggle()
            jQuery('input[name="pentavalenteref"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#influenza3').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#influenza3').toggleClass('bg-gray')
            jQuery('#influenza3').toggleClass('bg-influenza')
            jQuery('#influenza3_').toggle()
            jQuery('input[name="influenza3"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#influenza4').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#influenza4').toggleClass('bg-gray')
            jQuery('#influenza4').toggleClass('bg-influenza')
            jQuery('#influenza4_').toggle()
            jQuery('input[name="influenza4"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#dptref').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#dptref').toggleClass('bg-gray')
            jQuery('#dptref').toggleClass('bg-pentav')
            jQuery('#dptref_').toggle()
            jQuery('input[name="dptref"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#influenza5').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#influenza5').toggleClass('bg-gray')
            jQuery('#influenza5').toggleClass('bg-influenza')
            jQuery('#influenza5_').toggle()
            jQuery('input[name="influenza5"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#influenza6').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#influenza6').toggleClass('bg-gray')
            jQuery('#influenza6').toggleClass('bg-influenza')
            jQuery('#influenza6_').toggle()
            jQuery('input[name="influenza6"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#sabin').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#sabin').toggleClass('bg-gray')
            jQuery('#sabin').toggleClass('bg-sabin')
            jQuery('#sabin_').toggle()
            jQuery('input[name="sabin"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })
        jQuery('#sarampion2').click(function(e){
            if(jQuery(e.target).is('input')) return;
            jQuery('#sarampion2').toggleClass('bg-gray')
            jQuery('#sarampion2').toggleClass('bg-sarampion')
            jQuery('#sarampion2_').toggle()
            jQuery('input[name="sarampion2"]').prop('checked', function(_, checked) {
                return !checked;
            })
        })

        var date_input = $('.date'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'yyyy-mm-dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
            language: 'es',
        };
        date_input.datepicker(options);
      })
    </script>
  </head>

<body id="bootstrap_overrides">
  <noscript>You need to enable JavaScript to run this app.</noscript>
  <?php include("navigator.php"); ?>
  <div class="container-fluid">

    <div class="row custom-vertical-padding">
      <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
        <button class="btn my-2 my-sm-0 custom-btn-disabled" type="submit">
          <span>
            <i class="fas fa-eye-dropper custom-icon icon-behind"></i>
            <h4 class="text-white bold-font text-forward"><?php echo CHILD_VACCINATION; ?></h4>
          </span>
        </button>
      </div>
    </div>

    <div class="row">
      <form method="POST">
        <input type="hidden" name="module" value="<?php echo $_POST['module']; ?>">
        <input type="hidden" name="id_patient" value="<?php echo $_POST['id_patient']; ?>">
        <input type="hidden" name="form_answered" value="true">

        <div class="offset-1 offset-lg-2 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
          <section class="instructions vertical-margin-bottom">
            <p class="instructions-paragraph regular-font text-royal-blue">
              Marca el recuadro de cada vacuna que haya sido administrada.
            </p>
          </section>
        </div>

        <div class="offset-0 offset-lg-3 offset-md-2 offset-sm-2 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
          <h2 class="text-royal-blue bold-font custom-full-name-big vertical-margin-bottom"><?php echo $result[0]["firstLastName"]." ".$result[0]["secondLastName"]." ".$result[0]["name"]; ?></h2>
        </div>

        <div class="offset-1 offset-lg-2 offset-md-1 offset-sm-1 col-10 col-sm-10 col-md-10 col-lg-8">

            <div class="row text-center">
                <div class="col-12 col-sm-12 p-2 border-head">
                    <span class="text-royal-blue bold-font custom-form-label-element">
                        Esquema Básico de Vacunación
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">Nacimiento</span>
                </div>
                <div id="bcg" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['bcg']=='1') { echo 'bg-bcg'; } else { echo 'bg-gray';} ?> ">
                    <span class="ml-4">BCG (Única)</span>
                    <div id="bcg_" <?php if($result[0]['bcg']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['bcg']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="bcg">
                        <input placeholder="Fecha de vacunación" name="bcg_date" value="<?php echo $result[0]["bcg_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="bcg_desc" value="<?php echo utf8_encode($result[0]["bcg_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 border-headmid d-md-none"></div>
                <div id="hepatb1" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['hepatb1']=='1') { echo 'bg-hepatb'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">HEPATITIS B (primera)</span>
                    <div id="hepatb1_" <?php if($result[0]['hepatb1']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['hepatb1']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="hepatb1">
                        <input placeholder="Fecha de vacunación" name="hepatb1_date" value="<?php echo $result[0]["hepatb1_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="hepatb1_desc" value="<?php echo utf8_encode($result[0]["hepatb1_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">2 Meses</span>
                </div>
                <div id="pentavalente1" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['pentavalente1']=='1') { echo 'bg-pentav'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">PENTAVALENTE ACECULAR (Primera)</span>
                    <div id="pentavalente1_" <?php if($result[0]['pentavalente1']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['pentavalente1']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="pentavalente1">
                        <input placeholder="Fecha de vacunación" name="pentavalente1_date" value="<?php echo $result[0]["pentavalente1_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="pentavalente1_desc" value="<?php echo utf8_encode($result[0]["pentavalente1_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 border-headmid d-md-none"></div>
                <div id="hepatb2" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['hepatb2']=='1') { echo 'bg-hepatb'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">HEPATITIS B (Segunda)</span>
                    <div id="hepatb2_" <?php if($result[0]['hepatb2']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['hepatb2']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="hepatb2">
                        <input placeholder="Fecha de vacunación" name="hepatb2_date" value="<?php echo $result[0]["hepatb2_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="hepatb2_desc" value="<?php echo utf8_encode($result[0]["hepatb2_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div id="hepatb1">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 border-headmid"></div>
                <div id="neumoco1" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['neumoco1']=='1') { echo 'bg-neumoco'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">NEUMOCÓCCICA CONJUGADA (Primera)</span>
                    <div id="neumoco1_" <?php if($result[0]['neumoco1']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['neumoco1']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="neumoco1">
                        <input placeholder="Fecha de vacunación" name="neumoco1_date" value="<?php echo $result[0]["neumoco1_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="neumoco1_desc" value="<?php echo utf8_encode($result[0]["neumoco1_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 border-headmid d-md-none"></div>
                <div id="rotavirus2do1" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['rotavirus2do1']=='1') { echo 'bg-rotavirus'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">ROTAVIRUS 2 dosis. (Primera)</span>
                    <div id="rotavirus2do1_" <?php if($result[0]['rotavirus2do1']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['rotavirus2do1']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="rotavirus2do1">
                        <input placeholder="Fecha de vacunación" name="rotavirus2do1_date" value="<?php echo $result[0]["rotavirus2do1_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="rotavirus2do1_desc" value="<?php echo utf8_encode($result[0]["rotavirus2do1_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 border-headmid"></div>
                <div id="rotavirus3do1" class="col-7 col-sm-7 col-md-8 col-lg-10 p-2 border-mid <?php if($result[0]['rotavirus3do1']=='1') { echo 'bg-rotavirus'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">ROTAVIRUS 3 dosis. (Primera)</span>
                    <div class="row h-100 text-center">
                        <div id="rotavirus3do1_" <?php if($result[0]['rotavirus3do1']!='1') { echo 'style="display: none;"'; } ?> class="offset-md-3 col-md-6 mt-2">
                            <input type="checkbox" <?php if($result[0]['rotavirus3do1']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="rotavirus3do1">
                            <input placeholder="Fecha de vacunación" name="rotavirus3do1_date" value="<?php echo $result[0]["rotavirus3do1_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                            <input type="text" class="form-control custom-input mt-1" name="rotavirus3do1_desc" value="<?php echo utf8_encode($result[0]["rotavirus3do1_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">4 Meses</span>
                </div>
                <div id="pentavalente2" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['pentavalente2']=='1') { echo 'bg-pentav'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">PENTAVALENTE ACECULAR (Segunda)</span>
                    <div id="pentavalente2_" <?php if($result[0]['pentavalente2']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['pentavalente2']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="pentavalente2">
                        <input placeholder="Fecha de vacunación" name="pentavalente2_date" value="<?php echo $result[0]["pentavalente2_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="pentavalente2_desc" value="<?php echo utf8_encode($result[0]["pentavalente2_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 border-headmid d-md-none"></div>
                <div id="neumoco2" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['neumoco2']=='1') { echo 'bg-neumoco'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">NEUMOCÓCCICA CONJUGADA (Segunda)</span>
                    <div id="neumoco2_" <?php if($result[0]['neumoco2']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['neumoco2']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="neumoco2">
                        <input placeholder="Fecha de vacunación" name="neumoco2_date" value="<?php echo $result[0]["neumoco2_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="neumoco2_desc" value="<?php echo utf8_encode($result[0]["neumoco2_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 border-headmid"></div>
                <div id="rotavirus2do2" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['rotavirus2do2']=='1') { echo 'bg-rotavirus'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">ROTAVIRUS 2 dosis. (Segunda)</span>
                    <div id="rotavirus2do2_" <?php if($result[0]['rotavirus2do2']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['rotavirus2do2']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="rotavirus2do2">
                        <input placeholder="Fecha de vacunación" name="rotavirus2do2_date" value="<?php echo $result[0]["rotavirus2do2_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="rotavirus2do2_desc" value="<?php echo utf8_encode($result[0]["rotavirus2do2_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 border-headmid d-md-none"></div>
                <div id="rotavirus3do2" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['rotavirus3do2']=='1') { echo 'bg-rotavirus'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">ROTAVIRUS 3 dosis. (Segunda)</span>
                    <div id="rotavirus3do2_" <?php if($result[0]['rotavirus3do2']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['rotavirus3do2']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="rotavirus3do2">
                        <input placeholder="Fecha de vacunación" name="rotavirus3do2_date" value="<?php echo $result[0]["rotavirus3do2_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="rotavirus3do2_desc" value="<?php echo utf8_encode($result[0]["rotavirus3do2_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">6 Meses</span>
                </div>
                <div id="pentavalente3" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['pentavalente3']=='1') { echo 'bg-pentav'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">PENTAVALENTE ACECULAR (Tercera)</span>
                    <div id="pentavalente3_" <?php if($result[0]['pentavalente3']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['pentavalente3']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="pentavalente3">
                        <input placeholder="Fecha de vacunación" name="pentavalente3_date" value="<?php echo $result[0]["pentavalente3_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="pentavalente3_desc" value="<?php echo utf8_encode($result[0]["pentavalente3_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 border-headmid d-md-none"></div>
                <div id="hepatb3" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['hepatb3']=='1') { echo 'bg-hepatb'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">HEPATITIS B (Tercera)</span>
                    <div id="hepatb3_" <?php if($result[0]['hepatb3']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['hepatb3']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="hepatb3">
                        <input placeholder="Fecha de vacunación" name="hepatb3_date" value="<?php echo $result[0]["hepatb3_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="hepatb3_desc" value="<?php echo utf8_encode($result[0]["hepatb3_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div id="hepatb3">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 border-headmid"></div>
                <div id="influenza1" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['influenza1']=='1') { echo 'bg-influenza'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">INFLUENZA (Primera)</span>
                    <div id="influenza1_" <?php if($result[0]['influenza1']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['influenza1']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="influenza1">
                        <input placeholder="Fecha de vacunación" name="influenza1_date" value="<?php echo $result[0]["influenza1_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="influenza1_desc" value="<?php echo utf8_encode($result[0]["influenza1_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 border-headmid d-md-none"></div>
                <div id="rotavirus3do3" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['rotavirus3do3']=='1') { echo 'bg-rotavirus'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">ROTAVIRUS 3 dosis. (Tercera)</span>
                    <div id="rotavirus3do3_" <?php if($result[0]['rotavirus3do3']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['rotavirus3do3']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="rotavirus3do3">
                        <input placeholder="Fecha de vacunación" name="rotavirus3do3_date" value="<?php echo $result[0]["rotavirus3do3_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="rotavirus3do3_desc" value="<?php echo utf8_encode($result[0]["rotavirus3do3_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">7 Meses</span>
                </div>
                <div id="influenza2" class="col-7 col-sm-7 col-md-8 col-lg-10 p-2 border-mid <?php if($result[0]['influenza2']=='1') { echo 'bg-influenza'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">INFLUENZA (Segunda)</span>
                    <div class="row h-100 text-center">
                        <div id="influenza2_" <?php if($result[0]['influenza2']!='1') { echo 'style="display: none;"'; } ?> class="offset-md-3 col-md-6 mt-2">
                            <input type="checkbox" <?php if($result[0]['influenza2']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="influenza2">
                            <input placeholder="Fecha de vacunación" name="influenza2_date" value="<?php echo $result[0]["influenza2_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                            <input type="text" class="form-control custom-input mt-1" name="influenza2_desc" value="<?php echo utf8_encode($result[0]["influenza2_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">12 Meses</span>
                </div>
                <div id="sarampion1" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['sarampion1']=='1') { echo 'bg-sarampion'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">SRP (Refuerzo)</span>
                    <div id="sarampion1_" <?php if($result[0]['sarampion1']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['sarampion1']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="sarampion1">
                        <input placeholder="Fecha de vacunación" name="sarampion1_date" value="<?php echo $result[0]["sarampion1_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="sarampion1_desc" value="<?php echo utf8_encode($result[0]["sarampion1_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 border-headmid d-md-none"></div>
                <div id="neumocorev" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['neumocorev']=='1') { echo 'bg-neumoco'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">NEUMOCÓCCICA CONJUGADA (Revacunación)</span>
                    <div id="neumocorev_" <?php if($result[0]['neumocorev']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['neumocorev']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="neumocorev">
                        <input placeholder="Fecha de vacunación" name="neumocorev_date" value="<?php echo $result[0]["neumocorev_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="neumocorev_desc" value="<?php echo utf8_encode($result[0]["neumocorev_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">18 Meses</span>
                </div>
                <div id="pentavalenteref" class="col-7 col-sm-7 col-md-8 col-lg-10 p-2 border-mid <?php if($result[0]['pentavalenteref']=='1') { echo 'bg-pentav'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">PENTAVALENTE ACECULAR (Refuerzo)</span>
                    <div class="row h-100 text-center">
                        <div id="pentavalenteref_" <?php if($result[0]['pentavalenteref']!='1') { echo 'style="display: none;"'; } ?> class="offset-md-3 col-md-6 mt-2">
                            <input type="checkbox" <?php if($result[0]['pentavalenteref']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="pentavalenteref">
                            <input placeholder="Fecha de vacunación" name="pentavalenteref_date" value="<?php echo $result[0]["pentavalenteref_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                            <input type="text" class="form-control custom-input mt-1" name="pentavalenteref_desc" value="<?php echo utf8_encode($result[0]["pentavalenteref_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">24 Meses(2 años)</span>
                </div>
                <div id="influenza3" class="col-7 col-sm-7 col-md-8 col-lg-10 p-2 border-mid <?php if($result[0]['influenza3']=='1') { echo 'bg-influenza'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">INFLUENZA (Refuerzo anual)</span>
                    <div class="row h-100 text-center">
                        <div id="influenza3_" <?php if($result[0]['influenza3']!='1') { echo 'style="display: none;"'; } ?> class="offset-md-3 col-md-6 mt-2">
                            <input type="checkbox" <?php if($result[0]['influenza3']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="influenza3">
                            <input placeholder="Fecha de vacunación" name="influenza3_date" value="<?php echo $result[0]["influenza3_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                            <input type="text" class="form-control custom-input mt-1" name="influenza3_desc" value="<?php echo utf8_encode($result[0]["influenza3_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">36 Meses(3 Años)</span>
                </div>
                <div id="influenza4" class="col-7 col-sm-7 col-md-8 col-lg-10 p-2 border-mid <?php if($result[0]['influenza4']=='1') { echo 'bg-influenza'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">INFLUENZA (Refuerzo anual)</span>
                    <div class="row h-100 text-center">
                        <div id="influenza4_" <?php if($result[0]['influenza4']!='1') { echo 'style="display: none;"'; } ?> class="offset-md-3 col-md-6 mt-2">
                            <input type="checkbox" <?php if($result[0]['influenza4']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="influenza4">
                            <input placeholder="Fecha de vacunación" name="influenza4_date" value="<?php echo $result[0]["influenza4_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                            <input type="text" class="form-control custom-input mt-1" name="influenza4_desc" value="<?php echo utf8_encode($result[0]["influenza4_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">48 Meses(4 Años)</span>
                </div>
                <div id="dptref" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['dptref']=='1') { echo 'bg-pentav'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">DPT (refuerzo)</span>
                    <div id="dptref_" <?php if($result[0]['dptref']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['dptref']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="dptref">
                        <input placeholder="Fecha de vacunación" name="dptref_date" value="<?php echo $result[0]["dptref_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="dptref_desc" value="<?php echo utf8_encode($result[0]["dptref_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 border-headmid d-md-none"></div>
                <div id="influenza5" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['influenza5']=='1') { echo 'bg-influenza'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">INFLUENZA (Refuerzo anual)</span>
                    <div id="influenza5_" <?php if($result[0]['influenza5']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['influenza5']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="influenza5">
                        <input placeholder="Fecha de vacunación" name="influenza5_date" value="<?php echo $result[0]["influenza5_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="influenza5_desc" value="<?php echo utf8_encode($result[0]["influenza5_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-head">
                    <span class="text-royal-blue bold-font">59 Meses(5 Años)</span>
                </div>
                <div id="influenza6" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['influenza6']=='1') { echo 'bg-influenza'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">INFLUENZA (Refuerzo anual)</span>
                    <div id="influenza6_" <?php if($result[0]['influenza6']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['influenza6']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="influenza6">
                        <input placeholder="Fecha de vacunación" name="influenza6_date" value="<?php echo $result[0]["influenza6_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="influenza6_desc" value="<?php echo utf8_encode($result[0]["influenza6_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
                <div class="col-5 col-sm-5 border-headmid d-md-none"></div>
                <div id="sabin" class="col-7 col-sm-7 col-md-4 col-lg-5 p-2 border-mid <?php if($result[0]['sabin']=='1') { echo 'bg-sabin'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">SABIN (Adicionales primera y segunda semana nacional de vacunación)</span>
                    <div id="sabin_" <?php if($result[0]['sabin']!='1') { echo 'style="display: none;"'; } ?> class="mt-2">
                        <input type="checkbox" <?php if($result[0]['sabin']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="sabin">
                        <input placeholder="Fecha de vacunación" name="sabin_date" value="<?php echo $result[0]["sabin_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                        <input type="text" class="form-control custom-input mt-1" name="sabin_desc" value="<?php echo utf8_encode($result[0]["sabin_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-5 col-sm-5 col-md-4 col-lg-2 p-2 border-full">
                    <span class="text-royal-blue bold-font">72 Meses(6 Años)</span>
                </div>
                <div id="sarampion2" class="col-7 col-sm-7 col-md-8 col-lg-10 p-2 border-end <?php if($result[0]['sarampion2']=='1') { echo 'bg-sarampion'; } else { echo 'bg-gray';} ?>">
                    <span class="ml-4">SRP (Refuerzo)</span>
                    <div class="row h-100 text-center">
                        <div id="sarampion2_" <?php if($result[0]['sarampion2']!='1') { echo 'style="display: none;"'; } ?> class="offset-md-3 col-md-6 mt-2">
                            <input type="checkbox" <?php if($result[0]['sarampion2']=='1') { echo 'checked="checked"'; } ?> style="display: none;" name="sarampion2">
                            <input placeholder="Fecha de vacunación" name="sarampion2_date" value="<?php echo $result[0]["sarampion2_date"]; ?>" class="form-control custom-input date" autocomplete="off" />
                            <input type="text" class="form-control custom-input mt-1" name="sarampion2_desc" value="<?php echo utf8_encode($result[0]["sarampion2_desc"]); ?>" placeholder="Efectos adversos" autocomplete="off" />
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="offset-0 offset-lg-3 offset-md-2 offset-sm-2 col-12 col-sm-8 col-md-8 col-lg-6 mt-4 vertical-margin-bottom">
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