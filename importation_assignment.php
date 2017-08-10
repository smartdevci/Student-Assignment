<?php
		


session_start();
		include 'all_class.php';

		$connexion=DAO::getConnection();

		$erreur_fichier_non_correspond_consultation=array();
		$erreur_fichier_non_correspond_consultation['code']=0;
		$erreur_fichier_non_correspond_consultation['message_error']="Importation des données reussi";

		

		print_r($_POST);
		print_r($_FILES);
		

		//UPLOAD DU FICHIER VOTE
		if(isset($_FILES['fichier']) )
		{ 

			$consultation_instance_id_post=$_POST['consultation_instance_id'];
		
			
			$extension_tab=explode(".",$_FILES['fichier']['name']);
			$extension=strrchr($_FILES['fichier']['name'], '.');
			echo $extension;
			if(in_array($extension,$extensions_autorise = array('.csv')))
			{
				echo " extension CSV";
				$dossier = 'assignment/';
			     //$fichier = basename($_FILES['fichier']['name']);

			     $chemin_relatif=$dossier."assignment".$consultation_instance_id_post.$extension;

			     if(move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin_relatif)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			     {
			          echo 'Upload effectué avec succès !';
			     }
			     else //Sinon (la fonction renvoie FALSE).
			     {
			          echo 'Echec de l\'upload !';
			     }
			}

			echo "<hr/>";



			//$connexion=new DAO();
			



			$contenu=file_get_contents($chemin_relatif);
			//echo $contenu;

			$contenus=explode("\n",$contenu); //we are the count of line in the variable $contenus

			echo "Nombre de Ligne :".sizeof($contenus)."#<hr/>";

			
			
			$i=0;
			
			
			foreach ($contenus as $ligne) {
				
				$i++;
				
				
					$colonnes=explode(";", $ligne);
					if(sizeof($colonnes)!=1)
					{

						

						
						
							

						

								$consultation_instance_id=$colonnes[0];
								$student_id=$colonnes[1]; 
								$option_id=$colonnes[2];
								$choice_id=$colonnes[3];
						
								if($i==1 && $consultation_instance_id!=$consultation_instance_id_post)
								{
										echo  'ici';
										$erreur_fichier_non_correspond_consultation['code']=1;
										$erreur_fichier_non_correspond_consultation['message_error']="Fichier non conforme";
										break;
										
								}
								



								if($i==1)
								{

									$requete_insert_assignment=$connexion->prepare("
											INSERT INTO assignment(consultation_instance_id) VALUES (:consultation_instance_id)
									");

									$requete_insert_assignment->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
									$requete_insert_assignment->execute();

									$assignment_id=$connexion->lastInsertId();



									$requete_update_date_in_consultation=$connexion->prepare("
											UPDATE instance 
											SET 
											assignment_date=(SELECT assignment_importation_date FROM assignment WHERE assignment_id=:assignment_id),
											resultat=1
											WHERE instance_id=:instance_id
									");

									$requete_update_date_in_consultation->bindValue(':assignment_id',$assignment_id,PDO::PARAM_INT);
									$requete_update_date_in_consultation->bindValue(':instance_id',$consultation_instance_id,PDO::PARAM_INT);
									$requete_update_date_in_consultation->execute();


								}


								

								


								$requete=$connexion->prepare("
									SELECT * 
									FROM instance i 
									WHERE 
									instance_id=:consultation_instance_id
								");



								$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
								$requete->execute();
								$reponse_query=$requete->fetch();

								$semester_id=$reponse_query['semester_id'];
								$academic_year_id=$reponse_query['academic_year_id'];

								echo $semester_id."€".$academic_year_id."<hr/>";

								$insert_query=$connexion->prepare("
									INSERT INTO assignment_details(student_id, option_id, choice_id, semester_id, academic_year_id, reason, assignment_id) 
									VALUES (:student_id, :option_id, :choice_id, :semester_id, :academic_year_id, :reason, :assignment_id)
								");

								$insert_query->bindValue(':student_id',$student_id,PDO::PARAM_INT); 
								$insert_query->bindValue(':option_id',$option_id,PDO::PARAM_INT);
								$insert_query->bindValue(':choice_id',$choice_id,PDO::PARAM_INT);
								$insert_query->bindValue(':semester_id',$semester_id,PDO::PARAM_INT);
								$insert_query->bindValue(':academic_year_id',$academic_year_id,PDO::PARAM_INT);
								$insert_query->bindValue(':reason',"",PDO::PARAM_STR);
								$insert_query->bindValue(':assignment_id',$assignment_id,PDO::PARAM_INT);
								$insert_query->execute();

								$tab = array(
									'student_id' =>$student_id , 
									'option_id' =>$option_id , 
									'choice_id' =>$choice_id , 
									'semester_id' =>$semester_id , 
									'academic_year_id' =>$academic_year_id , 
									'reason' =>"" , 
									'assignment_id' =>$assignment_id,
									'instance_id' =>$consultation_instance_id
								);
						
					



				}
					

				



				
				
				
				//echo "<hr/>";
				$i++;
			}
			
		    
		}


		var_dump($erreur_fichier_non_correspond_consultation);
		$_SESSION['erreur_fichier_non_correspond_consultation']=$erreur_fichier_non_correspond_consultation;

		header('Location:consultations.php');

		

?>