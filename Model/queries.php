<?php
include_once('connection.php');

/**
 * [Función para el almacenado de información dentro de la sección de Historia Clínica]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveHistoriaClinicaData_DOM($connection, $method,
	$id_patient,
	$herencia_diabetes1,
	$herencia_diabetes1_mother,
	$herencia_diabetes1_father,
	$herencia_diabetes1_other,
	$herencia_diabetes2,
	$herencia_diabetes2_mother,
	$herencia_diabetes2_father,
	$herencia_diabetes2_other,
	$herencia_cardipatia,
	$herencia_cardipatia_mother,
	$herencia_cardipatia_father,
	$herencia_cardipatia_other,
	$herencia_cancer_mama,
	$herencia_cancer_mama_mother,
	$herencia_cancer_mama_father,
	$herencia_cancer_mama_other,
	$herencia_cancer_prostata,
	$herencia_cancer_prostata_mother,
	$herencia_cancer_prostata_father,
	$herencia_cancer_prostata_other,
	$herencia_cancer_cervico,
	$herencia_cancer_cervico_mother,
	$herencia_cancer_cervico_father,
	$herencia_cancer_cervico_other,
	$herencia_cancer_otro,
	$herencia_cancer_otro_mother,
	$herencia_cancer_otro_father,
	$herencia_cancer_otro_other,
	$herencia_psiquiatrico,
	$herencia_psiquiatrico_mother,
	$herencia_psiquiatrico_father,
	$herencia_psiquiatrico_other,
	$herencia_glaucoma,
	$herencia_glaucoma_mother,
	$herencia_glaucoma_father,
	$herencia_glaucoma_other,
	$herencia_alergia,
	$herencia_alergia_mother,
	$herencia_alergia_father,
	$herencia_alergia_other,
	$herencia_gineco,
	$herencia_gineco_mother,
	$herencia_gineco_father,
	$herencia_gineco_other,
	$herencia_genetico,
	$herencia_genetico_mother,
	$herencia_genetico_father,
	$herencia_genetico_other,
	$patologico_vector,
	$patologico_vector_familiar,
	$patologico_tuberculosis,
	$patologico_tuberculosis_familiar,
	$patologico_asma,
	$patologico_asma_familiar,
	$patologico_influenza,
	$patologico_influenza_familiar,
	$patologico_vih,
	$patologico_vih_familiar,
	$patologico_ets,
	$patologico_ets_familiar,
	$patologico_exantematica,
	$patologico_exantematica_familiar,
	$patologico_cancer,
	$patologico_cancer_familiar,
	$patologico_sistemica,
	$patologico_sistemica_familiar,
	$patologico_cardiopatia,
	$patologico_cardiopatia_familiar,
	$patologico_psiquiatrico,
	$patologico_psiquiatrico_familiar,
	$patologico_neurologico,
	$patologico_neurologico_familiar,
	$patologico_oftalmologico,
	$patologico_oftalmologico_familiar,
	$gineco_inicio_menstruacion,
	$gineco_crecimiento_mamas,
	$gineco_inicio_vidasexual,
	$gineco_embarazos,
	$gineco_hijos_vivos,
	$gineco_hijos_muertos,
	$gineco_causa_fallecimiento,
	$gineco_parto,
	$gineco_cesarea,
	$gineco_aborto,
	$gineco_metodo_planificacion,
	$gineco_ritmo,
	$gineco_ultima_menstruacion,
	$gineco_ultimo_papanicolaou,
	$gineco_exploracion_mamas,
	$gineco_inicio_menopausia,
	$problemas_salud,
	$signos_tension_arterial,
	$signos_frecuencia_cardiaca,
	$signos_frecuencia_respiratoria,
	$signos_temperatura,
	$signos_peso,
	$signos_talla,
	$signos_imc,
	$signos_perimetro_brazo,
	$signos_perimetro_abdominal,
	$signos_llenado_capilar,
	$signos_glucosa,
	$signos_hemoglobina,
	$signos_colesterol,
	$signos_campos_visuales,
	$signos_acustica,
	$capturist){

	$query = "";
	$postQuery = "";

	if ($method=="UPDATE") {
		$query = "UPDATE";
		$postQuery = "WHERE `id_patient` = $id_patient;";
	}else{
		$query = "INSERT";
		$postQuery = "";
	}

	$query .= " `clinichistorydata` SET
	`herencia_diabetes1`				= '$herencia_diabetes1',
	`herencia_diabetes1_mother`			= '$herencia_diabetes1_mother',
	`herencia_diabetes1_father`			= '$herencia_diabetes1_father',
	`herencia_diabetes1_other`			= '$herencia_diabetes1_other',
	`herencia_diabetes2`				= '$herencia_diabetes2',
	`herencia_diabetes2_mother`			= '$herencia_diabetes2_mother',
	`herencia_diabetes2_father`			= '$herencia_diabetes2_father',
	`herencia_diabetes2_other`			= '$herencia_diabetes2_other',
	`herencia_cardipatia`				= '$herencia_cardipatia',
	`herencia_cardipatia_mother`		= '$herencia_cardipatia_mother',
	`herencia_cardipatia_father`		= '$herencia_cardipatia_father',
	`herencia_cardipatia_other`			= '$herencia_cardipatia_other',
	`herencia_cancer_mama`				= '$herencia_cancer_mama',
	`herencia_cancer_mama_mother`		= '$herencia_cancer_mama_mother',
	`herencia_cancer_mama_father`		= '$herencia_cancer_mama_father',
	`herencia_cancer_mama_other`		= '$herencia_cancer_mama_other',
	`herencia_cancer_prostata`			= '$herencia_cancer_prostata',
	`herencia_cancer_prostata_mother`	= '$herencia_cancer_prostata_mother',
	`herencia_cancer_prostata_father`	= '$herencia_cancer_prostata_father',
	`herencia_cancer_prostata_other`	= '$herencia_cancer_prostata_other',
	`herencia_cancer_cervico`			= '$herencia_cancer_cervico',
	`herencia_cancer_cervico_mother`	= '$herencia_cancer_cervico_mother',
	`herencia_cancer_cervico_father`	= '$herencia_cancer_cervico_father',
	`herencia_cancer_cervico_other`		= '$herencia_cancer_cervico_other',
	`herencia_cancer_otro`				= '$herencia_cancer_otro',
	`herencia_cancer_otro_mother`		= '$herencia_cancer_otro_mother',
	`herencia_cancer_otro_father`		= '$herencia_cancer_otro_father',
	`herencia_cancer_otro_other`		= '$herencia_cancer_otro_other',
	`herencia_psiquiatrico`				= '$herencia_psiquiatrico',
	`herencia_psiquiatrico_mother`		= '$herencia_psiquiatrico_mother',
	`herencia_psiquiatrico_father`		= '$herencia_psiquiatrico_father',
	`herencia_psiquiatrico_other`		= '$herencia_psiquiatrico_other',
	`herencia_glaucoma`					= '$herencia_glaucoma',
	`herencia_glaucoma_mother`			= '$herencia_glaucoma_mother',
	`herencia_glaucoma_father`			= '$herencia_glaucoma_father',
	`herencia_glaucoma_other`			= '$herencia_glaucoma_other',
	`herencia_alergia`					= '$herencia_alergia',
	`herencia_alergia_mother`			= '$herencia_alergia_mother',
	`herencia_alergia_father`			= '$herencia_alergia_father',
	`herencia_alergia_other`			= '$herencia_alergia_other',
	`herencia_gineco`					= '$herencia_gineco',
	`herencia_gineco_mother`			= '$herencia_gineco_mother',
	`herencia_gineco_father`			= '$herencia_gineco_father',
	`herencia_gineco_other`				= '$herencia_gineco_other',
	`herencia_genetico`					= '$herencia_genetico',
	`herencia_genetico_mother`			= '$herencia_genetico_mother',
	`herencia_genetico_father`			= '$herencia_genetico_father',
	`herencia_genetico_other`			= '$herencia_genetico_other',
	`patologico_vector`					= '$patologico_vector',
	`patologico_vector_familiar`		= '$patologico_vector_familiar',
	`patologico_tuberculosis`			= '$patologico_tuberculosis',
	`patologico_tuberculosis_familiar`	= '$patologico_tuberculosis_familiar',
	`patologico_asma`					= '$patologico_asma',
	`patologico_asma_familiar`			= '$patologico_asma_familiar',
	`patologico_influenza`				= '$patologico_influenza',
	`patologico_influenza_familiar`		= '$patologico_influenza_familiar',
	`patologico_vih`					= '$patologico_vih',
	`patologico_vih_familiar`			= '$patologico_vih_familiar',
	`patologico_ets`					= '$patologico_ets',
	`patologico_ets_familiar`			= '$patologico_ets_familiar',
	`patologico_exantematica`			= '$patologico_exantematica',
	`patologico_exantematica_familiar`	= '$patologico_exantematica_familiar',
	`patologico_cancer`					= '$patologico_cancer',
	`patologico_cancer_familiar`		= '$patologico_cancer_familiar',
	`patologico_sistemica`				= '$patologico_sistemica',
	`patologico_sistemica_familiar`		= '$patologico_sistemica_familiar',
	`patologico_cardiopatia`			= '$patologico_cardiopatia',
	`patologico_cardiopatia_familiar`	= '$patologico_cardiopatia_familiar',
	`patologico_psiquiatrico`			= '$patologico_psiquiatrico',
	`patologico_psiquiatrico_familiar`	= '$patologico_psiquiatrico_familiar',
	`patologico_neurologico`			= '$patologico_neurologico',
	`patologico_neurologico_familiar`	= '$patologico_neurologico_familiar',
	`patologico_oftalmologico`			= '$patologico_oftalmologico',
	`patologico_oftalmologico_familiar`	= '$patologico_oftalmologico_familiar',
	`gineco_inicio_menstruacion`		= '$gineco_inicio_menstruacion',
	`gineco_crecimiento_mamas`			= '$gineco_crecimiento_mamas',
	`gineco_inicio_vidasexual`			= '$gineco_inicio_vidasexual',
	`gineco_embarazos`					= $gineco_embarazos,
	`gineco_hijos_vivos`				= $gineco_hijos_vivos,
	`gineco_hijos_muertos`				= $gineco_hijos_muertos,
	`gineco_causa_fallecimiento`		= '$gineco_causa_fallecimiento',
	`gineco_parto`						= $gineco_parto,
	`gineco_cesarea`					= $gineco_cesarea,
	`gineco_aborto`						= $gineco_aborto,
	`gineco_metodo_planificacion`		= '$gineco_metodo_planificacion',
	`gineco_ritmo`						= '$gineco_ritmo',
	`gineco_ultima_menstruacion`		= '$gineco_ultima_menstruacion',
	`gineco_ultimo_papanicolaou`		= '$gineco_ultimo_papanicolaou',
	`gineco_exploracion_mamas`			= '$gineco_exploracion_mamas',
	`gineco_inicio_menopausia`			= '$gineco_inicio_menopausia',
	`problemas_salud`					= '$problemas_salud',
	`signos_tension_arterial`			= $signos_tension_arterial,
	`signos_frecuencia_cardiaca`		= $signos_frecuencia_cardiaca,
	`signos_frecuencia_respiratoria`	= $signos_frecuencia_respiratoria,
	`signos_temperatura`				= $signos_temperatura,
	`signos_peso`						= $signos_peso,
	`signos_talla`						= $signos_talla,
	`signos_imc`						= $signos_imc,
	`signos_perimetro_brazo`			= $signos_perimetro_brazo,
	`signos_perimetro_abdominal`		= $signos_perimetro_abdominal,
	`signos_llenado_capilar`			= $signos_llenado_capilar,
	`signos_glucosa`					= $signos_glucosa,
	`signos_hemoglobina`				= $signos_hemoglobina,
	`signos_colesterol`					= $signos_colesterol,
	`signos_campos_visuales`			= '$signos_campos_visuales',
	`signos_acustica`					= '$signos_acustica',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	//var_dump($query);
	// echo $query;

		$inserted = mysqli_query($connection, $query);

		return $inserted;
}


/**
 * [Función para obtener todos los datos de un usuario, para determinado módulo.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getModuleData_DOM($connection, $table, $id_patient){
	$query = "SELECT * FROM `basicpatientdata` LEFT JOIN `".$table."` ON basicpatientdata.id = ".$table.".id_patient WHERE basicpatientdata.id = ".$id_patient." ORDER BY id ASC LIMIT 10";

	//echo $query;

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
				$resultado[] = $row;
		}
	    return $resultado;
	}
}


/**
 * [Listado de pacientes con registros en el módulo/formulario, funciona por medio de un INNER JOIN descontar los elementos pendientes del  llenado]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $table       [Nombre de la tabla en la DB]
 * @return [array]               [Listado de pacientes con registros]
 */
