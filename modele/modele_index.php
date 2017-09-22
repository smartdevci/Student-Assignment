<?php 
	//session_start();
	
	require 'redirect.php';
	require 'all_class.php';

	//$donnees=$_SESSION['student'];
	include ('init_student.php');
	$connexion=new DAO();
	$connexion->cancelData();

	/*******Consultation****************/
	$number_consultation=$connexion->getNumberConsultation();
	$number_consultation_having_assignment=$connexion->getNumberConsultationNoResult();

	$data=$connexion->getLastConsultation();
	$last_consultation_date=$data['la_date'];

	$number_of_student=$connexion->getNumberStudent();
	$number_of_student_automatic_password=$connexion->getNumberStudentAutomaticPassword();

	



	



?>
