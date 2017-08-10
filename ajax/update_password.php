<?php 
	session_start();

	$id=$_SESSION['id'];
	$old=$_GET['old'];
	$nouveau=$_GET['nouveau'];


	
	include '../all_class.php';
	$connexion=DAO::getConnection();

	$query=$connexion->prepare("
		UPDATE students 
		SET
		password=:password,
		password_changed=1

		WHERE 
		student_id=:id AND 
		password=:old_password
		
	");


	//$id=$_SESSION['id'];
	$query->bindValue(':password',$nouveau,PDO::PARAM_STR);
	$query->bindValue(':old_password',$old,PDO::PARAM_STR);
	$query->bindValue(':id',$id,PDO::PARAM_INT);
	$query->execute();

//print_r($_SESSION);
	echo $query->rowCount();
?>