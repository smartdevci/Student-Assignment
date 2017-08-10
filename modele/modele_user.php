<?php 
	session_start();
	$donnees=$_SESSION['student'];
	
	require 'redirect.php';
	require 'all_class.php';
	include ('init_student.php');

	$connexion=new DAO();
	$list_user_type=$connexion->getListUserTypeIHM();
	$list_user=$connexion->getListUserIHM();



?>
