<?php

	/**
	* Author 				: IRISA SemLIS
	*Creation date 			: 22/06/2017
	*Last Modification date : 22/06/2017
	*/
	class Vote
	{

		
		public $id;
		public $bids;
		public $argument1;
		public $argument2;
		public $argument3;
		public $student_id;
		public $option_id;
		public $consultation_id;
		public $pref;
		

		function __construct(
							$bids,
							$argument1,
							$argument2,
							$argument3,
							$student_id,
							$option_id,
							$choice_id,
							$consultation_id,
							$pref

			)
		{


			$this->bids=$bids;
			$this->argument1=$argument1;
			$this->argument2=$argument2;
			$this->argument3=$argument3;
			$this->student_id=$student_id;
			$this->option_id=$option_id;
			$this->consultation_id=$consultation_id;
			$this->choice_id=$choice_id;
			$this->id=0;
			$this->pref=$pref;
			
			
		}
		
		
		function register()
		{
			
			$connexion=DAO::getConnection();

				$check_exist=$connexion->prepare("
					SELECT * FROM vote 
					WHERE 
					student_id=:student_id AND 
					choice_id=:choice_id AND 
					option_id=:option_id AND 
					consultation_instance_id=:consultation_instance_id
				");


				$check_exist->bindValue(':student_id', $this->student_id, PDO::PARAM_INT);
				$check_exist->bindValue(':choice_id', $this->choice_id, PDO::PARAM_INT);
				$check_exist->bindValue(':option_id', $this->option_id, PDO::PARAM_INT);
				$check_exist->bindValue(':consultation_instance_id', $this->consultation_id, PDO::PARAM_INT);
				$check_exist->execute();





				if($check_exist->rowCount()==0)
				{
						//LE VOTE N'EXISTE PAS ENCORE, ON L'AJOUTE DONC

						$requete=$connexion->prepare("
							INSERT INTO vote (bids,argument1, argument2, argument3, student_id, choice_id, option_id, consultation_instance_id,pref) 
							VALUES 
							(
								:bids,
								:argument1, 
								:argument2, 
								:argument3, 
								:student_id, 
								:choice_id, 
								:option_id, 
								:consultation_id,
								:pref
							) 
							
						");
						
						$requete->bindValue(':bids', $this->bids, PDO::PARAM_INT);
						$requete->bindValue(':argument1', $this->argument1, PDO::PARAM_STR);
						$requete->bindValue(':argument2', $this->argument2, PDO::PARAM_STR);
						$requete->bindValue(':argument3', $this->argument3, PDO::PARAM_STR);
						$requete->bindValue(':student_id', $this->student_id, PDO::PARAM_INT);
						$requete->bindValue(':choice_id', $this->choice_id, PDO::PARAM_INT);
						$requete->bindValue(':option_id', $this->option_id, PDO::PARAM_INT);
						$requete->bindValue(':consultation_id', $this->consultation_id, PDO::PARAM_INT);
						$requete->bindValue(':pref', $this->pref, PDO::PARAM_INT);
						$requete->execute();


				}
				else 
				{

						//LE VOTE EXISTE DEJA, ON LE MET A JOUR

						$requete=$connexion->prepare("
							UPDATE vote  
							SET 
							bids=:bids,
							argument1=:argument1, 
							argument2=:argument2, 
							argument3=:argument3, 
							pref=:pref
							WHERE 
							student_id=:student_id, 
							choice_id=:choice_id, 
							option_id=:option_id, 
							consultation_instance_id=:consultation_id
						");
						
						$requete->bindValue(':bids', $this->bids, PDO::PARAM_INT);
						$requete->bindValue(':argument1', $this->argument1, PDO::PARAM_STR);
						$requete->bindValue(':argument2', $this->argument2, PDO::PARAM_STR);
						$requete->bindValue(':argument3', $this->argument3, PDO::PARAM_STR);
						$requete->bindValue(':student_id', $this->student_id, PDO::PARAM_INT);
						$requete->bindValue(':choice_id', $this->choice_id, PDO::PARAM_INT);
						$requete->bindValue(':option_id', $this->option_id, PDO::PARAM_INT);
						$requete->bindValue(':consultation_id', $this->consultation_id, PDO::PARAM_INT);
						$requete->bindValue(':pref', $this->pref, PDO::PARAM_INT);
						$requete->execute();


				}

				

				//$this->id=$requete->last_insert_id();	
			

			return $this->id;
			
		}



	}




?>