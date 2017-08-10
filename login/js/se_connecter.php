<?php 
include '../../all_class.php';


$login=$_GET['login'];
$password=$_GET['password'];
$connexion=new DAO();

echo $connexion->getId($login,$password);