<?php
//include_once("../../../Model/queries.php");
//include_once("../../../../../../../../Controller/resources.php");

use PhpOffice\PhpSpreadsheet\IOFactory;

require __DIR__ . '/../Header.php';

$inputFileName = __DIR__ . '/sampleData/BASEfinal.xlsx';
$helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory to identify the format');
$spreadsheet = IOFactory::load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

$limiteSuperior = sizeof($sheetData);
echo "<pre>";
var_dump($sheetData);
echo "</pre>";

$limiteSuperior = 5;

$fila=0;
$inicio = 2;

for ($i=$inicio; $i < $limiteSuperior; $i++) {
	$fila++;

	$folioFamiliar  		= $sheetData[$i]["A"];
	$numAfiliacion  		= $sheetData[$i]["B"];
	$numAfiliacionAlterno   = $sheetData[$i]["C"];
	$disponibilidadVisita   = $sheetData[$i]["D"];
	$ausenciaLaboral 		= $sheetData[$i]["E"];
	$nombre   				= $sheetData[$i]["F"];
	$apPaterno   			= $sheetData[$i]["G"];
	$apMaterno   			= $sheetData[$i]["H"];
	$fechaNacimiento  		= $sheetData[$i]["I"];
	$edad  					= $sheetData[$i]["J"];
	$anioNacimiento  		= 2020 - (int)$edad;
	$sexo  					= $sheetData[$i]["K"];
	$parentesco  			= $sheetData[$i]["L"];
	$calle 					= $sheetData[$i]["M"];
	$numEx 					= $sheetData[$i]["N"];
	$numIn 					= $sheetData[$i]["O"];
	$col   					= $sheetData[$i]["P"];
	$mun   					= $sheetData[$i]["Q"];
	$cp    					= $sheetData[$i]["M"];
	$edo   					= $sheetData[$i]["S"];
	$patologias   			= $sheetData[$i]["T"];
	$lugarLaboral   		= $sheetData[$i]["U"];
	$turnoLaboral   		= $sheetData[$i]["V"];
	$telefono   			= $sheetData[$i]["W"];
	$numAfiliados  			= $sheetData[$i]["X"];
	$ocupacion   			= $sheetData[$i]["Y"];


	//Declaración de validaciones según la columna del campo.
		//COLUMNA A - Se valida para tener un alto en la lectura del documento.
		if (strlen($folioFamiliar)==0) {
			echo "<br/>Folio Familiar faltante. <br/>";
			break;
		}


		//Categorización en trabajador o afiliado según su grado de parentesco. Con el motivo de eliminar la variación por espacios, se eliminan de la cadena a comparar.
		$parentesco = str_replace(' ', '', $parentesco);

		if ($parentesco=='TRABAJADOR') {
			$afiliado = 1;
		}else {
			$afiliado = 0;
		}


		//Para el registro del número de afiliación se procede a retirar los elementos adicionales al número de indicador debido a la irregularidad de las claves.
		$num_limpio = explode("/", $numAfiliacion);
		$num_limpio = explode("-", $num_limpio[0]);
		$num_limpio = explode(" ", $num_limpio[0]);
		$num_limpio = $num_limpio[0];
		$terminacion = "";


		//Para la definición del complemento del número de afilición se toman de referencia las terminaciones compartidas por el equipo de ISSET, se complementan ciertos casos que son inferibles como Hija o conyuge.
		switch ($parentesco) {

			case 'TRABAJADOR':    $terminacion = "/A";	break;
			case 'CONCUBINA':     $terminacion = "/C";	break;
			case 'ESPOSA': 		  $terminacion = "/E";	break;
			case 'HIJO': 		  $terminacion = "/H";	break;
			case 'HIJA': 		  $terminacion = "/H";	break;
			case 'INCAPACITADO':  $terminacion = "/I";	break;
			case 'JUBILADO': 	  $terminacion = "/J";	break;
			case 'LISTA DE RAYA': $terminacion = "/LR";	break;
			case 'MADRE': 		  $terminacion = "/M";	break;
			case 'PENSIONADO':	  $terminacion = "/N";	break;
			case 'PADRE': 		  $terminacion = "/P";	break;
			case 'ESPOSO': 		  $terminacion = "/O";	break;

			case 'CONYUGE': 	  $sexo=='MASCULINO' ? $terminacion = "/0" : $terminacion = "/E";	break;

			default:			  $terminacion = "/";	break;
		}

		$numAfiliacionAlterno = $terminacion;


		//
		if (strlen($fechaNacimiento)==0) {
			$fechaNacimiento = 'NULL';
		}else {
			$fechaNacimiento = "'".$fechaNacimiento."'";
		}



/*
"(
	//idÍndice | affiliationNumber | affiliationNumber_d | autoAffiliationNumber | affiliate | affiliatesNumber
	$fila, '$num_limpio', '$numAfiliacion', '$numAfiliacionAlterno', $afiliado, '$numAfiliados',

	//name | name_ | firstLastName | firstLastName_ | secondLastName
	'$nombre', NULL, '$apPaterno', NULL, '$apMaterno',

	//secondLastName_ | birthdate | age | birthYear | curp
	NULL, $fechaNacimiento, $edad, $anioNacimiento, NULL,

	//salusId | genre | genre_ | familyRole | familyRole_
	NULL, '$sexo', NULL, '$parentesco', NULL,

	//familyID | familiyReference | phone_number | calle | calle_
	$folioFamiliar, '$num_limpio','$telefono', '$calle', NULL,

	//no_ext | no_ext_ | no_int | no_int_ | colonia
	'$numEx', NULL, '$numIn', NULL, '$col',

	//colonia_ | municipio | municipio_ | codigo_postal | codigo_postal_
	NULL, '$mun', NULL, '$cp', NULL,

	//estado | address_reference | family_atmosphere | health_problems | occupation
	'$edo',NULL, NULL, '$patologias', '$ocupacion',

	//workPlace | workShift | visitAvailability | workPermit | capturist
	'$lugarLaboral', '$turnoLaboral', '$disponibilidadVisita', '$ausenciaLaboral', 0,

	//updated_at
	NULL),"
*/



		echo htmlspecialchars("(
				 $fila, '$num_limpio', '$numAfiliacion', '$numAfiliacionAlterno', $afiliado, '$numAfiliados',
				 '$nombre', NULL, '$apPaterno', NULL, '$apMaterno', NULL,
				 $fechaNacimiento, $edad, $anioNacimiento, NULL, NULL, '$sexo', NULL,
				 '$parentesco', NULL, $folioFamiliar, '$num_limpio',
				 '$telefono',
				 '$calle', NULL, '$numEx', NULL, '$numIn', NULL, '$col', NULL,
				 '$mun', NULL, '$cp', NULL, '$edo',
				 NULL, NULL, '$patologias',
				 '$ocupacion', '$lugarLaboral', '$turnoLaboral', '$disponibilidadVisita', '$ausenciaLaboral',
				  0, NULL),")."<br>";

}
?>