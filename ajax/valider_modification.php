<?php 
	session_start();

	
	include '../all_class.php';
	$connexion=DAO::getConnection();




	$query=$connexion->prepare("
		UPDATE vote 
		SET
		bids=:bids,
		pref=:pref
		WHERE 
		id_vote=:id
		
	");


	$query->bindValue(':bids',(trim($_GET['bid'])=="")?0:trim($_GET['bid']),PDO::PARAM_INT);
	$query->bindValue(':pref',$_GET['pref'],PDO::PARAM_INT);
	$query->bindValue(':id',$_GET['vote_id'],PDO::PARAM_INT);
	$query->execute();

	echo $query->rowCount();
?>