function listPatientsAnswered_DOM($connection, $table, $search){
	$search_part = "";
	if ($search !== ""){
		$search_part = " WHERE CONCAT(basicpatientdata.affiliationNumber, ' ', UPPER(basicpatientdata.firstLastName), ' ', UPPER(basicpatientdata.secondLastName), ' ', UPPER(basicpatientdata.name)) LIKE '%".strtoupper($search)."%'";
	}

	$query = "SELECT * FROM `basicpatientdata` INNER JOIN `".$table."` ON basicpatientdata.id = ".$table.".id_patient".$search_part." ORDER BY `created_at` DESC LIMIT 10";

	// echo $query;

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
				$resultado[] = $row;
		}
	    return $resultado;
	}
}


/**
 * [Listado de pacientes con registros en el módulo/formulario, funciona por medio de un LEFT JOIN para contar con elementos nulos identificables (pendientes de llenado)]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $table       [Nombre de la tabla en la DB]
 * @return [array]               [Listado de pacientes con registros]
 */
function listPatientsPending_DOM($connection, $table, $search){
	$search_part = "";
	if ($search !== ""){
		$search_part = " AND CONCAT(basicpatientdata.affiliationNumber, ' ', UPPER(basicpatientdata.firstLastName), ' ', UPPER(basicpatientdata.secondLastName), ' ', UPPER(basicpatientdata.name)) LIKE '%".strtoupper($search)."%'";
	}

	$query = "SELECT * FROM `basicpatientdata` LEFT JOIN `".$table."` ON basicpatientdata.id = ".$table.".id_patient WHERE ".$table.".id_data IS NULL".$search_part." ORDER BY id ASC LIMIT 10";

	// echo $query;

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
				$resultado[] = $row;
		}
	    return $resultado;
	}
}


