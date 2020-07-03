<?php

include_once("Controller/resources.php");

$form = filter_var($_GET["form"], FILTER_SANITIZE_NUMBER_INT);
$response = getDataEstadistic($linkDB, $form);

echo json_encode(convert_from_latin1_to_utf8_recursively($response));

?>