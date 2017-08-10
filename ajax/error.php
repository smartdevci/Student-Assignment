<?php 
	session_start();

	
	include '../all_class.php';
	$consultation_instance_id=$_GET['consultation_instance_id'];

	$connexion=DAO::getConnection();
	$connection_object=new DAO();
	$erreur_tout=array();
	$erreur_doublon=array();
	$erreur_nombre_jeton_etudiant=array();
	$erreur_min_max_consultation=array();
	$erreur_min_max_choix=array();

	$nb_error=1;
	
	






	//1- DUPLICATE ERROR
	$query_doublon=$connexion->prepare("
		SELECT student_id,consultation_instance_id,option_id FROM vote WHERE consultation_instance_id=:consultation_instance_id 
		GROUP BY student_id,consultation_instance_id,option_id HAVING COUNT(*)>=2 LIMIT 1
	");

	$query_doublon->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
	$query_doublon->execute();

	while($doublon=$query_doublon->fetch())
	{
		// if we are always the duplicate vote
		$query_error_id_vote=$connexion->prepare("
			SELECT id_vote 
			FROM vote 
			WHERE 
			student_id=:student_id AND
			consultation_instance_id=:consultation_instance_id AND 
			option_id=:option_id
		");

		$query_error_id_vote->bindValue(':student_id',$doublon['student_id'],PDO::PARAM_INT);
		$query_error_id_vote->bindValue(':consultation_instance_id',$doublon['consultation_instance_id'],PDO::PARAM_INT);
		$query_error_id_vote->bindValue(':option_id',$doublon['option_id'],PDO::PARAM_INT);
		$query_error_id_vote->execute();

		$texte="duplicate/".$query_error_id_vote->rowCount()."/";
		while($id_vote=$query_error_id_vote->fetch())
		{
			$texte.=$id_vote['id_vote']."/";
		}
		
		//echo $texte;
		array_push($erreur_doublon,$texte);

	}







	
		
		

	//ON TESTE SI L'ETUDIANT A RESPECTE LE NOMBRE DE SES JETONS

	$error2=0;
	$query_vote_token_number=$connexion->prepare("
		SELECT student_id,SUM(bids) as number_bid
		FROM vote 
		WHERE consultation_instance_id=:consultation_instance_id
		GROUP BY student_id
	");

	$query_vote_token_number->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
	$query_vote_token_number->execute();

	$student_vote_bid = array();

	while($bid_use=$query_vote_token_number->fetch())
	{
		//Pour chaque etudiant, on verifie s'il depasse le nombre de jeton quilui reste
		$query_student=$connexion->prepare("SELECT * FROM students WHERE token_temp<:bid_use AND student_id=:student_id");
		$query_student->bindValue(':bid_use',$bid_use['number_bid'],PDO::PARAM_INT);
		$query_student->bindValue(':student_id',$bid_use['student_id'],PDO::PARAM_INT);
		$query_student->execute();

		
		//si il y a une donnée , alors l'etudiant a utilisé un nombre de jéton inferieur à ses jetons restants, sinon il fait des bétises (Arrêtons le)
		if($query_student->rowCount()!=0)
		{	
			$student=$query_student->fetch();

			$error2=1;

			//Format : number_bid_use (text)/student_id/error_msg
			$texte="number_bid_use/".$bid_use['student_id']."/ ".$nb_error." - Unchecked constraint :".utf8_encode($student['name'])." dispose de  ".$student['token_temp']." jetons mais le nombre total de jetons misés pour cette consultation est ".$bid_use['number_bid'];

			$nb_error++;
			array_push($erreur_nombre_jeton_etudiant,$texte);
		}

	}


	





		/*************** ON TESTE S'IL A RESPECTE LE MIN MAX NOMBRE DE LA CONSULTATION***********************/

		
		$query_min_max_bid_consultation=$connexion->prepare("SELECT * FROM instance WHERE instance_id=:instance_id");
		$query_min_max_bid_consultation->bindValue(':instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$query_min_max_bid_consultation->execute();

		$min_max_bid_consultation=$query_min_max_bid_consultation->fetch();

		//echo "moi :".$query_min_max_bid_consultation->rowCount();


		$query_number_bid_consultation=$connexion->prepare("
			SELECT student_id,SUM(bids) as number_bid
			FROM vote 
			WHERE consultation_instance_id=:consultation_instance_id
			GROUP BY student_id
			HAVING SUM(bids)<:min_bid OR SUM(bids)>:max_bid 
		");

		$query_number_bid_consultation->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$query_number_bid_consultation->bindValue(':min_bid',$min_max_bid_consultation['min_bid'],PDO::PARAM_INT);
		$query_number_bid_consultation->bindValue(':max_bid',$min_max_bid_consultation['max_bid'],PDO::PARAM_INT);
		$query_number_bid_consultation->execute();

		//S'IL Y A QUELQU'UN QUI A DEPASSE LE NOMBRE AUTORISE DE JETON A MISER POUR LA CONSULTATION
		while($number_bid_consultation=$query_number_bid_consultation->fetch())
		{
			// IL Y A PROBLEME SUR L'ETUDIANT RECUPERE
			$requete_student=$connexion->prepare("SELECT * FROM students WHERE student_id=:student_id");
			$requete_student->bindValue(':student_id',$number_bid_consultation['student_id'],PDO::PARAM_INT);
			$requete_student->execute();
			$student=$requete_student->fetch();

			//Format : number_bid_consultation(text)/student_id/msg
			$texte="number_bid_consultation/".$number_bid_consultation['student_id']." / ".$nb_error." - Unchecked constraint : ".utf8_encode($student['name'])." n'a pas respecté le nombre de jetons autorisés pour cette consultation (Min bid : ".$min_max_bid_consultation['min_bid']." et Max bid : ".$min_max_bid_consultation['max_bid']." mais le nombre total de jetons misés est ".$number_bid_consultation['number_bid'].")";

			$nb_error++;
			//echo $texte;
			array_push($erreur_min_max_consultation, $texte);



		}



	
		/***************SI L'ETUDIANT NE RESPECTE PAS LES CONTRAINTES DE NOMBRE DE JETON AUTORISE D'UN CHOIX************/

		$requete_choice_consultation=$connexion->prepare("
			SELECT * FROM 
			proposedchoice p, choice c
			WHERE 
			consultation_instance_id=:consultation_instance_id AND 
			c.choice_id=p.choice_id
		");

		$requete_choice_consultation->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete_choice_consultation->execute();
		
		//echo $requete_choice_consultation->rowCount();


		$student_id="";
		$student_name="";
		$choice_id="";
		$choice_name="";
		$msg="";
		$texte="ok";

		//echo "max ".$requete_choice_consultation->rowCount()."#";
		$query_number_bid_choix="";
		while($choice_for_consultation=$requete_choice_consultation->fetch())
		{

			$query_number_bid_choix=$connexion->prepare("
				SELECT student_id,SUM(bids) as number_bid
				FROM vote 
				WHERE 
				consultation_instance_id=:consultation_instance_id AND 
				choice_id=:choice_id
				GROUP BY student_id
				HAVING SUM(bids)<:min_bid OR SUM(bids)>:max_bid 
			");

			$query_number_bid_choix->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
			$query_number_bid_choix->bindValue(':choice_id',$choice_for_consultation['choice_id'],PDO::PARAM_INT);
			$query_number_bid_choix->bindValue(':min_bid',$choice_for_consultation['min_bid'],PDO::PARAM_INT);
			$query_number_bid_choix->bindValue(':max_bid',$choice_for_consultation['max_bid'],PDO::PARAM_INT);
			$query_number_bid_choix->execute();

			//echo 'ici'.$query_number_bid_choix->rowCount()."/";
			//echo $query_number_bid_choix->rowCount();
			while($number_bid_choix=$query_number_bid_choix->fetch())
			{

				

				$requete_student=$connexion->prepare("SELECT * FROM students WHERE student_id=:student_id");
				$requete_student->bindValue(':student_id',$number_bid_choix['student_id'],PDO::PARAM_INT);
				$requete_student->execute();
				$student=$requete_student->fetch();

				$student_id=$student['student_id'];
				$student_name=utf8_encode($student['name']);
				$choice_id=$choice_for_consultation['choice_id'];
				$choice_name=utf8_encode($choice_for_consultation['choice_name']);
				$msg=" ".$student_name." n'a pas respecté le nombre de jetons autorisés pour le choix ".$choice_name."  (Min bid : ".$choice_for_consultation['min_bid']." et Max bid : ".$choice_for_consultation['max_bid']." mais le nombre total de jetons misés est ".$number_bid_choix['number_bid'].")";

				//Format : number_bid_choice/student_id/choice_id/msg
				$texte="number_bid_choice/".$student_id."/".$choice_id." / ".$nb_error." - Unchecked constraint ".$msg;
				$nb_error++;

				array_push($erreur_min_max_choix, $texte);
			}

			


		}






		
		$erreur_meme_pref=array();

		$list_students=$connection_object->getListStudentForConsultation($consultation_instance_id);
		while($student=$list_students->fetch())
		{
			$tab_pref=array();

			$votes=$connection_object->getListVoteAllInformation($consultation_instance_id,$student['student_id']);
			//echo "yes : ".$votes->rowCount()."-----------";

			$donnees=$votes->fetchAll();

			//on compare une ligne à tous les autres
			foreach ($donnees as $vote) {

				
				if(isset($tab_pref[$vote['pref']]) AND $tab_pref[$vote['pref']]['busy']==1)
				{

					





					$texte="same_pref/ ".$nb_error." - L'option ".$vote['option_name']." du choix ".$vote['choice_name']." et l'option ".$tab_pref[  $vote['pref'] ]['option_name']." du choix ".$tab_pref[  $vote['pref'] ]['choice_name']." de l'étudiant ".utf8_encode($student['name'])." ont la même preference (".$vote['pref'].")";
							$nb_error++;
							array_push($erreur_meme_pref,$texte);


				}
				else 
				{


					//echo $vote['pref'];
					$tab_pref[$vote['pref']]=array(
						'busy'=>1,
						'choice_name'=>$vote['choice_name'],
						'option_name'=>$vote['option_name']
					);


				}

				//var_dump($tab_pref);


				/*foreach ($donnees as $vote2) {

					if(($vote1['pref']==$vote2['pref'])  AND ($vote1['option_id']!=$vote2['option_id']) )
					{
						

						$position=trim((string)array_search($vote1['option_id'], $tab_pref));

						if($position=="")
						{
							//l'etudiant n'existe pas encore, on l'ajoute
							array_push($tab_pref,$vote2['option_id']);

							$texte="same_pref/ ".$nb_error." - L'option ".$vote1['option_name']." du choix ".$vote1['choice_name']." et l'option ".$vote2['option_name']." du choix ".utf8_encode($vote2['choice_name'])." de l'étudiant ".utf8_encode($student['name'])." ont la même preference (".$vote1['pref'].")";
							$nb_error++;
							array_push($erreur_meme_pref,$texte);

						}

						


					}
				}*/
			}

			//break;
		}






		//IL Y A ERREUR SUR LE BID  DE CHOIX

		$erreur_tout['erreur_doublon']=$erreur_doublon;
		$erreur_tout['erreur_nombre_jeton_etudiant']=$erreur_nombre_jeton_etudiant;
		$erreur_tout['erreur_min_max_consultation']=$erreur_min_max_consultation;
		$erreur_tout['erreur_min_max_choix']=$erreur_min_max_choix;
		$erreur_tout['erreur_meme_pref']=$erreur_meme_pref;
		

		//Format :
		//TypeErr1@TypeErr2@TypeErr3@... 
		//Err1#Err2#Err3#... 
		//id1\id2\...\msg
		$texte="";
		$tab_erreur=array();
		//var_dump($erreur_tout);
		

		foreach ($erreur_tout as $err) 
		{
			//Separation des erreurs

			array_push($tab_erreur,implode("#", $err));

		}


		//ON REGROUPE TOUTE LES ERREUR DANS UN STRING
		$texte=implode("@", $tab_erreur);
		

		echo $texte."@".($nb_error-1);

		

		


		

	

		



		
	










		//il n'y a plus d'erreur de doublon

		


	









?>