/**
 * [Función para validar las credenciales de acceso al sistema, por cuestión de facilidad se implementó un MD5 sencillo como método de encryptación]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $email       [Email de registro del usuario]
 * @param  [string] $password    [Contraseña convertida a MD5]
 * @return [bool]             	 [Resultado de la comparación entre credenciales]
 */
function userAuthentication_DOM($connection, $email, $password){
	$query = "SELECT * FROM `users` WHERE `password` = '$password' AND (`nombre` = '$email' OR `email` = '$email')";

	//echo $query;

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
				$resultado[] = $row;
		}
	    return $resultado;
	}
}


/**
 * [Función para actualizar la marca temporal del usuario cada que accesa.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $email       [Email de registro del usuario]
 * @param  [string] $password    [Contraseña convertida a MD5]
 * @return [bool]             	 [Estado de la consulta]
 */
function lasConnectionUpdate_DOM($connection, $email, $password){

	$query = "UPDATE `users` SET `lastLogin` = CURRENT_TIMESTAMP WHERE `email` = '$email'";

	$updated = mysqli_query($connection, $query);

	return $updated;
}


/**
 * [Función para obtener todos los datos de un paciente.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getPatientData_DOM($connection, $search){
	$query = "SELECT
	`id`,
	CASE `name_` WHEN '' THEN `name` ELSE COALESCE(`name_`, `name`) END as `name`,
	CASE `firstLastName_` WHEN '' THEN `firstLastName` ELSE COALESCE(`firstLastName_`, `firstLastName`) END as `firstLastName`,
	CASE `secondLastName_` WHEN '' THEN `secondLastName` ELSE COALESCE(`secondLastName_`, `secondLastName`) END as `secondLastName`,
	`affiliationNumber`,
	`birthdate`,
	`age`,
	`curp`,
	CASE `genre_` WHEN '' THEN `genre` ELSE COALESCE(`genre_`, `genre`) END as `genre`,
	CASE `familyRole_` WHEN '' THEN `familyRole` ELSE COALESCE(`familyRole_`, `familyRole`) END as `familyRole`,
	`familiyReference`,
	`phone_number`,
	CASE `calle_` WHEN '' THEN `calle` ELSE COALESCE(`calle_`, `calle`) END as `calle`,
	CASE `no_ext_` WHEN '' THEN `no_ext` ELSE COALESCE(`no_ext_`, `no_ext`) END as `no_ext`,
	CASE `no_int_` WHEN '' THEN `no_int` ELSE COALESCE(`no_int_`, `no_int`) END as `no_int`,
	CASE `colonia_` WHEN '' THEN `colonia` ELSE COALESCE(`colonia_`, `colonia`) END as `colonia`,
	CASE `municipio_` WHEN '' THEN `municipio` ELSE COALESCE(`municipio_`, `municipio`) END as `municipio`,
	CASE `codigo_postal_` WHEN '' THEN `codigo_postal` ELSE COALESCE(`codigo_postal_`, `codigo_postal`) END as `codigo_postal`,
	`address_reference`,
	`family_atmosphere`,
	`health_problems`
	FROM `basicpatientdata` WHERE `affiliationNumber` = ".$search." ORDER BY affiliate DESC";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
				$resultado[] = $row;
		}
	    return $resultado;
	}
}


/**
 * [Función para guardar los datos actualizados de un paciente.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function updaetePatientData_DOM($connection,
	$id,
	$affiliationNumber,
	$curp,
	$name,
	$firstLastName,
	$secondLastName,
	$birthdate,
	$genre,
	$familyRole,
	$familiyReference,
	$phone_number,
	$dependants,
	$calle,
	$no_ext,
	$no_int,
	$colonia,
	$municipio,
	$codigo_postal,
	$address_reference,
	$family_atmosphere,
	$health_problems,
	$id_user){

	$birthdate_frag = '';
	if ($birthdate !== ''){
		$birthdate_frag = "`birthdate` = '$birthdate'";
	} else {
		$birthdate_frag = "`birthdate` = NULL";
	}

	$cp_frag = '';
	if ($codigo_postal !== ''){
		$cp_frag = "`codigo_postal_` = $codigo_postal";
	} else {
		$cp_frag = "`codigo_postal_` = NULL";
	}

	$query = "UPDATE `basicpatientdata` SET
		`curp` = '$curp',
		`name_` = '$name',
		`firstLastName_` = '$firstLastName',
		`secondLastName_` = '$secondLastName',
		$birthdate_frag,
		`genre_` = '$genre',
		`phone_number` = '$phone_number',
		`calle_` = '$calle',
		`no_ext_` = '$no_ext',
		`no_int_` = '$no_int',
		`colonia_` = '$colonia',
		`municipio_` = '$municipio',
		$cp_frag,
		`address_reference` = '$address_reference',
		`family_atmosphere` = '$family_atmosphere',
		`health_problems` = '$health_problems',
		`updated_at` = CURRENT_TIMESTAMP,
		`capturist` = $id_user
	WHERE `id` = '$id'";

	foreach (!isset($dependants) ? [] : $dependants as $key=>$dependent){
		$id = $dependent['id'];
		$curp = $dependent['curp'];
		$name = $dependent['name'];
		$firstLastName = $dependent['firstLastName'];
		$secondLastName = $dependent['secondLastName'];
		$birthdate = $dependent['birthdate'];
		$genre = $dependent['genre'];
		$familyRole = $dependent['familyRole'];

		$birthdate_dep_frag = '';
		if ($birthdate !== ''){
			$birthdate_dep_frag = "`birthdate` = '$birthdate'";
		} else {
			$birthdate_dep_frag = "`birthdate` = NULL";
		}

		$cp_dep_frag = '';
		if ($codigo_postal !== ''){
			$cp_dep_frag = "`codigo_postal` = $codigo_postal";
		} else {
			$cp_dep_frag = "`codigo_postal` = NULL";
		}

		if (isset($id)) {
			$query_dep = "UPDATE `basicpatientdata` SET
			`curp` = '$curp',
			`name_` = '$name',
			`firstLastName_` = '$firstLastName',
			`secondLastName_` = '$secondLastName',
			$birthdate_frag,
			`genre_` = '$genre',
			`familyRole_` = '$familyRole',
			`updated_at` = CURRENT_TIMESTAMP,
			`capturist` = $id_user WHERE `id` = '$id'";
		}else{
			$query_dep = "INSERT `basicpatientdata` SET
			`affiliationNumber` = '$affiliationNumber',
			`curp` = '$curp',
			`name` = '$name',
			`firstLastName` = '$firstLastName',
			`secondLastName` = '$secondLastName',
			$birthdate_frag,
			`genre` = '$genre',
			`familyRole` = '$familyRole',
			`familiyReference` = '$familiyReference',
			`phone_number` = '$phone_number',
			`calle` = '$calle',
			`no_ext` = '$no_ext',
			`no_int` = '$no_int',
			`colonia` = '$colonia',
			`municipio` = '$municipio',
			$cp_dep_frag,
			`updated_at` = CURRENT_TIMESTAMP,
			`capturist` = $id_user";
		}

		mysqli_query($connection, $query_dep);
	}

	$updated = mysqli_query($connection, $query);

	return $updated;

	return TRUE;
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getClinicHistoryCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	LOWER(CASE name_ WHEN '' THEN `name` ELSE COALESCE(name_, `name`) END) as `name`,
	LOWER(CASE firstLastName_ WHEN '' THEN firstLastName ELSE COALESCE(firstLastName_, firstLastName) END) as `firstLastName`,
	LOWER(CASE secondLastName_ WHEN '' THEN secondLastName ELSE COALESCE(secondLastName_, secondLastName) END) as `secondLastName`,
	CASE WHEN bpd.affiliate = 1 THEN 'TITULAR' WHEN bpd.familyRole_ = '' THEN bpd.familyRole ELSE COALESCE(bpd.familyRole_, bpd.familyRole) END as `familyRole`,
	CASE WHEN chd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN clinichistorydata chd ON chd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getEnvironmentCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN chd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN environmentdata chd ON chd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getDepresionCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN dd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN depressiondata dd ON dd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getAnxietyCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN ad.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN anxietydata ad ON ad.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getViolenceCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN vd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN violencedata vd ON vd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getHopelessnessCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN hd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN hopelessnessdata hd ON hd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getVaccinationCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN hd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN vaccinatondata hd ON hd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getVectorCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN vd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN vectordata vd ON vd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getEtsCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN etsd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN etsdata etsd ON etsd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getCronicCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN cd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN cronicdata cd ON cd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getEdasCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN ed.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN edasdata ed ON ed.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getVitalSignCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN vsd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN vitalsigndata vsd ON vsd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getNutritionalCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN nd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN nutritionaldata nd ON nd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getLaboratoryCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN ld.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN laboratorydata ld ON ld.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getCabinetCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN cd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN cabinetdata cd ON cd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getHearingCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN hd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN hearingdata hd ON hd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getVisualCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN vd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN visualdata vd ON vd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getOrtopedicCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN od.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN ortopedicdata od ON od.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getCardioCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN cd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN cardiodata cd ON cd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getCancerCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN cd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN cancercdata cd ON cd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getBarthelCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN cd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN bartheldata cd ON cd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getGeriatricCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN gdd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN geriatricdepressiondata gdd ON gdd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getZarittCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN zd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN zarittdata zd ON zd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}

/**
 * [Función para obtener datos para pantalla de mediciones completadas por familia.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getRiskCompletedData_DOM($connection, $search){
	$query = "SELECT
	DISTINCT bpd.id,
	bpd.affiliationNumber,
	CASE WHEN rd.id_patient IS NULL THEN 0 ELSE 1 END as `completed`
	FROM basicpatientdata bpd
	LEFT JOIN riskdata rd ON rd.id_patient = bpd.id
	WHERE bpd.affiliationNumber = ".$search."
	GROUP BY bpd.id
	ORDER BY bpd.affiliate DESC, bpd.id ASC;";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}


/**
 * [Función para obtener el total de mediciones por municipio.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $module      [Nombre del módulo transmitido por GET]
 * @param  [int] $id_patient 	 [ID_del usuario]
 * @return [array]             	 [Información relacionada con el paciente.]
 */
