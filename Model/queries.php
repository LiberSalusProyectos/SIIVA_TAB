<?php
include_once('connection.php');

/**
 * [Función para el almacenado de información dentro de la sección de Antecedentes Familiares]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveFamilyRecordData_DOM($connection, $method,
	$id_patient,
	$birth_state,
	$birth_place,
	$residence_state,
	$residence_place,
	$hypertension,
	$diabetes,
	$heart_attack,
	$cardiac_arrhythmia,
	$heart_failure,
	$heart_other,
	$heart_other_desc,
	$asthma,
	$obesity,
	$dyslipidemia,
	$breast_cancer,
	$cervical_cancer,
	$prostate_cancer,
	$cancer_other,
	$cancer_other_desc,
	$anxiety_depression,
	$eating_disorders,
	$schizophrenia,
	$psychiatric_other,
	$psychiatric_other_desc,
	$glaucoma,
	$ametropia,
	$waterfalls,
	$eye_other,
	$eye_other_desc,
	$hyperthyroidism,
	$hypothyroidism,
	$cushing,
	$endocrine_other,
	$endocrine_other_desc,
	$preeclampsia,
	$cystic_ovary,
	$gestational_diabetes,
	$gynecological_other,
	$gynecological_other_desc,
	$parkinson,
	$epilepsy,
	$alzheimer,
	$neurological_other,
	$neurological_other_desc,
	$tuberculosis,
	$sida,
	$syphilis,
	$infectious_other,
	$infectious_other_desc,
	$down_syndrome,
	$cretinism_acromegaly,
	$hemophilia,
	$genetic_other,
	$genetic_other_desc,
	$other_diseases,
	$death_age,
	$death_cause,
	$observations,
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

	$query .= " `familyrecorddata` SET
	`birth_state`				= '$birth_state',
	`birth_place`				= '$birth_place',
	`residence_state`			= '$residence_state',
	`residence_place`			= '$residence_place',
	`hypertension`				= '$hypertension',
	`diabetes`					= '$diabetes',
	`heart_attack`				= '$heart_attack',
	`cardiac_arrhythmia`		= '$cardiac_arrhythmia',
	`heart_failure`				= '$heart_failure',
	`heart_other`				= '$heart_other',
	`heart_other_desc`			= '$heart_other_desc',
	`asthma`					= '$asthma',
	`obesity`					= '$obesity',
	`dyslipidemia`				= '$dyslipidemia',
	`breast_cancer`				= '$breast_cancer',
	`cervical_cancer`			= '$cervical_cancer',
	`prostate_cancer`			= '$prostate_cancer',
	`cancer_other`				= '$cancer_other',
	`cancer_other_desc`			= '$cancer_other_desc',
	`anxiety_depression`		= '$anxiety_depression',
	`eating_disorders`			= '$eating_disorders',
	`schizophrenia`				= '$schizophrenia',
	`psychiatric_other`			= '$psychiatric_other',
	`psychiatric_other_desc`	= '$psychiatric_other_desc',
	`glaucoma`					= '$glaucoma',
	`ametropia`					= '$ametropia',
	`waterfalls`				= '$waterfalls',
	`eye_other`					= '$eye_other',
	`eye_other_desc`			= '$eye_other_desc',
	`hyperthyroidism`			= '$hyperthyroidism',
	`hypothyroidism`			= '$hypothyroidism',
	`cushing`					= '$cushing',
	`endocrine_other`			= '$endocrine_other',
	`endocrine_other_desc`		= '$endocrine_other_desc',
	`preeclampsia`				= '$preeclampsia',
	`cystic_ovary`				= '$cystic_ovary',
	`gestational_diabetes`		= '$gestational_diabetes',
	`gynecological_other`		= '$gynecological_other',
	`gynecological_other_desc`	= '$gynecological_other_desc',
	`parkinson`					= '$parkinson',
	`epilepsy`					= '$epilepsy',
	`alzheimer`					= '$alzheimer',
	`neurological_other`		= '$neurological_other',
	`neurological_other_desc`	= '$neurological_other_desc',
	`tuberculosis`				= '$tuberculosis',
	`sida`						= '$sida',
	`syphilis`					= '$syphilis',
	`infectious_other`			= '$infectious_other',
	`infectious_other_desc`		= '$infectious_other_desc',
	`down_syndrome`				= '$down_syndrome',
	`cretinism_acromegaly`		= '$cretinism_acromegaly',
	`hemophilia`				= '$hemophilia',
	`genetic_other`				= '$genetic_other',
	`genetic_other_desc`		= '$genetic_other_desc',
	`other_diseases`			= '$other_diseases',
	`death_age`					= '$death_age',
	`death_cause`				= '$death_cause',
	`observations`				= '$observations',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información de la Hoja de administración familiar de DASS-21.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveDass21Data_DOM($connection, $method,
	$id_patient,
	$relax,
	$dry_mouth,
	$positive_feelings,
	$breathe,
	$initiative,
	$exaggerate,
	$tingling_hands,
	$worried,
	$concerned,
	$be_down,
	$agitate,
	$relax_difficult,
	$depression,
	$intolerance,
	$panic,
	$enthusiasm,
	$selfsteem,
	$irritable,
	$feel_agitated,
	$fear,
	$meaningless_life,
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

	$query .= " `dass21data` SET
	`relax`				= '$relax',
	`dry_mouth`			= '$dry_mouth',
	`positive_feelings`	= '$positive_feelings',
	`breathe`			= '$breathe',
	`initiative`		= '$initiative',
	`exaggerate`		= '$exaggerate',
	`tingling_hands`	= '$tingling_hands',
	`worried`			= '$worried',
	`concerned`			= '$concerned',
	`be_down`			= '$be_down',
	`agitate`			= '$agitate',
	`relax_difficult`	= '$relax_difficult',
	`depression`		= '$depression',
	`intolerance`		= '$intolerance',
	`panic`				= '$panic',
	`enthusiasm`		= '$enthusiasm',
	`selfsteem`			= '$selfsteem',
	`irritable`			= '$irritable',
	`feel_agitated`		= '$feel_agitated',
	`fear`				= '$fear',
	`meaningless_life`	= '$meaningless_life',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información de la Escala abreviada de depresión geriátrica deYesavage.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveGeriatricDepressionData_DOM($connection, $method,
	$id_patient,
	$satisfied,
	$giveup_hobby,
	$empty_life,
	$boredom,
	$optimism,
	$fear,
	$happiness,
	$abandonment,
	$at_home,
	$memory_loss,
	$love_forlife,
	$start_difficult,
	$full_energy,
	$anxiety,
	$economy,
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

	$query .= " `geriatricdepressiondata` SET
	`satisfied`			= $satisfied,
	`giveup_hobby`		= $giveup_hobby,
	`empty_life`		= $empty_life,
	`boredom`			= $boredom,
	`optimism`			= $optimism,
	`fear`				= $fear,
	`happiness`			= $happiness,
	`abandonment`		= $abandonment,
	`at_home`			= $at_home,
	`memory_loss`		= $memory_loss,
	`love_forlife`		= $love_forlife,
	`start_difficult`	= $start_difficult,
	`full_energy`		= $full_energy,
	`anxiety`			= $anxiety,
	`economy`			= $economy,
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información de la Escala abreviada de sobre carga del cuidador de Zarit.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveZarittScaleData_DOM($connection, $method,
	$id_patient,
	$own_time,
	$stressed,
	$relationship,
	$exhausted,
	$healthy,
	$control_life,
	$overloaded,
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

	$query .= " `zarittscaledata` SET
	`own_time`			= '$own_time',
	`stressed`			= '$stressed',
	`relationship`		= '$relationship',
	`exhausted`			= '$exhausted',
	`healthy`			= '$healthy',
	`control_life`		= '$control_life',
	`overloaded`		= '$overloaded',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información de Enfermedades de transmisión sexual de acuerdo a edad, sexo y orientación sexual.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveETSData_DOM($connection, $method,
	$id_patient,
	$gender,
	$starts_activity,
	$sexual_orientation,
	$couples,
	$safe_sex,
	$contraceptives,
	$condom,
	$intercourse,
	$ets_exposed,
	$medical_treatment,
	$vih_test,
	$pap_smear,
	$pap_smear_result,
	$knowledge,
	$ways_transmit,
	$talks,
	$vih_symptom,
	$vih_clinic,
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

	$query .= " `etsdata` SET
	`gender`			= '$gender',
	`starts_activity`	= $starts_activity,
	`sexual_orientation`= '$sexual_orientation',
	`couples`			= $couples,
	`safe_sex`			= $safe_sex,
	`contraceptives`	= $contraceptives,
	`condom`			= $condom,
	`intercourse`		= $intercourse,
	`ets_exposed`		= $ets_exposed,
	`medical_treatment`	= $medical_treatment,
	`vih_test`			= $vih_test,
	`pap_smear`			= $pap_smear,
	`pap_smear_result`	= '$pap_smear_result',
	`knowledge`			= '$knowledge',
	`ways_transmit`		= $ways_transmit,
	`talks`				= $talks,
	`vih_symptom`		= $vih_symptom,
	`vih_clinic`		= $vih_clinic,
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información del contexto socio-cultural]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveSocioculturalData_DOM($connection, $method,
	$id_patient,
	$decisions,
	$harmony,
	$responsibility,
	$sweetie,
	$point_blank,
	$defects,
	$experience,
	$support,
	$tasks,
	$habits,
	$converse,
	$look_help,
	$respect,
	$show_affection,
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

	$query .= " `socioculturaldata` SET
	`decisions`			= '$decisions',
	`harmony`			= '$harmony',
	`responsibility`	= '$responsibility',
	`sweetie`			= '$sweetie',
	`point_blank`		= '$point_blank',
	`defects`			= '$defects',
	`experience`		= '$experience',
	`support`			= '$support',
	`tasks`				= '$tasks',
	`habits`			= '$habits',
	`converse`			= '$converse',
	`look_help`			= '$look_help',
	`respect`			= '$respect',
	`show_affection`	= '$show_affection',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información de Tamizaje de diabetes mellitus.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveDiabetesData_DOM($connection, $method,
	$id_patient,
	$suffer_from,
	$thirsty,
	$urinate,
	$lose_weight,
	$over_eat,
	$glucose_check,
	$medical_times,
	$treatment,
	$feel_bad,
	$check_foot,
	$vision_changes,
	$healing_problems,
	$proper_diet,
	$weight_changes,
	$medical_control,
	$naturist,
	$age,
	$gender,
	$gestational_diabetes,
	$family,
	$blood_pressure,
	$physical_activity,
	$weight,
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

	$query .= " `diabetesdata` SET
	`suffer_from`			= $suffer_from,
	`thirsty`				= $thirsty,
	`urinate`				= $urinate,
	`lose_weight`			= $lose_weight,
	`over_eat`				= $over_eat,
	`glucose_check`			= $glucose_check,
	`medical_times`			= '$medical_times',
	`treatment`				= '$treatment',
	`feel_bad`				= '$feel_bad',
	`check_foot`			= '$check_foot',
	`vision_changes`		= '$vision_changes',
	`healing_problems`		= '$healing_problems',
	`proper_diet`			= '$proper_diet',
	`weight_changes`		= '$weight_changes',
	`medical_control`		= '$medical_control',
	`naturist`				= $naturist,
	`age`					= '$age',
	`gender`				= '$gender',
	`gestational_diabetes`	= $gestational_diabetes,
	`family`				= $family,
	`blood_pressure`		= $blood_pressure,
	`physical_activity`		= $physical_activity,
	`weight`				= '$weight',
	`id_patient`	= $id_patient,
	`created_at` 	= CURRENT_TIMESTAMP,
	`capturist` 	= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información de Prevención, Tamizaje, Detección y Control de Hipertensión Arterial Sistemica.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveHypertensionData_DOM($connection, $method,
	$id_patient,
	$heart_attack,
	$family,
	$alcoholic_drinks,
	$smoke,
	$blood_test,
	$stress,
	$nutrition,
	$physical_activity,
	$medical_consult,
	$ringing_ears,
	$flashes,
	$headache,
	$pression_check,
	$chest_pain,
	$difficulty_breathing,
	$forget_things,
	$kidney_test,
	$vision_test,
	$medical_visit,
	$treatment,
	$diet,
	$medical_place,
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

	$query .= " `hypertensiondata` SET
	`heart_attack`			= $heart_attack,
	`family`				= $family,
	`alcoholic_drinks`		= '$alcoholic_drinks',
	`smoke`					= '$smoke',
	`blood_test`			= '$blood_test',
	`stress`				= '$stress',
	`nutrition`				= '$nutrition',
	`physical_activity`		= '$physical_activity',
	`medical_consult`		= '$medical_consult',
	`ringing_ears`			= '$ringing_ears',
	`flashes`				= '$flashes',
	`headache`				= '$headache',
	`pression_check`		= '$pression_check',
	`chest_pain`			= '$chest_pain',
	`difficulty_breathing`	= '$difficulty_breathing',
	`forget_things`			= '$forget_things',
	`kidney_test`			= '$kidney_test',
	`vision_test`			= '$vision_test',
	`medical_visit`			= '$medical_visit',
	`treatment`				= '$treatment',
	`diet`					= '$diet',
	`medical_place`			= '$medical_place',
	`id_patient`	= $id_patient,
	`created_at` 	= CURRENT_TIMESTAMP,
	`capturist` 	= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información dentro de la sección de Evaluación de crecimiento y desarrollo]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveBornLifestyleData_DOM($connection, $method,
	$id_patient,
	$consultations,
	$pregnancy_complication,
	$pregnancy_resolution,
	$pregnancy_resolution_desc,
	$pregnancy_duration,
	$baby_weight,
	$lactation_type,
	$lactation_desc,
	$lactation_duration,
	$baby_allergy,
	$tamiz_neonatal,
	$tamiz_neonatal_desc,
	$table_one,
	$table_two,
	$table_three,
	$table_four,
	$table_five,
	$table_six,
	$table_seven,
	$table_eight,
	$table_nine,
	$table_ten,
	$table_eleven,
	$table_twelve,
	$table_thirteen,
	$table_fourteen,
	$table_fifteen,
	$table_sixteen,
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

	$query .= " `bornlifestyledata` SET
	`consultations`				= '$consultations',
	`pregnancy_complication`	= '$pregnancy_complication',
	`pregnancy_resolution`		= '$pregnancy_resolution',
	`pregnancy_resolution_desc`	= '$pregnancy_resolution_desc',
	`pregnancy_duration`		= '$pregnancy_duration',
	`baby_weight`				= '$baby_weight',
	`lactation_type`			= '$lactation_type',
	`lactation_desc`			= '$lactation_desc',
	`lactation_duration`		= '$lactation_duration',
	`baby_allergy`				= '$baby_allergy',
	`tamiz_neonatal`			= '$tamiz_neonatal',
	`tamiz_neonatal_desc`		= '$tamiz_neonatal_desc',
	`table_one`					= '$table_one',
	`table_two`					= '$table_two',
	`table_three`				= '$table_three',
	`table_four`			= '$table_four',
	`table_five`			= '$table_five',
	`table_six`				= '$table_six',
	`table_seven`			= '$table_seven',
	`table_eight`			= '$table_eight',
	`table_nine`			= '$table_nine',
	`table_ten`				= '$table_ten',
	`table_eleven`			= '$table_eleven',
	`table_twelve`			= '$table_twelve',
	`table_thirteen`		= '$table_thirteen',
	`table_fourteen`		= '$table_fourteen',
	`table_fifteen`			= '$table_fifteen',
	`table_sixteen`			= '$table_sixteen',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}


/**
 * [Función para el almacenado de información dentro de la sección de Evaluación de crecimiento y desarrollo]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveBabyLifestyleData_DOM($connection, $method,
	$id_patient,
	$wake_food,
	$chemical_food,
	$food_times,
	$fast_food,
	$fatty_food,
	$mealtime,
	$overeat,
	$balanced_diet,
	$fruit_diet,
	$meat_diet,
	$dairy_products,
	$meats,
	$tubers,
	$vegetables,
	$fruits,
	$cereals,
	$snacks,
	$early_stimulation,
	$exercise,
	$exercise_times,
	$sport_active,
	$medical_times,
	$kid_review,
	$medical_exams,
	$dentist,
	$nutrition,
	$psychology,
	$previous_treatment,
	$diseases,
	$childcare,
	$second_opinion,
	$say_feelings,
	$speak_louder,
	$play,
	$withdrawn,
	$share_family,
	$moodiness,
	$work_alone,
	$table_one,
	$table_two,
	$table_three,
	$table_four,
	$table_five,
	$table_six,
	$table_seven,
	$table_eight,
	$table_nine,
	$table_ten,
	$table_eleven,
	$table_twelve,
	$table_thirteen,
	$table_fourteen,
	$table_fifteen,
	$table_sixteen,
	$table_seventeen,
	$table_eighteen,
	$table_nineteen,
	$table_twenty,
	$table_twentyone,
	$table_twentytwo,
	$table_twentythree,
	$bath_times,
	$handwashing,
	$brush_teeth,
	$floss_use,
	$toothbrush,
	$nails_cut,
	$bath_towel,
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

	$query .= " `babylifestyledata` SET
	`wake_food`				= '$wake_food',
	`chemical_food`			= '$chemical_food',
	`food_times`			= '$food_times',
	`fast_food`				= '$fast_food',
	`fatty_food`			= '$fatty_food',
	`mealtime`				= '$mealtime',
	`overeat`				= '$overeat',
	`balanced_diet`			= '$balanced_diet',
	`fruit_diet`			= '$fruit_diet',
	`meat_diet`				= '$meat_diet',
	`dairy_products`		= $dairy_products,
	`meats`					= $meats,
	`tubers`				= $tubers,
	`vegetables`			= $vegetables,
	`fruits`				= $fruits,
	`cereals`				= $cereals,
	`snacks`				= $snacks,
	`early_stimulation`		= '$early_stimulation',
	`exercise`				= '$exercise',
	`exercise_times`		= '$exercise_times',
	`sport_active`			= '$sport_active',
	`medical_times`			= '$medical_times',
	`kid_review`			= '$kid_review',
	`medical_exams`			= '$medical_exams',
	`dentist`				= '$dentist',
	`nutrition`				= '$nutrition',
	`psychology`			= '$psychology',
	`previous_treatment`	= '$previous_treatment',
	`diseases`				= '$diseases',
	`childcare`				= '$childcare',
	`second_opinion`		= '$second_opinion',
	`say_feelings`			= '$say_feelings',
	`speak_louder`			= '$speak_louder',
	`play`					= '$play',
	`withdrawn`				= '$withdrawn',
	`share_family`			= '$share_family',
	`moodiness`				= '$moodiness',
	`work_alone`			= '$work_alone',
	`table_one`				= '$table_one',
	`table_two`				= '$table_two',
	`table_three`			= '$table_three',
	`table_four`			= '$table_four',
	`table_five`			= '$table_five',
	`table_six`				= '$table_six',
	`table_seven`			= '$table_seven',
	`table_eight`			= '$table_eight',
	`table_nine`			= '$table_nine',
	`table_ten`				= '$table_ten',
	`table_eleven`			= '$table_eleven',
	`table_twelve`			= '$table_twelve',
	`table_thirteen`		= '$table_thirteen',
	`table_fourteen`		= '$table_fourteen',
	`table_fifteen`			= '$table_fifteen',
	`table_sixteen`			= '$table_sixteen',
	`table_seventeen`		= '$table_seventeen',
	`table_eighteen`		= '$table_eighteen',
	`table_nineteen`		= '$table_nineteen',
	`table_twenty`			= '$table_twenty',
	`table_twentyone`		= '$table_twentyone',
	`table_twentytwo`		= '$table_twentytwo',
	`table_twentythree`		= '$table_twentythree',
	`bath_times`			= '$bath_times',
	`handwashing`			= '$handwashing',
	`brush_teeth`			= '$brush_teeth',
	`floss_use`				= '$floss_use',
	`toothbrush`			= '$toothbrush',
	`nails_cut`				= '$nails_cut',
	`bath_towel`			= '$bath_towel',
	`id_patient`			= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}


/**
 * [Función para el almacenado de información dentro de la sección de Evaluación de crecimiento y desarrollo]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveChildLifestyleData_DOM($connection, $method,
	$id_patient,
	$wake_food,
	$sausages,
	$food_times,
	$fast_food,
	$fatty_food,
	$mealtime,
	$balanced_diet,
	$dairy_products,
	$meats,
	$tubers,
	$vegetables,
	$fruits,
	$cereals,
	$snacks,
	$exercise,
	$exercise_times,
	$sport_active,
	$medical_times,
	$kid_review,
	$medical_exams,
	$dentist,
	$psychology,
	$nutrition,
	$previous_treatment,
	$diseases,
	$childcare,
	$second_opinion,
	$restless,
	$quiet,
	$difficulty_relating,
	$weeping,
	$alone_prefer,
	$bath_times,
	$handwashing,
	$brush_teeth,
	$floss_use,
	$underwear,
	$nails_cut,
	$bath_towel,
	$diagnostic_disorder,
	$school_perform,
	$relates,
	$stumbles,
	$vision_problems,
	$approximate,
	$headache,
	$difficult_learn,
	$frequent_restless,
	$difficult_pronounce,
	$letter_invert,
	$unfinished_activities,
	$naughty,
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

	$query .= " `childlifestyledata` SET
	`wake_food`				= '$wake_food',
	`sausages`				= '$sausages',
	`food_times`			= '$food_times',
	`fast_food`				= '$fast_food',
	`fatty_food`			= '$fatty_food',
	`mealtime`				= '$mealtime',
	`balanced_diet`			= '$balanced_diet',
	`dairy_products`		= $dairy_products,
	`meats`					= $meats,
	`tubers`				= $tubers,
	`vegetables`			= $vegetables,
	`fruits`				= $fruits,
	`cereals`				= $cereals,
	`snacks`				= $snacks,
	`exercise`				= '$exercise',
	`exercise_times`		= '$exercise_times',
	`sport_active`			= '$sport_active',
	`medical_times`			= '$medical_times',
	`kid_review`			= '$kid_review',
	`medical_exams`			= '$medical_exams',
	`dentist`				= '$dentist',
	`psychology`			= '$psychology',
	`nutrition`				= '$nutrition',
	`previous_treatment`	= '$previous_treatment',
	`diseases`				= '$diseases',
	`childcare`				= '$childcare',
	`second_opinion`		= '$second_opinion',
	`restless`				= '$restless',
	`quiet`					= '$quiet',
	`difficulty_relating`	= '$difficulty_relating',
	`weeping`				= '$weeping',
	`alone_prefer`			= '$alone_prefer',
	`bath_times`			= '$bath_times',
	`handwashing`			= '$handwashing',
	`brush_teeth`			= '$brush_teeth',
	`floss_use`				= '$floss_use',
	`underwear`				= '$underwear',
	`nails_cut`				= '$nails_cut',
	`bath_towel`			= '$bath_towel',
	`diagnostic_disorder`	= '$diagnostic_disorder',
	`school_perform`		= '$school_perform',
	`relates`				= '$relates',
	`stumbles`				= '$stumbles',
	`vision_problems`		= '$vision_problems',
	`approximate`			= '$approximate',
	`headache`				= '$headache',
	`difficult_learn`		= '$difficult_learn',
	`frequent_restless`		= '$frequent_restless',
	`difficult_pronounce`	= '$difficult_pronounce',
	`letter_invert`			= '$letter_invert',
	`unfinished_activities`	= '$unfinished_activities',
	`naughty`				= '$naughty',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información dentro de la sección de Evaluación de crecimiento y desarrollo]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveYoungLifestyleData_DOM($connection, $method,
	$id_patient,
	$wake_food,
	$chemical_food,
	$food_times,
	$fast_food,
	$fatty_food,
	$mealtime,
	$overeat,
	$balanced_diet,
	$eat_pleasure,
	$check_labels,
	$dairy_products,
	$meats,
	$tubers,
	$vegetables,
	$fruits,
	$cereals,
	$snacks,
	$exercise,
	$exercise_times,
	$sport_active,
	$medical_times,
	$body_explore,
	$medical_exams,
	$blood_pressure,
	$dentist,
	$psychology,
	$nutrition,
	$self_medicate,
	$diseases,
	$search_information,
	$second_opinion,
	$relax_time,
	$stress_causes,
	$stress_impact,
	$stress_control_methods,
	$confident,
	$feeling_alone,
	$difficulty_relating,
	$criticize,
	$no_opinion,
	$tofeel_affection,
	$affection_taste,
	$alone_prefer,
	$love_me,
	$purpose_life,
	$enthusiast,
	$long_term_goals,
	$realistic_goals,
	$fulfilled_goals,
	$capacity_debility,
	$mistakes,
	$recreation,
	$entertainment_time,
	$alcohol,
	$cigar,
	$recreational_activities,
	$time_sleep,
	$insomnia,
	$wake_midnight,
	$drowsiness,
	$shortness_breath,
	$cough_snore,
	$nightmare,
	$thoughts,
	$sleeping_pills,
	$energy_drink,
	$bath_times,
	$handwashing,
	$brush_teeth,
	$floss_use,
	$toothbrush,
	$deodorant,
	$underwear,
	$nails_cut,
	$bath_towel,
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

	$query .= " `younglifestyledata` SET
	`wake_food`				= '$wake_food',
	`chemical_food`			= '$chemical_food',
	`food_times`			= '$food_times',
	`fast_food`				= '$fast_food',
	`fatty_food`			= '$fatty_food',
	`mealtime`				= '$mealtime',
	`overeat`				= '$overeat',
	`balanced_diet`			= '$balanced_diet',
	`eat_pleasure`			= '$eat_pleasure',
	`check_labels`			= '$check_labels',
	`dairy_products`		= $dairy_products,
	`meats`					= $meats,
	`tubers`				= $tubers,
	`vegetables`			= $vegetables,
	`fruits`				= $fruits,
	`cereals`				= $cereals,
	`snacks`				= $snacks,
	`exercise`				= '$exercise',
	`exercise_times`		= '$exercise_times',
	`sport_active`			= '$sport_active',
	`medical_times`			= '$medical_times',
	`body_explore`			= '$body_explore',
	`medical_exams`			= '$medical_exams',
	`blood_pressure`		= '$blood_pressure',
	`dentist`				= '$dentist',
	`psychology`			= '$psychology',
	`nutrition`				= '$nutrition',
	`self_medicate`			= '$self_medicate',
	`diseases`				= '$diseases',
	`search_information`	= '$search_information',
	`second_opinion`		= '$second_opinion',
	`relax_time`			= '$relax_time',
	`stress_causes`			= '$stress_causes',
	`stress_impact`			= '$stress_impact',
	`stress_control_methods`	= '$stress_control_methods',
	`confident`				= '$confident',
	`feeling_alone`			= '$feeling_alone',
	`difficulty_relating`	= '$difficulty_relating',
	`criticize`				= '$criticize',
	`no_opinion`			= '$no_opinion',
	`tofeel_affection`		= '$tofeel_affection',
	`affection_taste`		= '$affection_taste',
	`alone_prefer`			= '$alone_prefer',
	`love_me`				= '$love_me',
	`purpose_life`			= '$purpose_life',
	`enthusiast`			= '$enthusiast',
	`long_term_goals`		= '$long_term_goals',
	`realistic_goals`		= '$realistic_goals',
	`fulfilled_goals`		= '$fulfilled_goals',
	`capacity_debility`		= '$capacity_debility',
	`mistakes`				= '$mistakes',
	`recreation`			= '$recreation',
	`entertainment_time`	= '$entertainment_time',
	`alcohol`				= '$alcohol',
	`cigar`					= '$cigar',
	`recreational_activities`	= '$recreational_activities',
	`time_sleep`			= '$time_sleep',
	`insomnia`				= '$insomnia',
	`wake_midnight`			= '$wake_midnight',
	`drowsiness`			= '$drowsiness',
	`shortness_breath`		= '$shortness_breath',
	`cough_snore`			= '$cough_snore',
	`nightmare`				= '$nightmare',
	`thoughts`				= '$thoughts',
	`sleeping_pills`		= '$sleeping_pills',
	`energy_drink`			= '$energy_drink',
	`bath_times`			= '$bath_times',
	`handwashing`			= '$handwashing',
	`brush_teeth`			= '$brush_teeth',
	`floss_use`				= '$floss_use',
	`toothbrush`			= '$toothbrush',
	`deodorant`				= '$deodorant',
	`underwear`				= '$underwear',
	`nails_cut`				= '$nails_cut',
	`bath_towel`			= '$bath_towel',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información dentro de la sección de Cuidado de la Salud]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveHealthCareData_DOM($connection, $method,
	$id_patient,
	$scare,
	$confront,
	$take_control,
	$relapse,
	$bad_inside,
	$normal,
	$personality,
	$something_inside,
	$professionals,
	$competent,
	$can_work,
	$ashamed,
	$judge_me,
	$can_talk,
	$draw_away,
	$psychiatric,
	$well_mentally,
	$mental_illness,
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

	$query .= " `healthcaredata` SET
	`scare`				= '$scare',
	`confront`			= '$confront',
	`take_control`		= '$take_control',
	`relapse`			= '$relapse',
	`bad_inside`		= '$bad_inside',
	`normal`			= '$normal',
	`personality`		= '$personality',
	`something_inside`	= '$something_inside',
	`professionals`		= '$professionals',
	`competent`			= '$competent',
	`can_work`			= '$can_work',
	`ashamed`			= '$ashamed',
	`judge_me`			= '$judge_me',
	`can_talk`			= '$can_talk',
	`draw_away`			= '$draw_away',
	`psychiatric`		= '$psychiatric',
	`well_mentally`		= '$well_mentally',
	`mental_illness`	= '$mental_illness',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información dentro de la sección de Signos vitales + Laboratorio]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveVitalSignData_DOM($connection, $method,
	$id_patient,
	$blood_pressure,
	$heart_rate,
	$breathe_rate,
	$temperature,
	$glucose,
	$weight,
	$height,
	$body_mass,
	$body_fat,
	$arm_perimeter,
	$abdomen_perimeter,
	$capillary_refill,
	$saturation,
	$glycated_hemoglobin,
	$glucose_lab,
	$creatinine,
	$cholesterol,
	$triglycerides,
	$prostatic_antigen,
	$sida,
	$syphilis,
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

	$query .= " `vitalsigndata` SET
	`blood_pressure`		= '$blood_pressure',
	`heart_rate`			= $heart_rate,
	`breathe_rate`			= $breathe_rate,
	`temperature`			= $temperature,
	`glucose`				= $glucose,
	`weight`				= $weight,
	`height`				= $height,
	`body_mass`				= $body_mass,
	`body_fat`				= $body_fat,
	`arm_perimeter`			= $arm_perimeter,
	`abdomen_perimeter`		= $abdomen_perimeter,
	`capillary_refill`		= $capillary_refill,
	`saturation`			= $saturation,
	`glycated_hemoglobin`	= $glycated_hemoglobin,
	`glucose_lab`			= $glucose_lab,
	`creatinine`			= $creatinine,
	`cholesterol`			= $cholesterol,
	`triglycerides`			= $triglycerides,
	`prostatic_antigen`		= $prostatic_antigen,
	`sida`					= $sida,
	`syphilis`				= $syphilis,
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
	// echo $query;

	$inserted = mysqli_query($connection, $query);

	return $inserted;
}

/**
 * [Función para el almacenado de información dentro del Cuestionario para evaluación de violencia de género.]
 * @param  [mysqlC] $connection  [Recurso MySQL. Objeto con la conexión a la base de datos]
 * @param  [string] $method      [Selección entre insertar o actualizar]
 * @param  [string] $data        [Información a ser guardada/actualizada]
 * @param  [int] $id_user    	 [ID del usuario en cuestión]
 * @return [bool]             	 [Resultado de la inserción/actualización]
 */
