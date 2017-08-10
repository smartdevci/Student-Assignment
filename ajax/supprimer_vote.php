<?php 
	session_start();

	
	include '../all_class.php';
	$connexion=DAO::getConnection();
	$votes=$_GET['id_vote'];
	$votes_tab=explode("_",$votes);
	$id1=$votes_tab[0];
	$id2=$votes_tab[1];


	$query=$connexion->prepare("
		DELETE FROM vote 
		WHERE 
		id_vote IN (:id1,:id2)
		
	");


	//$id=$_SESSION['id'];
	$query->bindValue(':id1',$id1,PDO::PARAM_INT);
	$query->bindValue(':id2',$id2,PDO::PARAM_INT);
	$query->execute();

//print_r($_SESSION);
	echo $query->rowCount();
?>