<?php
/**
 * Created by PhpStorm.
 * User: Melaine
 * Date: 05/08/2017
 * Time: 11:50
 */


session_start();

$name=$_GET['name'];
$login=$_GET['login'];
$password=$_GET['password'];

include '../all_class.php';
$connexion=DAO::getConnection();



$query_insert_admin=$connexion->prepare("
            INSERT INTO admin 
            (name) VALUES (:name)
");

$query_insert_admin->bindValue(':name',$name,PDO::PARAM_STR);
$query_insert_admin->execute();

$admin_id=$connexion->lastInsertId();
/*******************************************************************************/

$query_insert_user=$connexion->prepare("
            INSERT INTO user 
            (admin_id,login,password) VALUES (:admin_id,:login,:password)
");

$query_insert_user->bindValue(':admin_id',$admin_id,PDO::PARAM_INT);
$query_insert_user->bindValue(':login',$login,PDO::PARAM_STR);
$query_insert_user->bindValue(':password',$password,PDO::PARAM_STR);
$query_insert_user->execute();


echo $admin_id;



