<?php 
	//session_start();
	
	require 'redirect.php';
	require 'all_class.php';

	//$donnees=$_SESSION['student'];
	include ('init_student.php');
	$connexion=new DAO();
	$connexion->cancelData();

	/*******Consultation****************/
	$number_consultation=3;
	$number_consultation_having_assignment=2;
	$last_consultation_date="12/05/2014";

	



	



?>
