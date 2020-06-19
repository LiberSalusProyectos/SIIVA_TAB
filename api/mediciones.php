<?php

include_once("Controller/resources.php");

$query = htmlspecialchars($_GET["municipio"]);

switch($query){
  case 'zapata':
    $municipio = 'EMILIANO ZAPATA';
    break;
  case 'jalpa':
    $municipio = 'JALPA DE MENDEZ';
    break; 
  case 'total':
    $municipio = '';
    break;
  default:
    $municipio = strtoupper($query);
    break;
}

$response = getDetailByTownshipData($linkDB, $municipio)[0];

echo json_encode($response);

?>