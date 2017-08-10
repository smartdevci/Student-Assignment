<?php

	/**
	* Author 				: IRISA SemLIS
	*Creation date 			: 22/06/2017
	*Last Modification date : 22/06/2017
	*/
	class Option
	{

		
		public $id;
		public $name;
		public $description;
		public $choice_id;

		public $argument1;
		public $argument2;
		public $argument3;
		

		function __construct($name)
		{

			$this->id=0;
			$this->name=$name;
			$this->choice_id=0;
			
		}
		
		
		function register()
		{
			
			$autorisation=$this->autorise_inscription();


			if($autorisation AND !empty($this->name))
			{
				$connexion=DAO::getConnection();


				$requete=$connexion->prepare("
					INSERT INTO options (option_name) VALUES (:name)
				");
				
				$requete->bindValue(':name', trim(htmlspecialchars($this->name)), PDO::PARAM_STR);
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
				SELECT * FROM options 
				WHERE option_name=:name
			");
			
			$requete->bindValue(':name', trim($this->name), PDO::PARAM_STR);
			$requete->execute();
			$reponse=$requete->fetch();
			$this->id=$reponse['option_id'];
		}




		
		public function autorise_inscription()
		{
			$isAllowed=0;
			$connexion=DAO::getConnection();
			$requete=$connexion->prepare("
				SELECT * FROM options WHERE option_name=:name
			");
			

			$requete->bindValue(':name', trim($this->name), PDO::PARAM_STR);
			$requete->execute();

			if($requete->rowCount()==0 )
			{
				$isAllowed=1;

			}
			
			return $isAllowed;
			
		}




		public function registerChoiceForConsultation($consultation_instance_id)
		{
			$connexion=DAO::getConnection();

			$check_if_already_exist=$connexion->prepare("
				SELECT * 
				FROM proposedoption 
				WHERE 
				consultation_instance_id=:consultation_instance_id AND 
				choice_id=:choice_id AND 
				option_id=:option_id
			");

			$check_if_already_exist->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
			$check_if_already_exist->bindValue(':choice_id',$this->choice_id,PDO::PARAM_INT);
			$check_if_already_exist->bindValue(':option_id',$this->id,PDO::PARAM_INT);
			$check_if_already_exist->execute();

			
			if($check_if_already_exist->rowCount()==0)
			{ 
				$requete=$connexion->prepare("
					INSERT INTO proposedoption
					(choice_id, option_id, consultation_instance_id) 
					VALUES 
					(:choice_id, :option_id, :consultation_instance_id) 
				");


				$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
				$requete->bindValue(':choice_id',$this->choice_id,PDO::PARAM_INT);
				$requete->bindValue(':option_id',$this->id,PDO::PARAM_INT);
				$requete->execute();
			}

			

		}





	}




?>