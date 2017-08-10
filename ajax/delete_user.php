<?php
/**
 * Created by PhpStorm.
 * User: Melaine
 * Date: 04/08/2017
 * Time: 06:34
 */

$user_id=$_GET['user_id'];
include '../all_class.php';
$connexion=DAO::getConnection();

$query_recover_admin_id=$connexion->prepare("
		SELECT * FROM user WHERE user_id=:user_id
	");

$query_recover_admin_id->bindValue(':user_id',$user_id,PDO::PARAM_INT);
$query_recover_admin_id->execute();

$response_recover_admin_id=$query_recover_admin_id->fetch();
$admin_id=$response_recover_admin_id['admin_id'];


/******************************************************************************************/

$query_delete_user=$connexion->prepare("DELETE FROM user WHERE user_id=:user_id");
$query_delete_user->bindValue(":user_id",$user_id,PDO::PARAM_INT);
$query_delete_user->execute();


$query_delete_admin=$connexion->prepare("DELETE FROM admin WHERE admin_id=:admin_id");
$query_delete_admin->bindValue(":admin_id",$admin_id,PDO::PARAM_INT);
$query_delete_admin->execute();



?>