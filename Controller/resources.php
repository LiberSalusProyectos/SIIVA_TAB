<?php include_once("Model/queries.php");

!defined('FAMILY_RECORD_NAME') && define('FAMILY_RECORD_NAME', 'ANTECEDENTES FAMILIARES');

/**
 * [Función para validar las credenciales de acceso al sistema, por cuestión de facilidad se implementó un MD5 sencillo como método de encryptación]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $email       [Email de registro del usuario]
 * @param  [string] $password    [Contraseña convertida a MD5]
 * @return [bool]             	 [Resultado de la comparación entre credenciales]
 */
function userAuthentication($connection, $email, $password){

	$autenticated = false;

	$result = userAuthentication_DOM($connection, $email, $password);

	if (sizeof($result)>0) {
		echo "Autenticated User";
		$autenticated = true;

		lasConnectionUpdate_DOM($connection, $email, $password);

		session_start();
		$_SESSION['loggedin']  = TRUE;
		$_SESSION['id_user']  = $result[0]["id"];
		$_SESSION['username']  = $result[0]["nombre"];
		$_SESSION['email']  = $result[0]["email"];
		$_SESSION['id_role']  = $result[0]["id_role"];

	}

	return $autenticated;
}


/**
 * [Función para obtener todos los datos de un usuario, para determinada tabla.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getModuleData($connection, $module, $id_patient){

	switch ($module) {
		case "familyRecord":
			$table = "familyrecorddata";
			break;
		default:
			# code...
			break;
	}

	$result = getModuleData_DOM($connection, $table, $id_patient);

	return $result;
}


/**
 * [Listado de pacientes sin registros en el módulo/formulario]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $table       [Nombre de la tabla en la DB]
 * @return [array]               [Listado de pacientes sin registros]
 */
function listPatientsAnswered($connection, $table, $search){
	$result = listPatientsAnswered_DOM($connection, $table, $search);

	return $result;
}


/**
 * [Listado de pacientes con registros en el módulo/formulario]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $table       [Nombre de la tabla en la DB]
 * @return [array]               [Listado de pacientes con registros]
 */
function listPatientsPending($connection, $table, $search){
	$result = listPatientsPending_DOM($connection, $table, $search);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Antecedentes Familiares]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveFamilyRecordData($connection, $method, $data, $id_user){

	$result = saveFamilyRecordData_DOM($connection, $method,
		$data['id_patient'],
		$data['birth_state'],
		$data['birth_place'],
		$data['residence_state'],
		$data['residence_place'],
		($data['hypertension']!="" ? 1 : 0),
		($data['diabetes']!="" ? 1 : 0),
		($data['heart_attack']!="" ? 1 : 0),
		($data['cardiac_arrhythmia']!="" ? 1 : 0),
		($data['heart_failure']!="" ? 1 : 0),
		($data['heart_other']!="" ? 1 : 0),
		$data['heart_other_desc'],
		($data['asthma']!="" ? 1 : 0),
		($data['obesity']!="" ? 1 : 0),
		($data['dyslipidemia']!="" ? 1 : 0),
		($data['breast_cancer']!="" ? 1 : 0),
		($data['cervical_cancer']!="" ? 1 : 0),
		($data['prostate_cancer']!="" ? 1 : 0),
		($data['cancer_other']!="" ? 1 : 0),
		$data['cancer_other_desc'],
		($data['anxiety_depression']!="" ? 1 : 0),
		($data['eating_disorders']!="" ? 1 : 0),
		($data['schizophrenia']!="" ? 1 : 0),
		($data['psychiatric_other']!="" ? 1 : 0),
		$data['psychiatric_other_desc'],
		($data['glaucoma']!="" ? 1 : 0),
		($data['ametropia']!="" ? 1 : 0),
		($data['waterfalls']!="" ? 1 : 0),
		($data['eye_other']!="" ? 1 : 0),
		$data['eye_other_desc'],
		($data['hyperthyroidism']!="" ? 1 : 0),
		($data['hypothyroidism']!="" ? 1 : 0),
		($data['cushing']!="" ? 1 : 0),
		($data['endocrine_other']!="" ? 1 : 0),
		$data['endocrine_other_desc'],
		($data['preeclampsia']!="" ? 1 : 0),
		($data['cystic_ovary']!="" ? 1 : 0),
		($data['gestational_diabetes']!="" ? 1 : 0),
		($data['gynecological_other']!="" ? 1 : 0),
		$data['gynecological_other_desc'],
		($data['parkinson']!="" ? 1 : 0),
		($data['epilepsy']!="" ? 1 : 0),
		($data['alzheimer']!="" ? 1 : 0),
		($data['neurological_other']!="" ? 1 : 0),
		$data['neurological_other_desc'],
		($data['tuberculosis']!="" ? 1 : 0),
		($data['sida']!="" ? 1 : 0),
		($data['syphilis']!="" ? 1 : 0),
		($data['infectious_other']!="" ? 1 : 0),
		$data['infectious_other_desc'],
		($data['down_syndrome']!="" ? 1 : 0),
		($data['cretinism_acromegaly']!="" ? 1 : 0),
		($data['hemophilia']!="" ? 1 : 0),
		($data['genetic_other']!="" ? 1 : 0),
		$data['genetic_other_desc'],
		$data['other_diseases'],
		($data['death_age']!="" ? 1 : 0),
		$data['death_cause'],
		$data['observations'],
		$id_user);

	return $result;
}

