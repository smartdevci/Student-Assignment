<?php

	/**
	* Author 				: IRISA SemLIS
	*Creation date 			: 22/06/2017
	*Last Modification date : 22/06/2017
	*/
	class Year
	{

		
		public $id;
		public $year_name;
		

		function __construct($name)
		{

			$this->id=0;
			$this->year_name=$name;
			
		}
		
		
		function register()
		{
			
			$autorisation=$this->autorise_inscription();


			if($autorisation AND !empty($this->year_name))
			{
				$connexion=DAO::getConnection();


				$requete=$connexion->prepare("
					INSERT INTO academic_year (academic_year_label) VALUES (:name)
				");
				
				$requete->bindValue(':name', trim($this->year_name), PDO::PARAM_STR);
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
				SELECT * FROM academic_year 
				WHERE academic_year_label=:name
			");
			
			$requete->bindValue(':name', trim($this->year_name), PDO::PARAM_STR);
			$requete->execute();
			$reponse=$requete->fetch();
			$this->id=$reponse['academic_year_id'];
		}




		
		public function autorise_inscription()
		{
			$isAllowed=0;
			$connexion=DAO::getConnection();
			$requete=$connexion->prepare("
				SELECT * FROM academic_year WHERE academic_year_label=:name
			");
			

			$requete->bindValue(':name', trim($this->year_name), PDO::PARAM_STR);
			$requete->execute();

			if($requete->rowCount()==0 )
			{
				$isAllowed=1;

			}
			
			return $isAllowed;
			
		}


	}




?>