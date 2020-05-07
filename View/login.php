<?php include_once("Controller/resources.php"); 

if (isset($_POST) && sizeof($_POST)>0) {

	$result = userAuthentication($linkDB, $_POST["email"], md5($_POST["password"]));

	if ($result) {
		switch ($_SESSION['id_role']) {
			case 1:
				header('Location: admin.php'); exit;
				break;
			case 2:
				header('Location: user.php'); exit;
				break;
			case 3:
				header('Location: index.php'); exit;
				break;
			default:
				header('Location: index.php'); exit;
				break;
		}
	}

}


//echo "<pre>";
//var_dump($_SESSION);
//echo "</pre>";

 ?>



<!DOCTYPE html>
<html lang="en">

	<head>
		<?php include("header_references.php"); ?>
	</head>

	<body id="bootstrap_overrides">
		<noscript>You need to enable JavaScript to run this app.</noscript>
		<!--form onSubmit={this.onSubmit}-->
		<form action="login.php" method="POST">
		    <h1 class="custom-title text-royal-blue bold-font">Iniciar Sesión</h1>
		    <table id="tablaFormReg">
				<tbody>
					<tr>
						<td>
							<input name="email" type="text" class="input-box custom-input" placeholder="Usuario/Correo electrónico"  required />
						</td>
					</tr>
					<tr>
						<td>
							<input name="password" type="password" class="input-box custom-input" placeholder="Contraseña" required  />
						</td>
					</tr>
					<tr>
						<td>
							<button class="btn btn-center custom-btn-signin text-white bold-font" type="submit">
							  Iniciar Sesión
							</button>
							<!--button class="btn btn-center custom-btn-signin text-white bold-font" disabled={isInvalid} type="submit">
							  Iniciar Sesión
							</button-->
						</td>
					</tr>
				</tbody>
		    </table>
		</form>
	</body>
</html>