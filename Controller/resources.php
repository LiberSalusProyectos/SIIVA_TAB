<?php include_once("Model/queries.php");

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
		case "historiaClinica":
			$table = "clinichistorydata";
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
 * [Función para el almacenado de información dentro de la sección de Historia Clínica]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveHistoriaClinicaData($connection, $method, $data, $id_user){

	$result = saveHistoriaClinicaData_DOM($connection, $method,
		$data['id_patient'],
		$data['herencia_diabetes1'],
		($data['herencia_diabetes1_mother']!="" ? 1 : 0),
		($data['herencia_diabetes1_father']!="" ? 1 : 0),
		($data['herencia_diabetes1_other']!="" ? 1 : 0),
		$data['herencia_diabetes2'],
		($data['herencia_diabetes2_mother']!="" ? 1 : 0),
		($data['herencia_diabetes2_father']!="" ? 1 : 0),
		($data['herencia_diabetes2_other']!="" ? 1 : 0),
		$data['herencia_cardipatia'],
		($data['herencia_cardipatia_mother']!="" ? 1 : 0),
		($data['herencia_cardipatia_father']!="" ? 1 : 0),
		($data['herencia_cardipatia_other']!="" ? 1 : 0),
		$data['herencia_cancer_mama'],
		($data['herencia_cancer_mama_mother']!="" ? 1 : 0),
		($data['herencia_cancer_mama_father']!="" ? 1 : 0),
		($data['herencia_cancer_mama_other']!="" ? 1 : 0),
		$data['herencia_cancer_prostata'],
		($data['herencia_cancer_prostata_mother']!="" ? 1 : 0),
		($data['herencia_cancer_prostata_father']!="" ? 1 : 0),
		($data['herencia_cancer_prostata_other']!="" ? 1 : 0),
		$data['herencia_cancer_cervico'],
		($data['herencia_cancer_cervico_mother']!="" ? 1 : 0),
		($data['herencia_cancer_cervico_father']!="" ? 1 : 0),
		($data['herencia_cancer_cervico_other']!="" ? 1 : 0),
		$data['herencia_cancer_otro'],
		($data['herencia_cancer_otro_mother']!="" ? 1 : 0),
		($data['herencia_cancer_otro_father']!="" ? 1 : 0),
		($data['herencia_cancer_otro_other']!="" ? 1 : 0),
		$data['herencia_psiquiatrico'],
		($data['herencia_psiquiatrico_mother']!="" ? 1 : 0),
		($data['herencia_psiquiatrico_father']!="" ? 1 : 0),
		($data['herencia_psiquiatrico_other']!="" ? 1 : 0),
		$data['herencia_glaucoma'],
		($data['herencia_glaucoma_mother']!="" ? 1 : 0),
		($data['herencia_glaucoma_father']!="" ? 1 : 0),
		($data['herencia_glaucoma_other']!="" ? 1 : 0),
		$data['herencia_alergia'],
		($data['herencia_alergia_mother']!="" ? 1 : 0),
		($data['herencia_alergia_father']!="" ? 1 : 0),
		($data['herencia_alergia_other']!="" ? 1 : 0),
		$data['herencia_gineco'],
		($data['herencia_gineco_mother']!="" ? 1 : 0),
		($data['herencia_gineco_father']!="" ? 1 : 0),
		($data['herencia_gineco_other']!="" ? 1 : 0),
		$data['herencia_genetico'],
		($data['herencia_genetico_mother']!="" ? 1 : 0),
		($data['herencia_genetico_father']!="" ? 1 : 0),
		($data['herencia_genetico_other']!="" ? 1 : 0),
		$data['patologico_vector'],
		$data['patologico_vector_familiar'],
		$data['patologico_tuberculosis'],
		$data['patologico_tuberculosis_familiar'],
		$data['patologico_asma'],
		$data['patologico_asma_familiar'],
		$data['patologico_influenza'],
		$data['patologico_influenza_familiar'],
		$data['patologico_vih'],
		$data['patologico_vih_familiar'],
		$data['patologico_ets'],
		$data['patologico_ets_familiar'],
		$data['patologico_exantematica'],
		$data['patologico_exantematica_familiar'],
		$data['patologico_cancer'],
		$data['patologico_cancer_familiar'],
		$data['patologico_sistemica'],
		$data['patologico_sistemica_familiar'],
		$data['patologico_cardiopatia'],
		$data['patologico_cardiopatia_familiar'],
		$data['patologico_psiquiatrico'],
		$data['patologico_psiquiatrico_familiar'],
		$data['patologico_neurologico'],
		$data['patologico_neurologico_familiar'],
		$data['patologico_oftalmologico'],
		$data['patologico_oftalmologico_familiar'],
		$data['gineco_inicio_menstruacion'],
		$data['gineco_crecimiento_mamas'],
		$data['gineco_inicio_vidasexual'],
		($data['gineco_embarazos']=='' ? 0 : $data['gineco_embarazos']),
		($data['gineco_hijos_vivos']=='' ? 0 : $data['gineco_hijos_vivos']),
		($data['gineco_hijos_muertos']=='' ? 0 : $data['gineco_hijos_muertos']),
		$data['gineco_causa_fallecimiento'],
		($data['gineco_parto']=='' ? 0 : $data['gineco_parto']),
		($data['gineco_cesarea']=='' ? 0 : $data['gineco_cesarea']),
		($data['gineco_aborto']=='' ? 0 : $data['gineco_aborto']),
		$data['gineco_metodo_planificacion'],
		$data['gineco_ritmo'],
		$data['gineco_ultima_menstruacion'],
		$data['gineco_ultimo_papanicolaou'],
		$data['gineco_exploracion_mamas'],
		$data['gineco_inicio_menopausia'],
		$data['problemas_salud'],
		($data['signos_tension_arterial']=='' ? 0 : $data['signos_tension_arterial']),
		($data['signos_frecuencia_cardiaca']=='' ? 0 : $data['signos_frecuencia_cardiaca']),
		($data['signos_frecuencia_respiratoria']=='' ? 0 : $data['signos_frecuencia_respiratoria']),
		($data['signos_temperatura']=='' ? 0 : $data['signos_temperatura']),
		($data['signos_peso']=='' ? 0 : $data['signos_peso']),
		($data['signos_talla']=='' ? 0 : $data['signos_talla']),
		($data['signos_imc']=='' ? 0 : $data['signos_imc']),
		($data['signos_perimetro_brazo']=='' ? 0 : $data['signos_perimetro_brazo']),
		($data['signos_perimetro_abdominal']=='' ? 0 : $data['signos_perimetro_abdominal']),
		($data['signos_llenado_capilar']=='' ? 0 : $data['signos_llenado_capilar']),
		($data['signos_glucosa']=='' ? 0 : $data['signos_glucosa']),
		($data['signos_hemoglobina']=='' ? 0 : $data['signos_hemoglobina']),
		($data['signos_colesterol']=='' ? 0 : $data['signos_colesterol']),
		$data['signos_campos_visuales'],
		$data['signos_acustica'],
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