/**
 * [Función para obtener los datos completos de un paciente]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $table       [Nombre de la tabla en la DB]
 * @return [array]               [Listado de pacientes sin registros]
 */
function getPatientData($connection, $search){
	$result = getPatientData_DOM($connection, $search);

	return $result;
}

/**
 * [Función para actualizar los datos de un paciente]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $table       [Nombre de la tabla en la DB]
 * @return [array]               [Listado de pacientes sin registros]
 */
function updatePatientData($connection, $data, $id_user){
	$updated = updaetePatientData_DOM($connection,
	$data['id'],
	$data['affiliationNumber'],
	$data['curp'],
	$data['name'],
	$data['firstLastName'],
	$data['secondLastName'],
	$data['birthdate'],
	$data['genre'],
	$data['familyRole'],
	$data['familiyReference'],
	$data['phone_number'],
	$data['dependants'],
	$data['calle'],
	$data['no_ext'],
	$data['no_int'],
	$data['colonia'],
	$data['municipio'],
	$data['codigo_postal'],
	$data['address_reference'],
	$data['family_atmosphere'],
	$data['health_problems'],
	$id_user);

	return $updated;
}

/**
 * [Función para obtener los datos de mediciones completadas por familia]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $table       [Nombre de la tabla en la DB]
 * @return [array]               [Listado de pacientes sin registros]
 */
function getCompletedData($connection, $search){
	$result = new stdClass();
	$result->clinicHistory = getClinicHistoryCompletedData_DOM($connection, $search);
	$result->environment = getEnvironmentCompletedData_DOM($connection, $search);
	$result->depresion = getDepresionCompletedData_DOM($connection, $search);
	$result->anxiety = getAnxietyCompletedData_DOM($connection, $search);
	$result->violence = getViolenceCompletedData_DOM($connection, $search);
	$result->hopelessness = getHopelessnessCompletedData_DOM($connection, $search);
	$result->vaccination = getVaccinationCompletedData_DOM($connection, $search);
	$result->vector = getVectorCompletedData_DOM($connection, $search);
	$result->ets = getEtsCompletedData_DOM($connection, $search);
	$result->cronic = getCronicCompletedData_DOM($connection, $search);
	$result->edas = getEdasCompletedData_DOM($connection, $search);
	$result->vitalSign = getVitalSignCompletedData_DOM($connection, $search);
	$result->nutritional = getNutritionalCompletedData_DOM($connection, $search);
	$result->laboratory = getLaboratoryCompletedData_DOM($connection, $search);
	$result->cabinet = getCabinetCompletedData_DOM($connection, $search);
	$result->hearing = getHearingCompletedData_DOM($connection, $search);
	$result->visual = getVisualCompletedData_DOM($connection, $search);
	$result->ortopedic = getOrtopedicCompletedData_DOM($connection, $search);
	$result->cardio = getCardioCompletedData_DOM($connection, $search);
	$result->cancer = getCancerCompletedData_DOM($connection, $search);
	$result->barthel = getBarthelCompletedData_DOM($connection, $search);
	$result->geriatric = getGeriatricCompletedData_DOM($connection, $search);
	$result->zaritt = getZarittCompletedData_DOM($connection, $search);
	$result->risk = getRiskCompletedData_DOM($connection, $search);

	return $result;
}

/**
 * [Función para obtener los datos de mediciones completadas por municipio]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $table       [Nombre de la tabla en la DB]
 * @return [array]               [Listado de pacientes sin registros]
 */
function getDetailByTownshipData($connection){
	$result = new stdClass();
	$result->BALANCAN = getDetailByTownshipData_DOM($connection, 'BALANCAN');
	$result->CENTRO = getDetailByTownshipData_DOM($connection, 'CENTRO');
	$result->CENTLA = getDetailByTownshipData_DOM($connection, 'CENTLA');

	return $result;
}
 ?>