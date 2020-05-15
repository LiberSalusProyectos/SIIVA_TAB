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
        case 4:
          $update = true;
          $row_count=0;
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

                $data['invoice'] = trim($row[0]);
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
              }
            }
          }
          if($update){
            saveUpdateData($linkDB, $id_data, $row_count, 0, 0, $row_count, 1);
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