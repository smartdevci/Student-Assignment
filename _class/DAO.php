<?php


class DAO 
{
	public   $connexion;
	private static  $host="localhost";
	private static  $database_name="student_assignment";
	private static  $user="root";
	private static  $password="";

    const TYPE_ADMIN = 0;
    const TYPE_STUDENT = 1;



    function __construct()
	{
		$this->connexion=new PDO('mysql:host='.DAO::$host.';dbname='.DAO::$database_name, DAO::$user, DAO::$password);
	}

	static function getConnection()
	{
		$connexion=new PDO('mysql:host='.DAO::$host.';dbname='.DAO::$database_name, DAO::$user, DAO::$password);
		return $connexion;
	}




	function getListStudent()
	{
		$requete=$this->connexion->query("SELECT * FROM students WHERE type=1 ORDER BY name");
		return $requete;
	}


	function getListStudentForConsultation($consultation_instance_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * FROM students 
			WHERE student_id IN (SELECT student_id FROM vote WHERE consultation_instance_id=:consultation_instance_id)
			ORDER BY name"
		);

		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;
	}



	function getListSemester()
	{
		$requete=$this->connexion->query("SELECT * FROM semester ORDER BY semester_name");
		return $requete;
	}


	function getListSemesterIHM()
	{
		$html="";
		$data_list=$this->getListSemester();

		while($data=$data_list->fetch())
		{
			$html.='<option value="'.$data['semester_name'].'" > '.$data['semester_name'].'</option>';
		}

		$html.='<option value="Autre" >Autre</option>';
		return $html;
	}



    function getListLevelIHM()
    {
        $html="";
        $requete=$this->connexion->query("SELECT * FROM year_level ORDER BY year_level_label");

        while($reponse=$requete->fetch())
        {
            $html.='<option value="'.$reponse['year_level_label'].'" > '.$reponse['year_level_label'].'</option>';
        }

        return $html;
    }


    function getListUserTypeIHM()
    {
        $html="";
        $requete=$this->connexion->query("SELECT * FROM user_type ORDER BY level DESC");

        while($reponse=$requete->fetch())
        {
            $html.='<option value="'.$reponse['type_id'].'" > '.$reponse['type_label'].'</option>';
        }

        return $html;
    }



    function getListUserIHM()
    {
        $html="";
        $requete=$this->connexion->query(
            "
                    
                          SELECT user_id, name, u.login 
                          FROM user u, admin a
                          WHERE 
                          u.admin_id=a.admin_id 
                          ORDER BY name
                      
         ");

        while($reponse=$requete->fetch())
        {
            $html.='<option value="'.$reponse['user_id']."/".$reponse['name']."/".$reponse['login'].'" > '.$reponse['name'].'</option>';
        }


        return $html;
    }




    function getListOfOptionForChoice($consultation_instance_id,$choice_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * 
			FROM proposedoption p, options o 
			WHERE 
			p.option_id=o.option_id AND 
			consultation_instance_id=:consultation_instance_id AND 
			p.choice_id=:choice_id
		");

		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->bindValue(':choice_id',$choice_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;
	}








	/***********************************************************/
	/****************FUNCTION ABOUT IMPORT**********************/
	/***********************************************************/
	function nextNumberInstanceConsultation()
	{
		$requete=$this->connexion->query("SELECT MAX(instance_id) as max FROM instance");

		if($reponse=$requete->fetch())
		{
			$max=$reponse['max']+1;
		}
		else
		{
			$max=1;
		}
		return $max;
	}




	function getStudentId($login)
	{

		$requete=$this->connexion->prepare("SELECT * FROM students WHERE login=:login");
		$requete->bindValue(':login',$login,PDO::PARAM_INT);
		$requete->execute();

		if($requete->rowCount()!=0)
		{
			$student=$requete->fetch();
			return $student['student_id'];;
		}
		else 
		{
			return 0;
		}

		

	}




	//this function validate data of Moodle vote file in database
	function validateData($consultation_instance_id)
	{

		/*
		Les tables concernés sont :
		academic_year, choice, consultation, instance, options, proposechoice, proposeoption, semester, students,  use_token, vote, year_level
		*/
		$this->validate('academic_year');
		$this->validate('choice');
		$this->validate('consultation');
		$this->validate('instance');
		$this->validate('options');
		$this->validate('proposechoice');
		$this->validate('proposeoption');
		$this->validate('semester');
		$this->validate('students');
		$this->validate('use_token');
		$this->validate('vote');
		//$this->validate('year_level');


		/**SOUSTRACTION DES MISES DE LA CONSULTATION COURANTE**/
		$requete_retrancher_mise=$this->connexion->prepare("
			SELECT student_id,SUM(bids) as bids FROM vote WHERE consultation_instance_id=:consultation_instance_id GROUP BY student_id
		");


		$requete_retrancher_mise->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete_retrancher_mise->execute();


		//ON MET A JOUR LE JETON DE CHAQUE ETUDIANT
		while($mise_a_retrancher=$requete_retrancher_mise->fetch())
		{

			$requete=$this->connexion->prepare("
				UPDATE students 
				SET 
				remaining_token=token_temp-:bid,
				token_temp=0
				WHERE student_id=:student_id
			");


			
			$requete->bindValue(':bid',$mise_a_retrancher['bids'],PDO::PARAM_INT);
			$requete->bindValue(':student_id',$mise_a_retrancher['student_id'],PDO::PARAM_INT);
			$requete->execute();


			$requete_consultation_name=$this->connexion->prepare("
				SELECT * FROM consultation WHERE consultation_id=(SELECT consultation_id FROM instance WHERE instance_id=:consultation_instance_id)
			");

			$requete_consultation_name->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
			$requete_consultation_name->rowCount();
			$requete_consultation_name->execute();
			$reponse_consultation_name=$requete_consultation_name->fetch();
			$consultation_name=$reponse_consultation_name['consultation_name'];


			$use=-1*$mise_a_retrancher['bids'];
			$this->registerUseToken($use, $mise_a_retrancher['student_id'],1,$consultation_name);


		}

		
		
		
	}



	//this function validate data of Moodle vote file in database
	function cancelData()
	{

		/*
		Les tables concernés sont :
		academic_year, choice, consultation, instance, options, proposechoice, proposeoption, semester, students,  use_token, vote, year_level
		*/
		$this->cancel('academic_year');
		$this->cancel('choice');
		$this->cancel('consultation');
		$this->cancel('instance');
		$this->cancel('options');
		$this->cancel('proposechoice');
		$this->cancel('proposeoption');
		$this->cancel('semester');
		$this->cancel('students');
		$this->cancel('use_token');
		$this->cancel('vote');
		//$this->cancel('year_level');

		$requete=$this->connexion->query("
			UPDATE students SET token_temp=0
		");
		
		
	}




	function validate($table)
	{
		$requete=$this->connexion->query("UPDATE ".$table." SET temp=1 WHERE temp=0");
		
	}


	function cancel($table)
	{
		$requete=$this->connexion->query("DELETE FROM ".$table." WHERE temp=0");
		
	}











	/******************VIDEER*******************************/

	//this function validate data of Moodle vote file in database
	function viderData()
	{

		/*
		Les tables concernés sont :
		academic_year, choice, consultation, instance, options, proposechoice, proposeoption, semester, students,  use_token, vote, year_level
		*/
		$this->vider('academic_year');
		$this->vider('assignment');
		$this->vider('assignment_details');
		$this->vider('choice');
		$this->vider('consultation');
		$this->vider('instance');
		$this->vider('options');
		$this->vider('proposechoice');
		$this->vider('proposeoption');
		//$this->vider('semester');
		$this->vider('students');
		$this->vider('use_token');
		$this->vider('vote');
		//$this->cancel('year_level');

		
		
		
	}


	function vider($table)
	{	
		if($table=="students")
		{
			$requete=$this->connexion->query("DELETE FROM ".$table." WHERE type=1");
		}
		else 
		{
			$requete=$this->connexion->query("DELETE FROM ".$table);
		}
		
	}




	function registerUseToken($number_of_token,$student_id,$temp,$reason)
	{
		//echo "DDDDAAAAAANNNNNNNNNNNNSSSSSSSSSSSSSSSSSSS---".$student_id."---------";
		$nb=(string)$number_of_token;

		//echo "c'est.... : /".trim($nb)."/";

		if(trim($nb!="0" AND trim($nb)!=""))
		{

			$requete=$this->connexion->prepare("
				INSERT INTO use_token
				(number, student_id, temp,reason) 
				VALUES 
				(:number, :student_id, :temp, :reason)
			");


			$requete->bindValue(':number',$number_of_token,PDO::PARAM_INT);
			$requete->bindValue(':student_id',$student_id,PDO::PARAM_INT);
			$requete->bindValue(':reason',$reason,PDO::PARAM_STR);
			$requete->bindValue(':temp',$temp,PDO::PARAM_INT);
			$requete->execute();

		}
		

	}








	function registerUseToken_regret_point($number_of_token,$student_id,$temp,$reason)
	{
		//echo "DDDDAAAAAANNNNNNNNNNNNSSSSSSSSSSSSSSSSSSS---".$student_id."---------";
		$nb=(string)$number_of_token;

		if(trim($nb!="0" AND trim($nb)!=""))
		{

			$requete=$this->connexion->prepare("
				INSERT INTO use_token
				(number, student_id, temp,reason,about_token) 
				VALUES 
				(:number, :student_id, :temp, :reason,0)
			");


			$requete->bindValue(':number',$number_of_token,PDO::PARAM_INT);
			$requete->bindValue(':student_id',$student_id,PDO::PARAM_INT);
			$requete->bindValue(':reason',$reason,PDO::PARAM_STR);
			$requete->bindValue(':temp',$temp,PDO::PARAM_INT);
			$requete->execute();

		}
		

	}





























	function getListConsultation()
	{
		$requete=$this->connexion->query("
			SELECT * ,DATE_FORMAT(importation_date,'%d/%m/%Y') as date,DATE_FORMAT(assignment_date,'%d/%m/%Y') as assignment_date
			FROM instance i, consultation c, semester s, academic_year a, year_level y 
			WHERE 
			i.consultation_id=c.consultation_id AND
			i.semester_id=s.semester_id AND 
			i.academic_year_id=a.academic_year_id AND 
			i.year_level_id=y.year_level_id
			ORDER BY importation_date DESC
		");
		return $requete;
	}


	function getConsultation($consultation_instance_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * ,DATE_FORMAT(i.importation_date,'%d/%m/%Y') as date
			FROM instance i, consultation c  
			WHERE 
			c.consultation_id=i.consultation_id AND 
			i.instance_id=:id
		");

		$requete->bindValue(':id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();
		return $requete;
	}



	function getAssignment($consultation_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * ,DATE_FORMAT(i.importation_date,'%d/%m/%Y') as date, DATE_FORMAT(a.assignment_importation_date,'%d/%m/%Y') as date_assignment
			FROM assignment a, instance i, consultation c  
			WHERE 
			a.consultation_instance_id=i.instance_id AND 
			i.consultation_id=c.consultation_id AND
			i.instance_id=:id
		");
		$requete->bindValue(':id',$consultation_id,PDO::PARAM_INT);
		$requete->execute();
		return $requete;
	}



	











	function getListChoice()
	{
		$requete=$this->connexion->query("SELECT * FROM choice ORDER BY choice_name");
		return $requete;
	}


	/**
	*	consultation_id is the id_instance in table instance
	**/
	function getListChoiceForConsultation($consultation_instance_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * 
			FROM choice 
			WHERE choice_id IN (SELECT choice_id FROM proposedchoice WHERE consultation_instance_id=:consultation_instance_id) 
			ORDER BY choice_name
		");
		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();
		return $requete;
	}




	function getListChoiceForConsultation2($consultation_instance_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * 
			FROM choice c, proposedchoice p 
			WHERE c.choice_id=p.choice_id AND 
			consultation_instance_id=:consultation_instance_id
			ORDER BY choice_name
		");

		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();
		return $requete;
	}











	function getListOptionForChoice($choice_id,$consultation_instance_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * FROM options 
			WHERE option_id IN (SELECT option_id FROM proposedoption WHERE choice_id=:choice_id AND consultation_instance_id=:consultation_instance_id )
			ORDER BY option_name
		");
		
		$requete->bindValue(':choice_id',$choice_id,PDO::PARAM_INT);
		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->bindValue(':choice_id',$choice_id,PDO::PARAM_INT);
		$requete->execute();
		return $requete;
	}






	function getListVoteStudent($id)
	{
		//$connexion=
		$requete=$this->connexion->prepare("SELECT * FROM vote WHERE student_id=:student_id");
		$requete->bindValue(':student_id',$id,PDO::PARAM_INT);
		$requete->execute();
		
		return $requete;
	}



	function getListVoteForConsultationOption($student_id,$option_id,$consultation_instance_id)
	{
		//$connexion=
		$requete=$this->connexion->prepare("
			SELECT * 
			FROM vote 
			WHERE 
			student_id=:student_id AND 
			option_id=:option_id AND 
			consultation_instance_id=:consultation_instance_id

		");
		$requete->bindValue(':student_id',$student_id,PDO::PARAM_INT);
		$requete->bindValue(':option_id',$option_id,PDO::PARAM_INT);
		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();
		
		return $requete;
	}



	function getListVote($consultation_instance_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * 
			FROM vote 
			WHERE 
			consultation_instance_id=:consultation_instance_id
		");
		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;
	}



	function getListVoteAllInformation($consultation_instance_id,$student_id)
	{

		$requete=$this->connexion->prepare("
			SELECT * 
			FROM vote v, choice c, options o, students s   
			WHERE 
			v.choice_id=c.choice_id AND 
			v.option_id=o.option_id AND 
			v.student_id=s.student_id AND 
			s.student_id=:student_id AND 
			consultation_instance_id=:consultation_instance_id
		");

		$requete->bindValue(':student_id',$student_id,PDO::PARAM_INT);
		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;
	}


	

	//the list of assignment
	function getListAssignment($consultation_instance_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * 
			FROM assignment_details a, options o, choice c, students s
			WHERE 
			a.choice_id=c.choice_id AND 
			a.student_id=s.student_id AND 
			a.option_id=o.option_id AND 
			assignment_id=(SELECT assignment_id FROM assignment WHERE consultation_instance_id=:consultation_instance_id)
		");

		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();
		return $requete;
	}





	function getVoteStudentForOption($consultation_instance_id,$student_id,$choice_id,$option_id)
	{
		//$connexion=
		$requete=$this->connexion->prepare("
			SELECT * FROM vote 
			WHERE 
			student_id=:student_id AND 
			choice_id=:choice_id AND 
			option_id=:option_id AND 
			consultation_instance_id=:consultation_instance_id
		");

		$requete->bindValue(':student_id',$student_id,PDO::PARAM_INT);
		$requete->bindValue(':choice_id',$choice_id,PDO::PARAM_INT);
		$requete->bindValue(':option_id',$option_id,PDO::PARAM_INT);
		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();

		/*$tab = array(
			'std' =>  $student_id ,
			'choice_id' =>  $choice_id ,
			'option_id' =>  $option_id ,
			'consultation_instance_id' =>  $consultation_instance_id 
		);*/
		//var_dump($tab);
		//echo "Melaine : ".$requete->rowCount();
		
		return $requete;
	}



	function getId($login,$password)
	{
		$requete=$this->connexion->prepare("
          SELECT admin_id as id, 0 as type FROM user WHERE  login=:login AND password=:password
          UNION 
          SELECT student_id as id , type FROM students WHERE  login=:login AND password=:password
        ");


		$requete->bindValue(':login',$login,PDO::PARAM_STR);
		$requete->bindValue(':password',$password,PDO::PARAM_STR);
		$requete->execute();

		if($requete->rowCount()==0)
		{
			return -1;
		}
		else 
		{
			$id=$requete->fetch();
			return $id['type']."/".$id['id'];
		}

		

	}





	function getStudent($id,$type)
	{
        if($type==self::TYPE_STUDENT)
        {
            $requete=$this->connexion->prepare("SELECT * FROM students WHERE student_id=:id");
            $requete->bindValue(':id',$id,PDO::PARAM_INT);
            $requete->execute();

            if($requete->rowCount()!=0)
            {
                $student=$requete->fetch();
                $p=new Student(utf8_encode($student['name']),utf8_encode($student['login']));
                $p->password=$student['password'];
                $p->id=$id;
                $p->password_changed=$student['password_changed'];
                $p->remaining_token=$student['remaining_token'];
                $p->regret_point=$student['regret_point'];
                $p->type=$student['type'];
                $p->extra_case=$student['extra_case'];


                return $p;
            }
            else
            {
                return null;
            }


        }
        elseif ($type==self::TYPE_ADMIN)
        {
            $requete=$this->connexion->prepare("SELECT * FROM admin WHERE admin_id=:id");
            $requete->bindValue(':id',$id,PDO::PARAM_INT);
            $requete->execute();

            if($requete->rowCount()!=0)
            {
                $admin=$requete->fetch();
                $p=new Admin(utf8_encode($admin['name']));
                $p->updateData($id,$admin['type']);
                $p->initNoneAttribute();

                return $p;
            }
            else
            {
                return null;
            }


        }


		

	}




	/********getListAssignmentStudent************/
	function getListAcademicYearForStudent($student_id)
	{

		$requete=$this->connexion->prepare("
			SELECT * 
			FROM assignment_details a, assignment ass, academic_year ay , semester s, choice c, options o , instance i,year_level yl,consultation cons
			WHERE 
			a.academic_year_id=ay.academic_year_id AND 
			a.semester_id=s.semester_id AND 
			a.choice_id=c.choice_id AND 
			a.option_id=o.option_id AND 
			a.assignment_id=ass.assignment_id AND
			ass.consultation_instance_id=i.instance_id AND 
			i.year_level_id=yl.year_level_id AND 
			i.consultation_id=cons.consultation_id AND 
 			a.student_id=:student_id"
		);

		$requete->bindValue(':student_id',$student_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;
		

	}





	function getListAssignmentForStudentDuringYear($student_id,$academic_year_id)
	{

		$requete=$this->connexion->prepare("
			SELECT * 
			FROM assignment_details a, options o, choice c
			WHERE 
			a.choice_id=c.choice_id AND 
			a.option_id=o.option_id AND 
			a.academic_year_id=:academic_year_id AND 
			student_id=:student_id
		");

		$requete->bindValue(':student_id',$student_id,PDO::PARAM_INT);
		$requete->bindValue(':academic_year_id',$academic_year_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;
	}



	function getWalletUse($student_id)
	{

		$requete=$this->connexion->prepare("
			SELECT * , DATE_FORMAT(update_date,'%d/%m/%Y ') as date
			FROM use_token
			WHERE 
			student_id=:student_id
			ORDER BY update_date 
		");

		$requete->bindValue(':student_id',$student_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;

	}









	/*******************************RESULT*******************************/
	function getListAssignmentStudentChoice($consultation_instance_id,$student_id,$choice_id)
	{


		$requete=$this->connexion->prepare("
			SELECT *
			FROM assignment_details a, options o
			WHERE 
			a.option_id=o.option_id AND
			assignment_id=(SELECT assignment_id FROM assignment WHERE consultation_instance_id=:consultation_instance_id) AND 
			student_id=:student_id AND 
			a.choice_id=:choice_id
		");


		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->bindValue(':student_id',$student_id,PDO::PARAM_INT);
		$requete->bindValue(':choice_id',$choice_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;
	}



	function getListChoiceForAssignment($consultation_instance_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * FROM choice WHERE choice_id IN 
			(
				SELECT DISTINCT choice_id
				FROM assignment_details 
				WHERE assignment_id=(SELECT assignment_id FROM assignment WHERE consultation_instance_id=:consultation_instance_id)
			)
		");


		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;


	}



	function getListStudentsForAssignment($consultation_instance_id)
	{
		$requete=$this->connexion->prepare("
			SELECT * FROM students WHERE student_id IN 
			(
				SELECT DISTINCT student_id
				FROM assignment_details 
				WHERE assignment_id=(SELECT assignment_id FROM assignment WHERE consultation_instance_id=:consultation_instance_id)
			)
		");


		$requete->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete->execute();

		return $requete;


	}




	function hasResultAssignment($consultation_instance_id)
	{
		$requete_update=$this->connexion->prepare("
			UPDATE assignment 
			SET result_file = 1
			WHERE consultation_instance_id=:consultation_instance_id
		");

		$requete_update->bindValue(':consultation_instance_id',$consultation_instance_id,PDO::PARAM_INT);
		$requete_update->execute();

		return $requete;
	}







}