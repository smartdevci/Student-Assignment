<?php 
	session_start();
	$donnees=$_SESSION['student'];
	
	require 'redirect.php';
	require 'all_class.php';

	//$donnees=$_SESSION['student'];
	include ('init_student.php');

	$connexion=new DAO();
	$connexion->cancelData();

	$consultation_name="Consultation".$connexion->nextNumberInstanceConsultation();
	$list_semester=$connexion->getListSemesterIHM();
	$list_level=$connexion->getListLevelIHM();
	




?>
