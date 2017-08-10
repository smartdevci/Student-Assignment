<?php
session_start();

$user_id=$_GET['user_id'];
$name=$_GET['name'];
$login=$_GET['login'];

include '../all_class.php';
$connexion=DAO::getConnection();

$query_recover_user_id=$connexion->prepare("
		SELECT * FROM user WHERE user_id=:user_id
	");

$query_recover_user_id->bindValue(':user_id',$user_id,PDO::PARAM_INT);
$query_recover_user_id->execute();

$response_recover_user_id=$query_recover_user_id->fetch();



$query_update_user=$connexion->prepare("
	    UPDATE user 
	    SET login=:login  WHERE user_id=:user_id
	");

$query_update_user->bindValue(':login',$login,PDO::PARAM_STR);
$query_update_user->bindValue(':user_id',$user_id,PDO::PARAM_INT);
$query_update_user->execute();



$query_update_user=$connexion->prepare("
            UPDATE admin 
            SET name=:name WHERE admin_id=:admin_id
        ");

$query_update_user->bindValue(':admin_id',$response_recover_user_id['admin_id'],PDO::PARAM_INT);
$query_update_user->bindValue(':name',$name,PDO::PARAM_STR);
$query_update_user->execute();

?>