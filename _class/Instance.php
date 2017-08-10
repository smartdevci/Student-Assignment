<?php

	/**
	* Author 				: IRISA SemLIS
	*Creation date 			: 22/06/2017
	*Last Modification date : 22/06/2017
	*/
	class Instance
	{

		
		public $id;
		public $min_bid;
		public $max_bid;
		public $semester_id;
		public $consultation_id;
		public $academic_year;
		public $year_level_id;
		public $source_data_file;
		

		function __construct($min_bid,$max_bid,$semester_id,$consultation_id,$academic_year,$year_level_id,$source_data_file)
		{

			$this->id=0;
			$this->min_bid=$min_bid;
			$this->max_bid=$max_bid;
			$this->semester_id=$semester_id;
			$this->consultation_id=$consultation_id;
			$this->academic_year=$academic_year;
			$this->year_level_id=$year_level_id;
			$this->source_data_file=$source_data_file;
			
		}
		
		
		function register()
		{
			
			$connexion=DAO::getConnection();


			$requete=$connexion->prepare("
					INSERT INTO instance
					(min_bid, max_bid, semester_id, consultation_id, academic_year_id, year_level_id, importation_date, source_data_file) 
					VALUES 
					(:min_bid,:max_bid,:semester_id,:consultation_id,:academic_year_id,:year_level_id,NOW(),:source_data_file)
			");
				
			$requete->bindValue(':min_bid', trim($this->min_bid), PDO::PARAM_INT);
			$requete->bindValue(':max_bid', trim($this->max_bid), PDO::PARAM_INT);
			$requete->bindValue(':semester_id', trim($this->semester_id), PDO::PARAM_INT);
			$requete->bindValue(':consultation_id', trim($this->consultation_id), PDO::PARAM_INT);
			$requete->bindValue(':academic_year_id', trim($this->academic_year), PDO::PARAM_INT);
			$requete->bindValue(':year_level_id', trim($this->year_level_id), PDO::PARAM_INT);
			$requete->bindValue(':source_data_file', trim($this->source_data_file), PDO::PARAM_STR);
			$requete->execute();


			$this->id=$connexion->lastInsertId();
			return $this->id;
			
		}
		


	}




?>