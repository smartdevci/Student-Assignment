<?php 
	session_start();

	$consultation_instance_id=$_GET['consultation_instance_id'];
	$choice_id=$_GET['choice_id'];
	$value=$_GET['value'];
	
	include '../all_class.php';
	$connexion=DAO::getConnection();

	$query=$connexion->prepare("
		UPDATE proposedchoice 
		SET
		min_bid=:min_bid

		WHERE 
		choice_id=:choice_id AND 
		consultation_instance_id=:consultation_instance_id
		
	");


	//$id=$_SESSION['id'];
	$query->bindValue(':min_bid',$value,PDO::PARAM_INT);
	$query->bindValue(':choice_id',$choice_id,PDO::PARAM_INT);
	$query->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
	$query->execute();


?>