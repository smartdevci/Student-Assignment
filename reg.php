<?php 
//require 'all_class.php';

$host="91.216.107.162";
$database_name="inter858974";
$user="inter858974";
$password="5bafhqisbi";

	$connexion=new PDO('mysql:host='.$host.';dbname='.$database_name, $user,$password);

	//print_r($_SERVER);SERVER_ADDR

	$req=$connexion->prepare('INSERT INTO ip (adresse) VALUES (:ip)');
	$req->bindValue(':ip',$_SERVER['REMOTE_ADDR']);
	$req->execute();

