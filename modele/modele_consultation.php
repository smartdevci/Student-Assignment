<?php 
	session_start();
	//$_SESSION['id']=1;
	
	require 'redirect.php';
	require 'all_class.php';

	include ('init_student.php');
	
	$connexion=new DAO();
	$connexion->cancelData();


	$list_of_consultation=$connexion->getListConsultation();



?>