function getDetailByTownshipData_DOM($connection, $municipio){
	$query = "SELECT
	SUM(CASE DATA.FORM WHEN 'clinichistory' THEN DATA.CONT ELSE 0 END) clinichistory,
	SUM(CASE DATA.FORM WHEN 'environment' THEN DATA.CONT ELSE 0 END) environment,
	SUM(CASE DATA.FORM WHEN 'depression' THEN DATA.CONT ELSE 0 END) depression,
	SUM(CASE DATA.FORM WHEN 'anxiety' THEN DATA.CONT ELSE 0 END) anxiety,
	SUM(CASE DATA.FORM WHEN 'violence' THEN DATA.CONT ELSE 0 END) violence,
	SUM(CASE DATA.FORM WHEN 'hopelessness' THEN DATA.CONT ELSE 0 END) hopelessness,
	SUM(CASE DATA.FORM WHEN 'vaccinaton' THEN DATA.CONT ELSE 0 END) vaccinaton,
	SUM(CASE DATA.FORM WHEN 'vector' THEN DATA.CONT ELSE 0 END) vector,
	SUM(CASE DATA.FORM WHEN 'ets' THEN DATA.CONT ELSE 0 END) ets,
	SUM(CASE DATA.FORM WHEN 'cronic' THEN DATA.CONT ELSE 0 END) cronic,
	SUM(CASE DATA.FORM WHEN 'edas' THEN DATA.CONT ELSE 0 END) edas,
	SUM(CASE DATA.FORM WHEN 'vitalsign' THEN DATA.CONT ELSE 0 END) vitalsign,
	SUM(CASE DATA.FORM WHEN 'nutritional' THEN DATA.CONT ELSE 0 END) nutritional,
	SUM(CASE DATA.FORM WHEN 'laboratory' THEN DATA.CONT ELSE 0 END) laboratory,
	SUM(CASE DATA.FORM WHEN 'cabinet' THEN DATA.CONT ELSE 0 END) cabinet,
	SUM(CASE DATA.FORM WHEN 'hearing' THEN DATA.CONT ELSE 0 END) hearing,
	SUM(CASE DATA.FORM WHEN 'visual' THEN DATA.CONT ELSE 0 END) visual,
	SUM(CASE DATA.FORM WHEN 'ortopedic' THEN DATA.CONT ELSE 0 END) ortopedic,
	SUM(CASE DATA.FORM WHEN 'cardio' THEN DATA.CONT ELSE 0 END) cardio,
	SUM(CASE DATA.FORM WHEN 'cancer' THEN DATA.CONT ELSE 0 END) cancer,
	SUM(CASE DATA.FORM WHEN 'barthel' THEN DATA.CONT ELSE 0 END) barthel,
	SUM(CASE DATA.FORM WHEN 'geriatricdepression' THEN DATA.CONT ELSE 0 END) geriatricdepression,
	SUM(CASE DATA.FORM WHEN 'zaritt' THEN DATA.CONT ELSE 0 END) zaritt,
	SUM(CASE DATA.FORM WHEN 'risk' THEN DATA.CONT ELSE 0 END) risk,
	SUM(DATA.CONT) TOTAL
	FROM(
		SELECT
		'clinichistory' FORM,
		COUNT(DISTINCT chd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN clinichistorydata chd ON chd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'environment' FORM,
		COUNT(DISTINCT ed.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN environmentdata ed ON ed.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'depression' FORM,
		COUNT(DISTINCT dd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN depressiondata dd ON dd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'anxiety' FORM,
		COUNT(DISTINCT ad.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN anxietydata ad ON ad.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'violence' FORM,
		COUNT(DISTINCT vd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN violencedata vd ON vd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'hopelessness' FORM,
		COUNT(DISTINCT hnd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN hopelessnessdata hnd ON hnd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'vaccinaton' FORM,
		COUNT(DISTINCT vcd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN vaccinatondata vcd ON vcd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'vector' FORM,
		COUNT(DISTINCT vtd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN vectordata vtd ON vtd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'ets' FORM,
		COUNT(DISTINCT etsd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN etsdata etsd ON etsd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'cronic' FORM,
		COUNT(DISTINCT crd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN cronicdata crd ON crd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'edas' FORM,
		COUNT(DISTINCT edd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN edasdata edd ON edd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'vitalsign' FORM,
		COUNT(DISTINCT vsd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN vitalsigndata vsd ON vsd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'nutritional' FORM,
		COUNT(DISTINCT ntd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN nutritionaldata ntd ON ntd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'laboratory' FORM,
		COUNT(DISTINCT ld.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN laboratorydata ld ON ld.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'cabinet' FORM,
		COUNT(DISTINCT cnd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN cabinetdata cnd ON cnd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'hearing' FORM,
		COUNT(DISTINCT hd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN hearingdata hd ON hd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'visual' FORM,
		COUNT(DISTINCT vsd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN visualdata vsd ON vsd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'ortopedic' FORM,
		COUNT(DISTINCT od.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN ortopedicdata od ON od.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'cardio' FORM,
		COUNT(DISTINCT cd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN cardiodata cd ON cd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'cancer' FORM,
		COUNT(DISTINCT cnd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN cancercdata cnd ON cnd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'barthel' FORM,
		COUNT(DISTINCT btd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN bartheldata btd ON btd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'geriatricdepression' FORM,
		COUNT(DISTINCT gdd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN geriatricdepressiondata gdd ON gdd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'zaritt' FORM,
		COUNT(DISTINCT zd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN zarittdata zd ON zd.id_patient = bpd.id
		GROUP BY bpd.municipio
	UNION
		SELECT
		'risk' FORM,
		COUNT(DISTINCT rd.id_patient) CONT,
		bpd.municipio
		FROM basicpatientdata bpd
		JOIN riskdata rd ON rd.id_patient = bpd.id
		GROUP BY bpd.municipio
	) AS DATA WHERE DATA.municipio = '".$municipio."'";

	$resultado = array();

	if ($result = mysqli_query($connection, $query)) {
	    while ($row = $result->fetch_assoc()) {
			$resultado[] = $row;
		}
	    return $resultado;
	}
}
 ?>