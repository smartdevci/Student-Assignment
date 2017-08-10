<?php 
	session_start();

	
	include '../all_class.php';
	
	$connexion=DAO::getConnection();
	$connexion2=new DAO();

	$valeur=$_GET['value'];
	$student_id=$_GET['student_id'];


	$connexion2->registerUseToken(-1*$valeur,$student_id,1,"");


	$query_update_token=$connexion->prepare("
		UPDATE students 
		SET remaining_token= remaining_token-:number_token
		WHERE student_id=:student_id
	");

	$query_update_token->bindValue(':number_token',$valeur,PDO::PARAM_INT);
	$query_update_token->bindValue(':student_id',$student_id,PDO::PARAM_INT);
	$query_update_token->execute();

?>