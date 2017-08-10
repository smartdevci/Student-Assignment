<?php


	$id=$_SESSION['id'];
    $type=$_SESSION['type'];

    $connexion=new DAO();
	$p=$connexion->getStudent($id,$type);
	//print_r($_SESSION);

	

?>