<?php 
	session_start();
	
	require 'redirect.php';
	require 'all_class.php';

	//$donnees=$_SESSION['student'];
	//you must register the number of token and regret_point when you register a student
	//firstly the token and the regrer_point afterward

	include ('init_student.php');
	$student_id=$_SESSION['id'];
	//var_dump($_SESSION);

	$connexion=new DAO();
	$connexion->cancelData();






//$list_use_wallet_data=$connexion->getWalletUse($student_id);

$list_previous_assignment=$connexion->getListAcademicYearForStudent($student_id);


$liste_donnees_utilisation_monnaie=array();
//$donnees=array();
$indice=0;



	//for each line, we need 
	/*
	| Date       |  Number of Token used   |  about_token  : 1 if it is information about token, 0 if it is regret point |
	*/

	/*$liste_donnees_utilisation_monnaie=array();
	$indice=0;

	/************************************************************************

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

	/************************************************************************/
	//echo sizeof($liste_donnees_utilisation_monnaie)."#<hr/>";



	
	


	



?>
