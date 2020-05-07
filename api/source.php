<?php

if(isset($_POST['action'])){
	$action = $_POST['action'];

	switch ($action) {
		case 'prueba':
			prueba();
			break;

		default:
			# code...
			break;
	}
}


function prueba(){
	include("loadScript/01_antecedentes.php");
	include("../ManualLoader/resources/phpExcel/vendor/phpoffice/phpspreadsheet/samples/LSReader/modulo_1.php");
}


//usuarios
include("../ManualLoader/resources/phpExcel/vendor/phpoffice/phpspreadsheet/samples/LSReader/users_loader.php");

//módulo 1
//include("../ManualLoader/resources/phpExcel/vendor/phpoffice/phpspreadsheet/samples/LSReader/modulo_1.php");

 ?>