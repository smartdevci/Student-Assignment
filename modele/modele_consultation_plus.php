<?php 
	session_start();
	//$_SESSION['id']=1;
	$consultation_instance_id=$_GET['c'];
	
	require 'redirect.php';
	require 'all_class.php';

	//$donnees=$_SESSION['student'];
	include ('init_student.php');
	
	$connexion=new DAO();

	$consultations=$connexion->getConsultation($consultation_instance_id);
	$tab_consultation=$consultations->fetchAll();

	//var_dump($tab_consultation);

	$query_list_choice=$connexion->getListChoiceForConsultation2($consultation_instance_id);
	$list_choice=$query_list_choice->fetchAll();

	$query_list_student=$connexion->getListStudentForConsultation($consultation_instance_id);
	//$students=$list_student->fetchAll();
	
	$list_student = array();
	
	while ($db_students=$query_list_student->fetch()) {
		$list_student[$db_students['student_id']]=array(
			'login'=>$db_students['login'],
			'student_id'=>$db_students['student_id'],
			'name'=>utf8_encode($db_students['name']
				)
		);
	}

	
	$list_vote=$connexion->getListVote($consultation_instance_id);
	$votes= array(array(array(array())));



	while($vote=$list_vote->fetch())
	{

		$votes[$vote['student_id']][$vote['choice_id']][$vote['option_id']]['bid'] = $vote['bids'];
		$votes[$vote['student_id']][$vote['choice_id']][$vote['option_id']]['argument1'] = $vote['argument1'];
		$votes[$vote['student_id']][$vote['choice_id']][$vote['option_id']]['argument2'] = $vote['argument2'];
		$votes[$vote['student_id']][$vote['choice_id']][$vote['option_id']]['argument3'] = $vote['argument3'];
	}

	


?>
