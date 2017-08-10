<?php 
	require 'all_class.php';

	$con=new DAO();
	$connexion=$con->connexion;
	$id_consultation_instance_id=$_GET['id_consultation_instance_id'];
	//$ok="je suis,";
	//$ok[strlen($ok)-1]="";
	//echo $ok;




	//print_r($connexion);
	$list_students=$con->getListStudentForConsultation($id_consultation_instance_id);
	$list_choice=$con->getListChoiceForConsultation($id_consultation_instance_id);
	$tab_choice=$list_choice->fetchAll();

	/*print_r($list_choice);
	echo "<hr/><hr/>";
	$choice=$list_choice->fetchAll();
	print_r($choice);
	echo "<hr/>".sizeof($choice)."<hr/>";*/
	
	//$list_choice2=$list_choice;


	//echo $list_students->rowCount();

	$texte_json="{\n\t\"etudiants\" : [ \n";
	$i=0;
	while($etudiant=$list_students->fetch())
	{
		$i++;
		$texte_json.="\t{\n\t\t\"nom\" : \"".utf8_encode($etudiant['name'])."\",";
		$texte_json.="\n\t\t\"prenom\" : \"\",";
		$texte_json.="\n\t\t\"id\" : \"".$etudiant['student_id']."\",";
		$texte_json.="\n\t\t\"extra_case\" : \"rien\",";
		$texte_json.="\n\t\t\"consultation\" : [ \n";


		foreach ($tab_choice as $choice) 
		//while($choice=$list_choice->fetch())
		{
			$id=$choice['choice_id'];
			$list_option=$con->getListOptionForChoice($id,$id_consultation_instance_id);

		/*	$id=$etudiant['student_id'];
		$list_vote=$con->getListVoteStudent($id);
		echo "<hr/>".$list_vote->rowCount()."/".$id."<hr/>";*/
			$j=0;
			while ($option=$list_option->fetch())
			{ 	$j++;
			    //$list_vote
				$texte_json.="\t\t{\n\t\t\t\"id_etudiant\" : \"".$etudiant['student_id']."\",";
				$texte_json.="\n\t\t\t\"id_choix\" : \"".$choice['choice_id']."\",";
				$texte_json.="\n\t\t\t\"id_option\" : \"".$option['option_id']."\",";

				$donnees_vote=$con->getVoteStudentForOption($id_consultation_instance_id,$etudiant['student_id'],$choice['choice_id'],$option['option_id']);

				//echo "std_id : ". $etudiant['student_id']."/ choice_id : ".$choice['choice_id']." option_id : ".$option['option_id']." consul : ".$id_consultation_instance_id."  / vote : <hr/>";
				if($vote=$donnees_vote->fetch())
				{

					//echo "std_id : ". $etudiant['student_id']."/ choice_id : ".$choice['choice_id']." option_id : ".$option['option_id']." consul : ".$id_consultation_instance_id."  / vote : ".$vote['bids']."<hr/>";

					$texte_json.="\n\t\t\t\"bids\" : \"".$vote['bids']."\",";
					$texte_json.="\n\t\t\t\"preference\" : \"".$vote['pref']."\",";

					$nombre_argument=0;

					$argument1=trim($vote['argument1']);
					$argument2=trim($vote['argument2']);
					$argument3=trim($vote['argument3']);

					
					//echo "<hr/>0*/".$argument1."***********"."/".$argument2."/***********"."/".$argument3."/"."***********<hr/>";
					
					$argument1=str_replace("\\", "\\\\", $argument1);
					$argument2=str_replace("\\", "\\\\", $argument2);
					$argument3=str_replace("\\", "\\\\", $argument3);
					

					//echo "<hr/> <b>Avant</b> :".$j." - ".$texte_json." <hr/> ";
					$argument1=str_replace("\"", "\\\"", $argument1);
					$argument2=str_replace("\"", "\\\"", $argument2);
					$argument3=str_replace("\"", "\\\"", $argument3);

					//echo "<hr/>1*/".$argument1."***********"."/".$argument2."/***********"."/".$argument3."/"."***********<hr/>";
					
					//echo "<hr/> <b>Après</b> :".$j." /".$argument1."#".$argument2."#".$argument3."/  ( ".$etudiant['student_id']." ,".$choice['choice_id']." , ".$option['option_id'] .") -> ".$texte_json." <hr/> ";
					

					if((!empty($argument1)) || (!empty($argument2)) || (!empty($argument3) ))
					{	
						//$texte_json.='/ici/';

						//echo "<b>mais ? -----</b>";
						//echo "<hr/> <b>hummmm :".$texte_json."</b> <hr/> ";
						
						$texte_json.="\n\t\t\t\"arguments\" : [";
						if(!empty($argument1))
						{
							$texte_json.="\"".$argument1."\"";
							$nombre_argument++;
						}
						
						
						if(!empty($argument2))
						{
							$texte_json=($nombre_argument>=1)?$texte_json.",":$texte_json;
							$texte_json.="\"".$argument2."\"";
							$nombre_argument++;
							//echo "<hr/><hr/>*******************ooooooooooooooooooo***********".$j."******<b>".$texte_json."</b>**********<hr/>#########<hr/>";
							
						}
						
						if(!empty($argument3))
						{
							$texte_json=($nombre_argument>=1)?$texte_json.",":$texte_json;

							$texte_json.="\"".$argument3."\"";
							$nombre_argument++;
						}
						//echo "<hr/> <b>Après</b> :".$texte_json." <hr/> ";
					
						$texte_json.="]\n";
						


						/*$texte_json=(!empty($vote['argument2']))?$texte_json.,:"";
						

						$texte_json.="\n\n\t\t\"arguments\" : [\"".$vote['argument1']."\",\"".$vote['argument2']."\",\"".$vote['argument3']."\"]\n},\n";
						$texte_json.="\n\n\t\t\"arguments\" : [\"".$vote['argument1']."\",\"".$vote['argument2']."\",\"".$vote['argument3']."\"]\n},\n";
						$texte_json.="\n\n\t\t\"arguments\" : [\"".$vote['argument1']."\",\"".$vote['argument2']."\",\"".$vote['argument3']."\"]\n},\n";*/
					}
					else 
					{
						//echo "<b>ici ? -----</b>";
						$texte_json[strrpos($texte_json,",")]=" ";   //erase the last character ","
					}

					//echo "<hr/> <b>Après</b> :".$texte_json." <hr/> ";
					
					

					$texte_json.="\n\t\t},\n";
					
				
				}
				else 
				{
					$texte_json.="\n\t\t\t\"bids\" : \"".(-1)."\",";
					$texte_json.="\n\t\t\t\"preference\" : \"-1\"";
					$texte_json.="\n\t\t},\n";
				
				}




				
		
			}

		}
		$texte_json[strrpos($texte_json,",")]=" ";   //erase the last character ","
		$texte_json.="\n\t]} ,\n\n";
		
		
	}

	$texte_json[strrpos($texte_json,",")]=" ";   //erase the last character ","




	$texte_json.="\n ], \n \n\n\"Choix\" : [ \n";
	


	/********************************************************/
	/****************LISTE DES CHOIX*************************/
	/********************************************************/
	$i=0;
	foreach ($tab_choice as $choice) 
	//while($choice=$list_choice->fetch())
	{
		$id=$choice['choice_id'];
		$list_option=$con->getListOptionForChoice($id,$id_consultation_instance_id);
		$i++;
		$texte_json.="{\n\t\t\"nom\" : \"".utf8_encode($choice['choice_name'])."\",";
		$texte_json.="\n\t\t\"id\" : \"".$id."\",";
		$texte_json.="\n\t\t\"options\" : [ \n";

		$j=0;
		while($option=$list_option->fetch())
		{
			$j++;
			$texte_json.="\t\t{\n\t\t\t\"nom\" : \"".utf8_encode($option['option_name'])."\",";
			$texte_json.="\n\t\t\t\"id\" : \"".$option['option_id']."\",";
			$texte_json.="\n\t\t\t\"place_min\" : \"".$choice['locmin_bid']."\",";
			$texte_json.="\n\t\t\t\"place_maxi\" : \"".$choice['locmax_bid']."\"";
			$texte_json.="\n\t\t} ,\n";
			
			
		}

		//$texte_json[strrpos($texte_json,",")]=" ";  //erase the last character ","


		//$texte_json.="\n]} ,\n\n";
		$texte_json[strrpos($texte_json,",")]=" ";  //erase the last character ","


		$texte_json.="\n\t\t]\n} ,\n\n";
		
		
	}

	$texte_json[strrpos($texte_json,",")]=" ";   //erase the last character ","

	//$texte_json="{\n\t\"etudiants\" : [ \n\t\t";

	$texte_json.="],\n\n";
	$texte_json.="\"consultation\" : ".$id_consultation_instance_id;
	$texte_json.="\n}\n";

	//$texte_json.="]\n} \n\n";
	


	//$texte_json=str_replace("\"\"", "\"", $texte_json);
	//echo $texte_json;
	$contenu=file_put_contents("export/consultation".$id_consultation_instance_id.".json",$texte_json);






	$requete_update_date_in_consultation=$connexion->prepare("
		UPDATE instance 
		SET 
	    json=1
		WHERE instance_id=:instance_id
	");

	$requete_update_date_in_consultation->bindValue(':instance_id',$id_consultation_instance_id,PDO::PARAM_INT);
	$requete_update_date_in_consultation->execute();

//echo 'ok';


 ?>


