<?php 
	session_start();
	//$_SESSION['id']=1;
	$consultation_instance_id=$_GET['c'];
	
	require 'redirect.php';
	require 'all_class.php';

	//$donnees=$_SESSION['student'];
	include ('init_student.php');
	
	$connexion=new DAO();

	$assignments=$connexion->getAssignment($consultation_instance_id);
	
	if($assignments->rowCount()!=0)
	{

		$assignment=$assignments->fetch();
		$consultation_name=$assignment['consultation_name'];
		$consultation_importation_date=$assignment['date'];
		$assignment_importation_date=$assignment['date_assignment'];
		$activate_download=$assignment['result_file'];


		$list_choice=$connexion->getListChoiceForConsultation($consultation_instance_id);
		$choice=$list_choice->fetchAll();

		

		$list_student=$connexion->getListStudentForConsultation($consultation_instance_id);
		
		$students = array();
		

		while ($db_students=$list_student->fetch()) {
			$students[$db_students['student_id']]=array(
				'student_id'=>$db_students['student_id'],
				'login'=>$db_students['login'],
				'name'=>utf8_encode($db_students['name']
					)
			);
		}


		//var_dump($students);



		
		//$tab_consultation=$->fetchAll();

		$list_choice=$connexion->getListChoiceForConsultation($consultation_instance_id);
		$choices=$list_choice->fetchAll();
		//echo "choix taille : ".sizeof($choices);
		//var_dump($choices);
		

		$list_assignment=$connexion->getListAssignment($consultation_instance_id);
		$assignments= array(array());

		echo "ok : ".$list_assignment->rowCount()."/".$consultation_instance_id;



		while($assignment=$list_assignment->fetch())
		{

			$assignments[$assignment['student_id']][$assignment['choice_id']]= $assignment['option_name'];

		}

		//var_dump($assignments);
			
		


	}
	else
	{
		$consultation_query=$connexion->getConsultation($consultation_id);
		$consultation=$consultation_query->fetch();
		//$assignment=$assignments->fetch();
		$consultation_name=$consultation['consultation_name'];
		$consultation_importation_date=$consultation['date'];
		$assignment_importation_date="";


	}


	


?>
