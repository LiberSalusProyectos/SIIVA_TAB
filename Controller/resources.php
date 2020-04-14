<?php include_once("Model/queries.php");

!defined('FAMILY_RECORD_NAME') && define('FAMILY_RECORD_NAME', 'ANTECEDENTES FAMILIARES');
!defined('DASS21_SCALE_NAME') && define('DASS21_SCALE_NAME', 'DASS-21');
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
!defined('HEALTH_CARE_NAME') && define('HEALTH_CARE_NAME', 'CUIDADO DE LA SALUD');
!defined('VITAL_SIGN_NAME') && define('VITAL_SIGN_NAME', 'SIGNOS VITALES + LAB');
!defined('GENDER_VIOLENCE_NAME') && define('GENDER_VIOLENCE_NAME', 'VIOLENCIA DE GÉNERO');

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
		case "dass21Scale":
			$table = "dass21data";
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
		case "healthCare":
			$table = "healthcaredata";
			break;
		case "vitalSign":
			$table = "vitalsigndata";
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
		$data['relax'],
		$data['dry_mouth'],
		$data['positive_feelings'],
		$data['breathe'],
		$data['initiative'],
		$data['exaggerate'],
		$data['tingling_hands'],
		$data['worried'],
		$data['concerned'],
		$data['be_down'],
		$data['agitate'],
		$data['relax_difficult'],
		$data['depression'],
		$data['intolerance'],
		$data['panic'],
		$data['enthusiasm'],
		$data['selfsteem'],
		$data['irritable'],
		$data['feel_agitated'],
		$data['fear'],
		$data['meaningless_life'],
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
		($data['satisfied']!="" ? $data['satisfied'] : 0),
		($data['giveup_hobby']!="" ? $data['giveup_hobby'] : 0),
		($data['empty_life']!="" ? $data['empty_life'] : 0),
		($data['boredom']!="" ? $data['boredom'] : 0),
		($data['optimism']!="" ? $data['optimism'] : 0),
		($data['fear']!="" ? $data['fear'] : 0),
		($data['happiness']!="" ? $data['happiness'] : 0),
		($data['abandonment']!="" ? $data['abandonment'] : 0),
		($data['at_home']!="" ? $data['at_home'] : 0),
		($data['memory_loss']!="" ? $data['memory_loss'] : 0),
		($data['love_forlife']!="" ? $data['love_forlife'] : 0),
		($data['start_difficult']!="" ? $data['start_difficult'] : 0),
		($data['full_energy']!="" ? $data['full_energy'] : 0),
		($data['anxiety']!="" ? $data['anxiety'] : 0),
		($data['economy']!="" ? $data['economy'] : 0),
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
		$data['own_time'],
		$data['stressed'],
		$data['relationship'],
		$data['exhausted'],
		$data['healthy'],
		$data['control_life'],
		$data['overloaded'],
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
		$data['gender'],
		($data['starts_activity']!="" ? $data['starts_activity'] : 0),
		utf8_decode($data['sexual_orientation']),
		($data['couples']!="" ? $data['couples'] : 0),
		($data['safe_sex']!="" ? $data['safe_sex'] : 0),
		($data['contraceptives']!="" ? $data['contraceptives'] : 0),
		($data['condom']!="" ? $data['condom'] : 0),
		($data['intercourse']!="" ? $data['intercourse'] : 0),
		($data['ets_exposed']!="" ? $data['ets_exposed'] : 0),
		($data['medical_treatment']!="" ? $data['medical_treatment'] : 0),
		($data['vih_test']!="" ? $data['vih_test'] : 0),
		($data['pap_smear']!="" ? $data['pap_smear'] : 0),
		utf8_decode($data['pap_smear_result']),
		utf8_decode($data['knowledge']),
		($data['ways_transmit']!="" ? $data['ways_transmit'] : 0),
		($data['talks']!="" ? $data['talks'] : 0),
		($data['vih_symptom']!="" ? $data['vih_symptom'] : 0),
		($data['vih_clinic']!="" ? $data['vih_clinic'] : 0),
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
		$data['decisions'],
		$data['harmony'],
		$data['responsibility'],
		$data['sweetie'],
		$data['point_blank'],
		$data['defects'],
		$data['experience'],
		$data['support'],
		$data['tasks'],
		$data['habits'],
		$data['converse'],
		$data['look_help'],
		$data['respect'],
		$data['show_affection'],
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
		($data['suffer_from']!="" ? $data['suffer_from'] : 0),
		($data['thirsty']!="" ? $data['thirsty'] : 0),
		($data['urinate']!="" ? $data['urinate'] : 0),
		($data['lose_weight']!="" ? $data['lose_weight'] : 0),
		($data['over_eat']!="" ? $data['over_eat'] : 0),
		($data['glucose_check']!="" ? $data['glucose_check'] : 0),
		$data['medical_times'],
		$data['treatment'],
		$data['feel_bad'],
		$data['check_foot'],
		$data['vision_changes'],
		$data['healing_problems'],
		$data['proper_diet'],
		$data['weight_changes'],
		$data['medical_control'],
		($data['naturist']!="" ? $data['naturist'] : 0),
		$data['age'],
		$data['gender'],
		($data['gestational_diabetes']!="" ? $data['gestational_diabetes'] : 0),
		($data['family']!="" ? $data['family'] : 0),
		($data['blood_pressure']!="" ? $data['blood_pressure'] : 0),
		($data['physical_activity']!="" ? $data['physical_activity'] : 0),
		$data['weight'],
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