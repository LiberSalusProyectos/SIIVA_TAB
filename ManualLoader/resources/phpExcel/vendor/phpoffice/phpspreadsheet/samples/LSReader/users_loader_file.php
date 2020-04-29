<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require __DIR__ . '/../Header.php';

$inputFileName = __DIR__ . '/sampleData/BASEfinal.xlsx';
$helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory to identify the format');
$spreadsheet = IOFactory::load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

$helper->log('Create new Spreadsheet object');
$newSpreadsheet = new Spreadsheet();

$helper->log('Set document properties');
$newSpreadsheet->getProperties()->setCreator('Liber Salus')
    ->setLastModifiedBy('Miguel Segura');

// Create the worksheet
$helper->log('Add data');
$newSpreadsheet->setActiveSheetIndex(0);
$newSpreadsheet->getActiveSheet();


$limiteSuperior = sizeof($sheetData);

$limiteSuperior = 22;

$fila=0;
$inicio = 1;

for ($i=$inicio; $i < $limiteSuperior; $i++) {
	$fila++;

	for ($y=0; $y < 26 ; $y++) {
		//Evalua criterio

		$cell_reference = getCol($y).$i;
		//echo $cell_reference;

		switch ($y) {
			case '0':
					$folioFamiliar = $sheetData[$i]["A"];

					if (strlen($folioFamiliar) > 0) {
        				$newSpreadsheet->getActiveSheet()->getStyle($cell_reference)->getFill()->getStartColor()->setARGB('ff0000');
					}
				break;

			default:
				# code...
				break;
		}


		//Pinta según criterio
		//$newSpreadsheet->getActiveSheet()->getStyle($cell_reference)->getFont()->setBold(true);
        //$newSpreadsheet->getActiveSheet()->getStyle($cell_reference)->getFill()->getStartColor()->setARGB('FF0000');

	}

	//Escribe todo el arreglo.
		$newSpreadsheet->getActiveSheet()->fromArray($sheetData[$i], null, 'A'.$i);


}

$dataArray = [
    ['2010', 'Q1', 'United States', 790],
    ['2010', 'Q2', 'United States', 730],
    ['2010', 'Q3', 'United States', 860],
    ['2010', 'Q4', 'United States', 850],
];

//$dataArray = $sheetData;

//$newSpreadsheet->getActiveSheet()->fromArray($dataArray, null, 'A1');

// Set title row bold
$helper->log('Set title row bold');
$newSpreadsheet->getActiveSheet()->getStyle('A1:Z1')->getFont()->setBold(true);

// Set autofilter
$helper->log('Set autofilter');
// Always include the complete filter range!
// Excel does support setting only the caption
// row, but that's not a best practise...
$newSpreadsheet->getActiveSheet()->setAutoFilter($newSpreadsheet->getActiveSheet()->calculateWorksheetDimension());

// Save
$helper->write($newSpreadsheet, __FILE__);


$sheetData = [];

