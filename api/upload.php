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
          $row_count=0;
          foreach ($sheetData as $key=>$row){
            if($key>2){
              if(trim($row[2]) !== '' && trim($row[3]) !== ''){
                $data = array();
                $data['id_patient'] = -1;
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
                
                saveGeriatricDepressionData($linkDB, "INSERT", $data, 0);
                ++$row_count;
              }
            }
          }
          saveUpdateData($linkDB, $id_data, $row_count, 0, 0, $row_count, 1);
          $linkDB->commit();
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