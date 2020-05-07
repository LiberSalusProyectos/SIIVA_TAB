<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

require __DIR__ . '/../Header.php';

//$inputFileName = __DIR__ . '/sampleData/ISSET1666.xlsx';
$inputFileName = __DIR__ . '/sampleData/modulo1.xlsx';
$helper->log('Loading file ' . pathinfo($inputFileName, PATHINFO_BASENAME) . ' using IOFactory to identify the format');

$spreadsheet = IOFactory::load($inputFileName);
$spreadsheet->setActiveSheetIndex(0);
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//var_dump($sheetData);

$tope = sizeof($sheetData);
echo("Tope Hoja: ".$tope."<br/>");
$inicio = 4;
$tope = sizeof($sheetData);
$y=0;
$filas_netas = 0;
// Después de 4 filas vacias consecutivas, se rompe la iteración.
$ruptura= 0;

$tope = 14;


for ($i=$inicio; $i < $tope; $i++) {
	$y++;
	//var_dump($sheetData[$i]["A"]);
	////var_dump($sheetData[$i]["B"].$sheetData[$i]["C"].$sheetData[$i]["D"]);
	//var_dump($sheetData[$i]["E"]);
	//var_dump($sheetData[$i]["F"]);


	if (is_null($sheetData[$i]["A"]) && is_null($sheetData[$i]["E"]) && is_null($sheetData[$i]["F"])) {
		$ruptura++;
		if ($ruptura==4) {
			break;
		}
	}else{
		echo "Folio Interno: ".$sheetData[$i]["A"]." | ".$sheetData[$i]["B"]." | ".$sheetData[$i]["C"]." ".$sheetData[$i]["D"]." ".$sheetData[$i]["E"]." "." | ".$sheetData[$i]["F"]."<br/>";
		$ruptura = 0;
		$filas_netas++;
	}

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
/*
		$apP   = $sheetData[$i]["B"];
		$apM   = $sheetData[$i]["C"];
		$nom   = $sheetData[$i]["D"];
		$edad  = $sheetData[$i]["E"];
		$sexo  = $sheetData[$i]["F"];
		$numA  = $sheetData[$i]["G"];
		$calle = $sheetData[$i]["H"];
		$numEx = $sheetData[$i]["I"];
		$numIn = $sheetData[$i]["J"];
		$col   = $sheetData[$i]["K"];
		$cp    = $sheetData[$i]["L"];
		$mun   = $sheetData[$i]["M"];
		$edo   = $sheetData[$i]["N"];

		$num_limpio = explode("/", $numA);
		$num_limpio = explode("-", $num_limpio[0]);
		$num_limpio = explode(" ", $num_limpio[0]);
		$num_limpio = $num_limpio[0];
			echo "<br/>($y, '$num_limpio', '$numA', 1, '$nom', '$apP', '$apM', NULL, $edad, NULL, NULL, '$sexo', '', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";


		if ($sheetData[$i]["O"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["O"];
			$sexo = $sheetData[$i]["P"];
			$parentesco = $sheetData[$i]["Q"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apP = $nom_Temp[0];
			$apM = $nom_Temp[1];
			$nom = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nom .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nom', '$apP', '$apM', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["R"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["R"];
			$sexo = $sheetData[$i]["S"];
			$parentesco = $sheetData[$i]["T"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apP = $nom_Temp[0];
			$apM = $nom_Temp[1];
			$nom = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nom .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nom', '$apP', '$apM', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["U"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["U"];
			$sexo = $sheetData[$i]["V"];
			$parentesco = $sheetData[$i]["W"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apP = $nom_Temp[0];
			$apM = $nom_Temp[1];
			$nom = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nom .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nom', '$apP', '$apM', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["X"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["X"];
			$sexo = $sheetData[$i]["Y"];
			$parentesco = $sheetData[$i]["Z"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apP = $nom_Temp[0];
			$apM = $nom_Temp[1];
			$nom = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nom .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nom', '$apP', '$apM', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["AA"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["AA"];
			$sexo = $sheetData[$i]["AB"];
			$parentesco = $sheetData[$i]["AC"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apP = $nom_Temp[0];
			$apM = $nom_Temp[1];
			$nom = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nom .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nom', '$apP', '$apM', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["AD"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["AD"];
			$sexo = $sheetData[$i]["AE"];
			$parentesco = $sheetData[$i]["AF"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apP = $nom_Temp[0];
			$apM = $nom_Temp[1];
			$nom = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nom .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nom', '$apP', '$apM', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["AG"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["AG"];
			$sexo = $sheetData[$i]["AH"];
			$parentesco = $sheetData[$i]["AI"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apP = $nom_Temp[0];
			$apM = $nom_Temp[1];
			$nom = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nom .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nom', '$apP', '$apM', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}


		if ($sheetData[$i]["AJ"]!="") {
			$y++;
			$nomCompleto = $sheetData[$i]["AJ"];
			$sexo = $sheetData[$i]["AK"];
			$parentesco = $sheetData[$i]["AL"];
			$nom_Temp = explode(" ", $nomCompleto);
			$apP = $nom_Temp[0];
			$apM = $nom_Temp[1];
			$nom = "";
			if(sizeof($nom_Temp)>2)
				for ($x=2; $x < sizeof($nom_Temp); $x++) {
					$nom .= $nom_Temp[$x]." ";
				}

			echo "<br/>($y, '$num_limpio', '$numA', 0, '$nom', '$apP', '$apM', NULL, NULL, NULL, NULL, '$sexo', '$parentesco', NULL, '$num_limpio', '$calle', '$numEx', '$numIn', '$col', '$mun', '$cp', '$edo'),";

		}*/

	// Los campos hasya el índice N son estandar
}

echo "Filas netas: ".$filas_netas;
 ?>