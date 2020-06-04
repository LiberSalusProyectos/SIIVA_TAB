<?php include_once("Model/queries.php");

!defined('FAMILY_RECORD_NAME') && define('FAMILY_RECORD_NAME', 'ANTECEDENTES FAMILIARES');
!defined('DASS21_SCALE_NAME') && define('DASS21_SCALE_NAME', 'DASS-21');
!defined('ENVIRONMENT_NAME') && define('ENVIRONMENT_NAME', 'MEDIO AMBIENTE');
!defined('GERIATRIC_DEPRESSION_NAME') && define('GERIATRIC_DEPRESSION_NAME', 'DEPRESIÓN GERIÁTRICA');
!defined('ZARITT_SCALE_NAME') && define('ZARITT_SCALE_NAME', 'ESCALA DE ZARITT');
!defined('ETS_NAME') && define('ETS_NAME', 'ENF. TRANS. SEXUAL');
!defined('SOCIOCULTURAL_NAME') && define('SOCIOCULTURAL_NAME', 'SOCIO CULTURAL');
!defined('DIABETES_NAME') && define('DIABETES_NAME', 'DIABETES');
!defined('HYPERTENSION_NAME') && define('HYPERTENSION_NAME', 'HIPERTENSIÓN');
!defined('BORN_LIFESTYLE_NAME') && define('BORN_LIFESTYLE_NAME', 'ESTILO VIDA [0-1] AÑO');
!defined('BABY_LIFESTYLE_NAME') && define('BABY_LIFESTYLE_NAME', 'ESTILO VIDA [1-5] AÑOS');
!defined('CHILD_LIFESTYLE_NAME') && define('CHILD_LIFESTYLE_NAME', 'ESTILO VIDA [6-12] AÑOS');
!defined('YOUNG_LIFESTYLE_NAME') && define('YOUNG_LIFESTYLE_NAME', 'ESTILO VIDA [12+] AÑOS');
!defined('GYNECOLOGY_NAME') && define('GYNECOLOGY_NAME', 'GINECOLOGÍA');
!defined('HEALTH_CARE_NAME') && define('HEALTH_CARE_NAME', 'CUIDADO DE LA SALUD');
!defined('VITAL_SIGN_NAME') && define('VITAL_SIGN_NAME', 'SIGNOS VITALES + LAB');
!defined('GENDER_VIOLENCE_NAME') && define('GENDER_VIOLENCE_NAME', 'VIOLENCIA DE GÉNERO');
!defined('HOPELESS_NAME') && define('HOPELESS_NAME', 'DESESPERANZA DE BECK');
!defined('CHILD_VACCINATION') && define('CHILD_VACCINATION', 'VACUNACIÓN [0-9] AÑOS');
!defined('YOUNG_VACCINATION') && define('YOUNG_VACCINATION', 'VACUNACIÓN [10-19] AÑOS');
!defined('ADULT_VACCINATION') && define('ADULT_VACCINATION', 'VACUNACIÓN [20-59] AÑOS');
!defined('ELDER_VACCINATION') && define('ELDER_VACCINATION', 'VACUNACIÓN [60+] AÑOS');

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

		ini_set("session.cookie_lifetime", 7200);
		ini_set("session.gc_maxlifetime", 7200);
		ini_set("display_errors", 1);
		ini_set("session.use_cookies", 1);
		setlocale(LC_ALL, "es_ES");
	
		error_reporting(E_ALL & ~E_NOTICE); //Mostrar errores PHP

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
		case "dass21Scale":
			$table = "dass21data";
			break;
		case "environment":
			$table = "environmentdata";
			break;
		case "geriatricDepression":
			$table = "geriatricdepressiondata";
			break;
		case "zarittScale":
			$table = "zarittscaledata";
			break;
		case "ets":
			$table = "etsdata";
			break;
		case "socioCultural":
			$table = "socioculturaldata";
			break;
		case "diabetes":
			$table = "diabetesdata";
			break;
		case "hypertension":
			$table = "hypertensiondata";
			break;
		case "bornLifestyle":
			$table = "bornlifestyledata";
			break;
		case "babyLifestyle":
			$table = "babylifestyledata";
			break;
		case "childLifestyle":
			$table = "childlifestyledata";
			break;
		case "youngLifestyle":
			$table = "younglifestyledata";
			break;
		case "gynecology":
			$table = "gynecologydata";
			break;
		case "healthCare":
			$table = "healthcaredata";
			break;
		case "vitalSign":
			$table = "vitalsigndata";
			break;
		case "genderViolence":
			$table = "genderviolencedata";
			break;
		case "hopeless":
			$table = "hopelessdata";
			break;
		case "childVaccination":
			$table = "childvaccinationdata";
			break;
		case "youngVaccination":
			$table = "youngvaccinationdata";
			break;
		case "adultVaccination":
			$table = "adultvaccinationdata";
			break;
		case "elderVaccination":
			$table = "eldervaccinationdata";
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
		($data['birth_state']!="" ? "'".utf8_decode($data['birth_state'])."'" : 'NULL'),
		($data['birth_place']!="" ? "'".utf8_decode($data['birth_place'])."'" : 'NULL'),
		($data['residence_state']!="" ? "'".utf8_decode($data['residence_state'])."'" : 'NULL'),
		($data['residence_place']!="" ? "'".utf8_decode($data['residence_place'])."'" : 'NULL'),
		($data['hypertension']!="" ? '1' : 'NULL'),
		($data['diabetes']!="" ? '1' : 'NULL'),
		($data['heart_attack']!="" ? '1' : 'NULL'),
		($data['cardiac_arrhythmia']!="" ? '1' : 'NULL'),
		($data['heart_failure']!="" ? '1' : 'NULL'),
		($data['heart_other']!="" ? '1' : 'NULL'),
		($data['heart_other_desc']!="" ? "'".utf8_decode($data['heart_other_desc'])."'" : 'NULL'),
		($data['asthma']!="" ? '1' : 'NULL'),
		($data['obesity']!="" ? '1' : 'NULL'),
		($data['dyslipidemia']!="" ? "'".$data['dyslipidemia']."'" : 'NULL'),
		($data['breast_cancer']!="" ? '1' : 'NULL'),
		($data['cervical_cancer']!="" ? '1' : 'NULL'),
		($data['prostate_cancer']!="" ? '1' : 'NULL'),
		($data['leukemia']!="" ? '1' : 'NULL'),
		($data['cancer_other']!="" ? '1' : 'NULL'),
		($data['cancer_other_desc']!="" ? "'".utf8_decode($data['cancer_other_desc'])."'" : 'NULL'),
		($data['anxiety_depression']!="" ? '1' : 'NULL'),
		($data['eating_disorders']!="" ? '1' : 'NULL'),
		($data['schizophrenia']!="" ? '1' : 'NULL'),
		($data['psychiatric_other']!="" ? '1' : 'NULL'),
		($data['psychiatric_other_desc']!="" ? "'".utf8_decode($data['psychiatric_other_desc'])."'" : 'NULL'),
		($data['glaucoma']!="" ? '1' : 'NULL'),
		($data['ametropia']!="" ? '1' : 'NULL'),
		($data['waterfalls']!="" ? '1' : 'NULL'),
		($data['eye_other']!="" ? '1' : 'NULL'),
		($data['eye_other_desc']!="" ? "'".utf8_decode($data['eye_other_desc'])."'" : 'NULL'),
		($data['hyperthyroidism']!="" ? '1' : 'NULL'),
		($data['hypothyroidism']!="" ? '1' : 'NULL'),
		($data['cushing']!="" ? '1' : 'NULL'),
		($data['endocrine_other']!="" ? '1' : 'NULL'),
		($data['endocrine_other_desc']!="" ? "'".utf8_decode($data['endocrine_other_desc'])."'" : 'NULL'),
		($data['preeclampsia']!="" ? '1' : 'NULL'),
		($data['cystic_ovary']!="" ? '1' : 'NULL'),
		($data['gestational_diabetes']!="" ? '1' : 'NULL'),
		($data['gynecological_other']!="" ? '1' : 'NULL'),
		($data['gynecological_other_desc']!="" ? "'".utf8_decode($data['gynecological_other_desc'])."'" : 'NULL'),
		($data['parkinson']!="" ? '1' : 'NULL'),
		($data['epilepsy']!="" ? '1' : 'NULL'),
		($data['alzheimer']!="" ? '1' : 'NULL'),
		($data['neurological_other']!="" ? '1' : 'NULL'),
		($data['neurological_other_desc']!="" ? "'".utf8_decode($data['neurological_other_desc'])."'" : 'NULL'),
		($data['tuberculosis']!="" ? '1' : 'NULL'),
		($data['sida']!="" ? '1' : 'NULL'),
		($data['syphilis']!="" ? '1' : 'NULL'),
		($data['infectious_other']!="" ? '1' : 'NULL'),
		($data['infectious_other_desc']!="" ? "'".utf8_decode($data['infectious_other_desc'])."'" : 'NULL'),
		($data['down_syndrome']!="" ? '1' : 'NULL'),
		($data['cretinism_acromegaly']!="" ? '1' : 'NULL'),
		($data['hemophilia']!="" ? '1': 'NULL'),
		($data['genetic_other']!="" ? '1' : 'NULL'),
		($data['genetic_other_desc']!="" ? "'".utf8_decode($data['genetic_other_desc'])."'" : 'NULL'),
		($data['other_diseases']!="" ? "'".utf8_decode($data['other_diseases'])."'" : 'NULL'),
		($data['death_age']!="" ? "'".utf8_decode($data['death_age'])."'" : 'NULL'),
		($data['death_cause']!="" ? "'".utf8_decode($data['death_cause'])."'" : 'NULL'),
		($data['observations']!="" ? "'".utf8_decode($data['observations'])."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de Escala abreviada de la Hoja de administración familiar de DASS-21.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveDass21Data($connection, $method, $data, $id_user){

	$result = saveDass21Data_DOM($connection, $method,
		$data['id_patient'],
		($data['relax']!="" ? "'".$data['relax']."'" : 'NULL'),
		($data['dry_mouth']!="" ? "'".$data['dry_mouth']."'" : 'NULL'),
		($data['positive_feelings']!="" ? "'".$data['positive_feelings']."'" : 'NULL'),
		($data['breathe']!="" ? "'".$data['breathe']."'" : 'NULL'),
		($data['initiative']!="" ? "'".$data['initiative']."'" : 'NULL'),
		($data['exaggerate']!="" ? "'".$data['exaggerate']."'" : 'NULL'),
		($data['tingling_hands']!="" ? "'".$data['tingling_hands']."'" : 'NULL'),
		($data['worried']!="" ? "'".$data['worried']."'" : 'NULL'),
		($data['concerned']!="" ? "'".$data['concerned']."'" : 'NULL'),
		($data['be_down']!="" ? "'".$data['be_down']."'" : 'NULL'),
		($data['agitate']!="" ? "'".$data['agitate']."'" : 'NULL'),
		($data['relax_difficult']!="" ? "'".$data['relax_difficult']."'" : 'NULL'),
		($data['depression']!="" ? "'".$data['depression']."'" : 'NULL'),
		($data['intolerance']!="" ? "'".$data['intolerance']."'" : 'NULL'),
		($data['panic']!="" ? "'".$data['panic']."'" : 'NULL'),
		($data['enthusiasm']!="" ? "'".$data['enthusiasm']."'" : 'NULL'),
		($data['selfsteem']!="" ? "'".$data['selfsteem']."'" : 'NULL'),
		($data['irritable']!="" ? "'".$data['irritable']."'" : 'NULL'),
		($data['feel_agitated']!="" ? "'".$data['feel_agitated']."'" : 'NULL'),
		($data['fear']!="" ? "'".$data['fear']."'" : 'NULL'),
		($data['meaningless_life']!="" ? "'".$data['meaningless_life']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de Encuesta medio ambiente.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveEnvironmentData($connection, $method, $data, $id_user){

	$result = saveEnvironmentData_DOM($connection, $method,
		$data['id_patient'],
		$data['water_acquisition'],
		utf8_decode($data['water_acquisition_desc']),
		$data['water_store'],
		utf8_decode($data['water_store_desc']),
		utf8_decode($data['water_color']),
		utf8_decode($data['water_odor']),
		utf8_decode($data['water_flavor']),
		($data['water_quality_a']!="" ? 1 : 0),
		($data['water_quality_b']!="" ? 1 : 0),
		($data['water_quality_c']!="" ? 1 : 0),
		($data['water_quality_d']!="" ? 1 : 0),
		($data['water_quality_e']!="" ? 1 : 0),
		$data['sewage_type'],
		$data['pollution_react'],
		utf8_decode($data['pollution_react_desc']),
		$data['contamination'],
		utf8_decode($data['contamination_desc']),
		($data['refinery_nearby']!="" ? $data['refinery_nearby'] : 0),
		($data['pipelines_nearby']!="" ? $data['pipelines_nearby'] : 0),
		($data['health_impact_a']!="" ? 1 : 0),
		($data['health_impact_b']!="" ? 1 : 0),
		($data['health_impact_c']!="" ? 1 : 0),
		$data['dangerous_material'],
		utf8_decode($data['dangerous_material_desc']),
		($data['radiation_nearby']!="" ? $data['radiation_nearby'] : 0),
		utf8_decode($data['radiation_nearby_desc']),
		($data['burning_waste']!="" ? $data['burning_waste'] : 0),
		utf8_decode($data['burning_waste_desc']),
		($data['chemical_inspection']!="" ? $data['chemical_inspection'] : 0),
		utf8_decode($data['chemical_inspection_desc']),
		($data['know_pollutants']!="" ? $data['know_pollutants'] : 0),
		utf8_decode($data['know_pollutants_desc']),
		($data['garbage_collection']!="" ? $data['garbage_collection'] : 0),
		utf8_decode($data['garbage_collection_desc']),
		$data['collection_staff'],
		($data['dumps_nearby']!="" ? $data['dumps_nearby'] : 0),
		($data['dumps_nearby_number']!="" ? $data['dumps_nearby_number'] : 0),
		($data['dangerous_residues']!="" ? $data['dangerous_residues'] : 0),
		($data['dangerous_residues_number']!="" ? $data['dangerous_residues_number'] : 0),
		$data['separate_trash'],
		utf8_decode($data['separate_trash_desc']),
		$data['garbage_collection_times'],
		($data['slaughterhouse_nearby']!="" ? $data['slaughterhouse_nearby'] : 0),
		($data['slaughterhouse_nearby_number']!="" ? $data['slaughterhouse_nearby_number'] : 0),
		($data['clandestine_dump']!="" ? $data['clandestine_dump'] : 0),
		($data['clandestine_dump_number']!="" ? $data['clandestine_dump_number'] : 0),
		$data['sociocultural_activities'],
		($data['sociocultural_join']!="" ? $data['sociocultural_join'] : 0),
		($data['values_a']!="" ? 1 : 0),
		($data['values_b']!="" ? 1 : 0),
		($data['values_c']!="" ? 1 : 0),
		($data['values_d']!="" ? 1 : 0),
		($data['values_e']!="" ? 1 : 0),
		($data['values_f']!="" ? 1 : 0),
		($data['values_g']!="" ? 1 : 0),
		($data['values_h']!="" ? 1 : 0),
		($data['values_i']!="" ? 1 : 0),
		($data['consume_of_a']!="" ? 1 : 0),
		($data['consume_of_b']!="" ? 1 : 0),
		($data['consume_of_c']!="" ? 1 : 0),
		($data['consume_of_d']!="" ? 1 : 0),
		($data['consume_of_e']!="" ? 1 : 0),
		utf8_decode($data['work_activity']),
		utf8_decode($data['recreational_activities']),
		$data['hobby'],
		utf8_decode($data['hobby_desc']),
		utf8_decode($data['hobby_number']),
		($data['can_read']!="" ? $data['can_read'] : 0),
		($data['can_write']!="" ? $data['can_write'] : 0),
		$data['education_level'],
		($data['flood_zone']!="" ? $data['flood_zone'] : 0),
		($data['landslide_area']!="" ? $data['landslide_area'] : 0),
		$data['population'],
		$data['number_people'],
		$data['number_rooms'],
		($data['ventilation']!="" ? $data['ventilation'] : 0),
		utf8_decode($data['house_area']),
		($data['hot_water']!="" ? $data['hot_water'] : 0),
		($data['spotlights']!="" ? $data['spotlights'] : 0),
		utf8_decode($data['spotlights_number']),
		$data['house_type'],
		$data['house_materials'],
		$data['floor_type'],
		($data['humidity_home']!="" ? $data['humidity_home'] : 0),
		($data['pesticides_use']!="" ? $data['pesticides_use'] : 0),
		($data['fertilizers_use']!="" ? $data['fertilizers_use'] : 0),
		($data['know_risk']!="" ? $data['know_risk'] : 0),
		($data['have_because_a']!="" ? 1 : 0),
		($data['have_because_b']!="" ? 1 : 0),
		($data['have_because_c']!="" ? 1 : 0),
		($data['know_work_risks']!="" ? $data['know_work_risks'] : 0),
		($data['animals_a']!="" ? 1 : 0),
		($data['animals_b']!="" ? 1 : 0),
		($data['animals_c']!="" ? 1 : 0),
		($data['animals_d']!="" ? 1 : 0),
		($data['animals_e']!="" ? 1 : 0),
		utf8_decode($data['animals_desc']),
		($data['vaccinated']!="" ? $data['vaccinated'] : 0),
		($data['same_room']!="" ? $data['same_room'] : 0),
		($data['antecedent_fleas']!="" ? $data['antecedent_fleas'] : 0),
		($data['rodents_insects_a']!="" ? 1 : 0),
		($data['rodents_insects_b']!="" ? 1 : 0),
		($data['rodents_insects_c']!="" ? 1 : 0),
		($data['rodents_insects_d']!="" ? 1 : 0),
		utf8_decode($data['rodents_insects_desc']),
		$data['animal_waste'],
		($data['mosco_name']!="" ? $data['mosco_name'] : 0),
		($data['mosco_infestation']!="" ? $data['mosco_infestation'] : 0),
		($data['know_dengue']!="" ? $data['know_dengue'] : 0),
		$data['social_networks'],
		($data['suffer_a']!="" ? 1 : 0),
		($data['suffer_b']!="" ? 1 : 0),
		($data['suffer_c']!="" ? 1 : 0),
		($data['know_signs']!="" ? $data['know_signs'] : 0),
		($data['go_doctor']!="" ? $data['go_doctor'] : 0),
		($data['prevention']!="" ? $data['prevention'] : 0),
		($data['basic_sanitation']!="" ? $data['basic_sanitation'] : 0),
		($data['water_containers']!="" ? $data['water_containers'] : 0),
		$data['food_infection'],
		$data['diarrheal_infection'],
		$data['respiratory_infection'],
		($data['smoke_supervision']!="" ? $data['smoke_supervision'] : 0),
		utf8_decode($data['community_health_problems']),
		($data['work_health_services']!="" ? $data['work_health_services'] : 0),
		$data['work_type'],
		($data['work_water']!="" ? $data['work_water'] : 0),
		($data['work_water_a']!="" ? 1 : 0),
		($data['work_water_b']!="" ? 1 : 0),
		($data['work_water_c']!="" ? 1 : 0),
		($data['work_water_d']!="" ? 1 : 0),
		($data['work_hygiene']!="" ? $data['work_hygiene'] : 0),
		($data['work_hygiene_a']!="" ? 1 : 0),
		($data['work_hygiene_b']!="" ? 1 : 0),
		($data['dressing_room']!="" ? $data['dressing_room'] : 0),
		($data['dressing_room_a']!="" ? 1 : 0),
		($data['dressing_room_b']!="" ? 1 : 0),
		($data['work_exposition_a']!="" ? 1 : 0),
		($data['work_exposition_b']!="" ? 1 : 0),
		($data['work_exposition_c']!="" ? 1 : 0),
		utf8_decode($data['work_exposition_desc']),
		($data['work_risk_a']!="" ? 1 : 0),
		($data['work_risk_b']!="" ? 1 : 0),
		($data['work_risk_c']!="" ? 1 : 0),
		($data['work_risk_d']!="" ? 1 : 0),
		utf8_decode($data['work_risk_desc']),
		($data['work_tools']!="" ? $data['work_tools'] : 0),
		($data['suitable_area']!="" ? $data['suitable_area'] : 0),
		($data['protective_equipment']!="" ? $data['protective_equipment'] : 0),
		($data['severe_trauma']!="" ? $data['severe_trauma'] : 0),
		($data['psychosocial_support']!="" ? $data['psychosocial_support'] : 0),
		($data['anxiety_work']!="" ? $data['anxiety_work'] : 0),
		($data['sleep_cycle']!="" ? $data['sleep_cycle'] : 0),
		($data['medical_tests']!="" ? $data['medical_tests'] : 0),
		$data['medical_tests_times'],
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la Escala abreviada de depresión geriátrica deYesavage.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveGeriatricDepressionData($connection, $method, $data, $id_user){

	$result = saveGeriatricDepressionData_DOM($connection, $method,
		$data['id_patient'],
		($data['satisfied']!="" ? $data['satisfied'] : 'NULL'),
		($data['giveup_hobby']!="" ? $data['giveup_hobby'] : 'NULL'),
		($data['empty_life']!="" ? $data['empty_life'] : 'NULL'),
		($data['boredom']!="" ? $data['boredom'] : 'NULL'),
		($data['optimism']!="" ? $data['optimism'] : 'NULL'),
		($data['fear']!="" ? $data['fear'] : 'NULL'),
		($data['happiness']!="" ? $data['happiness'] : 'NULL'),
		($data['abandonment']!="" ? $data['abandonment'] : 'NULL'),
		($data['at_home']!="" ? $data['at_home'] : 'NULL'),
		($data['memory_loss']!="" ? $data['memory_loss'] : 'NULL'),
		($data['love_forlife']!="" ? $data['love_forlife'] : 'NULL'),
		($data['start_difficult']!="" ? $data['start_difficult'] : 'NULL'),
		($data['full_energy']!="" ? $data['full_energy'] : 'NULL'),
		($data['anxiety']!="" ? $data['anxiety'] : 'NULL'),
		($data['economy']!="" ? $data['economy'] : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de Escala abreviada de sobre carga del cuidador de Zarit.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveZarittScaleData($connection, $method, $data, $id_user){

	$result = saveZarittScaleData_DOM($connection, $method,
		$data['id_patient'],
		($data['own_time']!="" ? "'".$data['own_time']."'" : 'NULL'),
		($data['stressed']!="" ? "'".$data['stressed']."'" : 'NULL'),
		($data['relationship']!="" ? "'".$data['relationship']."'" : 'NULL'),
		($data['exhausted']!="" ? "'".$data['exhausted']."'" : 'NULL'),
		($data['healthy']!="" ? "'".$data['healthy']."'" : 'NULL'),
		($data['control_life']!="" ? "'".$data['control_life']."'" : 'NULL'),
		($data['overloaded']!="" ? "'".$data['overloaded']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Enfermedades de transmisión sexual de acuerdo a edad, sexo y orientación sexual.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveETSData($connection, $method, $data, $id_user){

	$result = saveETSData_DOM($connection, $method,
		$data['id_patient'],
		$data['genre'],
		utf8_decode($data['starts_activity']),
		utf8_decode($data['sexual_orientation']),
		utf8_decode($data['couples']),
		($data['safe_sex']!="" ? $data['safe_sex'] : 'NULL'),
		($data['contraceptives']!="" ? $data['contraceptives'] : 'NULL'),
		($data['condom']!="" ? $data['condom'] : 'NULL'),
		($data['intercourse']!="" ? $data['intercourse'] : 'NULL'),
		($data['ets_exposed']!="" ? $data['ets_exposed'] : 'NULL'),
		($data['medical_treatment']!="" ? $data['medical_treatment'] : 'NULL'),
		($data['vih_test']!="" ? $data['vih_test'] : 'NULL'),
		($data['pap_smear']!="" ? $data['pap_smear'] : 'NULL'),
		utf8_decode($data['pap_smear_result']),
		utf8_decode($data['knowledge']),
		($data['ways_transmit']!="" ? $data['ways_transmit'] : 'NULL'),
		($data['talks']!="" ? $data['talks'] : 'NULL'),
		($data['vih_symptom']!="" ? $data['vih_symptom'] : 'NULL'),
		($data['vih_clinic']!="" ? $data['vih_clinic'] : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro del contexto socio-cultural]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveSocioculturalData($connection, $method, $data, $id_user){

	$result = saveSocioculturalData_DOM($connection, $method,
		$data['id_patient'],
		($data['decisions']!="" ? "'".$data['decisions']."'" : 'NULL'),
		($data['harmony']!="" ? "'".$data['harmony']."'" : 'NULL'),
		($data['responsibility']!="" ? "'".$data['responsibility']."'" : 'NULL'),
		($data['sweetie']!="" ? "'".$data['sweetie']."'" : 'NULL'),
		($data['point_blank']!="" ? "'".$data['point_blank']."'" : 'NULL'),
		($data['defects']!="" ? "'".$data['defects']."'" : 'NULL'),
		($data['experience']!="" ? "'".$data['experience']."'" : 'NULL'),
		($data['support']!="" ? "'".$data['support']."'" : 'NULL'),
		($data['tasks']!="" ? "'".$data['tasks']."'" : 'NULL'),
		($data['habits']!="" ? "'".$data['habits']."'" : 'NULL'),
		($data['converse']!="" ? "'".$data['converse']."'" : 'NULL'),
		($data['look_help']!="" ? "'".$data['look_help']."'" : 'NULL'),
		($data['respect']!="" ? "'".$data['respect']."'" : 'NULL'),
		($data['show_affection']!="" ? "'".$data['show_affection']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información de Tamizaje de diabetes mellitus.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveDiabetesData($connection, $method, $data, $id_user){

	$result = saveDiabetesData_DOM($connection, $method,
		$data['id_patient'],
		($data['suffer_from']!="" ? $data['suffer_from'] : 'NULL'),
		($data['thirsty']!="" ? $data['thirsty'] : 'NULL'),
		($data['urinate']!="" ? $data['urinate'] : 'NULL'),
		($data['lose_weight']!="" ? $data['lose_weight'] : 'NULL'),
		($data['over_eat']!="" ? $data['over_eat'] : 'NULL'),
		($data['glucose_check']!="" ? $data['glucose_check'] : 'NULL'),
		($data['medical_times']!="" ? "'".$data['medical_times']."'" : 'NULL'),
		($data['treatment']!="" ? "'".$data['treatment']."'" : 'NULL'),
		($data['feel_bad']!="" ? "'".$data['feel_bad']."'" : 'NULL'),
		($data['check_foot']!="" ? "'".$data['check_foot']."'" : 'NULL'),
		($data['vision_changes']!="" ? "'".$data['vision_changes']."'" : 'NULL'),
		($data['healing_problems']!="" ? "'".$data['healing_problems']."'" : 'NULL'),
		($data['proper_diet']!="" ? "'".$data['proper_diet']."'" : 'NULL'),
		($data['weight_changes']!="" ? "'".$data['weight_changes']."'" : 'NULL'),
		($data['medical_control']!="" ? "'".$data['medical_control']."'" : 'NULL'),
		($data['naturist']!="" ? $data['naturist'] : 'NULL'),
		($data['age']!="" ? "'".$data['age']."'" : 'NULL'),
		($data['gender']!="" ? "'".$data['gender']."'" : 'NULL'),
		($data['gestational_diabetes']!="" ? $data['gestational_diabetes'] : 'NULL'),
		($data['family']!="" ? $data['family'] : 'NULL'),
		($data['blood_pressure']!="" ? $data['blood_pressure'] : 'NULL'),
		($data['physical_activity']!="" ? $data['physical_activity'] : 'NULL'),
		($data['weight']!="" ? "'".$data['weight']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información de Prevención, Tamizaje, Detección y Control de Hipertensión Arterial Sistemica.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveHypertensionData($connection, $method, $data, $id_user){

	$result = saveHypertensionData_DOM($connection, $method,
		$data['id_patient'],
		($data['heart_attack']!="" ? $data['heart_attack'] : 'NULL'),
		($data['family']!="" ? $data['family'] : 'NULL'),
		($data['alcoholic_drinks']!="" ? "'".$data['alcoholic_drinks']."'" : 'NULL'),
		($data['smoke']!="" ? "'".$data['smoke']."'" : 'NULL'),
		($data['blood_test']!="" ? "'".$data['blood_test']."'" : 'NULL'),
		($data['stress']!="" ? "'".$data['stress']."'" : 'NULL'),
		($data['nutrition']!="" ? "'".$data['nutrition']."'" : 'NULL'),
		($data['physical_activity']!="" ? "'".$data['physical_activity']."'" : 'NULL'),
		($data['medical_consult']!="" ? "'".$data['medical_consult']."'" : 'NULL'),
		($data['ringing_ears']!="" ? "'".$data['ringing_ears']."'" : 'NULL'),
		($data['flashes']!="" ? "'".$data['flashes']."'" : 'NULL'),
		($data['headache']!="" ? "'".$data['headache']."'" : 'NULL'),
		($data['pression_check']!="" ? "'".$data['pression_check']."'" : 'NULL'),
		($data['chest_pain']!="" ? "'".$data['chest_pain']."'" : 'NULL'),
		($data['difficulty_breathing']!="" ? "'".$data['difficulty_breathing']."'" : 'NULL'),
		($data['forget_things']!="" ? "'".$data['forget_things']."'" : 'NULL'),
		($data['kidney_test']!="" ? "'".$data['kidney_test']."'" : 'NULL'),
		($data['vision_test']!="" ? "'".$data['vision_test']."'" : 'NULL'),
		($data['medical_visit']!="" ? "'".$data['medical_visit']."'" : 'NULL'),
		($data['treatment']!="" ? "'".$data['treatment']."'" : 'NULL'),
		($data['diet']!="" ? "'".$data['diet']."'" : 'NULL'),
		($data['medical_place']!="" ? "'".$data['medical_place']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Evaluación de crecimiento y desarrollo]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveBornLifestyleData($connection, $method, $data, $id_user){

	$result = saveBornLifestyleData_DOM($connection, $method,
		$data['id_patient'],
		($data['consultations']!="" ? "'".$data['consultations']."'" : 'NULL'),
		($data['pregnancy_complication']!="" ? "'".$data['pregnancy_complication']."'" : 'NULL'),
		($data['pregnancy_resolution']!="" ? "'".$data['pregnancy_resolution']."'" : 'NULL'),
		($data['pregnancy_resolution_desc']!="" ? "'".utf8_decode($data['pregnancy_resolution_desc'])."'" : 'NULL'),
		($data['pregnancy_duration']!="" ? "'".$data['pregnancy_duration']."'" : 'NULL'),
		($data['baby_weight']!="" ? "'".$data['baby_weight']."'" : 'NULL'),
		($data['lactation_type']!="" ? "'".$data['lactation_type']."'" : 'NULL'),
		($data['lactation_desc']!="" ? "'".utf8_decode($data['lactation_desc'])."'" : 'NULL'),
		($data['lactation_duration']!="" ? "'".$data['lactation_duration']."'" : 'NULL'),
		($data['baby_allergy']!="" ? "'".$data['baby_allergy']."'" : 'NULL'),
		($data['tamiz_neonatal']!="" ? "'".$data['tamiz_neonatal']."'" : 'NULL'),
		($data['tamiz_neonatal_desc']!="" ? "'".utf8_decode($data['tamiz_neonatal_desc'])."'" : 'NULL'),
		($data['table_one']!="" ? "'".$data['table_one']."'" : 'NULL'),
		($data['table_two']!="" ? "'".$data['table_two']."'" : 'NULL'),
		($data['table_three']!="" ? "'".$data['table_three']."'" : 'NULL'),
		($data['table_four']!="" ? "'".$data['table_four']."'" : 'NULL'),
		($data['table_five']!="" ? "'".$data['table_five']."'" : 'NULL'),
		($data['table_six']!="" ? "'".$data['table_six']."'" : 'NULL'),
		($data['table_seven']!="" ? "'".$data['table_seven']."'" : 'NULL'),
		($data['table_eight']!="" ? "'".$data['table_eight']."'" : 'NULL'),
		($data['table_nine']!="" ? "'".$data['table_nine']."'" : 'NULL'),
		($data['table_ten']!="" ? "'".$data['table_ten']."'" : 'NULL'),
		($data['table_eleven']!="" ? "'".$data['table_eleven']."'" : 'NULL'),
		($data['table_twelve']!="" ? "'".$data['table_twelve']."'" : 'NULL'),
		($data['table_thirteen']!="" ? "'".$data['table_thirteen']."'" : 'NULL'),
		($data['table_fourteen']!="" ? "'".$data['table_fourteen']."'" : 'NULL'),
		($data['table_fifteen']!="" ? "'".$data['table_fifteen']."'" : 'NULL'),
		($data['table_sixteen']!="" ? "'".$data['table_sixteen']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Evaluación de crecimiento y desarrollo]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveBabyLifestyleData($connection, $method, $data, $id_user){

	$result = saveBabyLifestyleData_DOM($connection, $method,
		$data['id_patient'],
		($data['wake_food']!="" ? "'".$data['wake_food']."'" : 'NULL'),
		($data['chemical_food']!="" ? "'".$data['chemical_food']."'" : 'NULL'),
		($data['food_times']!="" ? "'".$data['food_times']."'" : 'NULL'),
		($data['fast_food']!="" ? "'".$data['fast_food']."'" : 'NULL'),
		($data['fatty_food']!="" ? "'".$data['fatty_food']."'" : 'NULL'),
		($data['mealtime']!="" ? "'".$data['mealtime']."'" : 'NULL'),
		($data['overeat']!="" ? "'".$data['overeat']."'" : 'NULL'),
		($data['balanced_diet']!="" ? "'".$data['balanced_diet']."'" : 'NULL'),
		($data['fruit_diet']!="" ? "'".$data['fruit_diet']."'" : 'NULL'),
		($data['meat_diet']!="" ? "'".$data['meat_diet']."'" : 'NULL'),
		($data['dairy_products']!="" ? $data['dairy_products'] : 'NULL'),
		($data['meats']!="" ? $data['meats'] : 'NULL'),
		($data['tubers']!="" ? $data['tubers'] : 'NULL'),
		($data['vegetables']!="" ? $data['vegetables'] : 'NULL'),
		($data['fruits']!="" ? $data['fruits'] : 'NULL'),
		($data['cereals']!="" ? $data['cereals'] : 'NULL'),
		($data['snacks']!="" ? $data['snacks'] : 'NULL'),
		($data['early_stimulation']!="" ? "'".$data['early_stimulation']."'" : 'NULL'),
		($data['exercise']!="" ? "'".$data['exercise']."'" : 'NULL'),
		($data['exercise_times']!="" ? "'".$data['exercise_times']."'" : 'NULL'),
		($data['sport_active']!="" ? "'".$data['sport_active']."'" : 'NULL'),
		($data['medical_times']!="" ? "'".$data['medical_times']."'" : 'NULL'),
		($data['kid_review']!="" ? "'".$data['kid_review']."'" : 'NULL'),
		($data['medical_exams']!="" ? "'".$data['medical_exams']."'" : 'NULL'),
		($data['dentist']!="" ? "'".$data['dentist']."'" : 'NULL'),
		($data['nutrition']!="" ? "'".$data['nutrition']."'" : 'NULL'),
		($data['psychology']!="" ? "'".$data['psychology']."'" : 'NULL'),
		($data['previous_treatment']!="" ? "'".$data['previous_treatment']."'" : 'NULL'),
		($data['diseases']!="" ? "'".$data['diseases']."'" : 'NULL'),
		($data['childcare']!="" ? "'".$data['childcare']."'" : 'NULL'),
		($data['second_opinion']!="" ? "'".$data['second_opinion']."'" : 'NULL'),
		($data['say_feelings']!="" ? "'".$data['say_feelings']."'" : 'NULL'),
		($data['speak_louder']!="" ? "'".$data['speak_louder']."'" : 'NULL'),
		($data['play']!="" ? "'".$data['play']."'" : 'NULL'),
		($data['withdrawn']!="" ? "'".$data['withdrawn']."'" : 'NULL'),
		($data['share_family']!="" ? "'".$data['share_family']."'" : 'NULL'),
		($data['moodiness']!="" ? "'".$data['moodiness']."'" : 'NULL'),
		($data['work_alone']!="" ? "'".$data['work_alone']."'" : 'NULL'),
		($data['table_one']!="" ? "'".$data['table_one']."'" : 'NULL'),
		($data['table_two']!="" ? "'".$data['table_two']."'" : 'NULL'),
		($data['table_three']!="" ? "'".$data['table_three']."'" : 'NULL'),
		($data['table_four']!="" ? "'".$data['table_four']."'" : 'NULL'),
		($data['table_five']!="" ? "'".$data['table_five']."'" : 'NULL'),
		($data['table_six']!="" ? "'".$data['table_six']."'" : 'NULL'),
		($data['table_seven']!="" ? "'".$data['table_seven']."'" : 'NULL'),
		($data['table_eight']!="" ? "'".$data['table_eight']."'" : 'NULL'),
		($data['table_nine']!="" ? "'".$data['table_nine']."'" : 'NULL'),
		($data['table_ten']!="" ? "'".$data['table_ten']."'" : 'NULL'),
		($data['table_eleven']!="" ? "'".$data['table_eleven']."'" : 'NULL'),
		($data['table_twelve']!="" ? "'".$data['table_twelve']."'" : 'NULL'),
		($data['table_thirteen']!="" ? "'".$data['table_thirteen']."'" : 'NULL'),
		($data['table_fourteen']!="" ? "'".$data['table_fourteen']."'" : 'NULL'),
		($data['table_fifteen']!="" ? "'".$data['table_fifteen']."'" : 'NULL'),
		($data['table_sixteen']!="" ? "'".$data['table_sixteen']."'" : 'NULL'),
		($data['table_seventeen']!="" ? "'".$data['table_seventeen']."'" : 'NULL'),
		($data['table_eighteen']!="" ? "'".$data['table_eighteen']."'" : 'NULL'),
		($data['table_nineteen']!="" ? "'".$data['table_nineteen']."'" : 'NULL'),
		($data['table_twenty']!="" ? "'".$data['table_twenty']."'" : 'NULL'),
		($data['table_twentyone']!="" ? "'".$data['table_twentyone']."'" : 'NULL'),
		($data['table_twentytwo']!="" ? "'".$data['table_twentytwo']."'" : 'NULL'),
		($data['table_twentythree']!="" ? "'".$data['table_twentythree']."'" : 'NULL'),
		($data['bath_times']!="" ? "'".$data['bath_times']."'" : 'NULL'),
		($data['handwashing']!="" ? "'".$data['handwashing']."'" : 'NULL'),
		($data['brush_teeth']!="" ? "'".$data['brush_teeth']."'" : 'NULL'),
		($data['floss_use']!="" ? "'".$data['floss_use']."'" : 'NULL'),
		($data['toothbrush']!="" ? "'".$data['toothbrush']."'" : 'NULL'),
		($data['nails_cut']!="" ? "'".$data['nails_cut']."'" : 'NULL'),
		($data['bath_towel']!="" ? "'".$data['bath_towel']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Evaluación de crecimiento y desarrollo]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveChildLifestyleData($connection, $method, $data, $id_user){

	$result = saveChildLifestyleData_DOM($connection, $method,
		$data['id_patient'],
		($data['wake_food']!="" ? "'".$data['wake_food']."'" : 'NULL'),
		($data['sausages']!="" ? "'".$data['sausages']."'" : 'NULL'),
		($data['food_times']!="" ? "'".$data['food_times']."'" : 'NULL'),
		($data['fast_food']!="" ? "'".$data['fast_food']."'" : 'NULL'),
		($data['fatty_food']!="" ? "'".$data['fatty_food']."'" : 'NULL'),
		($data['mealtime']!="" ? "'".$data['mealtime']."'" : 'NULL'),
		($data['balanced_diet']!="" ? "'".$data['balanced_diet']."'" : 'NULL'),
		($data['dairy_products']!="" ? $data['dairy_products'] : 'NULL'),
		($data['meats']!="" ? $data['meats'] : 'NULL'),
		($data['tubers']!="" ? $data['tubers'] : 'NULL'),
		($data['vegetables']!="" ? $data['vegetables'] : 'NULL'),
		($data['fruits']!="" ? $data['fruits'] : 'NULL'),
		($data['cereals']!="" ? $data['cereals'] : 'NULL'),
		($data['snacks']!="" ? $data['snacks'] : 'NULL'),
		($data['exercise']!="" ? "'".$data['exercise']."'" : 'NULL'),
		($data['exercise_times']!="" ? "'".$data['exercise_times']."'" : 'NULL'),
		($data['sport_active']!="" ? "'".$data['sport_active']."'" : 'NULL'),
		($data['medical_times']!="" ? "'".$data['medical_times']."'" : 'NULL'),
		($data['kid_review']!="" ? "'".$data['kid_review']."'" : 'NULL'),
		($data['medical_exams']!="" ? "'".$data['medical_exams']."'" : 'NULL'),
		($data['dentist']!="" ? "'".$data['dentist']."'" : 'NULL'),
		($data['psychology']!="" ? "'".$data['psychology']."'" : 'NULL'),
		($data['nutrition']!="" ? "'".$data['nutrition']."'" : 'NULL'),
		($data['previous_treatment']!="" ? "'".$data['previous_treatment']."'" : 'NULL'),
		($data['diseases']!="" ? "'".$data['diseases']."'" : 'NULL'),
		($data['childcare']!="" ? "'".$data['childcare']."'" : 'NULL'),
		($data['second_opinion']!="" ? "'".$data['second_opinion']."'" : 'NULL'),
		($data['restless']!="" ? "'".$data['restless']."'" : 'NULL'),
		($data['quiet']!="" ? "'".$data['quiet']."'" : 'NULL'),
		($data['difficulty_relating']!="" ? "'".$data['difficulty_relating']."'" : 'NULL'),
		($data['weeping']!="" ? "'".$data['weeping']."'" : 'NULL'),
		($data['alone_prefer']!="" ? "'".$data['alone_prefer']."'" : 'NULL'),
		($data['bath_times']!="" ? "'".$data['bath_times']."'" : 'NULL'),
		($data['handwashing']!="" ? "'".$data['handwashing']."'" : 'NULL'),
		($data['brush_teeth']!="" ? "'".$data['brush_teeth']."'" : 'NULL'),
		($data['floss_use']!="" ? "'".$data['floss_use']."'" : 'NULL'),
		($data['underwear']!="" ? "'".$data['underwear']."'" : 'NULL'),
		($data['nails_cut']!="" ? "'".$data['nails_cut']."'" : 'NULL'),
		($data['bath_towel']!="" ? "'".$data['bath_towel']."'" : 'NULL'),
		($data['diagnostic_disorder']!="" ? "'".$data['diagnostic_disorder']."'" : 'NULL'),
		($data['school_perform']!="" ? "'".$data['school_perform']."'" : 'NULL'),
		($data['relates']!="" ? "'".$data['relates']."'" : 'NULL'),
		($data['stumbles']!="" ? "'".$data['stumbles']."'" : 'NULL'),
		($data['vision_problems']!="" ? "'".$data['vision_problems']."'" : 'NULL'),
		($data['approximate']!="" ? "'".$data['approximate']."'" : 'NULL'),
		($data['headache']!="" ? "'".$data['headache']."'" : 'NULL'),
		($data['difficult_learn']!="" ? "'".$data['difficult_learn']."'" : 'NULL'),
		($data['frequent_restless']!="" ? "'".$data['frequent_restless']."'" : 'NULL'),
		($data['difficult_pronounce']!="" ? "'".$data['difficult_pronounce']."'" : 'NULL'),
		($data['letter_invert']!="" ? "'".$data['letter_invert']."'" : 'NULL'),
		($data['unfinished_activities']!="" ? "'".$data['unfinished_activities']."'" : 'NULL'),
		($data['naughty']!="" ? "'".$data['naughty']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Evaluación de crecimiento y desarrollo]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveYoungLifestyleData($connection, $method, $data, $id_user){

	$result = saveYoungLifestyleData_DOM($connection, $method,
		$data['id_patient'],
		($data['wake_food']!="" ? "'".$data['wake_food']."'" : 'NULL'),
		($data['chemical_food']!="" ? "'".$data['chemical_food']."'" : 'NULL'),
		($data['food_times']!="" ? "'".$data['food_times']."'" : 'NULL'),
		($data['fast_food']!="" ? "'".$data['fast_food']."'" : 'NULL'),
		($data['fatty_food']!="" ? "'".$data['fatty_food']."'" : 'NULL'),
		($data['mealtime']!="" ? "'".$data['mealtime']."'" : 'NULL'),
		($data['overeat']!="" ? "'".$data['overeat']."'" : 'NULL'),
		($data['balanced_diet']!="" ? "'".$data['balanced_diet']."'" : 'NULL'),
		($data['eat_pleasure']!="" ? "'".$data['eat_pleasure']."'" : 'NULL'),
		($data['check_labels']!="" ? "'".$data['check_labels']."'" : 'NULL'),
		($data['dairy_products']!="" ? $data['dairy_products'] : 'NULL'),
		($data['meats']!="" ? $data['meats'] : 'NULL'),
		($data['tubers']!="" ? $data['tubers'] : 'NULL'),
		($data['vegetables']!="" ? $data['vegetables'] : 'NULL'),
		($data['fruits']!="" ? $data['fruits'] : 'NULL'),
		($data['cereals']!="" ? $data['cereals'] : 'NULL'),
		($data['snacks']!="" ? $data['snacks'] : 'NULL'),
		($data['exercise']!="" ? "'".$data['exercise']."'" : 'NULL'),
		($data['exercise_times']!="" ? "'".$data['exercise_times']."'" : 'NULL'),
		($data['sport_active']!="" ? "'".$data['sport_active']."'" : 'NULL'),
		($data['medical_times']!="" ? "'".$data['medical_times']."'" : 'NULL'),
		($data['body_explore']!="" ? "'".$data['body_explore']."'" : 'NULL'),
		($data['medical_exams']!="" ? "'".$data['medical_exams']."'" : 'NULL'),
		($data['blood_pressure']!="" ? "'".$data['blood_pressure']."'" : 'NULL'),
		($data['dentist']!="" ? "'".$data['dentist']."'" : 'NULL'),
		($data['psychology']!="" ? "'".$data['psychology']."'" : 'NULL'),
		($data['nutrition']!="" ? "'".$data['nutrition']."'" : 'NULL'),
		($data['self_medicate']!="" ? "'".$data['self_medicate']."'" : 'NULL'),
		($data['diseases']!="" ? "'".$data['diseases']."'" : 'NULL'),
		($data['search_information']!="" ? "'".$data['search_information']."'" : 'NULL'),
		($data['second_opinion']!="" ? "'".$data['second_opinion']."'" : 'NULL'),
		($data['relax_time']!="" ? "'".$data['relax_time']."'" : 'NULL'),
		($data['stress_causes']!="" ? "'".$data['stress_causes']."'" : 'NULL'),
		($data['stress_impact']!="" ? "'".$data['stress_impact']."'" : 'NULL'),
		($data['stress_control_methods']!="" ? "'".$data['stress_control_methods']."'" : 'NULL'),
		($data['confident']!="" ? "'".$data['confident']."'" : 'NULL'),
		($data['feeling_alone']!="" ? "'".$data['feeling_alone']."'" : 'NULL'),
		($data['difficulty_relating']!="" ? "'".$data['difficulty_relating']."'" : 'NULL'),
		($data['criticize']!="" ? "'".$data['criticize']."'" : 'NULL'),
		($data['no_opinion']!="" ? "'".$data['no_opinion']."'" : 'NULL'),
		($data['tofeel_affection']!="" ? "'".$data['tofeel_affection']."'" : 'NULL'),
		($data['affection_taste']!="" ? "'".$data['affection_taste']."'" : 'NULL'),
		($data['alone_prefer']!="" ? "'".$data['alone_prefer']."'" : 'NULL'),
		($data['love_me']!="" ? "'".$data['love_me']."'" : 'NULL'),
		($data['purpose_life']!="" ? "'".$data['purpose_life']."'" : 'NULL'),
		($data['enthusiast']!="" ? "'".$data['enthusiast']."'" : 'NULL'),
		($data['long_term_goals']!="" ? "'".$data['long_term_goals']."'" : 'NULL'),
		($data['realistic_goals']!="" ? "'".$data['realistic_goals']."'" : 'NULL'),
		($data['fulfilled_goals']!="" ? "'".$data['fulfilled_goals']."'" : 'NULL'),
		($data['capacity_debility']!="" ? "'".$data['capacity_debility']."'" : 'NULL'),
		($data['mistakes']!="" ? "'".$data['mistakes']."'" : 'NULL'),
		($data['recreation']!="" ? "'".$data['recreation']."'" : 'NULL'),
		($data['entertainment_time']!="" ? "'".$data['entertainment_time']."'" : 'NULL'),
		($data['alcohol']!="" ? "'".$data['alcohol']."'" : 'NULL'),
		($data['cigar']!="" ? "'".$data['cigar']."'" : 'NULL'),
		($data['recreational_activities']!="" ? "'".$data['recreational_activities']."'" : 'NULL'),
		($data['time_sleep']!="" ? "'".$data['time_sleep']."'" : 'NULL'),
		($data['insomnia']!="" ? "'".$data['insomnia']."'" : 'NULL'),
		($data['wake_midnight']!="" ? "'".$data['wake_midnight']."'" : 'NULL'),
		($data['drowsiness']!="" ? "'".$data['drowsiness']."'" : 'NULL'),
		($data['shortness_breath']!="" ? "'".$data['shortness_breath']."'" : 'NULL'),
		($data['cough_snore']!="" ? "'".$data['cough_snore']."'" : 'NULL'),
		($data['nightmare']!="" ? "'".$data['nightmare']."'" : 'NULL'),
		($data['thoughts']!="" ? "'".$data['thoughts']."'" : 'NULL'),
		($data['sleeping_pills']!="" ? "'".$data['sleeping_pills']."'" : 'NULL'),
		($data['energy_drink']!="" ? "'".$data['energy_drink']."'" : 'NULL'),
		($data['bath_times']!="" ? "'".$data['bath_times']."'" : 'NULL'),
		($data['handwashing']!="" ? "'".$data['handwashing']."'" : 'NULL'),
		($data['brush_teeth']!="" ? "'".$data['brush_teeth']."'" : 'NULL'),
		($data['floss_use']!="" ? "'".$data['floss_use']."'" : 'NULL'),
		($data['toothbrush']!="" ? "'".$data['toothbrush']."'" : 'NULL'),
		($data['deodorant']!="" ? "'".$data['deodorant']."'" : 'NULL'),
		($data['underwear']!="" ? "'".$data['underwear']."'" : 'NULL'),
		($data['nails_cut']!="" ? "'".$data['nails_cut']."'" : 'NULL'),
		($data['bath_towel']!="" ? "'".$data['bath_towel']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Cuidado de la Salud]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveHealthCareData($connection, $method, $data, $id_user){

	$result = saveHealthCareData_DOM($connection, $method,
		$data['id_patient'],
		($data['scare']!="" ? "'".$data['scare']."'" : 'NULL'),
		($data['confront']!="" ? "'".$data['confront']."'" : 'NULL'),
		($data['take_control']!="" ? "'".$data['take_control']."'" : 'NULL'),
		($data['relapse']!="" ? "'".$data['relapse']."'" : 'NULL'),
		($data['bad_inside']!="" ? "'".$data['bad_inside']."'" : 'NULL'),
		($data['normal']!="" ? "'".$data['normal']."'" : 'NULL'),
		($data['personality']!="" ? "'".$data['personality']."'" : 'NULL'),
		($data['something_inside']!="" ? "'".$data['something_inside']."'" : 'NULL'),
		($data['professionals']!="" ? "'".$data['professionals']."'" : 'NULL'),
		($data['competent']!="" ? "'".$data['competent']."'" : 'NULL'),
		($data['can_work']!="" ? "'".$data['can_work']."'" : 'NULL'),
		($data['ashamed']!="" ? "'".$data['ashamed']."'" : 'NULL'),
		($data['judge_me']!="" ? "'".$data['judge_me']."'" : 'NULL'),
		($data['can_talk']!="" ? "'".$data['can_talk']."'" : 'NULL'),
		($data['draw_away']!="" ? "'".$data['draw_away']."'" : 'NULL'),
		($data['psychiatric']!="" ? "'".$data['psychiatric']."'" : 'NULL'),
		($data['well_mentally']!="" ? "'".$data['well_mentally']."'" : 'NULL'),
		($data['mental_illness']!="" ? "'".$data['mental_illness']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Atención médica y planificación familiar + antecedentes gineco-obstétricos.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveGynecologyData($connection, $method, $data, $id_user){

	$result = saveGynecologyData_DOM($connection, $method,
		$data['id_patient'],
		($data['ferrous_fumarate_a']!="" ? $data['ferrous_fumarate_a'] : 'NULL'),
		($data['ferrous_fumarate_b']!="" ? $data['ferrous_fumarate_b'] : 'NULL'),
		($data['ferrous_fumarate_c']!="" ? $data['ferrous_fumarate_c'] : 'NULL'),
		($data['ferrous_fumarate_d']!="" ? $data['ferrous_fumarate_d'] : 'NULL'),
		($data['folic_acid_a']!="" ? $data['folic_acid_a'] : 'NULL'),
		($data['folic_acid_b']!="" ? $data['folic_acid_b'] : 'NULL'),
		($data['folic_acid_c']!="" ? $data['folic_acid_c'] : 'NULL'),
		($data['folic_acid_d']!="" ? $data['folic_acid_d'] : 'NULL'),
		($data['multivitamins_a']!="" ? $data['multivitamins_a'] : 'NULL'),
		($data['multivitamins_b']!="" ? $data['multivitamins_b'] : 'NULL'),
		($data['multivitamins_c']!="" ? $data['multivitamins_c'] : 'NULL'),
		($data['multivitamins_d']!="" ? $data['multivitamins_d'] : 'NULL'),
		($data['hiv_test_a']!="" ? $data['hiv_test_a'] : 'NULL'),
		($data['hiv_test_b']!="" ? $data['hiv_test_b'] : 'NULL'),
		($data['hiv_test_c']!="" ? $data['hiv_test_c'] : 'NULL'),
		($data['hiv_test_d']!="" ? $data['hiv_test_d'] : 'NULL'),
		($data['syphilis_test_a']!="" ? $data['syphilis_test_a'] : 'NULL'),
		($data['syphilis_test_b']!="" ? $data['syphilis_test_b'] : 'NULL'),
		($data['syphilis_test_c']!="" ? $data['syphilis_test_c'] : 'NULL'),
		($data['syphilis_test_d']!="" ? $data['syphilis_test_d'] : 'NULL'),
		($data['newborn_care_a']!="" ? $data['newborn_care_a'] : 'NULL'),
		($data['newborn_care_b']!="" ? $data['newborn_care_b'] : 'NULL'),
		($data['newborn_care_c']!="" ? $data['newborn_care_c'] : 'NULL'),
		($data['newborn_care_d']!="" ? $data['newborn_care_d'] : 'NULL'),
		($data['breast_feed_a']!="" ? $data['breast_feed_a'] : 'NULL'),
		($data['breast_feed_b']!="" ? $data['breast_feed_b'] : 'NULL'),
		($data['breast_feed_c']!="" ? $data['breast_feed_c'] : 'NULL'),
		($data['breast_feed_d']!="" ? $data['breast_feed_d'] : 'NULL'),
		($data['get_married']!="" ? "'".utf8_decode($data['get_married'])."'" : 'NULL'),
		($data['children_plan']!="" ? "'".utf8_decode($data['children_plan'])."'" : 'NULL'),
		($data['children_current']!="" ? "'".utf8_decode($data['children_current'])."'" : 'NULL'),
		($data['planning_method']!="" ? "'".utf8_decode($data['planning_method'])."'" : 'NULL'),
		($data['transporter']!="" ? $data['transporter'] : 'NULL'),
		($data['relationship']!="" ? "'".utf8_decode($data['relationship'])."'" : 'NULL'),
		($data['transport']!="" ? $data['transport'] : 'NULL'),
		($data['vehicle_type']!="" ? "'".utf8_decode($data['vehicle_type'])."'" : 'NULL'),
		($data['medical_service']!="" ? "'".utf8_decode($data['medical_service'])."'" : 'NULL'),
		($data['odontology']!="" ? "'".utf8_decode($data['odontology'])."'" : 'NULL'),
		($data['fur']!="" ? "'".utf8_decode($data['fur'])."'" : 'NULL'),
		($data['ivsa']!="" ? "'".utf8_decode($data['ivsa'])."'" : 'NULL'),
		($data['childbirth']!="" ? $data['childbirth'] : 'NULL'),
		($data['caesarean']!="" ? $data['caesarean'] : 'NULL'),
		($data['abortion']!="" ? $data['abortion'] : 'NULL'),
		($data['children_live']!="" ? $data['children_live'] : 'NULL'),
		($data['children_dead']!="" ? $data['children_dead'] : 'NULL'),
		($data['min_weight']!="" ? $data['min_weight'] : 'NULL'),
		($data['max_weight']!="" ? $data['max_weight'] : 'NULL'),
		($data['self_manual']!="" ? "'".utf8_decode($data['self_manual'])."'" : 'NULL'),
		($data['self_image']!="" ? "'".utf8_decode($data['self_image'])."'" : 'NULL'),
		($data['exam_manual']!="" ? "'".utf8_decode($data['exam_manual'])."'" : 'NULL'),
		($data['exam_image']!="" ? "'".utf8_decode($data['exam_image'])."'" : 'NULL'),
		($data['menopausia']!="" ? "'".utf8_decode($data['menopausia'])."'" : 'NULL'),
		($data['mammography_date']!="" ? "'".$data['mammography_date']."'" : 'NULL'),
		($data['mammography_result']!="" ? "'".utf8_decode($data['mammography_result'])."'" : 'NULL'),
		($data['densitometry_date']!="" ? "'".$data['densitometry_date']."'" : 'NULL'),
		($data['densitometry_result']!="" ? "'".utf8_decode($data['densitometry_result'])."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Signos vitales + Laboratorio]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveVitalSignData($connection, $method, $data, $id_user){

	$result = saveVitalSignData_DOM($connection, $method,
		$data['id_patient'],
		($data['blood_pressure']!="" ? "'".utf8_decode($data['blood_pressure'])."'" : 'NULL'),
		($data['heart_rate']!="" ? $data['heart_rate'] : 'NULL'),
		($data['breathe_rate']!="" ? $data['breathe_rate'] : 'NULL'),
		($data['temperature']!="" ? $data['temperature'] : 'NULL'),
		($data['glucose']!="" ? $data['glucose'] : 'NULL'),
		($data['weight']!="" ? $data['weight'] : 'NULL'),
		($data['height']!="" ? $data['height'] : 'NULL'),
		($data['body_mass']!="" ? $data['body_mass'] : 'NULL'),
		($data['body_fat']!="" ? $data['body_fat'] : 'NULL'),
		($data['arm_perimeter']!="" ? $data['arm_perimeter'] : 'NULL'),
		($data['abdomen_perimeter']!="" ? $data['abdomen_perimeter'] : 'NULL'),
		($data['capillary_refill']!="" ? $data['capillary_refill'] : 'NULL'),
		($data['saturation']!="" ? $data['saturation'] : 'NULL'),
		($data['glycated_hemoglobin']!="" ? $data['glycated_hemoglobin'] : 'NULL'),
		($data['glucose_lab']!="" ? $data['glucose_lab'] : 'NULL'),
		($data['creatinine']!="" ? $data['creatinine'] : 'NULL'),
		($data['cholesterol']!="" ? $data['cholesterol'] : 'NULL'),
		($data['triglycerides']!="" ? $data['triglycerides'] : 'NULL'),
		($data['prostatic_antigen']!="" ? $data['prostatic_antigen'] : 'NULL'),
		($data['sida']!="" ? $data['sida'] : 'NULL'),
		($data['syphilis']!="" ? $data['syphilis'] : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la secciónd de Cuestionario para evaluación de violencia de género.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveGenderViolenceData($connection, $method, $data, $id_user){

	$result = saveGenderViolenceData_DOM($connection, $method,
		$data['id_patient'],
		($data['push_up']!="" ? "'".$data['push_up']."'" : 'NULL'),
		($data['push_down']!="" ? "'".$data['push_down']."'" : 'NULL'),
		($data['strike']!="" ? "'".$data['strike']."'" : 'NULL'),
		($data['wants']!="" ? "'".$data['wants']."'" : 'NULL'),
		($data['useless']!="" ? "'".$data['useless']."'" : 'NULL'),
		($data['normal_hit']!="" ? "'".$data['normal_hit']."'" : 'NULL'),
		($data['without_reason']!="" ? "'".$data['without_reason']."'" : 'NULL'),
		($data['violent']!="" ? "'".$data['violent']."'" : 'NULL'),
		($data['forced_sex']!="" ? "'".$data['forced_sex']."'" : 'NULL'),
		($data['engagement_sex']!="" ? "'".$data['engagement_sex']."'" : 'NULL'),
		($data['sex_fear']!="" ? "'".$data['sex_fear']."'" : 'NULL'),
		($data['bad_treatments']!="" ? "'".$data['bad_treatments']."'" : 'NULL'),
		($data['decide_4me']!="" ? "'".$data['decide_4me']."'" : 'NULL'),
		($data['isolates_me']!="" ? "'".$data['isolates_me']."'" : 'NULL'),
		($data['try_isolate']!="" ? "'".$data['try_isolate']."'" : 'NULL'),
		($data['feel_guilty']!="" ? "'".$data['feel_guilty']."'" : 'NULL'),
		($data['insults_me']!="" ? "'".$data['insults_me']."'" : 'NULL'),
		($data['bruises']!="" ? "'".$data['bruises']."'" : 'NULL'),
		($data['be_alert']!="" ? "'".$data['be_alert']."'" : 'NULL'),
		($data['denounced']!="" ? "'".$data['denounced']."'" : 'NULL'),
		($data['look_scare']!="" ? "'".$data['look_scare']."'" : 'NULL'),
		($data['feel_alone']!="" ? "'".$data['feel_alone']."'" : 'NULL'),
		($data['can_work']!="" ? "'".$data['can_work']."'" : 'NULL'),
		($data['see_family']!="" ? "'".$data['see_family']."'" : 'NULL'),
		($data['watches_me']!="" ? "'".$data['watches_me']."'" : 'NULL'),
		($data['keep_hooked']!="" ? "'".$data['keep_hooked']."'" : 'NULL'),
		($data['regret_guilty']!="" ? "'".$data['regret_guilty']."'" : 'NULL'),
		($data['care_aspect']!="" ? "'".$data['care_aspect']."'" : 'NULL'),
		($data['have_obey']!="" ? "'".$data['have_obey']."'" : 'NULL'),
		($data['gender_equality']!="" ? "'".$data['gender_equality']."'" : 'NULL'),
		($data['protect_couple']!="" ? "'".$data['protect_couple']."'" : 'NULL'),
		($data['private_life']!="" ? "'".$data['private_life']."'" : 'NULL'),
		($data['slap_necessary']!="" ? "'".$data['slap_necessary']."'" : 'NULL'),
		($data['abuser_failed']!="" ? "'".$data['abuser_failed']."'" : 'NULL'),
		($data['good_bad']!="" ? "'".$data['good_bad']."'" : 'NULL'),
		($data['life_proyect']!="" ? "'".$data['life_proyect']."'" : 'NULL'),
		($data['without_father']!="" ? "'".$data['without_father']."'" : 'NULL'),
		($data['childrens']!="" ? "'".$data['childrens']."'" : 'NULL'),
		($data['without_me']!="" ? "'".$data['without_me']."'" : 'NULL'),
		($data['love_him']!="" ? "'".$data['love_him']."'" : 'NULL'),
		($data['feel_sorry']!="" ? "'".$data['feel_sorry']."'" : 'NULL'),
		($data['marriage']!="" ? "'".$data['marriage']."'" : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la secciónd de Escala de desesperanza de Beck.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveHopelessData($connection, $method, $data, $id_user){

	$result = saveHopelessData_DOM($connection, $method,
		$data['id_patient'],
		($data['hope']!="" ? $data['hope'] : 'NULL'),
		($data['renounce']!="" ? $data['renounce'] : 'NULL'),
		($data['relief']!="" ? $data['relief'] : 'NULL'),
		($data['imagine']!="" ? $data['imagine'] : 'NULL'),
		($data['have_time']!="" ? $data['have_time'] : 'NULL'),
		($data['future']!="" ? $data['future'] : 'NULL'),
		($data['dark_future']!="" ? $data['dark_future'] : 'NULL'),
		($data['expect_good']!="" ? $data['expect_good'] : 'NULL'),
		($data['cant_change']!="" ? $data['cant_change'] : 'NULL'),
		($data['experiences']!="" ? $data['experiences'] : 'NULL'),
		($data['unpleasant_future']!="" ? $data['unpleasant_future'] : 'NULL'),
		($data['expect_anything']!="" ? $data['expect_anything'] : 'NULL'),
		($data['happy_future']!="" ? $data['happy_future'] : 'NULL'),
		($data['things_wrong']!="" ? $data['things_wrong'] : 'NULL'),
		($data['expect_future']!="" ? $data['expect_future'] : 'NULL'),
		($data['not_want']!="" ? $data['not_want'] : 'NULL'),
		($data['satisfaction']!="" ? $data['satisfaction'] : 'NULL'),
		($data['uncertain_future']!="" ? $data['uncertain_future'] : 'NULL'),
		($data['good_times']!="" ? $data['good_times'] : 'NULL'),
		($data['dont_try']!="" ? $data['dont_try'] : 'NULL'),
		$id_user);

	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Vacunación]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveChildVaccinatonData($connection, $method, $data, $id_user){

	$result = saveChildVaccinatonData_DOM($connection, $method,
		$data["id_patient"],
		($data['bcg']!="" ? 1 : 0),
		$data["bcg_date"],
		utf8_decode($data['bcg_desc']),
		($data['hepatb1']!="" ? 1 : 0),
		$data["hepatb1_date"],
		utf8_decode($data['hepatb1_desc']),
		($data['pentavalente1']!="" ? 1 : 0),
		$data["pentavalente1_date"],
		utf8_decode($data['pentavalente1_desc']),
		($data['hepatb2']!="" ? 1 : 0),
		$data["hepatb2_date"],
		utf8_decode($data['hepatb2_desc']),
		($data['neumoco1']!="" ? 1 : 0),
		$data["neumoco1_date"],
		utf8_decode($data['neumoco1_desc']),
		($data['rotavirus1']!="" ? 1 : 0),
		$data["rotavirus1_date"],
		utf8_decode($data['rotavirus1_desc']),
		($data['pentavalente2']!="" ? 1 : 0),
		$data["pentavalente2_date"],
		utf8_decode($data['pentavalente2_desc']),
		($data['neumoco2']!="" ? 1 : 0),
		$data["neumoco2_date"],
		utf8_decode($data['neumoco2_desc']),
		($data['rotavirus2']!="" ? 1 : 0),
		$data["rotavirus2_date"],
		utf8_decode($data['rotavirus2_desc']),
		($data['pentavalente3']!="" ? 1 : 0),
		$data["pentavalente3_date"],
		utf8_decode($data['pentavalente3_desc']),
		($data['hepatb3']!="" ? 1 : 0),
		$data["hepatb3_date"],
		utf8_decode($data['hepatb3_desc']),
		($data['influenza1']!="" ? 1 : 0),
		$data["influenza1_date"],
		utf8_decode($data['influenza1_desc']),
		($data['rotavirus3']!="" ? 1 : 0),
		$data["rotavirus3_date"],
		utf8_decode($data['rotavirus3_desc']),
		($data['influenza2']!="" ? 1 : 0),
		$data["influenza2_date"],
		utf8_decode($data['influenza2_desc']),
		($data['sarampion1']!="" ? 1 : 0),
		$data["sarampion1_date"],
		utf8_decode($data['sarampion1_desc']),
		($data['neumocorev']!="" ? 1 : 0),
		$data["neumocorev_date"],
		utf8_decode($data['neumocorev_desc']),
		($data['pentavalenteref']!="" ? 1 : 0),
		$data["pentavalenteref_date"],
		utf8_decode($data['pentavalenteref_desc']),
		($data['influenza3']!="" ? 1 : 0),
		$data["influenza3_date"],
		utf8_decode($data['influenza3_desc']),
		($data['influenza4']!="" ? 1 : 0),
		$data["influenza4_date"],
		utf8_decode($data['influenza4_desc']),
		($data['dptref']!="" ? 1 : 0),
		$data["dptref_date"],
		utf8_decode($data['dptref_desc']),
		($data['influenza5']!="" ? 1 : 0),
		$data["influenza5_date"],
		utf8_decode($data['influenza5_desc']),
		($data['influenza6']!="" ? 1 : 0),
		$data["influenza6_date"],
		utf8_decode($data['influenza6_desc']),
		($data['sabin']!="" ? 1 : 0),
		$data["sabin_date"],
		utf8_decode($data['sabin_desc']),
		($data['sarampion2']!="" ? 1 : 0),
		$data["sarampion2_date"],
		utf8_decode($data['sarampion2_desc']),
		($data['sarampion3']!="" ? 1 : 0),
		$data["sarampion3_date"],
		utf8_decode($data['sarampion3_desc']),
	 	$id_user);
	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Vacunación]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveYoungVaccinatonData($connection, $method, $data, $id_user){

	$result = saveYoungVaccinatonData_DOM($connection, $method,
		$data["id_patient"],
		($data['hepatb']!="" ? 1 : 0),
		$data["hepatb_date"],
		utf8_decode($data['hepatb_desc']),
		($data['hepatb2']!="" ? 1 : 0),
		$data["hepatb2_date"],
		utf8_decode($data['hepatb2_desc']),
		($data['dptc']!="" ? 1 : 0),
		$data["dptc_date"],
		utf8_decode($data['dptc_desc']),
		($data['dpti1']!="" ? 1 : 0),
		$data["dpti1_date"],
		utf8_decode($data['dpti1_desc']),
		($data['dpti2']!="" ? 1 : 0),
		$data["dpti2_date"],
		utf8_decode($data['dpti2_desc']),
		($data['dpti3']!="" ? 1 : 0),
		$data["dpti3_date"],
		utf8_decode($data['dpti3_desc']),
		($data['dptp']!="" ? 1 : 0),
		$data["dptp_date"],
		utf8_decode($data['dptp_desc']),
		($data['influenzap']!="" ? 1 : 0),
		$data["influenzap_date"],
		utf8_decode($data['influenzap_desc']),
		($data['influenza']!="" ? 1 : 0),
		$data["influenza_date"],
		utf8_decode($data['influenza_desc']),
		($data['influenza2']!="" ? 1 : 0),
		$data["influenza2_date"],
		utf8_decode($data['influenza2_desc']),
		($data['influenza3']!="" ? 1 : 0),
		$data["influenza3_date"],
		utf8_decode($data['influenza3_desc']),
		($data['influenza4']!="" ? 1 : 0),
		$data["influenza4_date"],
		utf8_decode($data['influenza4_desc']),
		($data['influenza5']!="" ? 1 : 0),
		$data["influenza5_date"],
		utf8_decode($data['influenza5_desc']),
		($data['influenza6']!="" ? 1 : 0),
		$data["influenza6_date"],
		utf8_decode($data['influenza6_desc']),
		$data["influenza7_date"],
		utf8_decode($data['influenza7_desc']),
		$data["influenza8_date"],
		utf8_decode($data['influenza8_desc']),
		($data['sarampion']!="" ? 1 : 0),
		$data["sarampion_date"],
		utf8_decode($data['sarampion_desc']),
		($data['sarampionsa1']!="" ? 1 : 0),
		$data["sarampionsa1_date"],
		utf8_decode($data['sarampionsa1_desc']),
		($data['sarampionsa2']!="" ? 1 : 0),
		$data["sarampionsa2_date"],
		utf8_decode($data['sarampionsa2_desc']),
		($data['vph']!="" ? 1 : 0),
		$data["vph_date"],
		utf8_decode($data['vph_desc']),
		($data['vph2']!="" ? 1 : 0),
		$data["vph2_date"],
		utf8_decode($data['vph2_desc']),
	 	$id_user);
	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Vacunación]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveAdultVaccinatonData($connection, $method, $data, $id_user){

	$result = saveAdultVaccinatonData_DOM($connection, $method,
		$data["id_patient"],
		($data['sarampion']!="" ? 1 : 0),
		$data["sarampion_date"],
		utf8_decode($data['sarampion_desc']),
		($data['sarampionsa1']!="" ? 1 : 0),
		$data["sarampionsa1_date"],
		utf8_decode($data['sarampionsa1_desc']),
		($data['sarampionsa2']!="" ? 1 : 0),
		$data["sarampionsa2_date"],
		utf8_decode($data['sarampionsa2_desc']),
		($data['dptc']!="" ? 1 : 0),
		$data["dptc_date"],
		utf8_decode($data['dptc_desc']),
		($data['dptc1']!="" ? 1 : 0),
		$data["dptc1_date"],
		utf8_decode($data['dptc1_desc']),
		($data['dptc2']!="" ? 1 : 0),
		$data["dptc2_date"],
		utf8_decode($data['dptc2_desc']),
		($data['dpti1']!="" ? 1 : 0),
		$data["dpti1_date"],
		utf8_decode($data['dpti1_desc']),
		($data['dpti2']!="" ? 1 : 0),
		$data["dpti2_date"],
		utf8_decode($data['dpti2_desc']),
		($data['dpti3']!="" ? 1 : 0),
		$data["dpti3_date"],
		utf8_decode($data['dpti3_desc']),
		($data['dptp']!="" ? 1 : 0),
		$data["dptp_date"],
		utf8_decode($data['dptp_desc']),
		($data['influenzap']!="" ? 1 : 0),
		$data["influenzap_date"],
		utf8_decode($data['influenzap_desc']),
		($data['influenza']!="" ? 1 : 0),
		$data["influenza_date"],
		utf8_decode($data['influenza_desc']),
		($data['influenza2']!="" ? 1 : 0),
		$data["influenza2_date"],
		utf8_decode($data['influenza2_desc']),
		($data['influenza3']!="" ? 1 : 0),
		$data["influenza3_date"],
		utf8_decode($data['influenza3_desc']),
		($data['influenza4']!="" ? 1 : 0),
		$data["influenza4_date"],
		utf8_decode($data['influenza4_desc']),
		($data['influenza5']!="" ? 1 : 0),
		$data["influenza5_date"],
		utf8_decode($data['influenza5_desc']),
		($data['influenza6']!="" ? 1 : 0),
		$data["influenza6_date"],
		utf8_decode($data['influenza6_desc']),
		$data["influenza7_date"],
		utf8_decode($data['influenza7_desc']),
		$data["influenza8_date"],
		utf8_decode($data['influenza8_desc']),
		$data["influenza9_date"],
		utf8_decode($data['influenza9_desc']),
		$data["influenza10_date"],
		utf8_decode($data['influenza10_desc']),
		$data["influenza11_date"],
		utf8_decode($data['influenza11_desc']),
		$data["influenza12_date"],
		utf8_decode($data['influenza12_desc']),
	 	$id_user);
	return $result;
}

/**
 * [Función para el almacenado de información dentro de la sección de Vacunación]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveElderVaccinatonData($connection, $method, $data, $id_user){

	$result = saveElderVaccinatonData_DOM($connection, $method,
		$data["id_patient"],
		($data['neumoco']!="" ? 1 : 0),
		$data["neumoco_date"],
		utf8_decode($data['neumoco_desc']),
		($data['neumoco1']!="" ? 1 : 0),
		$data["neumoco1_date"],
		utf8_decode($data['neumoco1_desc']),
		($data['neumoco2']!="" ? 1 : 0),
		$data["neumoco2_date"],
		utf8_decode($data['neumoco2_desc']),
		($data['dptc']!="" ? 1 : 0),
		$data["dptc_date"],
		utf8_decode($data['dptc_desc']),
		($data['dptc1']!="" ? 1 : 0),
		$data["dptc1_date"],
		utf8_decode($data['dptc1_desc']),
		($data['dptc2']!="" ? 1 : 0),
		$data["dptc2_date"],
		utf8_decode($data['dptc2_desc']),
		($data['dpti1']!="" ? 1 : 0),
		$data["dpti1_date"],
		utf8_decode($data['dpti1_desc']),
		($data['dpti2']!="" ? 1 : 0),
		$data["dpti2_date"],
		utf8_decode($data['dpti2_desc']),
		($data['dpti3']!="" ? 1 : 0),
		$data["dpti3_date"],
		utf8_decode($data['dpti3_desc']),
		($data['influenza']!="" ? 1 : 0),
		$data["influenza_date"],
		utf8_decode($data['influenza_desc']),
		($data['influenza2']!="" ? 1 : 0),
		$data["influenza2_date"],
		utf8_decode($data['influenza2_desc']),
		($data['influenza3']!="" ? 1 : 0),
		$data["influenza3_date"],
		utf8_decode($data['influenza3_desc']),
		($data['influenza4']!="" ? 1 : 0),
		$data["influenza4_date"],
		utf8_decode($data['influenza4_desc']),
		($data['influenza5']!="" ? 1 : 0),
		$data["influenza5_date"],
		utf8_decode($data['influenza5_desc']),
		($data['influenza6']!="" ? 1 : 0),
		$data["influenza6_date"],
		utf8_decode($data['influenza6_desc']),
		$data["influenza7_date"],
		utf8_decode($data['influenza7_desc']),
		$data["influenza8_date"],
		utf8_decode($data['influenza8_desc']),
		$data["influenza9_date"],
		utf8_decode($data['influenza9_desc']),
		$data["influenza10_date"],
		utf8_decode($data['influenza10_desc']),
		$data["influenza11_date"],
		utf8_decode($data['influenza11_desc']),
		$data["influenza12_date"],
		utf8_decode($data['influenza12_desc']),
	 	$id_user);
	return $result;
}

/**
 * [Función para validar las credenciales de acceso al sistema, por cuestión de facilidad se implementó un MD5 sencillo como método de encryptación]
 * @param  [mysqlC] $connection  			[Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $data        			[Información a ser guardada/actualizada]
 * @return [bool]             	 			[Resultado de la comparación entre credenciales]
 */
function searchPatientByName($connection, $data){

	$id = 0;
	$result = searchPatientByName_DOM($connection, $data['name'], $data['first_lastname'], $data['second_lastname']);

	if (sizeof($result)>0) {
		$id = $result[0]["id"];
	}

	return $id;
}

/**
 * [Función para actualizar la la tabla de cargas "updatedata".]
 * @param  [mysqlC] $connection  	[Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [int] $id_data    	 	[ID de la tabla "updatedata"]
 * @param  [int] $row_number  		[Número total de registros recorridos]
 * @param  [int] $found_number  	[Número de registros encontrados]
 * @param  [int] $fail_number  		[Número de registros fallidos]
 * @param  [int] $success_number  	[Número de registros completados]
 * @param  [string] $status  		[Cadena de texto con el estado actual de la carga]
 * @return [bool]             	 	[Estado de la consulta]
 */
function saveUpdateData($connection, $id_data, $row_number, $found_number, $fail_number, $success_number, $status){

	$result = saveUpdateData_DOM($connection,
		$id_data,
		$row_number,
		$found_number,
		$fail_number,
		$success_number,
		$status);

	return $result;
}

/**
 * [Función para insertar en la tabla de carga de formularios.]
 * @param  [mysqlC] $connection  	[Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [int] $id_form  			[ID correspondiente al formulario en la tabla "updatedada" ]
 * @return [bool]					[Estado de la consulta]
 */
function resetFormData($connection, $id_form){

	$table='';
	switch($id_form){
		case 0:
			$table='basicpatientdata';
			break;
		case 1:
			$table='familyrecorddata';
			break;
		case 2:
			$table='dass21data';
			break;
		case 2:
			$table='environmentdata';
			break;
		case 4:
			$table='geriatricdepressiondata';
			break;
		case 5:
			$table='zarittscaledata';
			break;
		case 6:
			$table='etsdata';
			break;
		case 7:
			$table='socioculturaldata';
			break;
		case 8:
			$table='diabetesdata';
			break;
		case 9:
			$table='hypertensiondata';
			break;
		case 10:
			$table='bornlifestyledata';
			break;
		case 11:
			$table='childlifestyledata';
			break;
		case 12:
			$table='younglifestyledata';
			break;
		case 13:
			$table='babylifestyledata';
			break;
		case 14:
			$table='gynecologydata';
			break;
		case 15:
			$table='healthcaredata';
			break;
		case 16:
			$table='vitalsigndata';
			break;
		case 17:
			$table='genderviolencedata';
			break;
		case 18:
			$table='childvaccinationdata';
			break;
		case 19:
			$table='youngvaccinationdata';
			break;
		case 20:
			$table='adultvaccinationdata';
			break;
		case 21:
			$table='eldervaccinationdata';
			break;
		case 22:
			$table='hopelessdata';
			break;
		default:
			break;
	}

	$result = resetFormData_DOM($connection, $id_form, $table);

	return $result;
}

/**
 * [Función para insertar en la tabla de carga de formularios.]
 * @param  [mysqlC] $connection  	[Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [int] $id_form  			[ID correspondiente al formulario en la tabla "updatedada" ]
 * @param  [int] $id_data  			[ID correspondiente al registro insertado en la tabla del formulario]
 * @param  [bool] $is_match  		[Representa si el paciente fue encontrado y el registro esta completo]
 * @param  [string] $data        	[Información a ser guardada/actualizada]
 * @return [bool]             	 	[Estado de la consulta]
 */
function saveLoadData($connection, $id_form, $id_data, $is_match, $data){

	$result = saveLoadData_DOM($connection,
		$id_form,
		$id_data,
		$is_match,
		$data["invoice"],
		$data["affiliation_number"],
		$data["name"],
		$data["first_lastname"],
		$data["second_lastname"],
		($data['relationship']!="" ? "'".utf8_decode($data['relationship'])."'" : 'NULL'),
		($data['occupation']!="" ? "'".utf8_decode($data['occupation'])."'" : 'NULL'),
		($data['age']!="" ? "'".utf8_decode($data['age'])."'" : 'NULL'),
		($data['birthdate']!="" ? "'".$data['birthdate']."'" : 'NULL'),
		$data["gender"]
	);

	return $result;
}

/**
 * [Función para insertar pacientes por carga masiva.]
 * @param  [mysqlC] $connection  	[Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [array] $data    	 	[Array con los datos a insertar en la base]
 * @return [bool]             	 	[Estado de la consulta]
 */
function bulkInsertPatientData($connection, $data){

	$result = bulkInsertPatientData_DOM($connection, $data);

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

function getDetailUpdateData($connection){
	$result = getDetailUpdateData_DOM($connection);

	return $result;
}

function get2Date($y, $m, $d){
	$response = '';
	if (checkdate($d, $m, $y)){
		$response = sprintf("%s-%s-%s", $y, $m, $d);
	} else {
		if (is_numeric($d) && is_numeric($m) && is_numeric($y)){
			if ($d<32 && $m<13 && strlen($y)==4){
				--$d;
				if (checkdate($d, $m, $y)){
					$response = sprintf("%s-%s-%s", $y, $m, $d);
				}
			}
		}
	}
	return $response;
}

 ?>