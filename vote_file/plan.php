<?php 

echo (empty(strpos("element",'m')))?'/':'-';
$contenu=file_get_contents("vote.csv");
			//echo $contenu;

			$contenus=explode("\n",$contenu); //we are the count of line in the variable $contenus

			echo "Nombre de Ligne :".sizeof($contenus)."#<hr/>";

			
			
			$i=1;
			//print_r($contenus);
			//echo 'yesssss';
			$colonnes=explode("\t",$contenus[0]);

			foreach ($colonnes as $col) {

				echo "<br/>".$i." - ".$col;
				$i++;
			}
$i=1;
			echo "<hr/>";
$colonnes=explode("\t",$contenus[1]);

			foreach ($colonnes as $col) {

				echo "<br/>".$i." - ".$col;
				$i++;
			}

			//echo sizeof($contenu);
			//$content_student = array(); //the data about a student

			//print_r($contenus[0]);

			/*foreach ($contenus as $ligne) {
				

				if($i==0)
				{

				}
				else 
				{

					$colonnes=explode("\t", $ligne);
					if(sizeof($colonnes)!=1)
					{


						$login=$colonnes[6];
						$names=explode("(",$colonnes[7]); //there is parenthesis in the value of name, so we must recover the name only
						$name=$names[0];
						//echo "#.##".$name."###";
						$student=new Student($name,$login);
						$password=$student->password;
						//echo $name;
	
						
						
						$consultation_name=utf8_decode($colonnes[4]);
						$consultation=new Consultation($consultation_name);
						
						$consultation_id=$consultation->register();

						
					}
					

				



				}
				
				$i++;
			}*/


			?>