<?php

	/**
	* Author 				: IRISA SemLIS
	*Creation date 			: 22/06/2017
	*Last Modification date : 22/06/2017
	*/
	class Level
	{

		
		public $id;
		public $level_name;
		

		function __construct($name)
		{

			$this->id=0;
			$this->level_name=$name;
			
		}
		
		
		function register()
		{
			
			$autorisation=$this->autorise_inscription();


			if($autorisation AND !empty($this->level_name))
			{
				$connexion=DAO::getConnection();


				$requete=$connexion->prepare("
					INSERT INTO year_level (year_level_label) VALUES (:name)
				");
				
				$requete->bindValue(':name', trim($this->level_name), PDO::PARAM_STR);
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
				SELECT * FROM year_level 
				WHERE year_level_label=:name
			");
			
			$requete->bindValue(':name', trim($this->level_name), PDO::PARAM_STR);
			$requete->execute();
			$reponse=$requete->fetch();
			$this->id=$reponse['year_level_id'];
		}




		
		public function autorise_inscription()
		{
			$isAllowed=0;
			$connexion=DAO::getConnection();
			$requete=$connexion->prepare("
				SELECT * FROM year_level WHERE year_level_label=:name
			");
			

			$requete->bindValue(':name', trim($this->level_name), PDO::PARAM_STR);
			$requete->execute();

			if($requete->rowCount()==0 )
			{
				$isAllowed=1;

			}
			
			return $isAllowed;
			
		}


	}




?>