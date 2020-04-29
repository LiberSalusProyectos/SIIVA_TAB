	<?php
		session_start();
		if (!isset($_SESSION['loggedin'])) {
		header('Location: login.php');
		exit();
		}
	?>
	<meta charset="utf-8" />
		<link rel="shortcut icon" type="image/png" href="View/assets/img/ico.png" />

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="theme-color" content="#000000" />

		<link rel="manifest" href="View/assets/js/manifest.json" />

		<title>SIIVA ISSET</title>
		<!--script src="https://code.jquery.com/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script-->
		<script src="View/assets/js/jquery-3.3.1.min.js"></script>
		
		<!--script src="View/assets/js/jquery-3.3.1.min.js"
		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script-->
		<script src="View/assets/js/bootstrap.min.js"></script>

		<!--link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"-->
		<link href="View/assets/css/bootstrap.min.css" rel="stylesheet">

		<!--link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
		integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"-->
		<link rel="stylesheet" href="View/assets/css/all.css">
		
		<link rel="stylesheet" type="text/css" href="View/assets/css/index.css" />

		<!--script type="text/javascript"
	    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script-->
		<script type="text/javascript" src="View/assets/js/bootstrap-datepicker.min.js"></script>
		
		<!--link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" /-->
		<link rel="stylesheet" href="View/assets/css/bootstrap-datepicker3.css" />
		
		<script type="text/javascript" src="View/assets/js/bootstrap-datepicker.es.min.js"></script>

		<script src="View/assets/js/typed.js@2.0.11"></script>
