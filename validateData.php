<?php 
	require 'all_class.php';
	$consultation_instance_id=$_GET['consultation_instance_id'];

	$connexion=new DAO();
	$connexion->validateData($consultation_instance_id);

	header('Location:consultations.php');
	
?>
