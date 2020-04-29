<?php
	ini_set("session.cookie_lifetime", 7200);
	ini_set("session.gc_maxlifetime", 7200);
	ini_set("display_errors", 1);
	ini_set("session.use_cookies", 1);
	setlocale(LC_ALL, "es_ES");

	error_reporting(E_ALL & ~E_NOTICE); //Mostrar errores PHP


	$servername = "localhost";
	$db 		= "siivat";
	$username 	= "root";
	$password	= "";


	$linkDB = mysqli_connect($servername, $username, $password, $db);

	if ($linkDB->connect_error) {
	    die("Connection failed: " . $linkDB->connect_error);
	}

	/* comprobar la conexión */
	if (mysqli_connect_errno()) {
	    printf("Falló la conexión: %s\n", mysqli_connect_error());
	    exit();
	}
?>