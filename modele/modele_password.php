<?php 
	session_start();
	
	require 'redirect.php';
	require 'all_class.php';

	include ('init_student.php');


	//$donnees=$_SESSION['student'];
		
	$connexion=new DAO();
	$connexion->cancelData();


	$list_of_students=$connexion->getListStudent();



?>
