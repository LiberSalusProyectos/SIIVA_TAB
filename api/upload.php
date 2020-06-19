<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 60000);
include 'resources/phpExcel/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

include_once("Controller/resources.php");

if($_FILES["select_excel"]["name"] != ''){
  $response = new stdClass();
  $response->success = true;
  $response->message = 'Carga realizada correctamente.';

  $id_data = $_POST["id_data"];

  $allowed_extension = array('xls', 'xlsx');
  $file_array = explode(".", $_FILES['select_excel']['name']);
  $file_extension = end($file_array);

  if(in_array($file_extension, $allowed_extension)){
    $reader = IOFactory::createReader('Xlsx');
    $spreadsheet = $reader->load($_FILES['select_excel']['tmp_name']);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    try {
      $linkDB->autocommit(false);
      switch($id_data){
        case 0:
          $update = true;
          $ins_count = 0;
          $data = array();
          $keys = array_keys($sheetData);
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if (trim($row[0]) !== 'FOLIO' ||
                  trim($row[1]) !== 'N° DE AFILIACIÓN (1)' ||
                  trim($row[2]) !== 'N° DE AFILIACIÓN' ||
                  trim($row[3]) !== 'VISITA' ||
                  trim($row[4]) !== 'PERMISO' ||
                  trim($row[5]) !== 'NOMBRE (S)' ||
                  trim($row[6]) !== 'PRIMER APELLIDO' ||
                  trim($row[7]) !== 'SEGUNDO APELLIDO' ||
                  trim($row[8]) !== 'FECHA  DE NACIMIENTO' ||
                  trim($row[9]) !== 'EDAD' ||
                  trim($row[10]) !== 'GENERO' ||
                  trim($row[11]) !== 'PARENTESCO' ||
                  trim($row[12]) !== 'CALLE' ||
                  trim($row[13]) !== 'N° EXTERIOR' ||
                  trim($row[14]) !== 'N° INTERIOR' ||
                  trim($row[15]) !== 'COLONIA' ||
                  trim($row[16]) !== 'MUNICIPIO' ||
                  trim($row[17]) !== 'CODIGO POSTAL' ||
                  trim($row[18]) !== 'ESTADO'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>107){
              if(trim($row[5]) !== '' && trim($row[6]) !== '' && trim($row[9]) !== ''){
                $element = new stdClass();
                $element->invoice = trim($row[0]);
                $element->n_affiliation = trim($row[1]);
                $element->n_affiliation_d = trim($row[2]);
                $element->visit = trim($row[3]);
                $element->permission = trim($row[4]);
                $element->name = trim($row[5]);
                $element->first_lastname = trim($row[6]);
                $element->second_lastname = trim($row[7]);
                $element->birthdate = trim($row[8]);
                $element->age = trim($row[9]);
                $element->gender = trim($row[10]);
                $element->relationship = trim($row[11]);
                $element->calle = trim($row[12]);
                $element->num_ext = trim($row[13]);
                $element->num_int = trim($row[14]);
                $element->colonia = trim($row[15]);
                $element->municipio = trim($row[16]);
                $element->codigo_postal = trim($row[17]);
                $element->estado = trim($row[18]);
                array_push($data, $element);
              }
              if ($key === end($keys)) {
                // En la ultima iteración se insertan datos restantes
                bulkInsertPatientData($linkDB, $data);
                $linkDB->commit();
              }
              if (sizeof($data) === 50) {
                // Mandamos a insertar datos de 50 registros y reiniciamos la variable
                bulkInsertPatientData($linkDB, $data);
                $data = array();
              }
            }
          }
          break;
        case 1:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'PARENTESCO' || 
                  trim($row[6]) !== 'LUGAR DE NACIMIENTO' ||
                  trim($row[8]) !== 'SEXO' ||
                  trim($row[9]) !== 'LUGAR DE RESIDENCIA' ||
                  trim($row[23]) !== 'OCUPACIÓN' ||
                  trim($row[24]) !== 'HIPERTENSIÓN ARTERIAL' ||
                  trim($row[25]) !== 'DIABETES MELLITUS' ||
                  trim($row[26]) !== 'CARDIOPATÍAS' ||
                  trim($row[30]) !== 'ASMA' ||
                  trim($row[31]) !== 'OBESIDAD' ||
                  trim($row[32]) !== 'DISLIPIDEMIA' || //Cambia de booleano a opción multiple
                  trim($row[33]) !== 'CÁNCER' ||
                  trim($row[38]) !== 'ENFERMEDADES PSIQUIÁTRICAS' ||
                  trim($row[42]) !== 'ENFERMEDADES OCULARES' ||
                  trim($row[46]) !== 'ENFERMEDADES ENDÓCRINAS' ||
                  trim($row[50]) !== 'ENFERMEDADES GINECO-OBSTÉTRICAS' ||
                  trim($row[54]) !== 'ENFERMEDADES NEUROLÓGICAS' ||
                  trim($row[58]) !== 'ENFERMEDADES INFECTO-CONTAGIOSAS' ||
                  trim($row[62]) !== 'ENFERMEDADES GENÉTICAS' ||
                  trim($row[66]) !== 'OTRAS ENFERMEDADES' ||
                  trim($row[67]) !== 'EDAD DE FALLECIMIENTO' || //Cambia de numerico a texto abierto
                  trim($row[68]) !== 'CAUSA DE MUERTE' ||
                  trim($row[69]) !== 'OBSERVACIONES'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['relationship'] = trim($row[5]) !== '' ? trim($row[5]) : NULL;
                $data['occupation'] = trim($row[23]) !== '' ? trim($row[23]) : NULL;
                $data['gender'] = trim($row[8]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['birth_state'] = trim($row[6]) !== '' ? $row[6] : NULL;
                $data['birth_place'] = trim($row[7]) !== '' ? $row[7] : NULL;
                $data['residence_place'] = trim($row[14]) !== '' ? $row[14] : NULL;
                $data['residence_state'] = trim($row[15]) !== '' ? $row[15] : NULL;

                $data['hypertension'] = trim($row[24]) !== '' ? (substr($row[24], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['diabetes'] = trim($row[25]) !== '' ? (substr($row[25], 0, 1) == 'X' ? '1' : NULL ) : NULL;

                $data['heart_attack'] = trim($row[26]) !== '' ? (substr($row[26], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['cardiac_arrhythmia'] = trim($row[27]) !== '' ? (substr($row[27], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['heart_failure'] = trim($row[28]) !== '' ? (substr($row[28], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['heart_other'] = trim($row[29]) !== '' ? '1' : NULL;
                $data['heart_other_desc'] = trim($row[29]) !== '' ? $row[29] : NULL;

                $data['asthma'] = trim($row[30]) !== '' ? (substr($row[30], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['obesity'] = trim($row[31]) !== '' ? (substr($row[31], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['dyslipidemia'] = trim($row[32]) !== '' ? strtolower(substr($row[32], 0, 1)) : NULL;

                $data['breast_cancer'] = trim($row[33]) !== '' ? (substr($row[33], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['cervical_cancer'] = trim($row[34]) !== '' ? (substr($row[34], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['prostate_cancer'] = trim($row[35]) !== '' ? (substr($row[35], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['leukemia'] = trim($row[36]) !== '' ? (substr($row[36], 0, 1) == 'X' ? '1' : NULL ) : NULL; //Falta agregar este campo
                $data['cancer_other'] = trim($row[37]) !== '' ? '1' : NULL;
                $data['cancer_other_desc'] = trim($row[37]) !== '' ? $row[37] : NULL;

                $data['anxiety_depression'] = trim($row[38]) !== '' ? (substr($row[38], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['eating_disorders'] = trim($row[39]) !== '' ? (substr($row[39], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['schizophrenia'] = trim($row[40]) !== '' ? (substr($row[40], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['psychiatric_other'] = trim($row[41]) !== '' ? '1' : NULL;
                $data['psychiatric_other_desc'] = trim($row[41]) !== '' ? $row[41] : NULL;

                $data['glaucoma'] = trim($row[42]) !== '' ? (substr($row[42], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['ametropia'] = trim($row[43]) !== '' ? (substr($row[43], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['waterfalls'] = trim($row[44]) !== '' ? (substr($row[44], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['eye_other'] = trim($row[45]) !== '' ? '1' : NULL;
                $data['eye_other_desc'] = trim($row[45]) !== '' ? $row[45] : NULL;

                $data['hyperthyroidism'] = trim($row[46]) !== '' ? (substr($row[46], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['hypothyroidism'] = trim($row[47]) !== '' ? (substr($row[47], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['cushing'] = trim($row[48]) !== '' ? (substr($row[48], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['endocrine_other'] = trim($row[49]) !== '' ? '1' : NULL;
                $data['endocrine_other_desc'] = trim($row[49]) !== '' ? $row[49] : NULL;

                $data['preeclampsia'] = trim($row[50]) !== '' ? (substr($row[50], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['cystic_ovary'] = trim($row[51]) !== '' ? (substr($row[51], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['gestational_diabetes'] = trim($row[52]) !== '' ? (substr($row[52], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['gynecological_other'] = trim($row[53]) !== '' ? '1' : NULL;
                $data['gynecological_other_desc'] = trim($row[53]) !== '' ? $row[53] : NULL;

                $data['parkinson'] = trim($row[54]) !== '' ? (substr($row[54], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['epilepsy'] = trim($row[55]) !== '' ? (substr($row[55], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['alzheimer'] = trim($row[56]) !== '' ? (substr($row[56], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['neurological_other'] = trim($row[57]) !== '' ? '1' : NULL;
                $data['neurological_other_desc'] = trim($row[57]) !== '' ? $row[57] : NULL;

                $data['tuberculosis'] = trim($row[58]) !== '' ? (substr($row[58], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['sida'] = trim($row[59]) !== '' ? (substr($row[59], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['syphilis'] = trim($row[60]) !== '' ? (substr($row[60], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['infectious_other'] = trim($row[61]) !== '' ? '1' : NULL;
                $data['infectious_other_desc'] = trim($row[61]) !== '' ? $row[61] : NULL;

                $data['down_syndrome'] = trim($row[62]) !== '' ? (substr($row[62], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['cretinism_acromegaly'] = trim($row[63]) !== '' ? (substr($row[63], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['hemophilia'] = trim($row[64]) !== '' ? (substr($row[64], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['genetic_other'] = trim($row[65]) !== '' ? '1' : NULL;
                $data['genetic_other_desc'] = trim($row[65]) !== '' ? $row[65] : NULL;

                $data['other_diseases'] = trim($row[15]) !== '' ? $row[15] : NULL;
                $data['death_age'] = trim($row[15]) !== '' ? $row[15] : NULL;
                $data['death_cause'] = trim($row[15]) !== '' ? $row[15] : NULL;
                $data['observations'] = trim($row[15]) !== '' ? $row[15] : NULL;
                
                $insert_id = saveFamilyRecordData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 2:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== 'Le costó mucho relajarse.' ||
                  trim($row[7]) !== 'Ha tenido la boca seca constantemente.' ||
                  trim($row[8]) !== 'Ha notado dificultad para sentir sentimientos positivos.' ||
                  trim($row[9]) !== 'Se le hizo difícil respirar.' ||
                  trim($row[10]) !== 'Se le hizo difícil tomar la iniciativa para hacer cosas.' ||
                  trim($row[11]) !== 'Reaccionó exageradamente en ciertas situaciones.' ||
                  trim($row[12]) !== 'Sintió que sus manos temblaban.' ||
                  trim($row[13]) !== 'Se ha sentido muy intranquilo.' ||
                  trim($row[14]) !== 'Ha estado preocupado por situaciones en las que podía sentir pánico o en las que podría hacer el ridículo.' ||
                  trim($row[15]) !== 'Sintió que no tenía nada porqué vivir.' ||
                  trim($row[16]) !== 'Ha notado que se agita.' ||
                  trim($row[17]) !== 'Se le hizo difícil relajarse.' ||
                  trim($row[18]) !== 'Se ha sentido triste y deprimido.' ||
                  trim($row[19]) !== 'Estuvo intolerante con lo que lo distrajera de lo que estaba haciendo.' ||
                  trim($row[20]) !== 'Sintió que estuvo a punto de entrar en pánico.' ||
                  trim($row[21]) !== 'No se puede entusiasmar por nada.' ||
                  trim($row[22]) !== 'Sintió que valía muy poco como persona.' ||
                  trim($row[23]) !== 'Sintió que ha estado muy irritable.' ||
                  trim($row[24]) !== 'Se sintió agitado a pesar de no haber hecho esfuerzo físico.' ||
                  trim($row[25]) !== 'Tuvo miedo sin razón.' ||
                  trim($row[26]) !== 'Sintió que la vida no tiene ningún sentido.'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $fields = array('relax', 'dry_mouth', 'positive_feelings', 'breathe', 'initiative', 'exaggerate', 'tingling_hands', 'worried',
                 'concerned', 'be_down', 'agitate', 'relax_difficult', 'depression', 'intolerance', 'panic', 'enthusiasm', 'selfsteem',
                 'irritable', 'feel_agitated', 'fear', 'meaningless_life');

                foreach($fields as $key=>$field){
                  $index = $key+6;
                  switch(substr($row[$index], 0, 1)){
                    case '0':
                      $value = 'a';
                      break;
                    case '1':
                      $value = 'b';
                      break;
                    case '2':
                      $value = 'c';
                      break;
                    case '3':
                      $value = 'd';
                      break;
                    default:
                      $value = NULL;
                      break;
                  }
                  $data[$field] = $value;
                }
                
                $insert_id = saveDass21Data($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 3:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== 'El origen de la captación del agua proviene de:' ||
                  trim($row[8]) !== '¿De qué forma es almacenada el agua que usas en casa?' ||
                  trim($row[10]) !== '¿El agua en tu casa es incolora, indolora e insabora?' ||
                  trim($row[13]) !== 'La medición de la cloración del agua es:' ||
                  trim($row[18]) !== '¿Cuáles es el tipo de aguas residuales en tu casa?' ||
                  trim($row[19]) !== 'La contaminación atmosférica química en el aire, ¿te causa?' ||
                  trim($row[21]) !== '¿Cuentas con alguna de las siguientes formas de contaminación física?' ||
                  trim($row[23]) !== '¿Sabes de la existencia de refinerías de PEMEX u otros, cerca de tu casa?' ||
                  trim($row[24]) !== '¿Sabes de la existencia de gasoductos de PEMEX u otros, cerca de tu casa?' ||
                  trim($row[25]) !== '¿Sabes de alguna repercusión en la salud a causa de esto?' ||
                  trim($row[28]) !== '¿Sabes si cerca de tu casa transportan material peligroso?' ||
                  trim($row[30]) !== '¿Sabes de la existencia de generadores de radiación cerca de tu casa?' ||
                  trim($row[32]) !== '¿Se realiza quema de productos o residuos peligrosos cerca de tu casa?' ||
                  trim($row[34]) !== '¿Sabes si existe vigilancia de la contaminación química?' ||
                  trim($row[36]) !== '¿Conoces los contaminantes que te rodean?' ||
                  trim($row[38]) !== '¿Existe recolección de basura en tu casa?' ||
                  trim($row[39]) !== '¿Quién es el personal encargado de la recolección de basura?' ||
                  trim($row[40]) !== '¿Sabes si existen vertederos de basura cerca de tu casa y cuantos?' ||
                  trim($row[42]) !== '¿Sabes si existen vertederos de residuos peligrosos cerca de tu casa y cuantos?' ||
                  trim($row[44]) !== '¿Cómo es la separación en la recolección de basura en tu casa?' ||
                  trim($row[46]) !== '¿Cuántas veces por semana se realiza la recolección de basura?' ||
                  trim($row[47]) !== '¿Sabes de la existencia de mataderos cerca de tu casa y cuantos?' ||
                  trim($row[49]) !== '¿Sabes de la existencia de vertederos de basura clandestinos cerca de tu casa y cuantos?' ||
                  trim($row[51]) !== '¿Con qué frecuencia acuden a las actividades socioculturales de la comunidad?' ||
                  trim($row[52]) !== '¿Estaría dispuesto a participar en las actividades socioculturales?' ||
                  trim($row[53]) !== 'De los siguientes valores, elije 3 que describan a tu familia' ||
                  trim($row[56]) !== '¿Realizas consumo de?' ||
                  trim($row[57]) !== '¿Cuál es tu actividad laboral?' ||
                  trim($row[58]) !== '¿Qué tipos de actividades recreativas realizas?' ||
                  trim($row[62]) !== '¿Sabe leer?' ||
                  trim($row[63]) !== '¿Sabe escribir?' ||
                  trim($row[64]) !== '¿Cuál es su nivel educativo?' ||
                  trim($row[65]) !== '¿La casa donde vives se encuentra en una zona inundable?' ||
                  trim($row[66]) !== '¿La casa donde vives se encuentra en una zona de deslizamientos?' ||
                  trim($row[67]) !== '¿Vives en un medio?' ||
                  trim($row[68]) !== '¿Cuántas personas viven en tu casa?' ||
                  trim($row[69]) !== '¿Cuántas habitaciones hay en tu casa?' ||
                  trim($row[70]) !== '¿Cuentas con ventilación directa?' ||
                  trim($row[71]) !== '¿Cuántos metros cuadrados tiene tu casa?' ||
                  trim($row[72]) !== '¿Cuenta con agua caliente?' ||
                  trim($row[73]) !== '¿Cuántos focos tiene en casa?' ||
                  trim($row[75]) !== '¿La casa donde vive es?' ||
                  trim($row[76]) !== '¿La casa donde vives está hecha de materiales?' ||
                  trim($row[77]) !== '¿El suelo en su casa es de?' ||
                  trim($row[78]) !== '¿Existe mucha humedad en tu casa?' ||
                  trim($row[79]) !== '¿Existe el uso de plaguicidas en casa?' ||
                  trim($row[80]) !== '¿Existe el uso de fertilizantes en casa?' ||
                  trim($row[81]) !== '¿Conoce los riesgos a la exposición de estos?' ||
                  trim($row[82]) !== '¿A presentado a causa de la exposición?' ||
                  trim($row[85]) !== '¿Está informado de los riesgos sanitarios de su actividad laboral?' ||
                  trim($row[86]) !== '¿Con que animales convive?' ||
                  trim($row[91]) !== '¿Están vacunados los animales en su casa?' ||
                  trim($row[92]) !== '¿Duermen en la misma habitación?' ||
                  trim($row[93]) !== '¿Existe antecedente de pulgas?' ||
                  trim($row[94]) !== '¿Con que roedores o insectos tiene contacto?' ||
                  trim($row[98]) !== '¿Cómo realiza el control de residuos de los animales en casa?' ||
                  trim($row[99]) !== '¿Conoce el nombre del mosco que transmite dengue, chinkungunya y zika?' ||
                  trim($row[100]) !== '¿Afirma la existencia de muchos moscos en su casa?' ||
                  trim($row[101]) !== '¿Sabe usted que es el dengue, chinkungunya, zika?' ||
                  trim($row[102]) !== '¿Ha escuchado en redes sociales información con respecto al tema?' ||
                  trim($row[103]) !== '¿Han padecido en casa alguna de estas enfermedades?' ||
                  trim($row[106]) !== '¿Conoce los síntomas y signos de estas enfermedades?' ||
                  trim($row[107]) !== '¿Cree importante acudir al médico en sospecha de algunas de estas enfermedades?' ||
                  trim($row[108]) !== '¿Conoce que acciones en promoción a la salud le pueden ayudar a prevenir estas enfermedades?' ||
                  trim($row[109]) !== '¿Sabe que es el saneamiento básico en el hogar?' ||
                  trim($row[110]) !== '¿Tiene recipientes que contengan agua dentro o fuera de su casa?' ||
                  trim($row[111]) !== '¿Cuántas infecciones alimenticias has padecido en el año?' ||
                  trim($row[112]) !== '¿Cuántas infecciones diarreicas has padecido en el año?' ||
                  trim($row[113]) !== '¿Cuántas infecciones respiratorias has padecido en el año?' ||
                  trim($row[114]) !== '¿Sabes si existe control y vigilancia de la emisión y extracción de gases y humo?' ||
                  trim($row[115]) !== '¿Cuáles son los principales problemas de salud en su comunidad y cuantos casos existen?' ||
                  trim($row[116]) !== '¿Tiene acceso a servicios de salud en su trabajo y de qué tipo es?' ||
                  trim($row[118]) !== '¿Tiene facilidades para el consumo de agua en su trabajo?' ||
                  trim($row[123]) !== '¿Tiene facilidades de higiene en el trabajo?' ||
                  trim($row[126]) !== '¿Tiene facilidades de vestimenta en el trabajo?' ||
                  trim($row[129]) !== '¿En su trabajo tiene exposición?' ||
                  trim($row[131]) !== '¿Qué riesgos presenta en su trabajo?' ||
                  trim($row[133]) !== '¿Cuenta con las herramientas necesarias para realizar el trabajo?' ||
                  trim($row[134]) !== '¿El área es la adecuada para realizar el trabajo?' ||
                  trim($row[135]) !== '¿Tiene facilidades para el uso de equipos de protección?' ||
                  trim($row[136]) !== '¿Ha presentado acontecimientos traumáticos severos?' ||
                  trim($row[137]) !== '¿Tiene apoyo psicosocial?' ||
                  trim($row[138]) !== '¿Padece ansiedad en su trabajo?' ||
                  trim($row[139]) !== '¿Se ve afectado el ciclo del sueño a causa de tu trabajo?' ||
                  trim($row[140]) !== '¿Le realizan exámenes médicos?'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['water_acquisition'] = trim($row[6]) !== '' ? strtolower(substr($row[6], 0, 1)) : NULL;
                $data['water_acquisition_desc'] = trim($row[7]) !== '' ? $row[7] : NULL;
                $data['water_store'] = trim($row[8]) !== '' ? strtolower(substr($row[8], 0, 1)) : NULL;
                $data['water_store_desc'] = trim($row[9]) !== '' ? $row[9] : NULL;
                $data['water_color'] = trim($row[10]) !== '' ? $row[10] : NULL;
                $data['water_odor'] = trim($row[11]) !== '' ? $row[11] : NULL;
                $data['water_flavor'] = trim($row[12]) !== '' ? $row[12] : NULL;
                $data['water_quality_a'] = trim($row[13]) !== '' ? (substr($row[13], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['water_quality_b'] = trim($row[14]) !== '' ? (substr($row[14], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['water_quality_c'] = trim($row[15]) !== '' ? (substr($row[15], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['water_quality_d'] = trim($row[16]) !== '' ? (substr($row[16], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['water_quality_e'] = trim($row[17]) !== '' ? (substr($row[17], 0, 1) == 'X' ? '1' : NULL ) : NULL;
                $data['sewage_type'] = trim($row[18]) !== '' ? strtolower(substr($row[18], 0, 1)) : NULL;
                $data['pollution_react'] = trim($row[19]) !== '' ? strtolower(substr($row[19], 0, 1)) : NULL;
                $data['pollution_react_desc'] = trim($row[20]) !== '' ? $row[20] : NULL;
                $data['contamination'] = trim($row[21]) !== '' ? strtolower(substr($row[21], 0, 1)) : NULL;
                $data['contamination_desc'] = trim($row[22]) !== '' ? $row[22] : NULL;
                $data['refinery_nearby'] = trim($row[23]) !== '' ? (substr($row[23], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['pipelines_nearby'] = trim($row[24]) !== '' ? (substr($row[24], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['health_impact_a'] = trim($row[25]) !== '' ? (substr($row[25], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['health_impact_b'] = trim($row[26]) !== '' ? (substr($row[26], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['health_impact_c'] = trim($row[27]) !== '' ? (substr($row[27], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['dangerous_material'] = trim($row[28]) !== '' ? strtolower(substr($row[28], 0, 1)) : NULL;
                $data['dangerous_material_desc'] = trim($row[29]) !== '' ? $row[29] : NULL;
                $data['radiation_nearby'] = trim($row[30]) !== '' ? (substr($row[30], 0, 1) == 'b' ? '0' : '1' ) : NULL;
                $data['radiation_nearby_desc'] = trim($row[31]) !== '' ? $row[31] : NULL;
                $data['burning_waste'] = trim($row[32]) !== '' ? (substr($row[32], 0, 1) == 'b' ? '0' : '1' ) : NULL;
                $data['burning_waste_desc'] = trim($row[33]) !== '' ? $row[33] : NULL;
                $data['chemical_inspection'] = trim($row[34]) !== '' ? (substr($row[34], 0, 1) == 'b' ? '0' : '1' ) : NULL;
                $data['chemical_inspection_desc'] = trim($row[35]) !== '' ? $row[35] : NULL;
                $data['know_pollutants'] = trim($row[36]) !== '' ? (substr($row[36], 0, 1) == 'b' ? '0' : '1' ) : NULL;
                $data['know_pollutants_desc'] = trim($row[37]) !== '' ? $row[37] : NULL;
                $data['garbage_collection'] = trim($row[38]) !== '' ? (substr($row[38], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['garbage_collection_desc'] = NULL;
                $data['collection_staff'] = trim($row[39]) !== '' ? strtolower(substr($row[39], 0, 1)) : NULL;
                $data['dumps_nearby'] = trim($row[40]) !== '' ? (substr($row[40], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['dumps_nearby_number'] = is_numeric(trim($row[41])) ? $row[41] : NULL;
                $data['dangerous_residues'] = trim($row[42]) !== '' ? (substr($row[42], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['dangerous_residues_number'] = is_numeric(trim($row[43])) ? $row[43] : NULL;
                $data['separate_trash'] = trim($row[44]) !== '' ? strtolower(substr($row[44], 0, 1)) : NULL;
                $data['separate_trash_desc'] = trim($row[45]) !== '' ? $row[45] : NULL;
                $data['garbage_collection_times'] = trim($row[46]) !== '' ? strtolower(substr($row[46], 0, 1)) : NULL;
                $data['slaughterhouse_nearby'] = trim($row[47]) !== '' ? (substr($row[47], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['slaughterhouse_nearby_number'] = is_numeric(trim($row[48])) ? $row[48] : NULL;
                $data['clandestine_dump'] = trim($row[49]) !== '' ? (substr($row[49], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['clandestine_dump_number'] = is_numeric(trim($row[50])) ? $row[50] : NULL;
                $data['sociocultural_activities'] = trim($row[51]) !== '' ? strtolower(substr($row[51], 0, 1)) : NULL;
                $data['sociocultural_join'] = trim($row[52]) !== '' ? (substr($row[52], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                
                // Pendiente los valores y consumo de 
                $data['values_a'] = (substr($row[53], 0, 1) == 'a' || substr($row[54], 0, 1) == 'a' || substr($row[55], 0, 1) == 'a') ? '1' : NULL;
                $data['values_b'] = (substr($row[53], 0, 1) == 'b' || substr($row[54], 0, 1) == 'b' || substr($row[55], 0, 1) == 'b') ? '1' : NULL;
                $data['values_c'] = (substr($row[53], 0, 1) == 'c' || substr($row[54], 0, 1) == 'c' || substr($row[55], 0, 1) == 'c') ? '1' : NULL;
                $data['values_d'] = (substr($row[53], 0, 1) == 'd' || substr($row[54], 0, 1) == 'd' || substr($row[55], 0, 1) == 'd') ? '1' : NULL;
                $data['values_e'] = (substr($row[53], 0, 1) == 'e' || substr($row[54], 0, 1) == 'e' || substr($row[55], 0, 1) == 'e') ? '1' : NULL;
                $data['values_f'] = (substr($row[53], 0, 1) == 'f' || substr($row[54], 0, 1) == 'f' || substr($row[55], 0, 1) == 'f') ? '1' : NULL;
                $data['values_g'] = (substr($row[53], 0, 1) == 'g' || substr($row[54], 0, 1) == 'g' || substr($row[55], 0, 1) == 'g') ? '1' : NULL;
                $data['values_h'] = (substr($row[53], 0, 1) == 'h' || substr($row[54], 0, 1) == 'h' || substr($row[55], 0, 1) == 'h') ? '1' : NULL;
                $data['values_i'] = (substr($row[53], 0, 1) == 'i' || substr($row[54], 0, 1) == 'i' || substr($row[55], 0, 1) == 'i') ? '1' : NULL;

                $data['consume_of_a'] = substr($row[54], 0, 1) == 'a' ? '1' : NULL;
                $data['consume_of_b'] = substr($row[54], 0, 1) == 'b' ? '1' : NULL;
                $data['consume_of_c'] = substr($row[54], 0, 1) == 'c' ? '1' : NULL;
                $data['consume_of_d'] = substr($row[54], 0, 1) == 'd' ? '1' : NULL;
                $data['consume_of_e'] = substr($row[54], 0, 1) == 'e' ? '1' : NULL;

                $data['work_activity'] = trim($row[57]) !== '' ? $row[57] : NULL;
                $data['recreational_activities'] = trim($row[58]) !== '' ? $row[58] : NULL;
                $data['hobby'] = trim($row[59]) !== '' ? strtolower(substr($row[59], 0, 1)) : NULL;
                $data['hobby_desc'] = trim($row[60]) !== '' ? $row[60] : NULL;
                $data['hobby_number'] = trim($row[61]) !== '' ? $row[61] : '';
                $data['can_read'] = trim($row[62]) !== '' ? (substr($row[62], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['can_write'] = trim($row[63]) !== '' ? (substr($row[63], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['education_level'] = trim($row[64]) !== '' ? strtolower(substr($row[64], 0, 1)) : NULL;
                $data['flood_zone'] = trim($row[65]) !== '' ? (substr($row[65], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['landslide_area'] = trim($row[66]) !== '' ? (substr($row[66], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['population'] = trim($row[67]) !== '' ? strtolower(substr($row[67], 0, 1)) : NULL;
                $data['number_people'] = trim($row[68]) !== '' ? strtolower(substr($row[68], 0, 1)) : NULL;
                $data['number_rooms'] = trim($row[69]) !== '' ? strtolower(substr($row[69], 0, 1)) : NULL;
                $data['ventilation'] = trim($row[70]) !== '' ? (substr($row[70], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['house_area'] = trim($row[71]) !== '' ? $row[71] : NULL;
                $data['hot_water'] = trim($row[72]) !== '' ? (substr($row[72], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['spotlights'] = trim($row[73]) !== '' ? (substr($row[73], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['spotlights_number'] = trim($row[74]) !== '' ? $row[74] : NULL;
                $data['house_type'] = trim($row[75]) !== '' ? strtolower(substr($row[75], 0, 1)) : NULL;
                $data['house_materials'] = trim($row[76]) !== '' ? strtolower(substr($row[76], 0, 1)) : NULL;
                $data['floor_type'] = trim($row[77]) !== '' ? strtolower(substr($row[77], 0, 1)) : NULL;
                $data['humidity_home'] = trim($row[78]) !== '' ? (substr($row[78], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['pesticides_use'] = trim($row[79]) !== '' ? (substr($row[79], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['fertilizers_use'] = trim($row[80]) !== '' ? (substr($row[80], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['know_risk'] = trim($row[81]) !== '' ? (substr($row[81], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['have_because_a'] = trim($row[82]) !== '' ? (substr($row[82], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['have_because_b'] = trim($row[83]) !== '' ? (substr($row[83], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['have_because_c'] = trim($row[84]) !== '' ? (substr($row[84], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['know_work_risks'] = trim($row[85]) !== '' ? (substr($row[85], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['animals_a'] = trim($row[86]) !== '' ? (substr($row[86], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['animals_b'] = trim($row[87]) !== '' ? (substr($row[87], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['animals_c'] = trim($row[88]) !== '' ? (substr($row[88], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['animals_d'] = trim($row[89]) !== '' ? (substr($row[89], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['animals_e'] = trim($row[90]) !== '' ? '1' : NULL;
                $data['animals_desc'] = trim($row[90]) !== '' ? $row[90] : NULL;
                $data['vaccinated'] = trim($row[91]) !== '' ? (substr($row[91], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['same_room'] = trim($row[92]) !== '' ? (substr($row[92], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['antecedent_fleas'] = trim($row[93]) !== '' ? (substr($row[93], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['rodents_insects_a'] = trim($row[94]) !== '' ? (substr($row[94], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['rodents_insects_b'] = trim($row[95]) !== '' ? (substr($row[95], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['rodents_insects_c'] = trim($row[96]) !== '' ? (substr($row[96], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['rodents_insects_d'] = trim($row[97]) !== '' ? '1' : NULL;
                $data['rodents_insects_desc'] = trim($row[97]) !== '' ? $row[97] : NULL;
                $data['animal_waste'] = trim($row[98]) !== '' ? strtolower(substr($row[98], 0, 1)) : NULL;
                $data['mosco_name'] = trim($row[99]) !== '' ? (substr($row[99], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['mosco_infestation'] = trim($row[100]) !== '' ? (substr($row[100], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['know_dengue'] = trim($row[101]) !== '' ? (substr($row[101], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['social_networks'] = trim($row[102]) !== '' ? strtolower(substr($row[102], 0, 1)) : NULL;
                $data['suffer_a'] = trim($row[103]) !== '' ? (substr($row[103], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['suffer_b'] = trim($row[104]) !== '' ? (substr($row[104], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['suffer_c'] = trim($row[105]) !== '' ? (substr($row[105], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['know_signs'] = trim($row[106]) !== '' ? (substr($row[106], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['go_doctor'] = trim($row[107]) !== '' ? (substr($row[107], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['prevention'] = trim($row[108]) !== '' ? (substr($row[108], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['basic_sanitation'] = trim($row[109]) !== '' ? (substr($row[109], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['water_containers'] = trim($row[110]) !== '' ? (substr($row[110], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['food_infection'] = trim($row[111]) !== '' ? strtolower(substr($row[111], 0, 1)) : NULL;
                $data['diarrheal_infection'] = trim($row[112]) !== '' ? strtolower(substr($row[112], 0, 1)) : NULL;
                $data['respiratory_infection'] = trim($row[113]) !== '' ? strtolower(substr($row[113], 0, 1)) : NULL;
                $data['smoke_supervision'] = trim($row[114]) !== '' ? (substr($row[114], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['community_health_problems'] = trim($row[115]) !== '' ? $row[115] : NULL;
                $data['work_health_services'] = trim($row[116]) !== '' ? (substr($row[116], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['work_type'] = trim($row[117]) !== '' ? (substr($row[117], 0, 1) == 'c' ? 'a' : 'b' ) : NULL;
                $data['work_water'] = trim($row[118]) !== '' ? (substr($row[118], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['work_water_a'] = trim($row[119]) !== '' ? (substr($row[119], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['work_water_b'] = trim($row[120]) !== '' ? (substr($row[120], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['work_water_c'] = trim($row[121]) !== '' ? (substr($row[121], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['work_water_d'] = trim($row[122]) !== '' ? (substr($row[122], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['work_hygiene'] = trim($row[123]) !== '' ? (substr($row[123], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['work_hygiene_a'] = trim($row[124]) !== '' ? (substr($row[124], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['work_hygiene_b'] = trim($row[125]) !== '' ? (substr($row[125], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['dressing_room'] = trim($row[126]) !== '' ? (substr($row[126], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['dressing_room_a'] = trim($row[127]) !== '' ? (substr($row[127], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['dressing_room_b'] = trim($row[128]) !== '' ? (substr($row[128], 0, 1) == 'a' ? '1' : NULL ) : NULL;

                //Falta expocision en trabajo y riesgos
                $data['work_exposition_a'] = substr($row[129], 0, 1) == 'a' ? '1' : NULL;
                $data['work_exposition_b'] = substr($row[129], 0, 1) == 'b' ? '1' : NULL;
                $data['work_exposition_c'] = substr($row[129], 0, 1) == 'c' ? '1' : NULL;
                $data['work_exposition_desc'] = trim($row[130]) !== '' ? $row[130] : NULL;

                $data['work_risk_a'] = substr($row[131], 0, 1) == 'a' ? '1' : NULL;
                $data['work_risk_b'] = substr($row[131], 0, 1) == 'b' ? '1' : NULL;
                $data['work_risk_c'] = substr($row[131], 0, 1) == 'c' ? '1' : NULL;
                $data['work_risk_d'] = substr($row[131], 0, 1) == 'd' ? '1' : NULL;
                $data['work_risk_desc'] = trim($row[132]) !== '' ? $row[132] : NULL;

                $data['work_tools'] = trim($row[133]) !== '' ? (substr($row[133], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['suitable_area'] = trim($row[134]) !== '' ? (substr($row[134], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['protective_equipment'] = trim($row[135]) !== '' ? (substr($row[135], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['severe_trauma'] = trim($row[136]) !== '' ? (substr($row[136], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['psychosocial_support'] = trim($row[137]) !== '' ? (substr($row[137], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['anxiety_work'] = trim($row[138]) !== '' ? (substr($row[138], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['sleep_cycle'] = trim($row[139]) !== '' ? (substr($row[139], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['medical_tests'] = trim($row[140]) !== '' ? (substr($row[140], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['medical_tests_times'] = trim($row[141]) !== '' ? strtolower(substr($row[141], 0, 1)) : NULL;

                $insert_id = saveEnvironmentData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 4:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== '¿Está básicamente satisfecho con su vida?' ||
                  trim($row[7]) !== '¿Ha renunciado a muchas de sus actividades y pasatiempos?' ||
                  trim($row[8]) !== '¿Siente que su vida está vacía?' ||
                  trim($row[9]) !== '¿Se encuentra a menudo aburrido?' ||
                  trim($row[10]) !== '¿Se encuentra alegre y optimista, con buen ánimo casi todo el tiempo?' ||
                  trim($row[11]) !== '¿Teme que le vaya a pasar algo malo?' ||
                  trim($row[12]) !== '¿Se siente feliz, contento la mayor parte del tiempo?' ||
                  trim($row[13]) !== '¿Se siente a menudo desamparado, desvalido, indeciso?' ||
                  trim($row[14]) !== '¿Prefiere quedarse en casa que acaso salir y hacer cosas nuevas?' ||
                  trim($row[15]) !== '¿Le da la impresión de que tiene más fallos de memoria que los demás?' ||
                  trim($row[16]) !== '¿Cree que es agradable estar vivo?' ||
                  trim($row[17]) !== '¿Se le hace duro empezar nuevos proyectos?' ||
                  trim($row[18]) !== '¿Se siente lleno de energía?' ||
                  trim($row[19]) !== '¿Siente que su situación es angustiosa, desesperada?' ||
                  trim($row[20]) !== '¿Cree que la mayoría de la gente vive económicamente mejor que usted?'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['satisfied'] = trim($row[6]) !== '' ? (substr($row[6], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['giveup_hobby'] = trim($row[7]) !== '' ? (substr($row[7], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['empty_life'] = trim($row[8]) !== '' ? (substr($row[8], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['boredom'] = trim($row[9]) !== '' ? (substr($row[9], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['optimism'] = trim($row[10]) !== '' ? (substr($row[10], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['fear'] = trim($row[11]) !== '' ? (substr($row[11], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['happiness'] = trim($row[12]) !== '' ? (substr($row[12], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['abandonment'] = trim($row[13]) !== '' ? (substr($row[13], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['at_home'] = trim($row[14]) !== '' ? (substr($row[14], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['memory_loss'] = trim($row[15]) !== '' ? (substr($row[15], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['love_forlife'] = trim($row[16]) !== '' ? (substr($row[16], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['start_difficult'] = trim($row[17]) !== '' ? (substr($row[17], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['full_energy'] = trim($row[18]) !== '' ? (substr($row[18], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['anxiety'] = trim($row[19]) !== '' ? (substr($row[19], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['economy'] = trim($row[20]) !== '' ? (substr($row[20], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                
                $insert_id = saveGeriatricDepressionData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 5:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== '¿Siente usted que a causas del tiempo que gasta con su familiar/paciente, ya no tiene tiempo para usted mismo?' ||
                  trim($row[7]) !== '¿Se seinte estresado(a) al tener que cuidar a su familiar/paciente y tener ademas que atender otras responsabilidades? (por ejemplo, con su familia o en el trabajo)' ||
                  trim($row[8]) !== '¿Crees que la situacion actual afecta a su relacion con amigos u otros miembros de su familia de una forma negativa?' ||
                  trim($row[9]) !== '¿Se seinte agotada(o) cuando tiene que estar junto a su familiar/paciente?' ||
                  trim($row[10]) !== '¿Siente usted que su salud se ha visto afectada por tener que cuidar a su familiar/paciente?' ||
                  trim($row[11]) !== '¿Siente que ha perdido el control sobre su vida desde que la enfermedad de su familiar/paciente se manifesto?' ||
                  trim($row[12]) !== 'En general ¿se siente muy sobre cargada(o) al tener que cuidar de su familiar/paciente?'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['own_time'] = trim($row[6]) !== '' ? substr($row[6], 0, 1) : NULL;
                $data['stressed'] = trim($row[7]) !== '' ? substr($row[7], 0, 1) : NULL;
                $data['relationship'] = trim($row[8]) !== '' ? substr($row[8], 0, 1) : NULL;
                $data['exhausted'] = trim($row[9]) !== '' ? substr($row[9], 0, 1) : NULL;
                $data['healthy'] = trim($row[10]) !== '' ? substr($row[10], 0, 1) : NULL;
                $data['control_life'] = trim($row[11]) !== '' ? substr($row[11], 0, 1) : NULL;
                $data['overloaded'] = trim($row[12]) !== '' ? substr($row[12], 0, 1) : NULL;
                
                $insert_id = saveZarittScaleData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 6:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'GÉNERO' || 
                  trim($row[6]) !== '1.-¿A que edad inicio su vida sexual?' ||
                  trim($row[7]) !== '2.- Orientación sexual' ||
                  trim($row[8]) !== '3.- No. de parejas sexuales' ||
                  trim($row[9]) !== '4.- ¿Conoce qué es el sexo seguro?' ||
                  trim($row[10]) !== '5.- Utiliza algún método anticonceptivo?' ||
                  trim($row[11]) !== '6._ ¿Conoce el uso correcto del condón?' ||
                  trim($row[12]) !== '7.- ¿Ha mantenido relaciones sexuales con sexo indistinto a su preferencia?' ||
                  trim($row[13]) !== '8.- ¿Ha estado expuesto a alguna ETS?' ||
                  trim($row[14]) !== '9.-¿ Llevo tratamiento y seguimiento médico?' ||
                  trim($row[15]) !== '10.- ¿Se ha realizado prueba rápida de VIH durante una consulta médica?' ||
                  trim($row[16]) !== '11.- ¿Se ha realizado Papanicolaou en el último año? ¿Cuál fue su resultado?' ||
                  trim($row[17]) !== 'Resultado' ||
                  trim($row[18]) !== '12.- ¿Cuántos y que tipos de enfermedades sexuales conoce?' ||
                  trim($row[19]) !== '13.- ¿conoce cuáles son las formas de transmisión de ETS?' ||
                  trim($row[20]) !== '14.- ¿Ha recibido platicas de ETS?' ||
                  trim($row[21]) !== '15.- ¿Conoce los síntomas del VIH?' ||
                  trim($row[22]) !== '16.- ¿Sabe a dónde acudir para valoración y tratamiento del VIH?'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['genre'] = trim($row[5]) !== '' ? ($row[5] == 'Hombre' ? 'a' : 'b' ) : NULL;
                $data['starts_activity'] = trim($row[6]);
                $data['sexual_orientation'] = trim($row[7]);
                $data['couples'] = trim($row[8]);
                $data['safe_sex'] = trim($row[9]) !== '' ? (substr($row[9], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['contraceptives'] = trim($row[10]) !== '' ? (substr($row[10], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['condom'] = trim($row[11]) !== '' ? (substr($row[11], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['intercourse'] = trim($row[12]) !== '' ? (substr($row[12], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['ets_exposed'] = trim($row[13]) !== '' ? (substr($row[13], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['medical_treatment'] = trim($row[14]) !== '' ? (substr($row[14], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['vih_test'] = trim($row[15]) !== '' ? (substr($row[15], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['pap_smear'] = trim($row[16]) !== '' ? (substr($row[16], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['pap_smear_result'] = trim($row[17]);
                $data['knowledge'] = trim($row[18]);
                $data['ways_transmit'] = trim($row[19]) !== '' ? (substr($row[19], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['talks'] = trim($row[20]) !== '' ? (substr($row[20], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['vih_symptom'] = trim($row[21]) !== '' ? (substr($row[21], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['vih_clinic'] = trim($row[22]) !== '' ? (substr($row[22], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                
                $insert_id = saveETSData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 7:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== '1 Se toman decisiones para cosas importantes de la familia.' ||
                  trim($row[7]) !== '2 En mi casa predomina la armonía.' ||
                  trim($row[8]) !== '3 En mi casa cada uno cumple con sus responsabilidades.' ||
                  trim($row[9]) !== '4 Las manifestaciones de cariño forman parte de nuestra vida cotidiana.' ||
                  trim($row[10]) !== '5 Nos expresamos sin insinuaciones, de forma clara y directa.' ||
                  trim($row[11]) !== '6 Podemos aceptar los defectos de los demás y sobrellevarlos.' ||
                  trim($row[12]) !== '7 Tomamos en consideración las experiencias de otras familias ante situaciones difíciles.' ||
                  trim($row[13]) !== '8 Cuando alguno de la familia tiene un problema, los demás lo ayudan.' ||
                  trim($row[14]) !== '9 Se distribuyen las tareas de forma que nadie está sobrecargado.' ||
                  trim($row[15]) !== '10 Las costumbres familiares pueden modificarse ante determinadas situaciones.' ||
                  trim($row[16]) !== '11 Podemos conversar diversos temas sin temor.' ||
                  trim($row[17]) !== '12 Ante una situación familiar difícil, somos capaces de buscar ayuda en otras personas.' ||
                  trim($row[18]) !== '13 Los intereses y necesidad de cada cual son respetados por el núcleo familiar.' ||
                  trim($row[19]) !== '14 Nos demostramos el cariño que nos tenemos.'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['decisions'] = trim($row[6]) !== '' ? substr($row[6], 0, 1) : NULL;
                $data['harmony'] = trim($row[7]) !== '' ? substr($row[7], 0, 1) : NULL;
                $data['responsibility'] = trim($row[8]) !== '' ? substr($row[8], 0, 1) : NULL;
                $data['sweetie'] = trim($row[9]) !== '' ? substr($row[9], 0, 1) : NULL;
                $data['point_blank'] = trim($row[10]) !== '' ? substr($row[10], 0, 1) : NULL;
                $data['defects'] = trim($row[11]) !== '' ? substr($row[11], 0, 1) : NULL;
                $data['experience'] = trim($row[12]) !== '' ? substr($row[12], 0, 1) : NULL;
                $data['support'] = trim($row[13]) !== '' ? substr($row[13], 0, 1) : NULL;
                $data['tasks'] = trim($row[14]) !== '' ? substr($row[14], 0, 1) : NULL;
                $data['habits'] = trim($row[15]) !== '' ? substr($row[15], 0, 1) : NULL;
                $data['converse'] = trim($row[16]) !== '' ? substr($row[16], 0, 1) : NULL;
                $data['look_help'] = trim($row[17]) !== '' ? substr($row[17], 0, 1) : NULL;
                $data['respect'] = trim($row[18]) !== '' ? substr($row[18], 0, 1) : NULL;
                $data['show_affection'] = trim($row[19]) !== '' ? substr($row[19], 0, 1) : NULL;

                
                $insert_id = saveSocioculturalData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 8:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== 'Tengo diabetes mellitus' ||
                  trim($row[7]) !== 'Suelo tener mucha sed durante el día sin importar beba agua o no' ||
                  trim($row[8]) !== 'He notado que orino más veces que las demás personas' ||
                  trim($row[9]) !== 'He perdido peso sin explicación aparente' ||
                  trim($row[10]) !== 'Considero que consumo demasiados alimentos durante todo el día' ||
                  trim($row[11]) !== 'Me he tomado los niveles de glucosa para conocerlo' ||
                  trim($row[12]) !== 'Acudo con regularidad al médico' ||
                  trim($row[13]) !== 'Tomo mi medicamento según las indicaciones del médico' ||
                  trim($row[14]) !== 'Me he sentido mal cuando me tomo mis medicamentos' ||
                  trim($row[15]) !== 'He revisado mis pies para detectar heridas o cambios en el aspecto de la piel' ||
                  trim($row[16]) !== 'He notado cambios en mi visión' ||
                  trim($row[17]) !== 'Siento que mis heridas cicatrizan muy lento' ||
                  trim($row[18]) !== 'Llevo una dieta adecuada a mi enfermedad' ||
                  trim($row[19]) !== 'He notado cambios en mi peso después de iniciado mi tratamiento' ||
                  trim($row[20]) !== '¿Dónde acudo a mis consultas de control?' ||
                  trim($row[21]) !== '¿Consumo medicina naturista?' ||
                  trim($row[22]) !== '¿Qué edad tiene?' ||
                  trim($row[23]) !== '¿Es usted hombre o mujer?' ||
                  trim($row[24]) !== 'Si es mujer, ¿tuvo alguna vez diabetes gestacional (glucosa/azúcar alta durante el embarazo)?' ||
                  trim($row[25]) !== '¿Tiene familiares (mamá, papá, hermano, hermana) que padecen diabetes?' ||
                  trim($row[26]) !== '¿Alguna vez le ha dicho un profesional de salud que tiene presión arterial alta (o hipertensión)?' ||
                  trim($row[27]) !== '¿Realiza algún tipo de actividad física?' ||
                  trim($row[28]) !== '¿Cuál es su peso? (Anote el puntaje correspondiente a su peso según la tabla a la derecha.)'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['suffer_from'] = trim($row[6]) !== '' ? (substr($row[6], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['thirsty'] = trim($row[7]) !== '' ? (substr($row[7], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['urinate'] = trim($row[8]) !== '' ? (substr($row[8], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['lose_weight'] = trim($row[9]) !== '' ? (substr($row[9], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['over_eat'] = trim($row[10]) !== '' ? (substr($row[10], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['glucose_check'] = trim($row[11]) !== '' ? (substr($row[11], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['medical_times'] = trim($row[12]) !== '' ? substr($row[12], 0, 1) : NULL;
                $data['treatment'] = trim($row[13]) !== '' ? substr($row[13], 0, 1) : NULL;
                $data['feel_bad'] = trim($row[14]) !== '' ? substr($row[14], 0, 1) : NULL;
                $data['check_foot'] = trim($row[15]) !== '' ? substr($row[15], 0, 1) : NULL;
                $data['vision_changes'] = trim($row[16]) !== '' ? substr($row[16], 0, 1) : NULL;
                $data['healing_problems'] = trim($row[17]) !== '' ? substr($row[17], 0, 1) : NULL;
                $data['proper_diet'] = trim($row[18]) !== '' ? substr($row[18], 0, 1) : NULL;
                $data['weight_changes'] = trim($row[19]) !== '' ? substr($row[19], 0, 1) : NULL;
                $data['medical_control'] = trim($row[20]) !== '' ? substr($row[20], 0, 1) : NULL;

                switch(substr($row[21], 0, 1)){
                  case 'a':
                    $data['naturist'] = '1';
                    break;
                  case 'b':
                    $data['naturist'] = '0';
                    break;
                  default:
                    $data['naturist'] = NULL;
                    break;
                }

                switch(trim($row[22])){
                  case 'Menos de 40 años (0 puntos)':
                    $data['age'] = 'a';
                    break;
                  case '40-49 años (1 punto)':
                    $data['age'] = 'b';
                    break;
                  case '50-59 años (2 puntos)':
                    $data['age'] = 'c';
                    break;
                  case '60 años o más (3 puntos)':
                    $data['age'] = 'd';
                    break;
                  default:
                    $data['age'] = NULL;
                    break;
                }

                switch(trim($row[23])){
                  case 'Mujer (0 puntos)':
                    $data['gender'] = 'a';
                    break;
                  case 'Hombre (1 punto)':
                    $data['gender'] = 'b';
                    break;
                  default:
                    $data['gender'] = NULL;
                    break;
                }

                switch(trim($row[24])){
                  case 'No (0 puntos)':
                    $data['gestational_diabetes'] = '0';
                    break;
                  case 'Si (1 punto)':
                    $data['gestational_diabetes'] = '1';
                    break;
                  default:
                    $data['gestational_diabetes'] = NULL;
                    break;
                }

                switch(trim($row[25])){
                  case 'No (0 puntos)':
                    $data['family'] = '0';
                    break;
                  case 'Si (1 punto)':
                    $data['family'] = '1';
                    break;
                  default:
                    $data['family'] = NULL;
                    break;
                }

                switch(trim($row[26])){
                  case 'No (0 puntos)':
                    $data['blood_pressure'] = '0';
                    break;
                  case 'Si (1 punto)':
                    $data['blood_pressure'] = '1';
                    break;
                  default:
                    $data['blood_pressure'] = NULL;
                    break;
                }

                switch(trim($row[27])){
                  case 'No (0 puntos)':
                    $data['physical_activity'] = '0';
                    break;
                  case 'Si (1 punto)':
                    $data['physical_activity'] = '1';
                    break;
                  default:
                    $data['physical_activity'] = NULL;
                    break;
                }

                switch(trim($row[28])){
                  case '(0 puntos)':
                    $data['weight'] = 'a';
                    break;
                  case '(1 punto)':
                    $data['weight'] = 'b';
                    break;
                  case '(2 puntos)':
                    $data['weight'] = 'c';
                    break;
                  case '(3 puntos)':
                    $data['weight'] = 'd';
                    break;
                  default:
                    $data['weight'] = NULL;
                    break;
                }
                
                $insert_id = saveDiabetesData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 9:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== 'He sufrido un ataque al corazón' ||
                  trim($row[7]) !== 'Tengo o tuve familiares directos con problemas de la presión' ||
                  trim($row[8]) !== 'Con que frecuencia consumes dos o más de las siguientes bebidas: Cerveza (33 centilitros, 5% alcohol), licor (4.5 centilitros, 40% alcohol), vino (15 centilitros, 15% alcohol), etc.' ||
                  trim($row[9]) !== 'Cuantos cigarrillos consumo durante el día' ||
                  trim($row[10]) !== 'Me he realizado estudios de sangre para saber mis niveles de colesterol y triglicéridos' ||
                  trim($row[11]) !== 'Me estreso durante el día' ||
                  trim($row[12]) !== 'Estoy pendiente de mi nutrición y peso corporal' ||
                  trim($row[13]) !== 'Camino, corro o realizo algún otro ejercicio por más de 20min al día' ||
                  trim($row[14]) !== 'Acudo a consulta con el médico para saber mis niveles de presión arterial' ||
                  trim($row[15]) !== 'He notado zumbido en los oídos' ||
                  trim($row[16]) !== 'Noto destellos de luz al mirar a mi alrededor' ||
                  trim($row[17]) !== 'Últimamente tengo dolores de cabeza constantes' ||
                  trim($row[18]) !== 'Suelo medir mi presión arterial por las mañanas o por las tardes' ||
                  trim($row[19]) !== 'He sentido dolor en mi pecho (Agitación, sensación de presión, dificultad para respirar)' ||
                  trim($row[20]) !== 'Cuando subo o bajo escaleras me cuesta trabajo respirar' ||
                  trim($row[21]) !== 'Tengo dificultades para recordar cosas' ||
                  trim($row[22]) !== 'Me realizo exámenes de sangre para ver el estado de mis riñones' ||
                  trim($row[23]) !== 'Me he realizado una evaluación de mi vista' ||
                  trim($row[24]) !== 'Acudo con regularidad al médico' ||
                  trim($row[25]) !== 'Tomo mi medicamento según las indicaciones del médico' ||
                  trim($row[26]) !== 'Llevo una dieta adecuada a mi enfermedad' ||
                  trim($row[27]) !== '¿Dónde acudo a mis consultas de control?'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['heart_attack'] = trim($row[6]) !== '' ? (substr($row[6], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['family'] = trim($row[7]) !== '' ? (substr($row[7], 0, 1) == 'a' ? '1' : NULL ) : NULL;
                $data['alcoholic_drinks'] = trim($row[8]) !== '' ? substr($row[8], 0, 1) : NULL;
                $data['smoke'] = trim($row[9]) !== '' ? substr($row[9], 0, 1) : NULL;
                $data['blood_test'] = trim($row[10]) !== '' ? substr($row[10], 0, 1) : NULL;
                $data['stress'] = trim($row[11]) !== '' ? substr($row[11], 0, 1) : NULL;
                $data['nutrition'] = trim($row[12]) !== '' ? substr($row[12], 0, 1) : NULL;
                $data['physical_activity'] = trim($row[13]) !== '' ? substr($row[13], 0, 1) : NULL;
                $data['medical_consult'] = trim($row[14]) !== '' ? substr($row[14], 0, 1) : NULL;
                $data['ringing_ears'] = trim($row[15]) !== '' ? substr($row[15], 0, 1) : NULL;
                $data['flashes'] = trim($row[16]) !== '' ? substr($row[16], 0, 1) : NULL;
                $data['headache'] = trim($row[17]) !== '' ? substr($row[17], 0, 1) : NULL;
                $data['pression_check'] = trim($row[18]) !== '' ? substr($row[18], 0, 1) : NULL;
                $data['chest_pain'] = trim($row[19]) !== '' ? substr($row[19], 0, 1) : NULL;
                $data['difficulty_breathing'] = trim($row[20]) !== '' ? substr($row[20], 0, 1) : NULL;
                $data['forget_things'] = trim($row[21]) !== '' ? substr($row[21], 0, 1) : NULL;
                $data['kidney_test'] = trim($row[22]) !== '' ? substr($row[22], 0, 1) : NULL;
                $data['vision_test'] = trim($row[23]) !== '' ? substr($row[23], 0, 1) : NULL;
                $data['medical_visit'] = trim($row[24]) !== '' ? substr($row[24], 0, 1) : NULL;
                $data['treatment'] = trim($row[25]) !== '' ? substr($row[25], 0, 1) : NULL;
                $data['diet'] = trim($row[26]) !== '' ? substr($row[26], 0, 1) : NULL;
                $data['medical_place'] = trim($row[27]) !== '' ? substr($row[27], 0, 1) : NULL;
                
                $insert_id = saveHypertensionData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 10:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== 'A cuentas consultas acudió durante su control prenatal.' ||
                  trim($row[7]) !== 'Presento alguna complicación durante su embarazo' ||
                  trim($row[8]) !== 'Tipo de resolución del embarazo' ||
                  trim($row[9]) !== 'Mencione el motivo de la cesárea' ||
                  trim($row[10]) !== 'Cuanto duro su embarazo' ||
                  trim($row[11]) !== 'Cual fue el peso de su hijo al nacer en gramos' ||
                  trim($row[12]) !== 'Que tipo de lactancia tuvo su bebe' ||
                  trim($row[13]) !== 'Menciona la fórmula' ||
                  trim($row[14]) !== 'En caso de lactancia materna exclusiva, cuanto tiempo duro la etapa' ||
                  trim($row[15]) !== 'En caso de presentar alergia seleccione y especifique cual' ||
                  trim($row[16]) !== 'Se realizó tamiz neonatal' ||
                  trim($row[17]) !== 'Mencione el resultado' ||
                  trim($row[18]) !== '1 MES' ||
                  trim($row[20]) !== '2 MESES' ||
                  trim($row[22]) !== '3 MESES' ||
                  trim($row[23]) !== '4 MESES' ||
                  trim($row[24]) !== '5 MESES' ||
                  trim($row[25]) !== '6 MESES' ||
                  trim($row[27]) !== '7 MESES' ||
                  trim($row[29]) !== '8 MESES' ||
                  trim($row[30]) !== '9 MESES' ||
                  trim($row[31]) !== '10 MESES' ||
                  trim($row[32]) !== '11 MESES' ||
                  trim($row[33]) !== '12 MESES'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['consultations'] = trim($row[6]) !== '' ? substr($row[6], 0, 1) : NULL;
                $data['pregnancy_complication'] = trim($row[7]) !== '' ? substr($row[7], 0, 1) : NULL;
                $data['pregnancy_resolution'] = trim($row[8]) !== '' ? substr($row[8], 0, 1) : NULL;
                $data['pregnancy_resolution_desc'] = trim($row[9]) !== '' ? $row[9] : NULL;
                $data['pregnancy_duration'] = trim($row[10]) !== '' ? substr($row[10], 0, 1) : NULL;
                $data['baby_weight'] = trim($row[11]) !== '' ? substr($row[11], 0, 1) : NULL;
                $data['lactation_type'] = trim($row[12]) !== '' ? substr($row[12], 0, 1) : NULL;
                $data['lactation_desc'] = trim($row[13]) !== '' ? $row[13] : NULL;
                $data['lactation_duration'] = trim($row[14]) !== '' ? substr($row[14], 0, 1) : NULL;
                $data['baby_allergy'] = trim($row[15]) !== '' ? substr($row[15], 0, 1) : NULL;
                $data['tamiz_neonatal'] = trim($row[16]) !== '' ? substr($row[16], 0, 1) : NULL;
                $data['tamiz_neonatal_desc'] = trim($row[17]) !== '' ? $row[17] : NULL;
                $data['table_one'] = trim($row[18]) !== '' ? substr($row[18], 0, 1) : NULL;
                $data['table_two'] = trim($row[19]) !== '' ? substr($row[19], 0, 1) : NULL;
                $data['table_three'] = trim($row[20]) !== '' ? substr($row[20], 0, 1) : NULL;
                $data['table_four'] = trim($row[21]) !== '' ? substr($row[21], 0, 1) : NULL;
                $data['table_five'] = trim($row[22]) !== '' ? substr($row[22], 0, 1) : NULL;
                $data['table_six'] = trim($row[23]) !== '' ? substr($row[23], 0, 1) : NULL;
                $data['table_seven'] = trim($row[24]) !== '' ? substr($row[24], 0, 1) : NULL;
                $data['table_eight'] = trim($row[25]) !== '' ? substr($row[25], 0, 1) : NULL;
                $data['table_nine'] = trim($row[26]) !== '' ? substr($row[26], 0, 1) : NULL;
                $data['table_ten'] = trim($row[27]) !== '' ? substr($row[27], 0, 1) : NULL;
                $data['table_eleven'] = trim($row[28]) !== '' ? substr($row[28], 0, 1) : NULL;
                $data['table_twelve'] = trim($row[29]) !== '' ? substr($row[29], 0, 1) : NULL;
                $data['table_thirteen'] = trim($row[30]) !== '' ? substr($row[30], 0, 1) : NULL;
                $data['table_fourteen'] = trim($row[31]) !== '' ? substr($row[31], 0, 1) : NULL;
                $data['table_fifteen'] = trim($row[32]) !== '' ? substr($row[32], 0, 1) : NULL;
                $data['table_sixteen'] = trim($row[33]) !== '' ? substr($row[33], 0, 1) : NULL;
                
                $insert_id = saveBornLifestyleData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 11:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== '¿Normalmente a la semana, el niño consume algún alimento al levantarse?' ||
                  trim($row[7]) !== '¿A la semana, con qué frecuencia consume alimentos como embutidos, enlatados y refrigerados?' ||
                  trim($row[8]) !== 'El número de veces que consume alimentos al día:' ||
                  trim($row[9]) !== 'Frecuentemente consume alimentos hechos fuera de casa' ||
                  trim($row[10]) !== 'Durante las comidas en casa acostumbra a consumir alimentos fritos (Antojitos)' ||
                  trim($row[11]) !== 'Respeta el horario establecido para las comidas' ||
                  trim($row[12]) !== 'Considero que la dieta del niño es balanceada' ||
                  trim($row[20]) !== 'El niño realiza actividades físicas de recreo como caminar, nadar, jugar futbol o ciclismo de 20 a 30min en la semana' ||
                  trim($row[21]) !== 'La frecuencia con la que hace actividad física a la semana' ||
                  trim($row[22]) !== 'Le interesa el deporte y es un niño activo' ||
                  trim($row[23]) !== 'El número de veces que acudo a servicios médicos para valoración del niño' ||
                  trim($row[24]) !== 'Reviso físicamente al niño en busca de cambios en su cuerpo' ||
                  trim($row[25]) !== 'Le realizo exámenes médicos de rutina (biometría hemática, examen general de orina, entre otros)' ||
                  trim($row[26]) !== 'Acudo a servicios con el dentista para valoración de salud bucal en el niño' ||
                  trim($row[27]) !== '¿Has acudido con él a consulta con psicología?' ||
                  trim($row[28]) !== '¿Y nutrición?' ||
                  trim($row[29]) !== 'Cuando se enferma, yo le doy tratamiento previo a la visita del médico' ||
                  trim($row[30]) !== 'Durante el último año ¿el niño se enfermó?' ||
                  trim($row[31]) !== 'Busco información confiable sobre cuidados de la salud infantil (Revistas, programas de salud, conferencias o exposiciones)' ||
                  trim($row[32]) !== 'Le pregunto a otro médico u otra opción cuando no estoy de acuerdo con el' ||
                  trim($row[33]) !== 'El niño ríe y habla con un timbre de voz alto' ||
                  trim($row[34]) !== 'El niño es callado o retraído la mayoría de las veces' ||
                  trim($row[35]) !== 'Tiene dificultad para relacionarse con las demás personas' ||
                  trim($row[36]) !== 'Llora ante cualquier estimulo externo' ||
                  trim($row[37]) !== 'Prefiere estar solo' ||
                  trim($row[38]) !== 'El número de veces que se baña al día el niño' ||
                  trim($row[39]) !== 'Acostumbra a lavarse las manos antes de comer o después de ir al baño' ||
                  trim($row[40]) !== 'La frecuencia con la que se lava los dientes es' ||
                  trim($row[41]) !== 'Hace uso de hilo dental bajo la supervisión de un adulto' ||
                  trim($row[42]) !== 'El niño cambia de ropa interior diario' ||
                  trim($row[43]) !== 'En el ultimo mes, le he cortado las uñas de las manos y de los pies al niño' ||
                  trim($row[44]) !== 'Las toallas que el niño ocupa son limpias cada vez que se baña' ||
                  trim($row[45]) !== 'Tiene diagnóstico de algún trastorno de aprendizaje o desarrollo' ||
                  trim($row[46]) !== 'Presenta adecuado rendimiento escolar' ||
                  trim($row[47]) !== 'Se relaciona con sus compañeros' ||
                  trim($row[48]) !== '¿Ha notado si se cae mucho al caminar o correr?' ||
                  trim($row[49]) !== '¿Ha presentado problemas de visión?' ||
                  trim($row[50]) !== '¿Se acerca mucho al televisor y/o al cuaderno?' ||
                  trim($row[51]) !== 'Presenta dolor de cabeza al realizar sus tareas y/o estímulos visuales' ||
                  trim($row[52]) !== 'Se le dificulta retener información' ||
                  trim($row[53]) !== 'Frecuentemente se le dificulta quedarse quieto' ||
                  trim($row[54]) !== 'Se le dificulta pronunciar algunas palabras' ||
                  trim($row[55]) !== 'Invierte letras o números similares (7 F, P 9, d b, etc.)' ||
                  trim($row[56]) !== 'Frecuentemente deja actividades inconclusas' ||
                  trim($row[57]) !== 'Frecuentemente se le dificulta seguir órdenes'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['wake_food'] = trim($row[6]) !== '' ? substr($row[6], 0, 1) : NULL;
                $data['sausages'] = trim($row[7]) !== '' ? substr($row[7], 0, 1) : NULL;
                $data['food_times'] = trim($row[8]) !== '' ? substr($row[8], 0, 1) : NULL;
                $data['fast_food'] = trim($row[9]) !== '' ? substr($row[9], 0, 1) : NULL;
                $data['fatty_food'] = trim($row[10]) !== '' ? substr($row[10], 0, 1) : NULL;
                $data['mealtime'] = trim($row[11]) !== '' ? substr($row[11], 0, 1) : NULL;
                $data['balanced_diet'] = trim($row[12]) !== '' ? substr($row[12], 0, 1) : NULL;
                $data['dairy_products'] = trim($row[13]) !== '' ? $row[13] : NULL;
                $data['meats'] = trim($row[14]) !== '' ? $row[14] : NULL;
                $data['tubers'] = trim($row[15]) !== '' ? $row[15] : NULL;
                $data['vegetables'] = trim($row[16]) !== '' ? $row[16] : NULL;
                $data['fruits'] = trim($row[17]) !== '' ? $row[17] : NULL;
                $data['cereals'] = trim($row[18]) !== '' ? $row[18] : NULL;
                $data['snacks'] = trim($row[19]) !== '' ? $row[19] : NULL;
                $data['exercise'] = trim($row[20]) !== '' ? substr($row[20], 0, 1) : NULL;
                $data['exercise_times'] = trim($row[21]) !== '' ? substr($row[21], 0, 1) : NULL;
                $data['sport_active'] = trim($row[22]) !== '' ? substr($row[22], 0, 1) : NULL;
                $data['medical_times'] = trim($row[23]) !== '' ? substr($row[23], 0, 1) : NULL;
                $data['kid_review'] = trim($row[24]) !== '' ? substr($row[24], 0, 1) : NULL;
                $data['medical_exams'] = trim($row[25]) !== '' ? substr($row[25], 0, 1) : NULL;
                $data['dentist'] = trim($row[26]) !== '' ? substr($row[26], 0, 1) : NULL;
                $data['psychology'] = trim($row[27]) !== '' ? substr($row[27], 0, 1) : NULL;
                $data['nutrition'] = trim($row[28]) !== '' ? substr($row[28], 0, 1) : NULL;
                $data['previous_treatment'] = trim($row[29]) !== '' ? substr($row[29], 0, 1) : NULL;
                $data['diseases'] = trim($row[30]) !== '' ? substr($row[30], 0, 1) : NULL;
                $data['childcare'] = trim($row[31]) !== '' ? substr($row[31], 0, 1) : NULL;
                $data['second_opinion'] = trim($row[32]) !== '' ? substr($row[32], 0, 1) : NULL;
                $data['restless'] = trim($row[33]) !== '' ? substr($row[33], 0, 1) : NULL;
                $data['quiet'] = trim($row[34]) !== '' ? substr($row[34], 0, 1) : NULL;
                $data['difficulty_relating'] = trim($row[35]) !== '' ? substr($row[35], 0, 1) : NULL;
                $data['weeping'] = trim($row[36]) !== '' ? substr($row[36], 0, 1) : NULL;
                $data['alone_prefer'] = trim($row[37]) !== '' ? substr($row[37], 0, 1) : NULL;
                $data['bath_times'] = trim($row[38]) !== '' ? substr($row[38], 0, 1) : NULL;
                $data['handwashing'] = trim($row[39]) !== '' ? substr($row[39], 0, 1) : NULL;
                $data['brush_teeth'] = trim($row[40]) !== '' ? substr($row[40], 0, 1) : NULL;
                $data['floss_use'] = trim($row[41]) !== '' ? substr($row[41], 0, 1) : NULL;
                $data['underwear'] = trim($row[42]) !== '' ? substr($row[42], 0, 1) : NULL;
                $data['nails_cut'] = trim($row[43]) !== '' ? substr($row[43], 0, 1) : NULL;
                $data['bath_towel'] = trim($row[44]) !== '' ? substr($row[44], 0, 1) : NULL;
                $data['diagnostic_disorder'] = trim($row[45]) !== '' ? substr($row[45], 0, 1) : NULL;
                $data['school_perform'] = trim($row[46]) !== '' ? substr($row[46], 0, 1) : NULL;
                $data['relates'] = trim($row[47]) !== '' ? substr($row[47], 0, 1) : NULL;
                $data['stumbles'] = trim($row[48]) !== '' ? substr($row[48], 0, 1) : NULL;
                $data['vision_problems'] = trim($row[49]) !== '' ? substr($row[49], 0, 1) : NULL;
                $data['approximate'] = trim($row[50]) !== '' ? substr($row[50], 0, 1) : NULL;
                $data['headache'] = trim($row[51]) !== '' ? substr($row[51], 0, 1) : NULL;
                $data['difficult_learn'] = trim($row[52]) !== '' ? substr($row[52], 0, 1) : NULL;
                $data['frequent_restless'] = trim($row[53]) !== '' ? substr($row[53], 0, 1) : NULL;
                $data['difficult_pronounce'] = trim($row[54]) !== '' ? substr($row[54], 0, 1) : NULL;
                $data['letter_invert'] = trim($row[55]) !== '' ? substr($row[55], 0, 1) : NULL;
                $data['unfinished_activities'] = trim($row[56]) !== '' ? substr($row[56], 0, 1) : NULL;
                $data['naughty'] = trim($row[57]) !== '' ? substr($row[57], 0, 1) : NULL;
                
                $insert_id = saveChildLifestyleData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 12:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== '¿Normalmente a la semana, consumo algún alimento al levantarme?' ||
                  trim($row[7]) !== '¿Normalmente a la semana con qué frecuencia consumo alimentos con conservadores artificiales?' ||
                  trim($row[8]) !== 'El número de veces que consumo alimentos al día:' ||
                  trim($row[9]) !== 'Frecuentemente consumo alimentos hechos fuera de casa' ||
                  trim($row[10]) !== 'Durante las comidas en casa acostumbro consumir alimentos fritos (Antojitos)' ||
                  trim($row[11]) !== 'Respeto el horario establecido para las comidas' ||
                  trim($row[12]) !== 'Continúo comiendo después de quedar satisfecho' ||
                  trim($row[13]) !== 'Considero que mi dieta es balanceada' ||
                  trim($row[14]) !== 'Como para sentirme bien o tranquilizarme' ||
                  trim($row[15]) !== 'Cuando compro alimentos reviso las etiquetas en los alimentos para conocer sus ingredientes' ||
                  trim($row[16]) !== 'ALIMENTACIÓN. Ordena en orden de frecuencia los grupos alimenticios en su dieta del 1 al 7 en los recuadros.' ||
                  trim($row[23]) !== 'Realizo actividades físicas de recreo como caminar, nadar, jugar futbol o ciclismo de 20 a 30min en la semana' ||
                  trim($row[24]) !== 'La frecuencia con la que hago actividad física a la semana' ||
                  trim($row[25]) !== 'Si realizas ejercicio, consideras que el tiempo invertido es el suficiente' ||
                  trim($row[26]) !== 'El número de veces que acudo a servicios médicos' ||
                  trim($row[27]) !== 'Autoexploro físicamente mi cuerpo para detectar cambios' ||
                  trim($row[28]) !== 'Me realizo exámenes médicos de rutina (biometría hemática, examen general de orina, química sanguínea, perfil de lípidos, entre otros)' ||
                  trim($row[29]) !== '¿Con que frecuencia te checas la presión arterial?' ||
                  trim($row[30]) !== 'Acudo a servicios con el dentista' ||
                  trim($row[31]) !== '¿Has acudido a consulta con psicología?' ||
                  trim($row[32]) !== '¿Y nutrición?' ||
                  trim($row[33]) !== 'Cuando me enfermo me automedico' ||
                  trim($row[34]) !== 'Durante el último año ¿usted se enfermó?' ||
                  trim($row[35]) !== 'Busco información confiable sobre cuidados de la salud (Revistas, programas de salud, conferencias o exposiciones)' ||
                  trim($row[36]) !== 'Le pregunto a otro médico u otra opción cuando no estoy de acuerdo con el' ||
                  trim($row[37]) !== 'Me tomo mi tiempo para relajarme' ||
                  trim($row[38]) !== 'Soy consciente de las causas que me producen estrés o ansiedad' ||
                  trim($row[39]) !== 'Durante el día siento que el estrés afecta mis actividades cotidianas' ||
                  trim($row[40]) !== 'Utilizo técnicas o métodos para controlar el estrés' ||
                  trim($row[41]) !== 'Tengo una persona con quien me siento en confianza para hablar' ||
                  trim($row[42]) !== 'Me siento solo a pesar de estar acompañado' ||
                  trim($row[43]) !== 'Tengo dificultad para relacionarme con las demás personas' ||
                  trim($row[44]) !== 'Critico a los demás por sus éxitos' ||
                  trim($row[45]) !== 'Evito dar opiniones por temor al rechazo, burlo o que otras personas me ignoren' ||
                  trim($row[46]) !== 'Me gusta expresar afecto a personas cercanas a mi' ||
                  trim($row[47]) !== 'Me gusta recibir muestras de afecto de personas cercanas a mi' ||
                  trim($row[48]) !== 'Prefiero trabajar solo' ||
                  trim($row[49]) !== 'Me quiero a mí mismo' ||
                  trim($row[50]) !== 'Considero que mi vida tiene un propósito' ||
                  trim($row[51]) !== 'Soy entusiasta y optimista sobre aspectos de mi vida' ||
                  trim($row[52]) !== 'Tengo metas a largo plazo' ||
                  trim($row[53]) !== 'Soy realista en las metas que me propongo' ||
                  trim($row[54]) !== 'En el último año, considero que he cumplido mis metas' ||
                  trim($row[55]) !== 'Soy consciente de mis capacidades y debilidades personales' ||
                  trim($row[56]) !== 'Considero que mis errores me han hecho crecer como persona' ||
                  trim($row[57]) !== 'Durante la semana dedico tiempo a actividades de recreación' ||
                  trim($row[58]) !== 'Cuando decides quedarte en casa a escuchar música, ver televisión o jugar videojuegos, ¿Cuántas horas al día le dedica a estas actividades?' ||
                  trim($row[59]) !== 'Durante la semana consumo alcohol (Cerveza, licor, vino, vodka)' ||
                  trim($row[60]) !== 'Durante la semana consumo tabaco (Cigarro, pipa, masticable, cigarro electrónico)' ||
                  trim($row[61]) !== 'Durante la semana dedico tiempo para realizar actividades recreativas con la familia' ||
                  trim($row[62]) !== 'En el último mes, duermo por lo regular' ||
                  trim($row[63]) !== 'En el último mes, tengo problemas para dormir dentro de la primera hora después de acostarme' ||
                  trim($row[64]) !== 'En el último mes, me despierto durante la noche o madrugada' ||
                  trim($row[65]) !== 'En el último mes, me siento cansado o somnoliento durante el día' ||
                  trim($row[66]) !== 'En el último mes, me he despertado durante la noche por no poder respirar bien' ||
                  trim($row[67]) !== 'En el último mes, me han dicho que toso o ronco intensamente mientras duermo' ||
                  trim($row[68]) !== 'En el último mes, he tenido pesadillas o "malos sueños"' ||
                  trim($row[69]) !== 'En el último mes, por la noche siento que mis propios pensamientos no me dejan dormir' ||
                  trim($row[70]) !== 'En el último mes, tomo medicamentos u otras sustancias o remedios para poder dormir' ||
                  trim($row[71]) !== 'Consumo café, bebidas energéticas, tabaco o hago ejercicio después de las 19:00 (7pm) horas' ||
                  trim($row[72]) !== 'El número de veces que me baño al día' ||
                  trim($row[73]) !== 'Acostumbro lavarme las manos antes de comer o después de ir al baño' ||
                  trim($row[74]) !== 'La frecuencia con la que me lavo los dientes es' ||
                  trim($row[75]) !== 'Hago uso de hilo dental' ||
                  trim($row[76]) !== 'Cambio el cepillo de dientes que uso' ||
                  trim($row[77]) !== 'Acostumbro a usar desodorante natural y/o artificial' ||
                  trim($row[78]) !== 'Tiendo a cambiar mi ropa interior' ||
                  trim($row[79]) !== 'En el ultimo mes, me he cortado las uñas de las manos y de los pies' ||
                  trim($row[80]) !== 'Cambio regularmente la toalla que uso'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['wake_food'] = trim($row[6]) !== '' ? substr($row[6], 0, 1) : NULL;
                $data['chemical_food'] = trim($row[7]) !== '' ? substr($row[7], 0, 1) : NULL;
                $data['food_times'] = trim($row[8]) !== '' ? substr($row[8], 0, 1) : NULL;
                $data['fast_food'] = trim($row[9]) !== '' ? substr($row[9], 0, 1) : NULL;
                $data['fatty_food'] = trim($row[10]) !== '' ? substr($row[10], 0, 1) : NULL;
                $data['mealtime'] = trim($row[11]) !== '' ? substr($row[11], 0, 1) : NULL;
                $data['overeat'] = trim($row[12]) !== '' ? substr($row[12], 0, 1) : NULL;
                $data['balanced_diet'] = trim($row[13]) !== '' ? substr($row[13], 0, 1) : NULL;
                $data['eat_pleasure'] = trim($row[14]) !== '' ? substr($row[14], 0, 1) : NULL;
                $data['check_labels'] = trim($row[15]) !== '' ? substr($row[15], 0, 1) : NULL;
                $data['dairy_products'] = trim($row[16]) !== '' ? $row[16] : NULL;
                $data['meats'] = trim($row[17]) !== '' ? $row[17] : NULL;
                $data['tubers'] = trim($row[18]) !== '' ? $row[18] : NULL;
                $data['vegetables'] = trim($row[19]) !== '' ? $row[19] : NULL;
                $data['fruits'] = trim($row[20]) !== '' ? $row[20] : NULL;
                $data['cereals'] = trim($row[21]) !== '' ? $row[21] : NULL;
                $data['snacks'] = trim($row[22]) !== '' ? $row[22] : NULL;
                $data['exercise'] = trim($row[23]) !== '' ? substr($row[23], 0, 1) : NULL;
                $data['exercise_times'] = trim($row[24]) !== '' ? substr($row[24], 0, 1) : NULL;
                $data['sport_active'] = trim($row[25]) !== '' ? substr($row[25], 0, 1) : NULL;
                $data['medical_times'] = trim($row[26]) !== '' ? substr($row[26], 0, 1) : NULL;
                $data['body_explore'] = trim($row[27]) !== '' ? substr($row[27], 0, 1) : NULL;
                $data['medical_exams'] = trim($row[28]) !== '' ? substr($row[28], 0, 1) : NULL;
                $data['blood_pressure'] = trim($row[29]) !== '' ? substr($row[29], 0, 1) : NULL;
                $data['dentist'] = trim($row[30]) !== '' ? substr($row[30], 0, 1) : NULL;
                $data['psychology'] = trim($row[31]) !== '' ? substr($row[31], 0, 1) : NULL;
                $data['nutrition '] = trim($row[32]) !== '' ? substr($row[32], 0, 1) : NULL;
                $data['self_medicate'] = trim($row[33]) !== '' ? substr($row[33], 0, 1) : NULL;
                $data['diseases'] = trim($row[34]) !== '' ? substr($row[34], 0, 1) : NULL;
                $data['search_information'] = trim($row[35]) !== '' ? substr($row[35], 0, 1) : NULL;
                $data['second_opinion'] = trim($row[36]) !== '' ? substr($row[36], 0, 1) : NULL;
                $data['relax_time'] = trim($row[37]) !== '' ? substr($row[37], 0, 1) : NULL;
                $data['stress_causes'] = trim($row[38]) !== '' ? substr($row[38], 0, 1) : NULL;
                $data['stress_impact'] = trim($row[39]) !== '' ? substr($row[39], 0, 1) : NULL;
                $data['stress_control_methods'] = trim($row[40]) !== '' ? substr($row[40], 0, 1) : NULL;
                $data['confident'] = trim($row[41]) !== '' ? substr($row[41], 0, 1) : NULL;
                $data['feeling_alone'] = trim($row[42]) !== '' ? substr($row[42], 0, 1) : NULL;
                $data['difficulty_relating'] = trim($row[43]) !== '' ? substr($row[43], 0, 1) : NULL;
                $data['criticize'] = trim($row[44]) !== '' ? substr($row[44], 0, 1) : NULL;
                $data['no_opinion'] = trim($row[45]) !== '' ? substr($row[45], 0, 1) : NULL;
                $data['tofeel_affection'] = trim($row[46]) !== '' ? substr($row[46], 0, 1) : NULL;
                $data['affection_taste'] = trim($row[47]) !== '' ? substr($row[47], 0, 1) : NULL;
                $data['alone_prefer'] = trim($row[48]) !== '' ? substr($row[48], 0, 1) : NULL;
                $data['love_me'] = trim($row[49]) !== '' ? substr($row[49], 0, 1) : NULL;
                $data['purpose_life'] = trim($row[50]) !== '' ? substr($row[50], 0, 1) : NULL;
                $data['enthusiast'] = trim($row[51]) !== '' ? substr($row[51], 0, 1) : NULL;
                $data['long_term_goals'] = trim($row[52]) !== '' ? substr($row[52], 0, 1) : NULL;
                $data['realistic_goals'] = trim($row[53]) !== '' ? substr($row[53], 0, 1) : NULL;
                $data['fulfilled_goals'] = trim($row[54]) !== '' ? substr($row[54], 0, 1) : NULL;
                $data['capacity_debility'] = trim($row[55]) !== '' ? substr($row[55], 0, 1) : NULL;
                $data['mistakes'] = trim($row[56]) !== '' ? substr($row[56], 0, 1) : NULL;
                $data['recreation'] = trim($row[57]) !== '' ? substr($row[57], 0, 1) : NULL;
                $data['entertainment_time'] = trim($row[58]) !== '' ? substr($row[58], 0, 1) : NULL;
                $data['alcohol'] = trim($row[59]) !== '' ? substr($row[59], 0, 1) : NULL;
                $data['cigar'] = trim($row[60]) !== '' ? substr($row[60], 0, 1) : NULL;
                $data['recreational_activities'] = trim($row[61]) !== '' ? substr($row[61], 0, 1) : NULL;
                $data['time_sleep'] = trim($row[62]) !== '' ? substr($row[62], 0, 1) : NULL;
                $data['insomnia'] = trim($row[63]) !== '' ? substr($row[63], 0, 1) : NULL;
                $data['wake_midnight'] = trim($row[64]) !== '' ? substr($row[64], 0, 1) : NULL;
                $data['drowsiness'] = trim($row[65]) !== '' ? substr($row[65], 0, 1) : NULL;
                $data['shortness_breath'] = trim($row[66]) !== '' ? substr($row[66], 0, 1) : NULL;
                $data['cough_snore'] = trim($row[67]) !== '' ? substr($row[67], 0, 1) : NULL;
                $data['nightmare'] = trim($row[68]) !== '' ? substr($row[68], 0, 1) : NULL;
                $data['thoughts'] = trim($row[69]) !== '' ? substr($row[69], 0, 1) : NULL;
                $data['sleeping_pills'] = trim($row[70]) !== '' ? substr($row[70], 0, 1) : NULL;
                $data['energy_drink'] = trim($row[71]) !== '' ? substr($row[71], 0, 1) : NULL;
                $data['bath_times'] = trim($row[72]) !== '' ? substr($row[72], 0, 1) : NULL;
                $data['handwashing'] = trim($row[73]) !== '' ? substr($row[73], 0, 1) : NULL;
                $data['brush_teeth'] = trim($row[74]) !== '' ? substr($row[74], 0, 1) : NULL;
                $data['floss_use'] = trim($row[75]) !== '' ? substr($row[75], 0, 1) : NULL;
                $data['toothbrush'] = trim($row[76]) !== '' ? substr($row[76], 0, 1) : NULL;
                $data['deodorant'] = trim($row[77]) !== '' ? substr($row[77], 0, 1) : NULL;
                $data['underwear'] = trim($row[78]) !== '' ? substr($row[78], 0, 1) : NULL;
                $data['nails_cut'] = trim($row[79]) !== '' ? substr($row[79], 0, 1) : NULL;
                $data['bath_towel'] = trim($row[80]) !== '' ? substr($row[80], 0, 1) : NULL;
                
                $insert_id = saveYoungLifestyleData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 13:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== '¿A la semana, el niño cuantas veces consume algún alimento al levantarse?' ||
                  trim($row[7]) !== '¿A la semana, cuantas veces consume alimentos con conservadores artificiales?' ||
                  trim($row[8]) !== 'El número de veces que consume alimentos al día:' ||
                  trim($row[9]) !== 'A la semana el niño, ¿cuantas veces come fuera de casa?' ||
                  trim($row[10]) !== '¿Durante las comidas en casa el niño acostumbra a consumir alimentos fritos?' ||
                  trim($row[11]) !== 'Respetan el horario establecido para las comidas?' ||
                  trim($row[12]) !== '¿El niño continua comiendo después de quedar satisfecho?' ||
                  trim($row[13]) !== '¿Considero que la dieta del niño es balanceada?' ||
                  trim($row[14]) !== 'A la semana, ¿cuantas veces consume frutas y verduras?' ||
                  trim($row[15]) !== 'la semana, ¿cuantas veces consume carnes (pollo, cerdo, res)' ||
                  trim($row[16]) !== 'ALIMENTACIÓN. Ordena en orden de frecuencia los grupos alimenticios en la dieta del niño del 1 al 7 en los recuadros, donde 1 sea el grupo más frecuente y 7 sea el grupo menos frecuente' ||
                  trim($row[23]) !== '¿Acudió a estimulación temprana?' ||
                  trim($row[24]) !== 'A la semana, ¿Realiza alguna actividad física con duración mínima de 20 a 30 min?' ||
                  trim($row[25]) !== 'A la semana, ¿Cuántas veces realiza actividad física?' ||
                  trim($row[26]) !== 'Si realiza ejercicio, consideras que el tiempo invertido es el suficiente' ||
                  trim($row[27]) !== 'Número de veces que acudo a servicios médicos con el niño:' ||
                  trim($row[28]) !== '¿Exploro fisicamente al niño para detectar cambios?' ||
                  trim($row[29]) !== 'Le realizo exámenes médicos de rutina para saber como esta de salud  (biometría hemática, exámen general de orina, entre otros)' ||
                  trim($row[30]) !== 'Acudo al servico de Odontologia con el niño para limpieza o algun otro tratamiento?' ||
                  trim($row[31]) !== '¿Has acudido alguna vez a consulta de nutrición con el?' ||
                  trim($row[32]) !== '¿Has acudido alguna vez a consulta de psicología con el?' ||
                  trim($row[33]) !== '¿Cuando se enferma el niño yo le doy medicamentos?' ||
                  trim($row[34]) !== 'Durante el último año ¿El niño se enfermó…?' ||
                  trim($row[35]) !== 'Busco información confiable sobre cuidados de la salud del niño (Revistas, programas de salud, conferencias o exposiciones)' ||
                  trim($row[36]) !== 'Le pregunto  a otro médico u otra opción cuando no estoy de acuerdo con el' ||
                  trim($row[37]) !== 'Cuando algo le preocupa al niño, abiertamente el expresa lo que siente?' ||
                  trim($row[38]) !== 'El niño habla y ríe fuertemente' ||
                  trim($row[39]) !== 'El niño juega con otros niños' ||
                  trim($row[40]) !== 'El niño es retraido' ||
                  trim($row[41]) !== 'Le gusta compartir con su familia' ||
                  trim($row[42]) !== 'Suele estas de mal humor' ||
                  trim($row[43]) !== 'Prefiere trabajar solo en las actividades escolares (si aplica)' ||
                  trim($row[44]) !== '1 AÑO' ||
                  trim($row[47]) !== '2 AÑOS' ||
                  trim($row[52]) !== '3 AÑOS' ||
                  trim($row[56]) !== '4 AÑOS' ||
                  trim($row[67]) !== 'El número de veces que el niño recibe baño al día' ||
                  trim($row[68]) !== 'Acostumbro lavarle las manos antes de comer o después de ir al baño' ||
                  trim($row[69]) !== 'La frecuencia con la que le lavo los dientes es' ||
                  trim($row[70]) !== 'Haco uso de hilo dental' ||
                  trim($row[71]) !== '¿Hago el cambio del cepillo de dientes del niño cada 6 meses?' ||
                  trim($row[72]) !== '¿Cambio regularmente la toalla que usa el niño?'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['wake_food'] = trim($row[6]) !== '' ? substr($row[6], 0, 1) : NULL;
                $data['chemical_food'] = trim($row[7]) !== '' ? substr($row[7], 0, 1) : NULL;
                $data['food_times'] = trim($row[8]) !== '' ? substr($row[8], 0, 1) : NULL;
                $data['fast_food'] = trim($row[9]) !== '' ? substr($row[9], 0, 1) : NULL;
                $data['fatty_food'] = trim($row[10]) !== '' ? substr($row[10], 0, 1) : NULL;
                $data['mealtime'] = trim($row[11]) !== '' ? substr($row[11], 0, 1) : NULL;
                $data['overeat'] = trim($row[12]) !== '' ? substr($row[12], 0, 1) : NULL;
                $data['balanced_diet'] = trim($row[13]) !== '' ? substr($row[13], 0, 1) : NULL;
                $data['fruit_diet'] = trim($row[14]) !== '' ? substr($row[14], 0, 1) : NULL;
                $data['meat_diet'] = trim($row[15]) !== '' ? substr($row[15], 0, 1) : NULL;
                $data['dairy_products'] = trim($row[16]) !== '' ? $row[16] : NULL;
                $data['meats'] = trim($row[17]) !== '' ? $row[17] : NULL;
                $data['tubers'] = trim($row[18]) !== '' ? $row[18] : NULL;
                $data['vegetables'] = trim($row[19]) !== '' ? $row[19] : NULL;
                $data['fruits'] = trim($row[20]) !== '' ? $row[20] : NULL;
                $data['cereals'] = trim($row[21]) !== '' ? $row[21] : NULL;
                $data['snacks'] = trim($row[22]) !== '' ? $row[22] : NULL;
                $data['early_stimulation'] = trim($row[23]) !== '' ? substr($row[23], 0, 1) : NULL;
                $data['exercise'] = trim($row[24]) !== '' ? substr($row[24], 0, 1) : NULL;
                $data['exercise_times'] = trim($row[25]) !== '' ? substr($row[25], 0, 1) : NULL;
                $data['sport_active'] = trim($row[26]) !== '' ? substr($row[26], 0, 1) : NULL;
                $data['medical_times'] = trim($row[27]) !== '' ? substr($row[27], 0, 1) : NULL;
                $data['kid_review'] = trim($row[28]) !== '' ? substr($row[28], 0, 1) : NULL;
                $data['medical_exams'] = trim($row[29]) !== '' ? substr($row[29], 0, 1) : NULL;
                $data['dentist'] = trim($row[30]) !== '' ? substr($row[30], 0, 1) : NULL;
                $data['nutrition'] = trim($row[31]) !== '' ? substr($row[31], 0, 1) : NULL;
                $data['psychology'] = trim($row[32]) !== '' ? substr($row[32], 0, 1) : NULL;
                $data['previous_treatment'] = trim($row[33]) !== '' ? substr($row[33], 0, 1) : NULL;
                $data['diseases'] = trim($row[34]) !== '' ? substr($row[34], 0, 1) : NULL;
                $data['childcare'] = trim($row[35]) !== '' ? substr($row[35], 0, 1) : NULL;
                $data['second_opinion'] = trim($row[36]) !== '' ? substr($row[36], 0, 1) : NULL;
                $data['say_feelings'] = trim($row[37]) !== '' ? substr($row[37], 0, 1) : NULL;
                $data['speak_louder'] = trim($row[38]) !== '' ? substr($row[38], 0, 1) : NULL;
                $data['play'] = trim($row[39]) !== '' ? substr($row[39], 0, 1) : NULL;
                $data['withdrawn'] = trim($row[40]) !== '' ? substr($row[40], 0, 1) : NULL;
                $data['share_family'] = trim($row[41]) !== '' ? substr($row[41], 0, 1) : NULL;
                $data['moodiness'] = trim($row[42]) !== '' ? substr($row[42], 0, 1) : NULL;
                $data['work_alone'] = trim($row[43]) !== '' ? substr($row[43], 0, 1) : NULL;
                $data['table_one'] = trim($row[44]) !== '' ? substr($row[44], 0, 1) : NULL;
                $data['table_two'] = trim($row[45]) !== '' ? substr($row[45], 0, 1) : NULL;
                $data['table_three'] = trim($row[46]) !== '' ? substr($row[46], 0, 1) : NULL;
                $data['table_four'] = trim($row[47]) !== '' ? substr($row[47], 0, 1) : NULL;
                $data['table_five'] = trim($row[48]) !== '' ? substr($row[48], 0, 1) : NULL;
                $data['table_six'] = trim($row[49]) !== '' ? substr($row[49], 0, 1) : NULL;
                $data['table_seven'] = trim($row[50]) !== '' ? substr($row[50], 0, 1) : NULL;
                $data['table_eight'] = trim($row[51]) !== '' ? substr($row[51], 0, 1) : NULL;
                $data['table_nine'] = trim($row[52]) !== '' ? substr($row[52], 0, 1) : NULL;
                $data['table_ten'] = trim($row[53]) !== '' ? substr($row[53], 0, 1) : NULL;
                $data['table_eleven'] = trim($row[54]) !== '' ? substr($row[54], 0, 1) : NULL;
                $data['table_twelve'] = trim($row[55]) !== '' ? substr($row[55], 0, 1) : NULL;
                $data['table_thirteen'] = trim($row[56]) !== '' ? substr($row[56], 0, 1) : NULL;
                $data['table_fourteen'] = trim($row[57]) !== '' ? substr($row[57], 0, 1) : NULL;
                $data['table_fifteen'] = trim($row[58]) !== '' ? substr($row[58], 0, 1) : NULL;
                $data['table_sixteen'] = trim($row[59]) !== '' ? substr($row[59], 0, 1) : NULL;
                $data['table_seventeen'] = trim($row[60]) !== '' ? substr($row[60], 0, 1) : NULL;
                $data['table_eighteen'] = trim($row[61]) !== '' ? substr($row[61], 0, 1) : NULL;
                $data['table_nineteen'] = trim($row[62]) !== '' ? substr($row[62], 0, 1) : NULL;
                $data['table_twenty'] = trim($row[63]) !== '' ? substr($row[63], 0, 1) : NULL;
                $data['table_twentyone'] = trim($row[64]) !== '' ? substr($row[64], 0, 1) : NULL;
                $data['table_twentytwo'] = trim($row[65]) !== '' ? substr($row[65], 0, 1) : NULL;
                $data['table_twentythree'] = trim($row[66]) !== '' ? substr($row[66], 0, 1) : NULL;
                $data['bath_times'] = trim($row[67]) !== '' ? substr($row[67], 0, 1) : NULL;
                $data['handwashing'] = trim($row[68]) !== '' ? substr($row[68], 0, 1) : NULL;
                $data['brush_teeth'] = trim($row[69]) !== '' ? substr($row[69], 0, 1) : NULL;
                $data['floss_use'] = trim($row[70]) !== '' ? substr($row[70], 0, 1) : NULL;
                $data['toothbrush'] = trim($row[71]) !== '' ? substr($row[71], 0, 1) : NULL;
                $data['bath_towel'] = trim($row[72]) !== '' ? substr($row[72], 0, 1) : NULL;
                
                $insert_id = saveBabyLifestyleData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 14:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== 'FUMARATO FERROSO' ||
                  trim($row[10]) !== 'ÁCIDO FOLICO' ||
                  trim($row[14]) !== 'MULTIVITAMINICOS' ||
                  trim($row[18]) !== 'PRUEBA DE VIH' ||
                  trim($row[22]) !== 'PRUEBA DE SIFILIS' ||
                  trim($row[26]) !== 'PLATICAS DE CUIDADO DE RECIEN NACIDO' ||
                  trim($row[30]) !== 'PLATICAS PARA AMAMANTAR' ||
                  trim($row[34]) !== '¿EDAD IDEAL PARA CASARSE?' ||
                  trim($row[35]) !== '¿NÚMERO DE HIJOS QUE PLANEA TENER?' ||
                  trim($row[36]) !== '¿NÚMERO DE HIJOS ACTUALMENTE?' ||
                  trim($row[37]) !== '¿DESCONOCE LA UTILIZACION DE ALGUN TIPO DE METODO DE PLANIFICACION FAMILIAR?' ||
                  trim($row[38]) !== '¿CUENTA CON ALGUIEN PARA LLEVARLA AL MEDICO EN CASO DE URGENCIAS?' ||
                  trim($row[39]) !== 'PARENTESCO' ||
                  trim($row[40]) !== '¿CUENTA CON TRANSPORTE PARA TRASLADARSE AL MEDICO?' ||
                  trim($row[41]) !== 'TIPO DE VEHÍCULO' ||
                  trim($row[42]) !== '¿ANTE UNA URGENCIA QUE SERVICIO MEDICO USA POR LO REGULAR?' ||
                  trim($row[43]) !== '¿CUANTAS CONSULTAS REALIZA AL AÑO PARA ODONTOLOGIA?' ||
                  trim($row[44]) !== 'FUR:' ||
                  trim($row[45]) !== 'IVSA:' ||
                  trim($row[46]) !== 'NÚMERO DE EMBARAZOS:' ||
                  trim($row[49]) !== 'HIJOS VIVOS/MUERTOS:' ||
                  trim($row[51]) !== 'PESO AL NACER DE HIJO DE' || //Continuar apartir de aqui
                  trim($row[53]) !== 'AUTOEXPLORACIÓN MAMARIA' ||
                  trim($row[55]) !== 'EXPLORACION MAMARIA EN UNIDAD DE SALUD' ||
                  trim($row[58]) !== 'MASTOGRAFIA' ||
                  trim($row[62]) !== 'DENSITOMETRIA:'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['ferrous_fumarate_a'] = trim($row[6]) !== '' ? (strtoupper(trim($row[6])) == 'NO' ? '0' : '1') : NULL;
                $data['ferrous_fumarate_b'] = trim($row[7]) !== '' ? (strtoupper(trim($row[7])) == 'NO' ? '0' : '1') : NULL;
                $data['ferrous_fumarate_c'] = trim($row[8]) !== '' ? (strtoupper(trim($row[8])) == 'NO' ? '0' : '1') : NULL;
                $data['ferrous_fumarate_d'] = trim($row[9]) !== '' ? (strtoupper(trim($row[9])) == 'NO' ? '0' : '1') : NULL;
                $data['folic_acid_a'] = trim($row[10]) !== '' ? (strtoupper(trim($row[10])) == 'NO' ? '0' : '1') : NULL;
                $data['folic_acid_b'] = trim($row[11]) !== '' ? (strtoupper(trim($row[11])) == 'NO' ? '0' : '1') : NULL;
                $data['folic_acid_c'] = trim($row[12]) !== '' ? (strtoupper(trim($row[12])) == 'NO' ? '0' : '1') : NULL;
                $data['folic_acid_d'] = trim($row[13]) !== '' ? (strtoupper(trim($row[13])) == 'NO' ? '0' : '1') : NULL;
                $data['multivitamins_a'] = trim($row[14]) !== '' ? (strtoupper(trim($row[14])) == 'NO' ? '0' : '1') : NULL;
                $data['multivitamins_b'] = trim($row[15]) !== '' ? (strtoupper(trim($row[15])) == 'NO' ? '0' : '1') : NULL;
                $data['multivitamins_c'] = trim($row[16]) !== '' ? (strtoupper(trim($row[16])) == 'NO' ? '0' : '1') : NULL;
                $data['multivitamins_d'] = trim($row[17]) !== '' ? (strtoupper(trim($row[17])) == 'NO' ? '0' : '1') : NULL;
                $data['hiv_test_a'] = trim($row[18]) !== '' ? (strtoupper(trim($row[18])) == 'NO' ? '0' : '1') : NULL;
                $data['hiv_test_b'] = trim($row[19]) !== '' ? (strtoupper(trim($row[19])) == 'NO' ? '0' : '1') : NULL;
                $data['hiv_test_c'] = trim($row[20]) !== '' ? (strtoupper(trim($row[20])) == 'NO' ? '0' : '1') : NULL;
                $data['hiv_test_d'] = trim($row[21]) !== '' ? (strtoupper(trim($row[21])) == 'NO' ? '0' : '1') : NULL;
                $data['syphilis_test_a'] = trim($row[22]) !== '' ? (strtoupper(trim($row[22])) == 'NO' ? '0' : '1') : NULL;
                $data['syphilis_test_b'] = trim($row[23]) !== '' ? (strtoupper(trim($row[23])) == 'NO' ? '0' : '1') : NULL;
                $data['syphilis_test_c'] = trim($row[24]) !== '' ? (strtoupper(trim($row[24])) == 'NO' ? '0' : '1') : NULL;
                $data['syphilis_test_d'] = trim($row[25]) !== '' ? (strtoupper(trim($row[25])) == 'NO' ? '0' : '1') : NULL;
                $data['newborn_care_a'] = trim($row[26]) !== '' ? (strtoupper(trim($row[26])) == 'NO' ? '0' : '1') : NULL;
                $data['newborn_care_b'] = trim($row[27]) !== '' ? (strtoupper(trim($row[27])) == 'NO' ? '0' : '1') : NULL;
                $data['newborn_care_c'] = trim($row[28]) !== '' ? (strtoupper(trim($row[28])) == 'NO' ? '0' : '1') : NULL;
                $data['newborn_care_d'] = trim($row[29]) !== '' ? (strtoupper(trim($row[29])) == 'NO' ? '0' : '1') : NULL;
                $data['breast_feed_a'] = trim($row[30]) !== '' ? (strtoupper(trim($row[30])) == 'NO' ? '0' : '1') : NULL;
                $data['breast_feed_b'] = trim($row[31]) !== '' ? (strtoupper(trim($row[31])) == 'NO' ? '0' : '1') : NULL;
                $data['breast_feed_c'] = trim($row[32]) !== '' ? (strtoupper(trim($row[32])) == 'NO' ? '0' : '1') : NULL;
                $data['breast_feed_d'] = trim($row[33]) !== '' ? (strtoupper(trim($row[33])) == 'NO' ? '0' : '1') : NULL;

                $data['get_married'] = trim($row[34]) !== '' ? trim($row[34]) : NULL;
                $data['children_plan'] = trim($row[35]) !== '' ? trim($row[35]) : NULL;
                $data['children_current'] = trim($row[36]) !== '' ? trim($row[36]) : NULL;
                $data['planning_method'] = trim($row[37]) !== '' ? trim($row[37]) : NULL;
                $data['transporter'] = trim($row[38]) !== '' ? (strtoupper(trim($row[38])) == 'NO' ? '0' : '1') : NULL;
                $data['relationship'] = trim($row[39]) !== '' ? trim($row[39]) : NULL;
                $data['transport'] = trim($row[40]) !== '' ? (strtoupper(trim($row[40])) == 'NO' ? '0' : '1') : NULL;
                $data['vehicle_type'] = trim($row[41]) !== '' ? trim($row[41]) : NULL;
                $data['medical_service'] = trim($row[42]) !== '' ? trim($row[42]) : NULL;
                $data['odontology'] = trim($row[43]) !== '' ? trim($row[43]) : NULL;
                $data['fur'] = trim($row[44]) !== '' ? trim($row[44]) : NULL;
                $data['ivsa'] = trim($row[45]) !== '' ? trim($row[45]) : NULL;

                $data['childbirth'] = (string)(int)$row[46] == $row[46] ? $row[46] : NULL;
                $data['caesarean'] = (string)(int)$row[47] == $row[47] ? $row[47] : NULL;
                $data['abortion'] = (string)(int)$row[48] == $row[48] ? $row[48] : NULL;
                $data['children_live'] = (string)(int)$row[49] == $row[49] ? $row[49] : NULL;
                $data['children_dead'] = (string)(int)$row[50] == $row[50] ? $row[50] : NULL;

                $data['min_weight'] = trim($row[51]) !== '' ? (is_numeric(trim(str_replace('KG', '', strtoupper($row[51])))) ? trim(str_replace('KG', '', strtoupper($row[51]))) : NULL) : NULL;
                $data['max_weight'] = trim($row[52]) !== '' ? (is_numeric(trim(str_replace('KG', '', strtoupper($row[52])))) ? trim(str_replace('KG', '', strtoupper($row[52]))) : NULL) : NULL;

                $data['self_manual'] = trim($row[53]) !== '' ? trim($row[53]) : NULL;
                $data['self_image'] = trim($row[54]) !== '' ? trim($row[54]) : NULL;
                $data['exam_manual'] = trim($row[55]) !== '' ? trim($row[55]) : NULL;
                $data['exam_image'] = trim($row[56]) !== '' ? trim($row[56]) : NULL;
                $data['menopausia'] = trim($row[57]) !== '' ? trim($row[57]) : NULL;

                $data['mammography_date'] = trim($row[60]) !== '' && trim($row[59]) !== '' && trim($row[58]) !== '' ? get2Date($row[60], $row[59], $row[58]) : '';
                $data['mammography_result'] = trim($row[61]) !== '' ? trim($row[61]) : '';

                $data['densitometry_date'] = trim($row[64]) !== '' && trim($row[63]) !== '' && trim($row[62]) !== '' ? get2Date($row[64], $row[63], $row[62]) : '';
                $data['densitometry_result'] = trim($row[65]) !== '' ? trim($row[65]) : '';

                $insert_id = saveGynecologyData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 15:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== '1 Me asusta mi enfermedad.' ||
                  trim($row[7]) !== '2 Se me hace difícil enfrentarme con mis actuales síntomas.' ||
                  trim($row[8]) !== '3 Soy incapaz de controlar mi enfermedad.' ||
                  trim($row[9]) !== '4 Si tengo una recaída, no puedo hacer nada para evitarlo.' ||
                  trim($row[10]) !== '5 Siempre ha existido algo malo en mí como persona (que ha causado esta enfermedad).' ||
                  trim($row[11]) !== '6 Yo soy esencialmente normal: mi enfermedad es como cualquier otra.' ||
                  trim($row[12]) !== '7 Hay algo en mi personalidad que causa mi enfermedad.' ||
                  trim($row[13]) !== '8 Hay algo en mí que es responsable de mi enfermedad.' ||
                  trim($row[14]) !== '9 Siempre necesitaré los cuidados de un equipo de profesionales.' ||
                  trim($row[15]) !== '10 Soy capaz de muy pocas cosas como consecuencia de mi enfermedad.' ||
                  trim($row[16]) !== '11 Mi enfermedad es demasiado delicada como para dejar de trabajar o mantener un trabajo.' ||
                  trim($row[17]) !== '12 Estoy avergonzado por mi enfermedad.' ||
                  trim($row[18]) !== '13 Me juzgan por mi enfermedad.' ||
                  trim($row[19]) !== '14 Puedo hablar a la mayoría de la gente sobre mi enfermedad.' ||
                  trim($row[20]) !== '15 La sociedad necesita mantener apartada a la gente, que como yo tiene esta enfermedad' ||
                  trim($row[21]) !== '16 La gente como yo debe de ser controlada por servicios psiquiátricos.' ||
                  trim($row[22]) !== '17 Yo siempre he estado mentalmente bien.' ||
                  trim($row[23]) !== '18 Yo siempre he tenido una enfermedad mental.'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['scare'] = trim($row[6]) !== '' ? substr($row[6], 0, 1) : NULL;
                $data['confront'] = trim($row[7]) !== '' ? substr($row[7], 0, 1) : NULL;
                $data['take_control'] = trim($row[8]) !== '' ? substr($row[8], 0, 1) : NULL;
                $data['relapse'] = trim($row[9]) !== '' ? substr($row[9], 0, 1) : NULL;
                $data['bad_inside'] = trim($row[10]) !== '' ? substr($row[10], 0, 1) : NULL;
                $data['normal'] = trim($row[11]) !== '' ? substr($row[11], 0, 1) : NULL;
                $data['personality'] = trim($row[12]) !== '' ? substr($row[12], 0, 1) : NULL;
                $data['something_inside'] = trim($row[13]) !== '' ? substr($row[13], 0, 1) : NULL;
                $data['professionals'] = trim($row[14]) !== '' ? substr($row[14], 0, 1) : NULL;
                $data['competent'] = trim($row[15]) !== '' ? substr($row[15], 0, 1) : NULL;
                $data['can_work'] = trim($row[16]) !== '' ? substr($row[16], 0, 1) : NULL;
                $data['ashamed'] = trim($row[17]) !== '' ? substr($row[17], 0, 1) : NULL;
                $data['judge_me'] = trim($row[18]) !== '' ? substr($row[18], 0, 1) : NULL;
                $data['can_talk'] = trim($row[19]) !== '' ? substr($row[19], 0, 1) : NULL;
                $data['draw_away'] = trim($row[20]) !== '' ? substr($row[20], 0, 1) : NULL;
                $data['psychiatric'] = trim($row[21]) !== '' ? substr($row[21], 0, 1) : NULL;
                $data['well_mentally'] = trim($row[22]) !== '' ? substr($row[22], 0, 1) : NULL;
                $data['mental_illness'] = trim($row[23]) !== '' ? substr($row[23], 0, 1) : NULL;
                
                $insert_id = saveHealthCareData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 16:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== 'PRESION ARTERIAL' ||
                  trim($row[7]) !== 'FRECUENCIA CARDIACA' ||
                  trim($row[8]) !== 'FRECUENCIA RESPIRATORIA' ||
                  trim($row[9]) !== 'TEMPERATURA' ||
                  trim($row[10]) !== 'GLUCOSA' ||
                  trim($row[11]) !== 'PESOS' ||
                  trim($row[12]) !== 'TALLA' ||
                  trim($row[13]) !== 'IMC' ||
                  trim($row[14]) !== '% GRASA CORPORAL' ||
                  trim($row[15]) !== 'PERIMETRO DE BRAZO' ||
                  trim($row[16]) !== 'PERIMETRO ABDOMINAL' ||
                  trim($row[17]) !== 'LLENADO CAPILAR' ||
                  trim($row[18]) !== 'SATURACIÓN' ||
                  trim($row[19]) !== 'HEMOGLOBINA GLUCOSILADA' ||
                  trim($row[20]) !== 'GLUCOSA' ||
                  trim($row[21]) !== 'CREATININA' ||
                  trim($row[22]) !== 'COLESTEROL' ||
                  trim($row[23]) !== 'TRIGLICERIDOS' ||
                  trim($row[24]) !== 'ANTIGENO PROSTÁTICO' ||
                  trim($row[25]) !== 'PRUEBA DE VIH' ||
                  trim($row[26]) !== 'PRUEBA DE SÍFILIS'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['blood_pressure'] = trim($row[6]) !== '' ? $row[6] : NULL;
                $data['heart_rate'] = (string)(int)$row[7] == $row[7] ? $row[7] : NULL;
                $data['breathe_rate'] = (string)(int)$row[8] == $row[8] ? $row[8] : NULL;
                $data['temperature'] = is_numeric(trim($row[9])) ? $row[9] : NULL;
                $data['glucose'] = is_numeric(trim($row[10])) ? $row[10] : NULL;
                $data['weight'] = is_numeric(trim($row[11])) ? $row[11] : NULL;
                $data['height'] = is_numeric(trim($row[12])) ? $row[12] : NULL;
                $data['body_mass'] = is_numeric(trim($row[13])) ? $row[13] : NULL;
                $data['body_fat'] = is_numeric(trim($row[14])) ? $row[14] : NULL;
                $data['arm_perimeter'] = is_numeric(trim($row[15])) ? $row[15] : NULL;
                $data['abdomen_perimeter'] = is_numeric(trim($row[16])) ? $row[16] : NULL;
                $data['capillary_refill'] = is_numeric(trim($row[17])) ? $row[17] : NULL;
                $data['saturation'] = (string)(int)$row[18] == $row[18] ? $row[18] : NULL;
                $data['glycated_hemoglobin'] = is_numeric(trim($row[19])) ? $row[19] : NULL;
                $data['glucose_lab'] = is_numeric(trim($row[20])) ? $row[20] : NULL;
                $data['creatinine'] = is_numeric(trim($row[21])) ? $row[21] : NULL;
                $data['cholesterol'] = is_numeric(trim($row[22])) ? $row[22] : NULL;
                $data['triglycerides'] = is_numeric(trim($row[23])) ? $row[23] : NULL;
                $data['prostatic_antigen'] = is_numeric(trim($row[24])) ? $row[24] : NULL;
                $data['sida'] = trim($row[25]) !== '' ? (strtoupper(trim($row[25])) == 'SI' ? '1' : NULL) : NULL;
                $data['syphilis'] = trim($row[26]) !== '' ? (strtoupper(trim($row[26])) == 'SI' ? '1' : NULL) : NULL;
                
                $insert_id = saveVitalSignData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 17:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== '1 Considero violencia el hecho de que me empujen aunque no me caiga.' ||
                  trim($row[7]) !== '2 Considero violencia el hecho de que me empujen si caigo.' ||
                  trim($row[8]) !== '3 Sólo es violencia cuando te golpean mucho.' ||
                  trim($row[9]) !== '4 Quien te quiere no puede pegarte.' ||
                  trim($row[10]) !== '5 Me siento inútil cuando me golpean.' ||
                  trim($row[11]) !== '6 Me parece normal que mi pareja me pegue si no le hace caso.' ||
                  trim($row[12]) !== '7 Me ha golpeado sin motivo aparente.' ||
                  trim($row[13]) !== '8 Antes de vivir conmigo, yo sabía que mi pareja había pegado a sus parejas anteriores.' ||
                  trim($row[14]) !== '9 He tenido relaciones sexuales con mi pareja por la fuerza.' ||
                  trim($row[15]) !== '10 Accedo a tener relaciones sexuales con mi pareja para evitar los malos tratos.' ||
                  trim($row[16]) !== '11 Tengo relaciones sexuales con mi pareja por miedo.' ||
                  trim($row[17]) !== '12 Considero que hay malos tratos aunque no me ponga una mano encima.' ||
                  trim($row[18]) !== '13 Él decide por mí.' ||
                  trim($row[19]) !== '14 Ha conseguido aislarme de mis amigos.' ||
                  trim($row[20]) !== '15 Ha intentado aislarme de mi familia.' ||
                  trim($row[21]) !== '16 Me siento culpable de lo que pasa.' ||
                  trim($row[22]) !== '17 Me insulta en cualquier lugar.' ||
                  trim($row[23]) !== '18 Trato de ocultar los motivos de mis “moretones”.' ||
                  trim($row[24]) !== '19 Siempre estoy en alerta.' ||
                  trim($row[25]) !== '20 Lo he denunciado.' ||
                  trim($row[26]) !== '21 Me asusta la manera en que me mira.' ||
                  trim($row[27]) !== '22 Me siento sola.' ||
                  trim($row[28]) !== '23 Puedo estudiar/trabajar fuera de casa.' ||
                  trim($row[29]) !== '24 Me impide ver a mi familia.' ||
                  trim($row[30]) !== '25 Vigila lo que hago.' ||
                  trim($row[31]) !== '26 Creo que sigo “enganchada” a mi marido.' ||
                  trim($row[32]) !== '27 Me siento culpable cuando mi marido se arrepiente.' ||
                  trim($row[33]) !== '27 Me siento culpable cuando mi marido se arrepiente.' ||
                  trim($row[34]) !== '29 Yo creo que la mujer tiene que obedecer.' ||
                  trim($row[35]) !== '30 Yo creo que las mujeres somos iguales que los hombres.' ||
                  trim($row[36]) !== '31 Yo creo que las mujeres no llaman a la policía porque protegen a sus maridos.' ||
                  trim($row[37]) !== '32 Yo creo que lo que ocurren en la familia es privado.' ||
                  trim($row[38]) !== '33 Yo creo que las bofetadas pueden ser necesarias.' ||
                  trim($row[39]) !== '34 Yo creo que los maltratadores son personas fracasadas.' ||
                  trim($row[40]) !== '35 Yo creo que cuando te casas es para lo bueno y lo malo.' ||
                  trim($row[41]) !== '36 Yo creo que soy capaz de realizar un proyecto de vida futuro y por mi cuenta.' ||
                  trim($row[42]) !== '37 Yo creo que un/a hijo/a sin padre se desarrolla completamente.' ||
                  trim($row[43]) !== '38 Yo creo que hay que aguantar el maltrato por los hijos.' ||
                  trim($row[44]) !== '39 Yo creo que mi marido no puede vivir sin mí.' ||
                  trim($row[45]) !== '40 Yo creo que no lo abandono porque lo quiero.' ||
                  trim($row[46]) !== '41 Yo creo que no lo abandono aunque me pegue porque me da pena.' ||
                  trim($row[47]) !== '42 Yo creo que la esposa tiene que aguantar lo que sea por el matrimonio.'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $fields = array('push_up', 'push_down', 'strike', 'wants', 'useless', 'normal_hit', 'without_reason', 'violent',
                  'forced_sex', 'engagement_sex', 'sex_fear', 'bad_treatments', 'decide_4me', 'isolates_me', 'try_isolate', 'feel_guilty', 'insults_me',
                  'bruises', 'be_alert', 'denounced', 'look_scare', 'feel_alone', 'can_work', 'see_family', 'watches_me', 'keep_hooked', 'regret_guilty',
                  'care_aspect', 'have_obey', 'gender_equality', 'protect_couple', 'private_life', 'slap_necessary', 'abuser_failed', 'good_bad',
                  'life_proyect', 'without_father', 'childrens', 'without_me', 'love_him', 'feel_sorry', 'marriage'
                );

                foreach($fields as $key=>$field){
                  $index = $key+6;
                  switch(substr($row[$index], 0, 1)){
                    case '0':
                      $value = 'a';
                      break;
                    case '1':
                      $value = 'b';
                      break;
                    case '2':
                      $value = 'c';
                      break;
                    case '3':
                      $value = 'd';
                      break;
                    case '4':
                      $value = 'e';
                      break;
                    default:
                      $value = NULL;
                      break;
                  }
                  $data[$field] = $value;
                }
                
                $insert_id = saveGenderViolenceData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 18:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || $row[3] !== 'APELLIDO PATERNO'
                  || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || $row[6] !== 'EDAD' ||
                  trim($row[7]) !== 'FECHA DE NACIMIENTO' ||
                  trim($row[10]) !== 'BCG  (Tuberculosis)' ||
                  trim($row[14]) !== 'Hepatitis B (Hepatitis B)' ||
                  trim($row[26]) !== 'Pentavalente acelular DPaT + VPI + Hib (Difteria, Tosferina, Tétanos, Poliomielitis e infecciones por Haemophilus influenzae b)' ||
                  trim($row[42]) !== 'DPT (Difteria, Tosferina y Tétanos)' ||
                  trim($row[46]) !== 'Rotavirus (Diarrea por Rotavirus)' ||
                  trim($row[58]) !== 'Neumocócica conjugada (Infecciones por neumococo)' ||
                  trim($row[70]) !== 'Influenza (Influenza)' ||
                  trim($row[86]) !== 'SRP (Sarampión, Rubéola y Parotiditis)' ||
                  trim($row[94]) !== 'Sabin (Poliomelitis)' ||
                  trim($row[98]) !== 'SR (Sarampión y Rubéola)'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);
                $data['age'] = trim($row[6]) !== '' ? trim($row[6]) : NULL;
                $data['birthdate'] = trim($row[7]) !== '' && trim($row[8]) !== '' && trim($row[9]) !== '' ? get2Date($row[9], $row[8], $row[7]) : NULL;

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['bcg'] = trim($row[12]) !== '' || trim($row[11]) !== '' || trim($row[10]) !== '' ? '1' : '';
                $data['bcg_date'] = trim($row[12]) !== '' && trim($row[11]) !== '' && trim($row[10]) !== '' ? get2Date($row[12], $row[11], $row[10]) : '';
                $data['bcg_desc'] = trim($row[13]) !== '' ? trim($row[13]) : '';

                $data['hepatb1'] = trim($row[16]) !== '' || trim($row[15]) !== '' || trim($row[14]) !== '' ? '1' : '';
                $data['hepatb1_date'] = trim($row[16]) !== '' && trim($row[15]) !== '' && trim($row[14]) !== '' ? get2Date($row[16], $row[15], $row[14]) : '';
                $data['hepatb1_desc'] = trim($row[17]) !== '' ? trim($row[17]) : '';

                $data['hepatb2'] = trim($row[20]) !== '' || trim($row[19]) !== '' || trim($row[18]) !== '' ? '1' : '';
                $data['hepatb2_date'] = trim($row[20]) !== '' && trim($row[19]) !== '' && trim($row[18]) !== '' ? get2Date($row[20], $row[19], $row[18]) : '';
                $data['hepatb3_desc'] = trim($row[21]) !== '' ? trim($row[21]) : '';

                $data['hepatb3'] = trim($row[24]) !== '' || trim($row[23]) !== '' || trim($row[22]) !== '' ? '1' : '';
                $data['hepatb3_date'] = trim($row[24]) !== '' && trim($row[23]) !== '' && trim($row[22]) !== '' ? get2Date($row[24], $row[23], $row[22]) : '';
                $data['hepatb3_desc'] = trim($row[25]) !== '' ? trim($row[25]) : '';

                $data['pentavalente1'] = trim($row[28]) !== '' || trim($row[27]) !== '' || trim($row[26]) !== '' ? '1' : '';
                $data['pentavalente1_date'] = trim($row[28]) !== '' && trim($row[27]) !== '' && trim($row[26]) !== '' ? get2Date($row[28], $row[27], $row[26]) : '';
                $data['pentavalente1_desc'] = trim($row[29]) !== '' ? trim($row[29]) : '';

                $data['pentavalente2'] = trim($row[32]) !== '' || trim($row[31]) !== '' || trim($row[30]) !== '' ? '1' : '';
                $data['pentavalente2_date'] = trim($row[32]) !== '' && trim($row[31]) !== '' && trim($row[30]) !== '' ? get2Date($row[32], $row[31], $row[30]) : '';
                $data['pentavalente2_desc'] = trim($row[33]) !== '' ? trim($row[33]) : '';

                $data['pentavalente3'] = trim($row[36]) !== '' || trim($row[35]) !== '' || trim($row[34]) !== '' ? '1' : '';
                $data['pentavalente3_date'] = trim($row[36]) !== '' && trim($row[35]) !== '' && trim($row[34]) !== '' ? get2Date($row[36], $row[35], $row[34]) : '';
                $data['pentavalente3_desc'] = trim($row[37]) !== '' ? trim($row[37]) : '';

                $data['pentavalenteref'] = trim($row[40]) !== '' || trim($row[39]) !== '' || trim($row[38]) !== '' ? '1' : '';
                $data['pentavalenteref_date'] = trim($row[40]) !== '' && trim($row[39]) !== '' && trim($row[38]) !== '' ? get2Date($row[40], $row[39], $row[38]) : '';
                $data['pentavalenteref_desc'] = trim($row[41]) !== '' ? trim($row[41]) : '';

                $data['dptref'] = trim($row[44]) !== '' || trim($row[43]) !== '' || trim($row[42]) !== '' ? '1' : '';
                $data['dptref_date'] = trim($row[44]) !== '' && trim($row[43]) !== '' && trim($row[42]) !== '' ? get2Date($row[44], $row[43], $row[42]) : '';
                $data['dptref_desc'] = trim($row[45]) !== '' ? trim($row[45]) : '';

                $data['rotavirus1'] = trim($row[48]) !== '' || trim($row[47]) !== '' || trim($row[46]) !== '' ? '1' : '';
                $data['rotavirus1_date'] = trim($row[48]) !== '' && trim($row[47]) !== '' && trim($row[46]) !== '' ? get2Date($row[48], $row[47], $row[46]) : '';
                $data['rotavirus1_desc'] = trim($row[49]) !== '' ? trim($row[49]) : '';

                $data['rotavirus2'] = trim($row[52]) !== '' || trim($row[51]) !== '' || trim($row[50]) !== '' ? '1' : '';
                $data['rotavirus2_date'] = trim($row[52]) !== '' && trim($row[51]) !== '' && trim($row[50]) !== '' ? get2Date($row[52], $row[51], $row[50]) : '';
                $data['rotavirus2_desc'] = trim($row[53]) !== '' ? trim($row[53]) : '';

                $data['rotavirus3'] = trim($row[56]) !== '' || trim($row[55]) !== '' || trim($row[54]) !== '' ? '1' : '';
                $data['rotavirus3_date'] = trim($row[56]) !== '' && trim($row[55]) !== '' && trim($row[54]) !== '' ? get2Date($row[56], $row[55], $row[54]) : '';
                $data['rotavirus3_desc'] = trim($row[57]) !== '' ? trim($row[57]) : '';

                $data['neumoco1'] = trim($row[60]) !== '' || trim($row[59]) !== '' || trim($row[58]) !== '' ? '1' : '';
                $data['neumoco1_date'] = trim($row[60]) !== '' && trim($row[59]) !== '' && trim($row[58]) !== '' ? get2Date($row[60], $row[59], $row[58]) : '';
                $data['neumoco1_desc'] = trim($row[61]) !== '' ? trim($row[61]) : '';

                $data['neumoco2'] = trim($row[64]) !== '' || trim($row[63]) !== '' || trim($row[62]) !== '' ? '1' : '';
                $data['neumoco2_date'] = trim($row[64]) !== '' && trim($row[63]) !== '' && trim($row[62]) !== '' ? get2Date($row[64], $row[63], $row[62]) : '';
                $data['neumoco2_desc'] = trim($row[65]) !== '' ? trim($row[65]) : '';

                $data['neumocorev'] = trim($row[68]) !== '' || trim($row[67]) !== '' || trim($row[66]) !== '' ? '1' : '';
                $data['neumocorev_date'] = trim($row[68]) !== '' && trim($row[67]) !== '' && trim($row[66]) !== '' ? get2Date($row[68], $row[67], $row[66]) : '';
                $data['neumocorev_desc'] = trim($row[69]) !== '' ? trim($row[69]) : '';

                $data['influenza1'] = trim($row[72]) !== '' || trim($row[71]) !== '' || trim($row[70]) !== '' ? '1' : '';
                $data['influenza1_date'] = trim($row[72]) !== '' && trim($row[71]) !== '' && trim($row[70]) !== '' ? get2Date($row[72], $row[71], $row[70]) : '';
                $data['influenza1_desc'] = trim($row[73]) !== '' ? trim($row[73]) : '';

                $data['influenza2'] = trim($row[76]) !== '' || trim($row[75]) !== '' || trim($row[74]) !== '' ? '1' : '';
                $data['influenza2_date'] = trim($row[76]) !== '' && trim($row[75]) !== '' && trim($row[74]) !== '' ? get2Date($row[76], $row[75], $row[74]) : '';
                $data['influenza2_desc'] = trim($row[77]) !== '' ? trim($row[77]) : '';

                $data['influenza3'] = trim($row[80]) !== '' || trim($row[79]) !== '' || trim($row[78]) !== '' ? '1' : '';
                $data['influenza3_date'] = trim($row[80]) !== '' && trim($row[79]) !== '' && trim($row[78]) !== '' ? get2Date($row[80], $row[79], $row[78]) : '';
                $data['influenza3_desc'] = trim($row[81]) !== '' ? trim($row[81]) : '';

                $data['influenza4'] = trim($row[84]) !== '' || trim($row[83]) !== '' || trim($row[82]) !== '' ? '1' : '';
                $data['influenza4_date'] = trim($row[84]) !== '' && trim($row[83]) !== '' && trim($row[82]) !== '' ? get2Date($row[84], $row[83], $row[82]) : '';
                $data['influenza4_desc'] = trim($row[85]) !== '' ? trim($row[85]) : '';

                $data['influenza5'] = '';
                $data['influenza5_date'] = '';
                $data['influenza5_desc'] = '';

                $data['influenza6'] = '';
                $data['influenza6_date'] = '';
                $data['influenza6_desc'] = '';

                $data['sarampion1'] = trim($row[88]) !== '' || trim($row[87]) !== '' || trim($row[86]) !== '' ? '1' : '';
                $data['sarampion1_date'] = trim($row[88]) !== '' && trim($row[87]) !== '' && trim($row[86]) !== '' ? get2Date($row[88], $row[87], $row[86]) : '';
                $data['sarampion1_desc'] = trim($row[89]) !== '' ? trim($row[89]) : '';

                $data['sarampion2'] = trim($row[92]) !== '' || trim($row[91]) !== '' || trim($row[90]) !== '' ? '1' : '';
                $data['sarampion2_date'] = trim($row[92]) !== '' && trim($row[91]) !== '' && trim($row[90]) !== '' ? get2Date($row[92], $row[91], $row[90]) : '';
                $data['sarampion2_desc'] = trim($row[93]) !== '' ? trim($row[93]) : '';

                $data['sabin'] = trim($row[96]) !== '' || trim($row[95]) !== '' || trim($row[94]) !== '' ? '1' : '';
                $data['sabin_date'] = trim($row[96]) !== '' && trim($row[95]) !== '' && trim($row[94]) !== '' ? get2Date($row[96], $row[95], $row[94]) : '';
                $data['sabin_desc'] = trim($row[97]) !== '' ? trim($row[97]) : '';

                $data['sarampion3'] = trim($row[100]) !== '' || trim($row[99]) !== '' || trim($row[98]) !== '' ? '1' : '';
                $data['sarampion3_date'] = trim($row[100]) !== '' && trim($row[99]) !== '' && trim($row[98]) !== '' ? get2Date($row[100], $row[99], $row[98]) : '';
                $data['sarampion3_desc'] = trim($row[101]) !== '' ? trim($row[101]) : '';

                $insert_id = saveChildVaccinatonData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 19:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)'
                  || $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO'||
                  trim($row[6]) !== 'Hepatitis B (Hepatitis B)' ||
                  trim($row[14]) !== 'Td (Tétanos y Difteria)' ||
                  trim($row[30]) !== 'Tdpa (Tétanos, Difteria y Tos ferina)' ||
                  trim($row[34]) !== 'Influenza Estacional (Influenza)' ||
                  trim($row[42]) !== 'SR [Los que no han sido vacunados o tienen esquema incompleto] (Sarampión y Rubéola)' ||
                  trim($row[54]) !== 'VPH (Infección por el Virus del Papiloma Humano y Cánceer Cérvico-Uterino)'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['hepatb'] = trim($row[8]) !== '' || trim($row[7]) !== '' || trim($row[6]) !== '' ? '1' : '';
                $data['hepatb_date'] = trim($row[8]) !== '' && trim($row[7]) !== '' && trim($row[6]) !== '' ? get2Date($row[8], $row[7], $row[6]) : '';
                $data['hepatb_desc'] = trim($row[9]) !== '' ? trim($row[9]) : '';

                $data['hepatb2'] = trim($row[12]) !== '' || trim($row[11]) !== '' || trim($row[10]) !== '' ? '1' : '';
                $data['hepatb2_date'] = trim($row[12]) !== '' && trim($row[11]) !== '' && trim($row[10]) !== '' ? get2Date($row[12], $row[11], $row[10]) : '';
                $data['hepatb2_desc'] = trim($row[13]) !== '' ? trim($row[13]) : '';

                $data['dptc'] = trim($row[16]) !== '' || trim($row[15]) !== '' || trim($row[14]) !== '' ? '1' : '';
                $data['dptc_date'] = trim($row[16]) !== '' && trim($row[15]) !== '' && trim($row[14]) !== '' ? get2Date($row[16], $row[15], $row[14]) : '';
                $data['dptc_desc'] = trim($row[17]) !== '' ? trim($row[17]) : '';

                $data['dpti1'] = trim($row[20]) !== '' || trim($row[19]) !== '' || trim($row[18]) !== '' ? '1' : '';
                $data['dpti1_date'] = trim($row[20]) !== '' && trim($row[19]) !== '' && trim($row[18]) !== '' ? get2Date($row[20], $row[19], $row[18]) : '';
                $data['dpti1_desc'] = trim($row[21]) !== '' ? trim($row[21]) : '';

                $data['dpti2'] = trim($row[24]) !== '' || trim($row[23]) !== '' || trim($row[22]) !== '' ? '1' : '';
                $data['dpti2_date'] = trim($row[24]) !== '' && trim($row[23]) !== '' && trim($row[22]) !== '' ? get2Date($row[24], $row[23], $row[22]) : '';
                $data['dpti2_desc'] = trim($row[25]) !== '' ? trim($row[25]) : '';

                $data['dpti3'] = trim($row[28]) !== '' || trim($row[27]) !== '' || trim($row[26]) !== '' ? '1' : '';
                $data['dpti3_date'] = trim($row[28]) !== '' && trim($row[27]) !== '' && trim($row[26]) !== '' ? get2Date($row[28], $row[27], $row[26]) : '';
                $data['dpti3_desc'] = trim($row[29]) !== '' ? trim($row[29]) : '';

                $data['dptp'] = trim($row[32]) !== '' || trim($row[31]) !== '' || trim($row[30]) !== '' ? '1' : '';
                $data['dptp_date'] = trim($row[32]) !== '' && trim($row[31]) !== '' && trim($row[30]) !== '' ? get2Date($row[32], $row[31], $row[30]) : '';
                $data['dptp_desc'] = trim($row[33]) !== '' ? trim($row[33]) : '';

                $data['influenzap'] = trim($row[36]) !== '' || trim($row[35]) !== '' || trim($row[34]) !== '' ? '1' : '';
                $data['influenzap_date'] = trim($row[36]) !== '' && trim($row[35]) !== '' && trim($row[34]) !== '' ? get2Date($row[36], $row[35], $row[34]) : '';
                $data['influenzap_desc'] = trim($row[37]) !== '' ? trim($row[37]) : '';

                $data['influenza'] = trim($row[40]) !== '' || trim($row[39]) !== '' || trim($row[38]) !== '' ? '1' : '';
                $data['influenza_date'] = trim($row[40]) !== '' && trim($row[39]) !== '' && trim($row[38]) !== '' ? get2Date($row[40], $row[39], $row[38]) : '';
                $data['influenza_desc'] = trim($row[41]) !== '' ? trim($row[41]) : '';

                $data['influenza2'] = '';
                $data['influenza2_date'] = '';
                $data['influenza2_desc'] = '';

                $data['influenza3'] = '';
                $data['influenza3_date'] = '';
                $data['influenza3_desc'] = '';

                $data['influenza5'] = '';
                $data['influenza5_date'] = '';
                $data['influenza5_desc'] = '';

                $data['influenza4'] = '';
                $data['influenza4_date'] = '';
                $data['influenza4_desc'] = '';

                $data['influenza5'] = '';
                $data['influenza5_date'] = '';
                $data['influenza5_desc'] = '';

                $data['influenza6'] = '';
                $data['influenza6_date'] = '';
                $data['influenza6_desc'] = '';

                $data['influenza7'] = '';
                $data['influenza7_date'] = '';
                $data['influenza7_desc'] = '';

                $data['influenza8'] = '';
                $data['influenza8_date'] = '';
                $data['influenza8_desc'] = '';

                $data['sarampionsa1'] = trim($row[44]) !== '' || trim($row[43]) !== '' || trim($row[42]) !== '' ? '1' : '';
                $data['sarampionsa1_date'] = trim($row[44]) !== '' && trim($row[43]) !== '' && trim($row[42]) !== '' ? get2Date($row[44], $row[43], $row[42]) : '';
                $data['sarampionsa1_desc'] = trim($row[45]) !== '' ? trim($row[45]) : '';

                $data['sarampionsa2'] = trim($row[48]) !== '' || trim($row[47]) !== '' || trim($row[46]) !== '' ? '1' : '';
                $data['sarampionsa2_date'] = trim($row[48]) !== '' && trim($row[47]) !== '' && trim($row[46]) !== '' ? get2Date($row[48], $row[47], $row[46]) : '';
                $data['sarampionsa2_desc'] = trim($row[49]) !== '' ? trim($row[49]) : '';

                $data['sarampion'] = trim($row[52]) !== '' || trim($row[51]) !== '' || trim($row[50]) !== '' ? '1' : '';
                $data['sarampion_date'] = trim($row[52]) !== '' && trim($row[51]) !== '' && trim($row[50]) !== '' ? get2Date($row[52], $row[51], $row[50]) : '';
                $data['sarampion_desc'] = trim($row[53]) !== '' ? trim($row[53]) : '';

                $data['vph'] = trim($row[56]) !== '' || trim($row[55]) !== '' || trim($row[54]) !== '' ? '1' : '';
                $data['vph_date'] = trim($row[56]) !== '' && trim($row[55]) !== '' && trim($row[54]) !== '' ? get2Date($row[56], $row[55], $row[54]) : '';
                $data['vph_desc'] = trim($row[57]) !== '' ? trim($row[57]) : '';

                $data['vph2'] = trim($row[60]) !== '' || trim($row[59]) !== '' || trim($row[58]) !== '' ? '1' : '';
                $data['vph2_date'] = trim($row[60]) !== '' && trim($row[59]) !== '' && trim($row[58]) !== '' ? get2Date($row[60], $row[59], $row[58]) : '';
                $data['vph2_desc'] = trim($row[61]) !== '' ? trim($row[61]) : '';

                $insert_id = saveYoungVaccinatonData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 20:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)'
                  || $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO'||
                  trim($row[6]) !== 'SR [Los que no han sido vacunados o tienen esquema incompleto hasta los 39 años de edad] (Sarampión y Rubéola)' ||
                  trim($row[18]) !== 'Td (Tétanos y Difteria)' ||
                  trim($row[34]) !== 'Tdpa (Tétanos, Difteria y Tos ferina)' ||
                  trim($row[38]) !== 'Influenza Estacional (Influenza)'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['sarampionsa1'] = trim($row[8]) !== '' || trim($row[7]) !== '' || trim($row[6]) !== '' ? '1' : '';
                $data['sarampionsa1_date'] = trim($row[8]) !== '' && trim($row[7]) !== '' && trim($row[6]) !== '' ? get2Date($row[8], $row[7], $row[6]) : '';
                $data['sarampionsa1_desc'] = trim($row[9]) !== '' ? trim($row[9]) : '';

                $data['sarampionsa2'] = trim($row[12]) !== '' || trim($row[11]) !== '' || trim($row[10]) !== '' ? '1' : '';
                $data['sarampionsa2_date'] = trim($row[12]) !== '' && trim($row[11]) !== '' && trim($row[10]) !== '' ? get2Date($row[12], $row[11], $row[10]) : '';
                $data['sarampionsa2_desc'] = trim($row[13]) !== '' ? trim($row[13]) : '';

                $data['sarampion'] = trim($row[16]) !== '' || trim($row[15]) !== '' || trim($row[14]) !== '' ? '1' : '';
                $data['sarampion_date'] = trim($row[16]) !== '' && trim($row[15]) !== '' && trim($row[14]) !== '' ? get2Date($row[16], $row[15], $row[14]) : '';
                $data['sarampion_desc'] = trim($row[17]) !== '' ? trim($row[17]) : '';

                $data['dptc'] = trim($row[20]) !== '' || trim($row[19]) !== '' || trim($row[18]) !== '' ? '1' : '';
                $data['dptc_date'] = trim($row[20]) !== '' && trim($row[19]) !== '' && trim($row[18]) !== '' ? get2Date($row[20], $row[19], $row[18]) : '';
                $data['dptc_desc'] = trim($row[21]) !== '' ? trim($row[21]) : '';

                $data['dptc1'] = '';
                $data['dptc1_date'] = '';
                $data['dptc1_desc'] = '';

                $data['dptc2'] = '';
                $data['dptc2_date'] = '';
                $data['dptc2_desc'] = '';

                $data['dpti1'] = trim($row[24]) !== '' || trim($row[23]) !== '' || trim($row[22]) !== '' ? '1' : '';
                $data['dpti1_date'] = trim($row[24]) !== '' && trim($row[23]) !== '' && trim($row[22]) !== '' ? get2Date($row[24], $row[23], $row[22]) : '';
                $data['dpti1_desc'] = trim($row[25]) !== '' ? trim($row[25]) : '';

                $data['dpti2'] = trim($row[28]) !== '' || trim($row[27]) !== '' || trim($row[26]) !== '' ? '1' : '';
                $data['dpti2_date'] = trim($row[28]) !== '' && trim($row[27]) !== '' && trim($row[26]) !== '' ? get2Date($row[28], $row[27], $row[26]) : '';
                $data['dpti2_desc'] = trim($row[29]) !== '' ? trim($row[29]) : '';

                $data['dpti3'] = trim($row[32]) !== '' || trim($row[31]) !== '' || trim($row[30]) !== '' ? '1' : '';
                $data['dpti3_date'] = trim($row[32]) !== '' && trim($row[31]) !== '' && trim($row[30]) !== '' ? get2Date($row[32], $row[31], $row[30]) : '';
                $data['dpti3_desc'] = trim($row[33]) !== '' ? trim($row[33]) : '';

                $data['dptp'] = trim($row[36]) !== '' || trim($row[35]) !== '' || trim($row[34]) !== '' ? '1' : '';
                $data['dptp_date'] = trim($row[36]) !== '' && trim($row[35]) !== '' && trim($row[34]) !== '' ? get2Date($row[36], $row[35], $row[34]) : '';
                $data['dptp_desc'] = trim($row[37]) !== '' ? trim($row[37]) : '';

                $data['influenza'] = trim($row[40]) !== '' || trim($row[39]) !== '' || trim($row[38]) !== '' ? '1' : '';
                $data['influenza_date'] = trim($row[40]) !== '' && trim($row[39]) !== '' && trim($row[38]) !== '' ? get2Date($row[40], $row[39], $row[38]) : '';
                $data['influenza_desc'] = trim($row[41]) !== '' ? trim($row[41]) : '';

                $data['influenzap'] = trim($row[44]) !== '' || trim($row[43]) !== '' || trim($row[42]) !== '' ? '1' : '';
                $data['influenzap_date'] = trim($row[44]) !== '' && trim($row[43]) !== '' && trim($row[42]) !== '' ? get2Date($row[44], $row[43], $row[42]) : '';
                $data['influenzap_desc'] = trim($row[45]) !== '' ? trim($row[45]) : '';

                $data['influenza2'] = '';
                $data['influenza2_date'] = '';
                $data['influenza2_desc'] = '';

                $data['influenza3'] = '';
                $data['influenza3_date'] = '';
                $data['influenza3_desc'] = '';

                $data['influenza5'] = '';
                $data['influenza5_date'] = '';
                $data['influenza5_desc'] = '';

                $data['influenza4'] = '';
                $data['influenza4_date'] = '';
                $data['influenza4_desc'] = '';

                $data['influenza5'] = '';
                $data['influenza5_date'] = '';
                $data['influenza5_desc'] = '';

                $data['influenza6'] = '';
                $data['influenza6_date'] = '';
                $data['influenza6_desc'] = '';

                $data['influenza7'] = '';
                $data['influenza7_date'] = '';
                $data['influenza7_desc'] = '';

                $data['influenza8'] = '';
                $data['influenza8_date'] = '';
                $data['influenza8_desc'] = '';

                $data['influenza9'] = '';
                $data['influenza9_date'] = '';
                $data['influenza9_desc'] = '';

                $data['influenza10'] = '';
                $data['influenza10_date'] = '';
                $data['influenza10_desc'] = '';

                $data['influenza11'] = '';
                $data['influenza11_date'] = '';
                $data['influenza11_desc'] = '';

                $data['influenza12'] = '';
                $data['influenza12_date'] = '';
                $data['influenza12_desc'] = '';

                $insert_id = saveAdultVaccinatonData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 21:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)'
                  || $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO'||
                  trim($row[6]) !== 'Neumocócica polisacárida (Neumonía por neumococo)' ||
                  trim($row[18]) !== 'Td (Tétanos y Difteria)' ||
                  trim($row[34]) !== 'Influenza estacional (Influenza)'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['neumoco'] = trim($row[8]) !== '' || trim($row[7]) !== '' || trim($row[6]) !== '' ? '1' : '';
                $data['neumoco_date'] = trim($row[8]) !== '' && trim($row[7]) !== '' && trim($row[6]) !== '' ? get2Date($row[8], $row[7], $row[6]) : '';
                $data['neumoco_desc'] = trim($row[9]) !== '' ? trim($row[9]) : '';

                $data['neumoco1'] = trim($row[12]) !== '' || trim($row[11]) !== '' || trim($row[10]) !== '' ? '1' : '';
                $data['neumoco1_date'] = trim($row[12]) !== '' && trim($row[11]) !== '' && trim($row[10]) !== '' ? get2Date($row[12], $row[11], $row[10]) : '';
                $data['neumoco1_desc'] = trim($row[13]) !== '' ? trim($row[13]) : '';

                $data['neumoco2'] = trim($row[16]) !== '' || trim($row[15]) !== '' || trim($row[14]) !== '' ? '1' : '';
                $data['neumoco2_date'] = trim($row[16]) !== '' && trim($row[15]) !== '' && trim($row[14]) !== '' ? get2Date($row[16], $row[15], $row[14]) : '';
                $data['neumoco2_desc'] = trim($row[17]) !== '' ? trim($row[17]) : '';

                $data['dptc'] = trim($row[20]) !== '' || trim($row[19]) !== '' || trim($row[18]) !== '' ? '1' : '';
                $data['dptc_date'] = trim($row[20]) !== '' && trim($row[19]) !== '' && trim($row[18]) !== '' ? get2Date($row[20], $row[19], $row[18]) : '';
                $data['dptc_desc'] = trim($row[21]) !== '' ? trim($row[21]) : '';

                $data['dptc1'] = '';
                $data['dptc1_date'] = '';
                $data['dptc1_desc'] = '';

                $data['dptc2'] = '';
                $data['dptc2_date'] = '';
                $data['dptc2_desc'] = '';

                $data['dpti1'] = trim($row[24]) !== '' || trim($row[23]) !== '' || trim($row[22]) !== '' ? '1' : '';
                $data['dpti1_date'] = trim($row[24]) !== '' && trim($row[23]) !== '' && trim($row[22]) !== '' ? get2Date($row[24], $row[23], $row[22]) : '';
                $data['dpti1_desc'] = trim($row[25]) !== '' ? trim($row[25]) : '';

                $data['dpti2'] = trim($row[28]) !== '' || trim($row[27]) !== '' || trim($row[26]) !== '' ? '1' : '';
                $data['dpti2_date'] = trim($row[28]) !== '' && trim($row[27]) !== '' && trim($row[26]) !== '' ? get2Date($row[28], $row[27], $row[26]) : '';
                $data['dpti2_desc'] = trim($row[29]) !== '' ? trim($row[29]) : '';

                $data['dpti3'] = trim($row[32]) !== '' || trim($row[31]) !== '' || trim($row[30]) !== '' ? '1' : '';
                $data['dpti3_date'] = trim($row[32]) !== '' && trim($row[31]) !== '' && trim($row[30]) !== '' ? get2Date($row[32], $row[31], $row[30]) : '';
                $data['dpti3_desc'] = trim($row[33]) !== '' ? trim($row[33]) : '';

                $data['influenza'] = trim($row[36]) !== '' || trim($row[35]) !== '' || trim($row[34]) !== '' ? '1' : '';
                $data['influenza_date'] = trim($row[36]) !== '' && trim($row[35]) !== '' && trim($row[34]) !== '' ? get2Date($row[36], $row[35], $row[34]) : '';
                $data['influenza_desc'] = trim($row[37]) !== '' ? trim($row[37]) : '';

                $data['influenza2'] = '';
                $data['influenza2_date'] = '';
                $data['influenza2_desc'] = '';

                $data['influenza3'] = '';
                $data['influenza3_date'] = '';
                $data['influenza3_desc'] = '';

                $data['influenza5'] = '';
                $data['influenza5_date'] = '';
                $data['influenza5_desc'] = '';

                $data['influenza4'] = '';
                $data['influenza4_date'] = '';
                $data['influenza4_desc'] = '';

                $data['influenza5'] = '';
                $data['influenza5_date'] = '';
                $data['influenza5_desc'] = '';

                $data['influenza6'] = '';
                $data['influenza6_date'] = '';
                $data['influenza6_desc'] = '';

                $data['influenza7'] = '';
                $data['influenza7_date'] = '';
                $data['influenza7_desc'] = '';

                $data['influenza8'] = '';
                $data['influenza8_date'] = '';
                $data['influenza8_desc'] = '';

                $data['influenza9'] = '';
                $data['influenza9_date'] = '';
                $data['influenza9_desc'] = '';

                $data['influenza10'] = '';
                $data['influenza10_date'] = '';
                $data['influenza10_desc'] = '';

                $data['influenza11'] = '';
                $data['influenza11_date'] = '';
                $data['influenza11_desc'] = '';

                $data['influenza12'] = '';
                $data['influenza12_date'] = '';
                $data['influenza12_desc'] = '';

                $insert_id = saveElderVaccinatonData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        case 22:
          $update = true;
          $row_count=0;
          $found_count=0;
          foreach ($sheetData as $key=>$row){
            if($key==0){
              if ($row[0] !== 'FOLIO INTERNO' || $row[1] !== '# AFILIADO' || $row[2] !== 'NOMBRE (S)' || 
                  $row[3] !== 'APELLIDO PATERNO' || $row[4] !== 'APELLIDO MATERNO' || $row[5] !== 'SEXO' || 
                  trim($row[6]) !== '1. Espero el futuro con esperanza y entusiasmo' ||
                  trim($row[7]) !== '2. Puedo darme por vencido, renunciar, ya que no puedo hacer mejor las cosas por mí mismo' ||
                  trim($row[8]) !== '3. Cuando las cosas van mal me alivia saber que las cosas no pueden permanecer tiempo así' ||
                  trim($row[9]) !== '4. No puedo imaginar cómo será mi vida en 10 años' ||
                  trim($row[10]) !== '5. Tengo bastante tiempo para poder hacer las cosas que quisiera poder hacer' ||
                  trim($row[11]) !== '6. En el futuro, espero conseguir lo que me pueda interesar' ||
                  trim($row[12]) !== '7. Mi futuro me parece oscuro' ||
                  trim($row[13]) !== '8. Espero más cosas buenas de la vida que lo que la gente suele conseguir por término medio' ||
                  trim($row[14]) !== '9. No logro hacer que las cosas cambien, y no existen razones para creer que pueda en el futuro' ||
                  trim($row[15]) !== '10. Mis pasadas experiencias me han preparado bien para mi futuro' ||
                  trim($row[16]) !== '11. Todo lo que puedo ver por delante de mí es más desagradable que agradable' ||
                  trim($row[17]) !== '12. No espero conseguir lo que realmente deseo' ||
                  trim($row[18]) !== '13. Cuando miro hacia el futuro, espero que seré más feliz de lo que soy ahora' ||
                  trim($row[19]) !== '14. Las cosas no marchan como yo quisiera' ||
                  trim($row[20]) !== '15. Tengo una gran confianza en el futuro' ||
                  trim($row[21]) !== '16. Nunca consigo lo que deseo, por lo que es absurdo desear cualquier cosa' ||
                  trim($row[22]) !== '17. Es muy improbable que pueda lograr una satisfacción real en el futuro' ||
                  trim($row[23]) !== '18. El futuro me parece vago e incierto' ||
                  trim($row[24]) !== '19. Espero más bien épocas buenas que malas' ||
                  trim($row[25]) !== '20. No merece la pena que intente conseguir algo que desee, porque probablemente no lo lograré'
              ){
                $update = false;
                $response->success = false;
                $response->message = 'Esté no parece ser el archivo correcto.';
                break;
              } else {
                resetFormData($linkDB, $id_data);
              }
            }
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();

                $data['invoice'] = trim($row[0]) !== '' ? trim($row[0]) : 'NULL';
                $data['affiliation_number'] = trim($row[1]);
                $data['name'] = trim($row[2]);
                $data['first_lastname'] = trim($row[3]);
                $data['second_lastname'] = trim($row[4]);
                $data['gender'] = trim($row[5]);

                $found = searchPatientByName($linkDB, $data);
                $data['id_patient'] = $found !== 0 ? $found : -1;

                $data['hope'] = trim($row[6]) !== '' ? (substr($row[6], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['renounce'] = trim($row[7]) !== '' ? (substr($row[7], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['relief'] = trim($row[8]) !== '' ? (substr($row[8], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['imagine'] = trim($row[9]) !== '' ? (substr($row[9], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['have_time'] = trim($row[10]) !== '' ? (substr($row[10], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['future'] = trim($row[11]) !== '' ? (substr($row[11], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['dark_future'] = trim($row[12]) !== '' ? (substr($row[12], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['expect_good'] = trim($row[13]) !== '' ? (substr($row[13], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['cant_change'] = trim($row[14]) !== '' ? (substr($row[14], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['experiences'] = trim($row[15]) !== '' ? (substr($row[15], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['unpleasant_future'] = trim($row[16]) !== '' ? (substr($row[16], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['expect_anything'] = trim($row[17]) !== '' ? (substr($row[17], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['happy_future'] = trim($row[18]) !== '' ? (substr($row[18], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['things_wrong'] = trim($row[19]) !== '' ? (substr($row[19], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['expect_future'] = trim($row[20]) !== '' ? (substr($row[20], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['not_want'] = trim($row[21]) !== '' ? (substr($row[21], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['satisfaction'] = trim($row[22]) !== '' ? (substr($row[22], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['uncertain_future'] = trim($row[23]) !== '' ? (substr($row[23], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['good_times'] = trim($row[24]) !== '' ? (substr($row[24], 0, 1) == '0' ? '1' : NULL ) : NULL;
                $data['dont_try'] = trim($row[25]) !== '' ? (substr($row[25], 0, 1) == '0' ? '1' : NULL ) : NULL;
                
                $insert_id = saveHopelessData($linkDB, "INSERT", $data, 1);
                saveLoadData($linkDB, $id_data, $insert_id, ($found == 0 ? $found : 1), $data);

                ++$row_count;
                if ($found !== 0){
                  ++$found_count;
                }
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, $found_count, 0, $row_count, 1);
            $linkDB->commit();
          }
          break;
        default:
          $response->success = false;
          $response->message = 'Modulo no configurado para carga.';
          break;
      }
    } catch (Throwable $e) {
      $linkDB->rollback();
      $response->success = false;
      $response->message = $e->getMessage();
    }

  } else{
    $response->success = false;
    $response->message = 'Only .xls or .xlsx file allowed';
  }
} else {
  $response->success = false;
  $response->message = 'Please Send a File';
}

echo json_encode($response);

?>