<?php 
	session_start();

	
	include '../all_class.php';
	$consultation_instance_id=$_GET['consultation_instance_id'];

	$connexion=DAO::getConnection();
	$list_student_warning=array();
	$list_vote_warning=array();

	$list_vote_warning=array();
	$msg="";

	
	

	$requete=$connexion->prepare("
		SELECT DISTINCT student_id FROM vote 
		WHERE consultation_instance_id=:consultation_instance_id
		
	");

	$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
	$requete->execute();



	$students=$requete->fetchAll();
	$nb=1;
	
	foreach ($students as $student) 
	{
		
		$requete_vote=$connexion->prepare("
		SELECT * 
		FROM vote v, options o, choice c, students s 
		WHERE 
		v.option_id= o.option_id AND 
		v.choice_id=c.choice_id AND 
		v.student_id=s.student_id AND 
		v.consultation_instance_id=:consultation_instance_id AND 
		v.student_id=:student_id 
		");

		$requete_vote->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete_vote->bindValue(':student_id',$student['student_id'],PDO::PARAM_INT);
		$requete_vote->execute();
		$reponse_votes=$requete_vote->fetchAll();

		//var_dump($reponse_votes);

		foreach($reponse_votes as $vote1)
		{
			
			foreach ($reponse_votes as $vote2) {
				
				if($vote1['pref']<$vote2['pref'])
				{
					if($vote1['bids']<$vote2['bids'])
					{
						$position=trim((string)array_search($vote1['id_vote'], $list_vote_warning));
						
						if($position=="")
						{
							array_push($list_student_warning,$vote1['student_id']);
							array_push($list_vote_warning,$vote1['id_vote']);
							$msg.=" ".$nb." - ".utf8_encode($vote1['name'])." prefère ".$vote1['option_name']." par rapport à ".$vote2['option_name'].", ";
							$msg.=" mais a misé ".$vote1['bids']." pour ".$vote1['option_name']." et ".$vote2['bids']." pour ".$vote2['option_name'];
							$msg.="<br/>";

							$nb++;
							
						}
					}
				}

				else if($vote1['pref']>$vote2['pref'])
				{
					if($vote1['bids']>$vote2['bids'])
					{
						

						$position=trim((string)array_search($vote1['id_vote'], $list_vote_warning));
						
						if($position=="")
						{

							array_push($list_student_warning,$vote1['student_id']);
							array_push($list_vote_warning,$vote1['id_vote']);
							$msg.=" ".$nb." - ".utf8_encode($vote1['name'])." prefère ".$vote2['option_name']." par rapport à ".$vote1['option_name'].", ";
							$msg.=" mais a misé ".$vote1['bids']." pour ".$vote1['option_name']." et ".$vote2['bids']." pour ".$vote2['option_name'];
							$msg.="<br/>";

							$nb++;
							
						}
						
					}
				}
			




					//echo $vote1['bids'].":".$vote1['pref']."/".$vote2['bids'].":".$vote2['pref']."<hr/>";
					
				
			}

			
		}



		

		
		

	}

	$texte=implode("\\",$list_vote_warning);

	if(trim($texte)=="")
	{
		$texte=sizeof($list_vote_warning);
	}
	else
	{
		$texte=sizeof($list_vote_warning)."\\".$texte;
	}
	
	echo $texte."\\".($nb-1)."\\".$msg;
	


?>