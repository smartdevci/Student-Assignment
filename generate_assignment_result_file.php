<?php 
print_r($_POST);
$separator="";

if($_POST['separator']=="pvirgule")
{
	$separator=";";
}
else if($_POST['separator']=="tab")
{
	$separator="\t";
}
else if($_POST['separator']=="Autre")
{
	$separator=htmlspecialchars(trim($_POST['other_separator'])[0]);
}



include 'all_class.php';
$connexion=new DAO();

$choices = array();
$lignes=array();
$data_csv=array();
$index=0;


array_push($lignes, "Students", "ID");



$requete_choices_list=$connexion->getListChoiceForAssignment($_POST['consultation_instance_id']);

while($reponse_choices=$requete_choices_list->fetch())
{

	array_push($choices,array(
		'choice_id' => $reponse_choices['choice_id'],
		'choice_name' => $reponse_choices['choice_name']

	 ));

	

	array_push($lignes, $reponse_choices['choice_name']);
	
}

array_push($data_csv, $lignes);
$index++;


$list_student=$connexion->getListStudentsForAssignment($_POST['consultation_instance_id']);
while($student=$list_student->fetch())
{
	$lignes=array();
	array_push($lignes, utf8_encode($student['name']));
	array_push($lignes, $student['login']);
	

	foreach ($choices as $choix) {
		
		$requete_assignment=$connexion->getListAssignmentStudentChoice($_POST['consultation_instance_id'],$student['student_id'],$choix['choice_id']);
		$assignment=$requete_assignment->fetch();

		array_push($lignes, utf8_encode($assignment['option_name']));
	

	}

	array_push($data_csv, $lignes);
	$index++;
}


/*echo $data_assignment_result->rowCount();



while($reponse_data_assignment=$data_assignment_result->fetch())
{
	var_dump($reponse_data_assignment);
	array_push($data_csv[$index], $reponse_data_assignment['choice_name']);
	
}

$lignes[] = array("ok1","ok2");
$lignes[] = array("ok1","ok2");*/
$chemin = 'result_assignment/result_assignment'.$_POST['consultation_instance_id'].'.csv';
$fichier_csv = fopen($chemin,'w+');

foreach($data_csv as $ligne){
	fputcsv($fichier_csv, $ligne, $separator);
}





$connexion->hasResultAssignment($_POST['consultation_instance_id']);

//var_dump($lignes);



//echo "<hr/>".$separator."/";

header('Location:assignment.php?c='.$_POST['consultation_instance_id']);

?>