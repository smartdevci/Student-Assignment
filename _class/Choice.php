<?php

	/**
	* Author 				: IRISA SemLIS
	*Creation date 			: 22/06/2017
	*Last Modification date : 22/06/2017
	*/
	class Choice
	{

		
		public $id;
		public $choice_name;
		public $min_bid;
		public $max_bid;

		
		

		function __construct($name)
		{

			$this->id=0;
			$this->choice_name=$name;
			$this->min_bid=0;
			$this->max_bid=100;
			
		}
		
		
		function register()
		{
			
			$autorisation=$this->autorise_inscription();


			if($autorisation AND !empty($this->choice_name))
			{
				$connexion=DAO::getConnection();


				$requete=$connexion->prepare("
					INSERT INTO choice (choice_name) VALUES (:name)
				");
				
				$requete->bindValue(':name', trim(htmlspecialchars($this->choice_name)), PDO::PARAM_STR);
				/*$requete->bindValue(':min', trim($this->min_bid), PDO::PARAM_INT);
				$requete->bindValue(':max', trim($this->max_bid), PDO::PARAM_INT);*/
				$requete->execute();


					
			}

			$this->getId();
			return $this->id;
			
		}




		/*
		*This function recover the unknown parameters of $this
		*The rank and Id
		*/
		function getId()
		{
			$connexion=DAO::getConnection();
			$requete=$connexion->prepare("
				SELECT * FROM choice 
				WHERE choice_name=:name
			");
			
			$requete->bindValue(':name', trim($this->choice_name), PDO::PARAM_STR);
			$requete->execute();
			$reponse=$requete->fetch();
			$this->id=$reponse['choice_id'];
		}




		
		public function autorise_inscription()
		{
			$isAllowed=0;
			$connexion=DAO::getConnection();
			$requete=$connexion->prepare("
				SELECT * FROM choice WHERE choice_name=:name
			");
			

			$requete->bindValue(':name', trim($this->choice_name), PDO::PARAM_STR);
			$requete->execute();

			if($requete->rowCount()==0 )
			{
				$isAllowed=1;

			}
			
			return $isAllowed;
			
		}






		public function registerChoiceForConsultation($consultation_instance_id,$min_bid,$max_bid)
		{
			$connexion=DAO::getConnection();

			$check_if_already_exist=$connexion->prepare("
				SELECT * 
				FROM proposedchoice 
				WHERE 
				consultation_instance_id=:consultation_instance_id AND 
				choice_id=:choice_id
			");

			$check_if_already_exist->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
			$check_if_already_exist->bindValue(':choice_id',$this->id,PDO::PARAM_INT);
			$check_if_already_exist->execute();

			
			if($check_if_already_exist->rowCount()==0)
			{ 
				$requete=$connexion->prepare("
					INSERT INTO proposedchoice
					(choice_id, consultation_instance_id,min_bid,max_bid) 
					VALUES 
					(:choice_id, :consultation_instance_id,:min_bid,:max_bid) 
				");


				$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
				$requete->bindValue(':choice_id',$this->id,PDO::PARAM_INT);
				$requete->bindValue(':min_bid',$min_bid,PDO::PARAM_INT);
				$requete->bindValue(':max_bid',$max_bid,PDO::PARAM_INT);
				$requete->execute();
			}

			

		}


	}




?>