function saveGenderViolenceData_DOM($connection, $method,
	$id_patient,
	$push_up,
	$push_down,
	$strike,
	$wants,
	$useless,
	$normal_hit,
	$without_reason,
	$violent,
	$forced_sex,
	$engagement_sex,
	$sex_fear,
	$bad_treatments,
	$decide_4me,
	$isolates_me,
	$try_isolate,
	$feel_guilty,
	$insults_me,
	$bruises,
	$be_alert,
	$denounced,
	$look_scare,
	$feel_alone,
	$can_work,
	$see_family,
	$watches_me,
	$keep_hooked,
	$regret_guilty,
	$care_aspect,
	$have_obey,
	$gender_equality,
	$protect_couple,
	$private_life,
	$slap_necessary,
	$abuser_failed,
	$good_bad,
	$life_proyect,
	$without_father,
	$childrens,
	$without_me,
	$love_him,
	$feel_sorry,
	$marriage,
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

	$query .= " `genderviolencedata` SET
	`push_up`			= '$push_up',
	`push_down`			= '$push_down',
	`strike`			= '$strike',
	`wants`				= '$wants',
	`useless`			= '$useless',
	`normal_hit`		= '$normal_hit',
	`without_reason`	= '$without_reason',
	`violent`			= '$violent',
	`forced_sex`		= '$forced_sex',
	`engagement_sex`	= '$engagement_sex',
	`sex_fear`			= '$sex_fear',
	`bad_treatments`	= '$bad_treatments',
	`decide_4me`		= '$decide_4me',
	`isolates_me`		= '$isolates_me',
	`try_isolate`		= '$try_isolate',
	`feel_guilty`		= '$feel_guilty',
	`insults_me`		= '$insults_me',
	`bruises`			= '$bruises',
	`be_alert`			= '$be_alert',
	`denounced`			= '$denounced',
	`look_scare`		= '$look_scare',
	`feel_alone`		= '$feel_alone',
	`can_work`			= '$can_work',
	`see_family`		= '$see_family',
	`watches_me`		= '$watches_me',
	`keep_hooked`		= '$keep_hooked',
	`regret_guilty`		= '$regret_guilty',
	`care_aspect`		= '$care_aspect',
	`have_obey`			= '$have_obey',
	`gender_equality`	= '$gender_equality',
	`protect_couple`	= '$protect_couple',
	`private_life`		= '$private_life',
	`slap_necessary`	= '$slap_necessary',
	`abuser_failed`		= '$abuser_failed',
	`good_bad`			= '$good_bad',
	`life_proyect`		= '$life_proyect',
	`without_father`	= '$without_father',
	`childrens`			= '$childrens',
	`without_me`		= '$without_me',
	`love_him`			= '$love_him',
	`feel_sorry`		= '$feel_sorry',
	`marriage`			= '$marriage',
	`id_patient`		= $id_patient,
	`created_at` 		= CURRENT_TIMESTAMP,
	`capturist` 		= $capturist $postQuery";

	// var_dump($query);
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