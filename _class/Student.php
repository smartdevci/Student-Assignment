<?php

	/**
	* Author 				: IRISA SemLIS
	*Creation date 			: 12/05/2017
	*Last Modification date : 03/06/2017
	*/
	class Student
	{

		
		public $id;
		public $name;
		public $login;
		public $password;
		public $date_inscription;
		public $remaining_token;
		public $regret_point;
		public $password_changed;
		public $type;
		public $extra_case;
		

		function __construct($name,$login)
		{

			$this->id=0;
			$this->name=$name;
			$this->login=$login;
			$this->producePassword();
			$this->date_inscription="12/05/2017";
			$this->remaining_token=0;
			$this->regret_point=0;
			$this->password_changed=0;
			$this->type=0;
			$this->extra_case=0;
		}
		
		
		function register()
		{
			

			$autorisation=$this->autorise_inscription();

			//if($autorisation AND !empty($this->name))
			if(!empty($this->name))
			{
				$connexion=DAO::getConnection();

				$requete=$connexion->prepare("SELECT * FROM students WHERE login=:login");
				$requete->bindValue(':login', $this->login, PDO::PARAM_STR);
				$requete->execute();

				
				if($requete->rowCount()==0)
				{
					//echo "***1*********".$this->login."*****".$this->remaining_token."******";
					

					//S'IL EXISTE DEJA DANS LA BASE DE DONNEES
					$requete=$connexion->prepare("
					INSERT INTO students (name,login,password,remaining_token,token_temp) VALUES (:name,:login,:password,:remaining_token,:token_temp)
					");
					
					$requete->bindValue(':name', utf8_decode($this->name), PDO::PARAM_STR);
					$requete->bindValue(':login', $this->login, PDO::PARAM_STR);
					$requete->bindValue(':password', $this->password, PDO::PARAM_STR);
					$requete->bindValue(':remaining_token', 0, PDO::PARAM_STR);
					$requete->bindValue(':token_temp', $this->remaining_token, PDO::PARAM_STR);
					$requete->execute();
				}
				else
				{
					$requete=$connexion->prepare("
						UPDATE students SET token_temp=remaining_token+:token_add WHERE login=:login
					");

					
					$requete->bindValue(':login', $this->login, PDO::PARAM_STR);
					$requete->bindValue(':token_add', $this->remaining_token, PDO::PARAM_INT);
					$requete->execute();
					
						
				}
				

				
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
					SELECT * FROM students 
					WHERE login=:login
			");
			
			$requete->bindValue(':login', $this->login, PDO::PARAM_STR);
			$requete->execute();

			$reponse=$requete->fetch();
			$this->id=$reponse['student_id'];
			
		}




		
		public function autorise_inscription()
		{
			$isAllowed=0;
			$connexion=DAO::getConnection();
			$requete=$connexion->prepare("
				SELECT * FROM students WHERE login=:login
			");



			$requete->bindValue(':login', $this->login, PDO::PARAM_STR);
			$requete->execute();

			
			if($requete->rowCount()==0 )
			{
				$isAllowed=1;

			}
			
			return $isAllowed;
			
		}




        public function producePassword()
        {


            $letters="ABCDEFGHIJKLMNOPQRSTUVWXYZ_-@!abcdefghijklmnopqrstuvwxyz0123456789";
            $password="";

            for($i=0;$i<10;$i++)
            {

                $nb=rand(0,strlen($letters)-1);
                $password.=$letters[$nb];

            }

            $this->password=$password;

            //echo strlen($letters)."/".$password;

        }


        public static function resetPassword()
        {


            $letters="ABCDEFGHIJKLMNOPQRSTUVWXYZ_-@!abcdefghijklmnopqrstuvwxyz0123456789";
            $password="";

            for($i=0;$i<10;$i++)
            {

                $nb=rand(0,strlen($letters)-1);
                $password.=$letters[$nb];

            }

           return $password;
        }

	}




?>