$tope = sizeof($sheetData);
//$tope = 10;
$y=0;
for ($i=4; $i < $tope; $i++) {
	$y++;
	/*
	echo("A:".$sheetData[$i]["A"]." <br/>");
	echo("B:".$sheetData[$i]["B"]." <br/>");
	echo("C:".$sheetData[$i]["C"]." <br/>");
	echo("D:".$sheetData[$i]["D"]." <br/>");
	echo("E:".$sheetData[$i]["E"]." <br/>");
	echo("F:".$sheetData[$i]["F"]." <br/>");
	echo("G:".$sheetData[$i]["G"]." <br/>");
	echo("H:".$sheetData[$i]["H"]." <br/>");
	echo("I:".$sheetData[$i]["I"]." <br/>");
	echo("J:".$sheetData[$i]["J"]." <br/>");
	echo("K:".$sheetData[$i]["K"]." <br/>");
	echo("L:".$sheetData[$i]["L"]." <br/>");
	echo("M:".$sheetData[$i]["M"]." <br/>");
	echo("N:".$sheetData[$i]["N"]." <br/>");
	echo("O:".$sheetData[$i]["O"]." <br/>");*/
	//echo "<br/>";
		$folioFamiliar  		= $sheetData[$i]["A"];
		$numAfiliacion  		= $sheetData[$i]["B"];
		$numAfiliacionAlterno   = $sheetData[$i]["C"];
		$horariosDisponibilidad = $sheetData[$i]["D"];
		$ausenciaLaboral 		= $sheetData[$i]["E"];
		$nombre   				= $sheetData[$i]["F"];
		$apPaterno   			= $sheetData[$i]["G"];
		$apMaterno   			= $sheetData[$i]["H"];
		$fechaNacimiento  		= $sheetData[$i]["I"];
		$edad  					= $sheetData[$i]["J"];
		$anioNacimiento  		= 2020 - $edad;
		$sexo  					= $sheetData[$i]["K"];
		$parentesco  			= $sheetData[$i]["L"];
		$calle 					= $sheetData[$i]["M"];
		$numEx 					= $sheetData[$i]["N"];
		$numIn 					= $sheetData[$i]["O"];
		$col   					= $sheetData[$i]["P"];
		$mun   					= $sheetData[$i]["Q"];
		$cp    					= $sheetData[$i]["M"];
		$edo   					= $sheetData[$i]["S"];
		$patoogias   			= $sheetData[$i]["T"];
		$lugarLaboral   		= $sheetData[$i]["U"];
		$turnoLaboral   		= $sheetData[$i]["V"];
		$telefono   			= $sheetData[$i]["W"];
		$afiliado   			= $sheetData[$i]["X"];
		$ocupacion   			= $sheetData[$i]["Y"];

		//$newSpreadsheet->getActiveSheet()->fromArray($dataArray, null, 'A1');


/*
		$num_limpio = explode("/", $numA);
		$num_limpio = explode("-", $num_limpio[0]);
		$num_limpio = explode(" ", $num_limpio[0]);
		$num_limpio = $num_limpio[0];
			echo "<br/>($y, '$num_limpio', '$numA', 1, '$nombre', '$apPaterno', '$apMaterno', NULL, $edad, NULL, NULL, '$sexo', '', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";


		if ($sheetData[$i]["O"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["O"];
			$sexo = $sheetData[$i]["P"];
			$parentesco = $sheetData[$i]["Q"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apPaterno = $nom_Temp[0];
			$apMaterno = $nom_Temp[1];
			$nombre = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nombre .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nombre', '$apPaterno', '$apMaterno', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["R"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["R"];
			$sexo = $sheetData[$i]["S"];
			$parentesco = $sheetData[$i]["T"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apPaterno = $nom_Temp[0];
			$apMaterno = $nom_Temp[1];
			$nombre = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nombre .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nombre', '$apPaterno', '$apMaterno', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["U"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["U"];
			$sexo = $sheetData[$i]["V"];
			$parentesco = $sheetData[$i]["W"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apPaterno = $nom_Temp[0];
			$apMaterno = $nom_Temp[1];
			$nombre = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nombre .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nombre', '$apPaterno', '$apMaterno', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["X"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["X"];
			$sexo = $sheetData[$i]["Y"];
			$parentesco = $sheetData[$i]["Z"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apPaterno = $nom_Temp[0];
			$apMaterno = $nom_Temp[1];
			$nombre = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nombre .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nombre', '$apPaterno', '$apMaterno', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["AA"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["AA"];
			$sexo = $sheetData[$i]["AB"];
			$parentesco = $sheetData[$i]["AC"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apPaterno = $nom_Temp[0];
			$apMaterno = $nom_Temp[1];
			$nombre = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nombre .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nombre', '$apPaterno', '$apMaterno', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["AD"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["AD"];
			$sexo = $sheetData[$i]["AE"];
			$parentesco = $sheetData[$i]["AF"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apPaterno = $nom_Temp[0];
			$apMaterno = $nom_Temp[1];
			$nombre = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nombre .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nombre', '$apPaterno', '$apMaterno', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["AG"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["AG"];
			$sexo = $sheetData[$i]["AH"];
			$parentesco = $sheetData[$i]["AI"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apPaterno = $nom_Temp[0];
			$apMaterno = $nom_Temp[1];
			$nombre = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nombre .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nombre', '$apPaterno', '$apMaterno', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["AJ"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["AJ"];
			$sexo = $sheetData[$i]["AK"];
			$parentesco = $sheetData[$i]["AL"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apPaterno = $nom_Temp[0];
			$apMaterno = $nom_Temp[1];
			$nombre = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nombre .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nombre', '$apPaterno', '$apMaterno', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}*/

	// Los campos hasya el índice N son estandar
}


function getCol($index){
	$columns = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK","AL","AM","AN","AO","AP","AQ","AR","AS","AT","AU","AV","AW","AX","AY","AZ","BA","BB","BC","BD","BE","BF","BG","BH"];

	return $columns[$index];
}



 ?>