<?php include_once("Controller/resources.php"); ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php include("header_references_auth.php");

            if ($_SESSION['id_role'] > 3) {
                header('Location: error.php');
                exit();
            }
            
            $search = "";
            if (sizeof($_POST)>0) {
                $search = $_POST["search"];
            }
            if (isset($_GET) && sizeof($_GET)>0) {
                switch($_GET["m"]){
                    
                    case 'familyRecord':
                        $sectionName = FAMILY_RECORD_NAME;
                        $iconName = "fa-users";
                        $table = "familyrecorddata";
                        $module = "family_record.php";
                        break;

                    case 'dass21Scale':
                        $sectionName = DASS21_SCALE_NAME;
                        $iconName = "fa-tablets";
                        $table = "dass21data";
                        $module = "dass21_scale.php";
                        break;

                    case 'environment':
                        $sectionName = ENVIRONMENT_NAME;
                        $iconName = "fa-seedling";
                        $table = "environmentdata";
                        $module = "environment.php";
                        break;

                    case 'ets':
                        $sectionName = ETS_NAME;
                        $iconName = "fa-random";
                        $table = "etsdata";
                        $module = "ets.php";
                        break;

                    case 'geriatricDepression':
                        $sectionName = GERIATRIC_DEPRESSION_NAME;
                        $iconName = "fa-hourglass-end";
                        $table = "geriatricdepressiondata";
                        $module = "geriatric_depression.php";
                        break;
                    
                    case 'zarittScale':
                        $sectionName = ZARITT_SCALE_NAME;
                        $iconName = "fa-bath";
                        $table = "zarittscaledata";
                        $module = "zaritt_scale.php";
                        break;

                    case 'socioCultural':
                        $sectionName = SOCIOCULTURAL_NAME;
                        $iconName = "fa-comment";
                        $table = "socioculturaldata";
                        $module = "sociocultural.php";
                        break;

                    case 'diabetes':
                        $sectionName = DIABETES_NAME;
                        $iconName = "fa-dna";
                        $table = "diabetesdata";
                        $module = "diabetes.php";
                        break;
                
                    case 'hypertension':
                        $sectionName = HYPERTENSION_NAME;
                        $iconName = "fa-heartbeat";
                        $table = "hypertensiondata";
                        $module = "hypertension.php";
                        break;

                    case 'bornLifestyle':
                        $sectionName = BORN_LIFESTYLE_NAME;
                        $iconName = "fa-baby-carriage";
                        $table = "bornlifestyledata";
                        $module = "born_lifestyle.php";
                        break;
                    
                    case 'babyLifestyle':
                        $sectionName = BABY_LIFESTYLE_NAME;
                        $iconName = "fa-baby";
                        $table = "babylifestyledata";
                        $module = "baby_lifestyle.php";
                        break;
                
                    case 'childLifestyle':
                        $sectionName = CHILD_LIFESTYLE_NAME;
                        $iconName = "fa-child";
                        $table = "childlifestyledata";
                        $module = "chlid_lifestyle.php";
                        break;
                    
                    case 'youngLifestyle':
                        $sectionName = YOUNG_LIFESTYLE_NAME;
                        $iconName = "fa-child";
                        $table = "younglifestyledata";
                        $module = "young_lifestyle.php";
                        break;

                    case 'gynecology':
                        $sectionName = GYNECOLOGY_NAME;
                        $iconName = "fa-venus";
                        $table = "gynecologydata";
                        $module = "gynecology.php";
                        break;

                    case 'healthCare':
                        $sectionName = HEALTH_CARE_NAME;
                        $iconName = "fa-user-md";
                        $table = "healthcaredata";
                        $module = "health_care.php";
                        break;

                    case 'vitalSign':
                        $sectionName = VITAL_SIGN_NAME;
                        $iconName = "fa-microscope";
                        $table = "younglifestyledata";
                        $module = "vital_sign.php";
                        break;

                    case 'genderViolence':
                        $sectionName = GENDER_VIOLENCE_NAME;
                        $iconName = "fa-venus-mars";
                        $table = "genderviolencedata";
                        $module = "gender_violence.php";
                        break;

                    case 'hopeless':
                        $sectionName = HOPELESS_NAME;
                        $iconName = "fa-burn";
                        $table = "hopelessdata";
                        $module = "hopeless.php";
                        break;

                    case 'childVaccination':
                        $sectionName = CHILD_VACCINATION;
                        $iconName = "fa-eye-dropper";
                        $table = "childvaccinationdata";
                        $module = "child_vaccination.php";
                        break;

                    case 'elderVaccination':
                        $sectionName = ELDER_VACCINATION;
                        $iconName = "fa-flask";
                        $table = "eldervaccinationdata";
                        $module = "elder_vaccination.php";
                        break;
                    
                    defalut:
                        break;
                }

                $listPatientsAnswered = listPatientsAnswered($linkDB, $table, $search);
                $listPatientsPending = listPatientsPending($linkDB, $table, $search);

            }else{
                header('Location: home.php'); exit;
            }
