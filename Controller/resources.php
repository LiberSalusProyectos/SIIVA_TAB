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
		($data['pollution_react_a']!="" ? 1 : 0),
		($data['pollution_react_b']!="" ? 1 : 0),
		($data['pollution_react_c']!="" ? 1 : 0),
		utf8_decode($data['pollution_react_desc']),
		($data['contamination_a']!="" ? 1 : 0),
		($data['contamination_b']!="" ? 1 : 0),
		($data['contamination_c']!="" ? 1 : 0),
		utf8_decode($data['contamination_desc']),
		($data['refinery_nearby']!="" ? $data['refinery_nearby'] : 0),
		($data['pipelines_nearby']!="" ? $data['pipelines_nearby'] : 0),
		($data['health_impact_a']!="" ? 1 : 0),
		($data['health_impact_b']!="" ? 1 : 0),
		($data['health_impact_c']!="" ? 1 : 0),
		($data['dangerous_material_a']!="" ? 1 : 0),
		($data['dangerous_material_b']!="" ? 1 : 0),
		($data['dangerous_material_c']!="" ? 1 : 0),
		($data['dangerous_material_d']!="" ? 1 : 0),
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
		($data['hobby_number']!="" ? $data['hobby_number'] : 0),
		($data['can_read']!="" ? $data['can_read'] : 0),
		($data['can_write']!="" ? $data['can_write'] : 0),
		$data['education_level'],
		($data['flood_zone']!="" ? $data['flood_zone'] : 0),
		($data['landslide_area']!="" ? $data['landslide_area'] : 0),
		$data['population'],
		$data['number_people'],
		$data['number_rooms'],
		($data['ventilation']!="" ? $data['ventilation'] : 0),
		($data['house_area']!="" ? $data['house_area'] : 0),
		($data['hot_water']!="" ? $data['hot_water'] : 0),
		($data['spotlights']!="" ? $data['spotlights'] : 0),
		($data['spotlights_number']!="" ? $data['spotlights_number'] : 0),
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
		($data['heart_attack']!="" ? $data['heart_attack'] : 0),
		($data['family']!="" ? $data['family'] : 0),
		$data['alcoholic_drinks'],
		$data['smoke'],
		$data['blood_test'],
		$data['stress'],
		$data['nutrition'],
		$data['physical_activity'],
		$data['medical_consult'],
		$data['ringing_ears'],
		$data['flashes'],
		$data['headache'],
		$data['pression_check'],
		$data['chest_pain'],
		$data['difficulty_breathing'],
		$data['forget_things'],
		$data['kidney_test'],
		$data['vision_test'],
		$data['medical_visit'],
		$data['treatment'],
		$data['diet'],
		$data['medical_place'],
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
		$data['consultations'],
		$data['pregnancy_complication'],
		$data['pregnancy_resolution'],
		$data['pregnancy_resolution_desc'],
		$data['pregnancy_duration'],
		$data['baby_weight'],
		$data['lactation_type'],
		$data['lactation_desc'],
		$data['lactation_duration'],
		$data['baby_allergy'],
		$data['tamiz_neonatal'],
		$data['tamiz_neonatal_desc'],
		$data['table_one'],
		$data['table_two'],
		$data['table_three'],
		$data['table_four'],
		$data['table_five'],
		$data['table_six'],
		$data['table_seven'],
		$data['table_eight'],
		$data['table_nine'],
		$data['table_ten'],
		$data['table_eleven'],
		$data['table_twelve'],
		$data['table_thirteen'],
		$data['table_fourteen'],
		$data['table_fifteen'],
		$data['table_sixteen'],
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
		$data['wake_food'],
		$data['chemical_food'],
		$data['food_times'],
		$data['fast_food'],
		$data['fatty_food'],
		$data['mealtime'],
		$data['overeat'],
		$data['balanced_diet'],
		$data['fruit_diet'],
		$data['meat_diet'],
		$data['dairy_products'],
		$data['meats'],
		$data['tubers'],
		$data['vegetables'],
		$data['fruits'],
		$data['cereals'],
		$data['snacks'],
		$data['early_stimulation'],
		$data['exercise'],
		$data['exercise_times'],
		$data['sport_active'],
		$data['medical_times'],
		$data['kid_review'],
		$data['medical_exams'],
		$data['dentist'],
		$data['nutrition'],
		$data['psychology'],
		$data['previous_treatment'],
		$data['diseases'],
		$data['childcare'],
		$data['second_opinion'],
		$data['say_feelings'],
		$data['speak_louder'],
		$data['play'],
		$data['withdrawn'],
		$data['share_family'],
		$data['moodiness'],
		$data['work_alone'],
		$data['table_one'],
		$data['table_two'],
		$data['table_three'],
		$data['table_four'],
		$data['table_five'],
		$data['table_six'],
		$data['table_seven'],
		$data['table_eight'],
		$data['table_nine'],
		$data['table_ten'],
		$data['table_eleven'],
		$data['table_twelve'],
		$data['table_thirteen'],
		$data['table_fourteen'],
		$data['table_fifteen'],
		$data['table_sixteen'],
		$data['table_seventeen'],
		$data['table_eighteen'],
		$data['table_nineteen'],
		$data['table_twenty'],
		$data['table_twentyone'],
		$data['table_twentytwo'],
		$data['table_twentythree'],
		$data['bath_times'],
		$data['handwashing'],
		$data['brush_teeth'],
		$data['floss_use'],
		$data['toothbrush'],
		$data['nails_cut'],
		$data['bath_towel'],
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
		$data['wake_food'],
		$data['sausages'],
		$data['food_times'],
		$data['fast_food'],
		$data['fatty_food'],
		$data['mealtime'],
		$data['balanced_diet'],
		$data['dairy_products'],
		$data['meats'],
		$data['tubers'],
		$data['vegetables'],
		$data['fruits'],
		$data['cereals'],
		$data['snacks'],
		$data['exercise'],
		$data['exercise_times'],
		$data['sport_active'],
		$data['medical_times'],
		$data['kid_review'],
		$data['medical_exams'],
		$data['dentist'],
		$data['psychology'],
		$data['nutrition'],
		$data['previous_treatment'],
		$data['diseases'],
		$data['childcare'],
		$data['second_opinion'],
		$data['restless'],
		$data['quiet'],
		$data['difficulty_relating'],
		$data['weeping'],
		$data['alone_prefer'],
		$data['bath_times'],
		$data['handwashing'],
		$data['brush_teeth'],
		$data['floss_use'],
		$data['underwear'],
		$data['nails_cut'],
		$data['bath_towel'],
		$data['diagnostic_disorder'],
		$data['school_perform'],
		$data['relates'],
		$data['stumbles'],
		$data['vision_problems'],
		$data['approximate'],
		$data['headache'],
		$data['difficult_learn'],
		$data['frequent_restless'],
		$data['difficult_pronounce'],
		$data['letter_invert'],
		$data['unfinished_activities'],
		$data['naughty'],
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
		$data['wake_food'],
		$data['chemical_food'],
		$data['food_times'],
		$data['fast_food'],
		$data['fatty_food'],
		$data['mealtime'],
		$data['overeat'],
		$data['balanced_diet'],
		$data['eat_pleasure'],
		$data['check_labels'],
		$data['dairy_products'],
		$data['meats'],
		$data['tubers'],
		$data['vegetables'],
		$data['fruits'],
		$data['cereals'],
		$data['snacks'],
		$data['exercise'],
		$data['exercise_times'],
		$data['sport_active'],
		$data['medical_times'],
		$data['body_explore'],
		$data['medical_exams'],
		$data['blood_pressure'],
		$data['dentist'],
		$data['psychology'],
		$data['nutrition'],
		$data['self_medicate'],
		$data['diseases'],
		$data['search_information'],
		$data['second_opinion'],
		$data['relax_time'],
		$data['stress_causes'],
		$data['stress_impact'],
		$data['stress_control_methods'],
		$data['confident'],
		$data['feeling_alone'],
		$data['difficulty_relating'],
		$data['criticize'],
		$data['no_opinion'],
		$data['tofeel_affection'],
		$data['affection_taste'],
		$data['alone_prefer'],
		$data['love_me'],
		$data['purpose_life'],
		$data['enthusiast'],
		$data['long_term_goals'],
		$data['realistic_goals'],
		$data['fulfilled_goals'],
		$data['capacity_debility'],
		$data['mistakes'],
		$data['recreation'],
		$data['entertainment_time'],
		$data['alcohol'],
		$data['cigar'],
		$data['recreational_activities'],
		$data['time_sleep'],
		$data['insomnia'],
		$data['wake_midnight'],
		$data['drowsiness'],
		$data['shortness_breath'],
		$data['cough_snore'],
		$data['nightmare'],
		$data['thoughts'],
		$data['sleeping_pills'],
		$data['energy_drink'],
		$data['bath_times'],
		$data['handwashing'],
		$data['brush_teeth'],
		$data['floss_use'],
		$data['toothbrush'],
		$data['deodorant'],
		$data['underwear'],
		$data['nails_cut'],
		$data['bath_towel'],
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
		$data['scare'],
		$data['confront'],
		$data['take_control'],
		$data['relapse'],
		$data['bad_inside'],
		$data['normal'],
		$data['personality'],
		$data['something_inside'],
		$data['professionals'],
		$data['competent'],
		$data['can_work'],
		$data['ashamed'],
		$data['judge_me'],
		$data['can_talk'],
		$data['draw_away'],
		$data['psychiatric'],
		$data['well_mentally'],
		$data['mental_illness'],
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
		($data['ferrous_fumarate_a']!="" ? 1 : 0),
		($data['ferrous_fumarate_b']!="" ? 1 : 0),
		($data['ferrous_fumarate_c']!="" ? 1 : 0),
		($data['ferrous_fumarate_d']!="" ? 1 : 0),
		($data['folic_acid_a']!="" ? 1 : 0),
		($data['folic_acid_b']!="" ? 1 : 0),
		($data['folic_acid_c']!="" ? 1 : 0),
		($data['folic_acid_d']!="" ? 1 : 0),
		($data['multivitamins_a']!="" ? 1 : 0),
		($data['multivitamins_b']!="" ? 1 : 0),
		($data['multivitamins_c']!="" ? 1 : 0),
		($data['multivitamins_d']!="" ? 1 : 0),
		($data['hiv_test_a']!="" ? 1 : 0),
		($data['hiv_test_b']!="" ? 1 : 0),
		($data['hiv_test_c']!="" ? 1 : 0),
		($data['hiv_test_d']!="" ? 1 : 0),
		($data['syphilis_test_a']!="" ? 1 : 0),
		($data['syphilis_test_b']!="" ? 1 : 0),
		($data['syphilis_test_c']!="" ? 1 : 0),
		($data['syphilis_test_d']!="" ? 1 : 0),
		($data['newborn_care_a']!="" ? 1 : 0),
		($data['newborn_care_b']!="" ? 1 : 0),
		($data['newborn_care_c']!="" ? 1 : 0),
		($data['newborn_care_d']!="" ? 1 : 0),
		($data['breast_feed_a']!="" ? 1 : 0),
		($data['breast_feed_b']!="" ? 1 : 0),
		($data['breast_feed_c']!="" ? 1 : 0),
		($data['breast_feed_d']!="" ? 1 : 0),
		utf8_decode($data['get_married']),
		utf8_decode($data['children_plan']),
		utf8_decode($data['children_current']),
		utf8_decode($data['planning_method']),
		($data['transporter']!="" ? 1 : 0),
		utf8_decode($data['relationship']),
		($data['transport']!="" ? 1 : 0),
		utf8_decode($data['vehicle_type']),
		utf8_decode($data['medical_service']),
		utf8_decode($data['odontology']),
		utf8_decode($data['fur']),
		utf8_decode($data['ivsa']),
		($data['childbirth']!="" ? $data['childbirth'] : 0),
		($data['caesarean']!="" ? $data['caesarean'] : 0),
		($data['abortion']!="" ? $data['abortion'] : 0),
		($data['children_live']!="" ? $data['children_live'] : 0),
		($data['children_dead']!="" ? $data['children_dead'] : 0),
		($data['min_weight']!="" ? $data['min_weight'] : 0),
		($data['max_weight']!="" ? $data['max_weight'] : 0),
		utf8_decode($data['self_manual']),
		utf8_decode($data['self_image']),
		utf8_decode($data['exam_manual']),
		utf8_decode($data['exam_image']),
		($data['menopausia']!="" ? $data['menopausia'] : 0),
		$data['mammography_date'],
		utf8_decode($data['mammography_result']),
		$data['densitometry_date'],
		utf8_decode($data['densitometry_result']),
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
		$data['blood_pressure'],
		($data['heart_rate']!="" ? $data['heart_rate'] : 0),
		($data['breathe_rate']!="" ? $data['breathe_rate'] : 0),
		($data['temperature']!="" ? $data['temperature'] : 0),
		($data['glucose']!="" ? $data['glucose'] : 0),
		($data['weight']!="" ? $data['weight'] : 0),
		($data['height']!="" ? $data['height'] : 0),
		($data['body_mass']!="" ? $data['body_mass'] : 0),
		($data['body_fat']!="" ? $data['body_fat'] : 0),
		($data['arm_perimeter']!="" ? $data['arm_perimeter'] : 0),
		($data['abdomen_perimeter']!="" ? $data['abdomen_perimeter'] : 0),
		($data['capillary_refill']!="" ? $data['capillary_refill'] : 0),
		($data['saturation']!="" ? $data['saturation'] : 0),
		($data['glycated_hemoglobin']!="" ? $data['glycated_hemoglobin'] : 0),
		($data['glucose_lab']!="" ? $data['glucose_lab'] : 0),
		($data['creatinine']!="" ? $data['creatinine'] : 0),
		($data['cholesterol']!="" ? $data['cholesterol'] : 0),
		($data['triglycerides']!="" ? $data['triglycerides'] : 0),
		($data['prostatic_antigen']!="" ? $data['prostatic_antigen'] : 0),
		($data['sida']!="" ? 1 : 0),
		($data['syphilis']!="" ? 1 : 0),
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
		$data['push_up'],
		$data['push_down'],
		$data['strike'],
		$data['wants'],
		$data['useless'],
		$data['normal_hit'],
		$data['without_reason'],
		$data['violent'],
		$data['forced_sex'],
		$data['engagement_sex'],
		$data['sex_fear'],
		$data['bad_treatments'],
		$data['decide_4me'],
		$data['isolates_me'],
		$data['try_isolate'],
		$data['feel_guilty'],
		$data['insults_me'],
		$data['bruises'],
		$data['be_alert'],
		$data['denounced'],
		$data['look_scare'],
		$data['feel_alone'],
		$data['can_work'],
		$data['see_family'],
		$data['watches_me'],
		$data['keep_hooked'],
		$data['regret_guilty'],
		$data['care_aspect'],
		$data['have_obey'],
		$data['gender_equality'],
		$data['protect_couple'],
		$data['private_life'],
		$data['slap_necessary'],
		$data['abuser_failed'],
		$data['good_bad'],
		$data['life_proyect'],
		$data['without_father'],
		$data['childrens'],
		$data['without_me'],
		$data['love_him'],
		$data['feel_sorry'],
		$data['marriage'],
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
		($data['hope']!="" ? $data['hope'] : 0),
		($data['renounce']!="" ? $data['renounce'] : 0),
		($data['relief']!="" ? $data['relief'] : 0),
		($data['imagine']!="" ? $data['imagine'] : 0),
		($data['have_time']!="" ? $data['have_time'] : 0),
		($data['future']!="" ? $data['future'] : 0),
		($data['dark_future']!="" ? $data['dark_future'] : 0),
		($data['expect_good']!="" ? $data['expect_good'] : 0),
		($data['cant_change']!="" ? $data['cant_change'] : 0),
		($data['experiences']!="" ? $data['experiences'] : 0),
		($data['unpleasant_future']!="" ? $data['unpleasant_future'] : 0),
		($data['expect_anything']!="" ? $data['expect_anything'] : 0),
		($data['happy_future']!="" ? $data['happy_future'] : 0),
		($data['things_wrong']!="" ? $data['things_wrong'] : 0),
		($data['expect_future']!="" ? $data['expect_future'] : 0),
		($data['not_want']!="" ? $data['not_want'] : 0),
		($data['satisfaction']!="" ? $data['satisfaction'] : 0),
		($data['uncertain_future']!="" ? $data['uncertain_future'] : 0),
		($data['good_times']!="" ? $data['good_times'] : 0),
		($data['dont_try']!="" ? $data['dont_try'] : 0),
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
		($data['rotavirus2do1']!="" ? 1 : 0),
		$data["rotavirus2do1_date"],
		utf8_decode($data['rotavirus2do1_desc']),
		($data['rotavirus3do1']!="" ? 1 : 0),
		$data["rotavirus3do1_date"],
		utf8_decode($data['rotavirus3do1_desc']),
		($data['pentavalente2']!="" ? 1 : 0),
		$data["pentavalente2_date"],
		utf8_decode($data['pentavalente2_desc']),
		($data['neumoco2']!="" ? 1 : 0),
		$data["neumoco2_date"],
		utf8_decode($data['neumoco2_desc']),
		($data['rotavirus2do2']!="" ? 1 : 0),
		$data["rotavirus2do2_date"],
		utf8_decode($data['rotavirus2do2_desc']),
		($data['rotavirus3do2']!="" ? 1 : 0),
		$data["rotavirus3do2_date"],
		utf8_decode($data['rotavirus3do2_desc']),
		($data['pentavalente3']!="" ? 1 : 0),
		$data["pentavalente3_date"],
		utf8_decode($data['pentavalente3_desc']),
		($data['hepatb3']!="" ? 1 : 0),
		$data["hepatb3_date"],
		utf8_decode($data['hepatb3_desc']),
		($data['influenza1']!="" ? 1 : 0),
		$data["influenza1_date"],
		utf8_decode($data['influenza1_desc']),
		($data['rotavirus3do3']!="" ? 1 : 0),
		$data["rotavirus3do3_date"],
		utf8_decode($data['rotavirus3do3_desc']),
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
		case 2:
			$table='dass21data';
			break;
		case 4:
			$table='geriatricdepressiondata';
			break;
		case 5:
			$table='etsdata';
			break;
		case 6:
			$table='socioculturaldata';
			break;
		case 7:
			$table='diabetesdata';
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

 ?>