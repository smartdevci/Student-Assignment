<?php 
	session_start();
	include 'all_class.php';
	if(isset($_GET['id']))
	{

		
            echo 'ok';
		
			$id=$_GET['id'];
			$type=$_GET['type'];


			$connexion=new DAO();




			$p=$connexion->getStudent($id,$type);

            $_SESSION['id']=$p->id;
			$_SESSION['name']=$p->name;
			$_SESSION['date']=$p->date_inscription;
			$_SESSION['mobilite']=$p->extra_case;
			$_SESSION['password_changed']=$p->password_changed;
            $_SESSION['type']=$p->type;

        //sur le Dashboard
			header('Location:./');

            //var_dump($p);



		

	}
	else
	{
		header('Location:../');
	}
	

//print_r($_SESSION);
	

?>