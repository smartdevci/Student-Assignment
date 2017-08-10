<?php 
	session_start();
	$student_id=$_GET['st'];
	
	require 'redirect.php';
	require 'all_class.php';

	require 'init_student.php';	
	$connexion=new DAO();

	$student=$connexion->getStudent($student_id);

	$list_previous_assignment=$connexion->getListAcademicYearForStudent($student_id);
	$list_use_wallet_data=$connexion->getWalletUse($student_id);


	
	$liste_donnees_utilisation_monnaie=array();
	//$donnees=array();
	$indice=0;

	while($use_wallet_data=$list_use_wallet_data->fetch())
	{
		/*$donnees_utilisation_monnaie = array(
			'date' => $use_wallet_data['date'], 
			'number' => $use_wallet_data['number'], 
			'about_token' => $use_wallet_data['about_token'],
			'reason' => $use_wallet_data['reason']
		);*/

		array_push(
			$liste_donnees_utilisation_monnaie,
			array(
			'date' => $use_wallet_data['date'], 
			'reason' => $use_wallet_data['reason'], 
			'number' => $use_wallet_data['number'], 
			'about_token' => $use_wallet_data['about_token'],
			'reason' => $use_wallet_data['reason']
			)
		);

		//	$donnees_utilisation_monnaie);
		//$liste_donnees_utilisation_monnaie[$indice]=$donnees_utilisation_monnaie;
		//$indice++;
		//$donnees_utilisation_monnaie[$indice]=
	}










	

	/************************************************************************/
/*
	$donnees_utilisation_monnaie = array(
		'date' => '03/05/2017', 
		'number' => 20, 
		'about_token' => 1
	);
	$liste_donnees_utilisation_monnaie[$indice]=$donnees_utilisation_monnaie;
	$indice++;

	/************************************************************************
	$donnees_utilisation_monnaie = array(
		'date' => '03/05/2017', 
		'number' =>2, 
		'about_token' => 0
	);
	$liste_donnees_utilisation_monnaie[$indice]=$donnees_utilisation_monnaie;
	$indice++;

	/************************************************************************
	$donnees_utilisation_monnaie = array(
		'date' => '03/05/2017', 
		'number' => -2, 
		'about_token' => 1
	);
	$liste_donnees_utilisation_monnaie[$indice]=$donnees_utilisation_monnaie;
	$indice++;

	/************************************************************************

	$donnees_utilisation_monnaie = array(
		'date' => '03/05/2017', 
		'number' => -4, 
		'about_token' => 1
	);
	$liste_donnees_utilisation_monnaie[$indice]=$donnees_utilisation_monnaie;
	$indice++;

	/************************************************************************

	$donnees_utilisation_monnaie = array(
		'date' => '03/05/2017', 
		'number' => 7, 
		'about_token' => 0
	);
	$liste_donnees_utilisation_monnaie[$indice]=$donnees_utilisation_monnaie;
	$indice++;

	/************************************************************************

	
	$donnees_utilisation_monnaie = array(
		'date' => '03/05/2017', 
		'number' => 1, 
		'about_token' => 1
	);
	$liste_donnees_utilisation_monnaie[$indice]=$donnees_utilisation_monnaie;
	$indice++;

	/************************************************************************

	$donnees_utilisation_monnaie = array(
		'date' => '03/05/2017', 
		'number' => -2, 
		'about_token' => 0
	);
	$liste_donnees_utilisation_monnaie[$indice]=$donnees_utilisation_monnaie;
	$indice++;
	*/

	
	//var_dump($liste_donnees_utilisation_monnaie);


?>
