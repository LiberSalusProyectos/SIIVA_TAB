<?php
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
                $element->municipip = trim($row[16]);
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

                $data['hypertension'] = trim($row[24]) !== '' ? (substr($row[24], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['diabetes'] = trim($row[25]) !== '' ? (substr($row[25], 0, 1) == 'X' ? '1' : '0' ) : NULL;

                $data['heart_attack'] = trim($row[26]) !== '' ? (substr($row[26], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['cardiac_arrhythmia'] = trim($row[27]) !== '' ? (substr($row[27], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['heart_failure'] = trim($row[28]) !== '' ? (substr($row[28], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['heart_other'] = trim($row[29]) !== '' ? '1' : NULL;
                $data['heart_other_desc'] = trim($row[29]) !== '' ? $row[29] : NULL;

                $data['asthma'] = trim($row[30]) !== '' ? (substr($row[30], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['obesity'] = trim($row[31]) !== '' ? (substr($row[31], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['dyslipidemia'] = trim($row[32]) !== '' ? strtolower(substr($row[32], 0, 1)) : NULL;

                $data['breast_cancer'] = trim($row[33]) !== '' ? (substr($row[33], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['cervical_cancer'] = trim($row[34]) !== '' ? (substr($row[34], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['prostate_cancer'] = trim($row[35]) !== '' ? (substr($row[35], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['leukemia'] = trim($row[36]) !== '' ? (substr($row[36], 0, 1) == 'X' ? '1' : '0' ) : NULL; //Falta agregar este campo
                $data['cancer_other'] = trim($row[37]) !== '' ? '1' : NULL;
                $data['cancer_other_desc'] = trim($row[37]) !== '' ? $row[37] : NULL;

                $data['anxiety_depression'] = trim($row[38]) !== '' ? (substr($row[38], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['eating_disorders'] = trim($row[39]) !== '' ? (substr($row[39], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['schizophrenia'] = trim($row[40]) !== '' ? (substr($row[40], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['psychiatric_other'] = trim($row[41]) !== '' ? '1' : NULL;
                $data['psychiatric_other_desc'] = trim($row[41]) !== '' ? $row[41] : NULL;

                $data['glaucoma'] = trim($row[42]) !== '' ? (substr($row[42], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['ametropia'] = trim($row[43]) !== '' ? (substr($row[43], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['waterfalls'] = trim($row[44]) !== '' ? (substr($row[44], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['eye_other'] = trim($row[45]) !== '' ? '1' : NULL;
                $data['eye_other_desc'] = trim($row[45]) !== '' ? $row[45] : NULL;

                $data['hyperthyroidism'] = trim($row[46]) !== '' ? (substr($row[46], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['hypothyroidism'] = trim($row[47]) !== '' ? (substr($row[47], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['cushing'] = trim($row[48]) !== '' ? (substr($row[48], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['endocrine_other'] = trim($row[49]) !== '' ? '1' : NULL;
                $data['endocrine_other_desc'] = trim($row[49]) !== '' ? $row[49] : NULL;

                $data['preeclampsia'] = trim($row[50]) !== '' ? (substr($row[50], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['cystic_ovary'] = trim($row[51]) !== '' ? (substr($row[51], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['gestational_diabetes'] = trim($row[52]) !== '' ? (substr($row[52], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['gynecological_other'] = trim($row[53]) !== '' ? '1' : NULL;
                $data['gynecological_other_desc'] = trim($row[53]) !== '' ? $row[53] : NULL;

                $data['parkinson'] = trim($row[54]) !== '' ? (substr($row[54], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['epilepsy'] = trim($row[55]) !== '' ? (substr($row[55], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['alzheimer'] = trim($row[56]) !== '' ? (substr($row[56], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['neurological_other'] = trim($row[57]) !== '' ? '1' : NULL;
                $data['neurological_other_desc'] = trim($row[57]) !== '' ? $row[57] : NULL;

                $data['tuberculosis'] = trim($row[58]) !== '' ? (substr($row[58], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['sida'] = trim($row[59]) !== '' ? (substr($row[59], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['syphilis'] = trim($row[60]) !== '' ? (substr($row[60], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['infectious_other'] = trim($row[61]) !== '' ? '1' : NULL;
                $data['infectious_other_desc'] = trim($row[61]) !== '' ? $row[61] : NULL;

                $data['down_syndrome'] = trim($row[62]) !== '' ? (substr($row[62], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['cretinism_acromegaly'] = trim($row[63]) !== '' ? (substr($row[63], 0, 1) == 'X' ? '1' : '0' ) : NULL;
                $data['hemophilia'] = trim($row[64]) !== '' ? (substr($row[64], 0, 1) == 'X' ? '1' : '0' ) : NULL;
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

                $data['satisfied'] = trim($row[6]) !== '' ? (substr($row[6], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['giveup_hobby'] = trim($row[7]) !== '' ? (substr($row[7], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['empty_life'] = trim($row[8]) !== '' ? (substr($row[8], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['boredom'] = trim($row[9]) !== '' ? (substr($row[9], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['optimism'] = trim($row[10]) !== '' ? (substr($row[10], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['fear'] = trim($row[11]) !== '' ? (substr($row[11], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['happiness'] = trim($row[12]) !== '' ? (substr($row[12], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['abandonment'] = trim($row[13]) !== '' ? (substr($row[13], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['at_home'] = trim($row[14]) !== '' ? (substr($row[14], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['memory_loss'] = trim($row[15]) !== '' ? (substr($row[15], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['love_forlife'] = trim($row[16]) !== '' ? (substr($row[16], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['start_difficult'] = trim($row[17]) !== '' ? (substr($row[17], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['full_energy'] = trim($row[18]) !== '' ? (substr($row[18], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['anxiety'] = trim($row[19]) !== '' ? (substr($row[19], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['economy'] = trim($row[20]) !== '' ? (substr($row[20], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                
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
                $data['safe_sex'] = trim($row[9]) !== '' ? (substr($row[9], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['contraceptives'] = trim($row[10]) !== '' ? (substr($row[10], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['condom'] = trim($row[11]) !== '' ? (substr($row[11], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['intercourse'] = trim($row[12]) !== '' ? (substr($row[12], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['ets_exposed'] = trim($row[13]) !== '' ? (substr($row[13], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['medical_treatment'] = trim($row[14]) !== '' ? (substr($row[14], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['vih_test'] = trim($row[15]) !== '' ? (substr($row[15], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['pap_smear'] = trim($row[16]) !== '' ? (substr($row[16], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['pap_smear_result'] = trim($row[17]);
                $data['knowledge'] = trim($row[18]);
                $data['ways_transmit'] = trim($row[19]) !== '' ? (substr($row[19], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['talks'] = trim($row[20]) !== '' ? (substr($row[20], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['vih_symptom'] = trim($row[21]) !== '' ? (substr($row[21], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['vih_clinic'] = trim($row[22]) !== '' ? (substr($row[22], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                
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

                $data['suffer_from'] = trim($row[6]) !== '' ? (substr($row[6], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['thirsty'] = trim($row[7]) !== '' ? (substr($row[7], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['urinate'] = trim($row[8]) !== '' ? (substr($row[8], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['lose_weight'] = trim($row[9]) !== '' ? (substr($row[9], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['over_eat'] = trim($row[10]) !== '' ? (substr($row[10], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['glucose_check'] = trim($row[11]) !== '' ? (substr($row[11], 0, 1) == 'a' ? '1' : '0' ) : NULL;
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

                $data['heart_attack'] = trim($row[6]) !== '' ? (substr($row[6], 0, 1) == 'a' ? '1' : '0' ) : NULL;
                $data['family'] = trim($row[7]) !== '' ? (substr($row[7], 0, 1) == 'a' ? '1' : '0' ) : NULL;
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