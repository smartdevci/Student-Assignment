<?php 
	session_start();

	include '../all_class.php';
	$connexion=DAO::getConnection();
	
	$colonne=$_GET['colonne'];
	$id=$_GET['id'];
	$value=$_GET['value'];

	$query=$connexion->prepare("
		UPDATE students 
		SET ".$colonne."=:value
		WHERE 
		student_id=:student_id
	");


	//$id=$_SESSION['id'];
	$query->bindValue(':student_id',$id,PDO::PARAM_INT);
	$query->bindValue(':value',utf8_decode($value),PDO::PARAM_STR);
	$query->execute();

	echo $query->rowCount();
?>

