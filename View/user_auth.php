<?php
	session_start();
	if (!isset($_SESSION['loggedin'])) {
		header('Location: login.php');
		exit();
	}
	else if ($_SESSION['id_role'] > 2) {
        header('Location: error.php');
        exit();
    }
?>
