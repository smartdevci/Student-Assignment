<?php 
	session_start();

	
	include '../all_class.php';
	
	$connexion=DAO::getConnection();
	$connexion2=new DAO();

	$valeur=$_GET['value'];
	$student_id=$_GET['student_id'];


	$connexion2->registerUseToken_regret_point($valeur,$student_id,1,"");


	$query_update_token=$connexion->prepare("
		UPDATE students 
		SET regret_point= regret_point+:number_regret_point
		WHERE student_id=:student_id
	");

	$query_update_token->bindValue(':number_regret_point',$valeur,PDO::PARAM_INT);
	$query_update_token->bindValue(':student_id',$student_id,PDO::PARAM_INT);
	$query_update_token->execute();

?>