<?php 
include '../dashboard/all_class.php';

$connexion=DAO::getConnection();

$email=$_GET['email'];
$password=md5($_GET['password']);



$sql="
	SELECT * FROM participant
	WHERE 
	email=:email
	AND
	password=:password 

	";

//echo "/".$sql."/";
$requete=$connexion->prepare($sql);

$requete->bindValue(':email',$email,PDO::PARAM_STR);
$requete->bindValue(':password',$password,PDO::PARAM_STR);
$requete->execute();

//echo $requete->rowCount();

$reponse=$requete->fetch();

echo ($requete->rowCount()!=0)?$reponse['id_participant']:$requete->rowCount();	

//echo "/".$password."/".$email."/".md5($_GET['password']);