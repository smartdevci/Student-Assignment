<?php

	/**
	* Author 				: IRISA SemLIS
	*Creation date 			: 12/05/2017
	*Last Modification date : 12/05/2017
	*/
	class Consultation
	{

		
		public $id;
		public $name;
		

		function __construct($name)
		{

			$this->id=0;
			$this->name=$name;
			
		}
		
		
		function register()
		{
			

			$autorisation=$this->autorise_inscription();

			if($autorisation AND !empty($this->name))
			{
				$connexion=DAO::getConnection();


				$requete=$connexion->prepare("
					INSERT INTO Consultation (consultation_name) VALUES (:name)
				");
				
				$requete->bindValue(':name', htmlspecialchars($this->name), PDO::PARAM_STR);
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
				SELECT * FROM consultation 
				WHERE consultation_name=:name
			");
			
			$requete->bindValue(':name', $this->name, PDO::PARAM_STR);
			$requete->execute();
			$reponse=$requete->fetch();
			$this->id=$reponse['consultation_id'];

			//$this->id=0;

			
			
		}




		
		public function autorise_inscription()
		{
			$isAllowed=0;
			$connexion=DAO::getConnection();
			$requete=$connexion->prepare("
				SELECT * FROM consultation WHERE consultation_name=:name
			");
			

			$requete->bindValue(':name', $this->name, PDO::PARAM_STR);
			$requete->execute();

			if($requete->rowCount()==0 )
			{
				$isAllowed=1;

			}
			
			return $isAllowed;
			
		}


	}




?>