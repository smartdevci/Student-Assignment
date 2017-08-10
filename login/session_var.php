<?php 
	session_start();
	include '../all_class.php';
	if(isset($_GET['id']))
	{
		
			$id=$_GET['id'];
			$type=$_GET['type'];


			$connexion=new DAO();

			$p=$connexion->getStudent($id,$type);
			//print_r($p);
			$donnees = array(
				'id' =>$p->id , 
				'name' =>utf8_encode($p->name) , 
				'login' =>$p->login , 
				'password' =>utf8_encode($p->password) , 
				'date_inscription' =>$p->date_inscription , 
				'remaining_token' =>$p->remaining_token,
				'type' =>$p->type

			);

			$_SESSION['student']=$donnees;
			$_SESSION['id']=$p->id;
			 $_SESSION['type']=$p->type;

			/*
			$_SESSION['date']=$p->date_inscription;
			$_SESSION['mobilite']=0;*/

			//sur le Dashboard
			header('Location:../');
			
			


	}
	else
	{
		header('Location:./');
	}
	

//print_r($_SESSION);
	

?>