/*
            echo "<pre>";
            var_dump($listPatientsAnswered);
            echo "</pre>";

            echo "<pre>";
            var_dump($listPatientsPending);
            echo "</pre>"; */

         ?>
         <style type="text/css">
             .inline {
                  display: inline;
                }

                .link-button {
                  background: none;
                  border: none;
                  color: blue;
                  text-decoration: underline;
                  cursor: pointer;
                  /*font-size: 1em;*/
                }
                .link-button:focus {
                  outline: none;
                }
                .link-button:active {
                  color:red;
                }
         </style>
    </head>


<body id="bootstrap_overrides">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <?php include("navigator.php"); ?>
    <div class="container-fluid">

        <div class="row custom-vertical-padding">
            <div class="offset-0 offset-md-2 offset-sm-2 offset-lg-3 col-12 col-sm-8 col-md-8 col-lg-6 text-center">
                <button class="btn my-2 my-sm-0 custom-btn-disabled" type="submit">
                    <span>
                        <i class="fas <?php echo $iconName; ?> custom-icon icon-behind"></i>
                        <h4 class="text-white bold-font text-forward"><?php echo $sectionName; ?></h4>
                    </span>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <h2 class="text-orange bold-font label-user-pass">PENDIENTES</h2>
            </div>
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <section class="pending-users vertical-margin-bottom block-users double-vertical-margin-bottom">
                    <ul class="user-list">
                        <div>
                            <?php
                            if($listPatientsPending!="")
                                for ($i=0; $i < sizeof($listPatientsPending); $i++) { ?>
                                <li class="user-list-element">
                                    <form method="post" action="<?php echo $module; ?>" class="inline">
                                        <input type="hidden" name="module" value="<?php echo $_GET['m']; ?>">
                                        <input type="hidden" name="id_patient" value="<?php echo $listPatientsPending[$i]['id']; ?>">
                                        <div class="row">
                                            <div class="col-3 col-sm-3 col-md-2 col-lg-2 m-0">
                                                <button type="submit" name="submit_param" value="submit_value" class="link-button">
                                                    <?php echo utf8_encode($listPatientsPending[$i]["affiliationNumber_d"]); ?>
                                                </button>
                                            </div>
                                            <div class="col-9 col-sm-9 col-md-10 col-lg-10 m-0">
                                                <button type="submit" name="submit_param" value="submit_value" class="link-button">
                                                    <?php echo utf8_encode($listPatientsPending[$i]["firstLastName"]." ".$listPatientsPending[$i]["secondLastName"]." ".$listPatientsPending[$i]["name"]); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            <?php } ?>
                        </div>
                    </ul>
                </section>
            </div>
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <h2 class="text-orange bold-font label-user-pass">
                    REALIZADOS
                </h2>
            </div>
            <div class="offset-0 offset-lg-1 offset-md-1 offset-sm-1 col-12 col-sm-10 col-md-10 col-lg-10">
                <section class="pending-users double-vertical-margin-bottom block-users">
                     <ul class="user-list">
                        <div>
                            <?php
                            if($listPatientsAnswered!="")
                                for ($i=0; $i < sizeof($listPatientsAnswered); $i++) { ?>
                                <li class="user-list-element">
                                    <form method="post" action="<?php echo $module; ?>" class="inline">
                                        <input type="hidden" name="module" value="<?php echo $_GET['m']; ?>">
                                        <input type="hidden" name="id_patient" value="<?php echo $listPatientsAnswered[$i]['id']; ?>">
                                        <div class="row">
                                            <div class="col-3 col-sm-3 col-md-2 col-lg-2 m-0">
                                                <button type="submit" name="submit_param" value="submit_value" class="link-button">
                                                    <?php echo utf8_encode($listPatientsAnswered[$i]["affiliationNumber_d"]); ?>
                                                </button>
                                            </div>
                                            <div class="col-9 col-sm-9 col-md-10 col-lg-10 m-0">
                                                <button type="submit" name="submit_param" value="submit_value" class="link-button">
                                                    <?php echo utf8_encode($listPatientsAnswered[$i]["firstLastName"]." ".$listPatientsAnswered[$i]["secondLastName"]." ".$listPatientsAnswered[$i]["name"]); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            <?php } ?>
                        </div>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</body>

</html>