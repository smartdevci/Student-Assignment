<?php
		//var_dump($_POST);


		
		$academic_year=$_POST['academic_year'];
		$semester_name=($_POST['semester']!='Autre')?$_POST['semester']:$_POST['nouveau_semestre'];
		$year_level=$_POST['level'];
		$min_bid=$_POST['min_bid'];
		$max_bid=$_POST['max_bid'];
		$source_data_file=$_POST['consultation_name'];
		$consultation_name=$_POST['consultation_name'];
		$jeton_a_ajouter=$_POST['nombre_jeton_purse'];


		$consultation=new Consultation($consultation_name);
		$consultation->register();
		$consultation_id=$consultation->id;
		

		$semester=new Semester($semester_name);
		$semester->register();

		$level=new Level($year_level);
		$level->register();

		$year=new Year($academic_year);
		$year->register();

		







		$list_number_Option = array();



					

		//$p=new Student("Meco","4521");
		//$p->register();
		$contenu_fichier_login_password = array();


		//print_r($_POST);
		//print_r($_FILES);
		

		//UPLOAD DU FICHIER VOTE
		if(isset($_FILES['fichier']) )
		{ 
			//$line_separator=$_POST['line_separator'];
			//$colonne_separator=$_POST['column_separator'];

			$extension_tab=explode(".",$_FILES['fichier']['name']);
			$extension=strrchr($_FILES['fichier']['name'], '.');
			//echo $extension;
			if(in_array($extension,$extensions_autorise = array('.csv')))
			{
				//echo " extension CSV";
				$dossier = 'vote_file/';

			     //$fichier = basename($_FILES['fichier']['name']);

				 $number_of_consultation=$connexion->nextNumberInstanceConsultation();
			     $chemin_relatif=$dossier."vote".$number_of_consultation.$extension;
			     $source_data_file="vote".$number_of_consultation.$extension;

			     if(move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin_relatif)) //Si la fonction renvoie TRUE, c'est que le telechargement du fichier a reussi...
			     {
			     ?>
			     	<div class="alert alert-success">
					  <strong>Fichier importé avec succès </strong> 
					</div>

			     <?php    
			     }
			     else //Sinon (la fonction renvoie FALSE).
			     {
			          echo 'Echec de l\'upload !';
			     }
			}

			




			$instance=new Instance($min_bid,$max_bid,$semester->id,$consultation_id,$year->id,$level->id,$source_data_file);
			$instance->register();
			$consultation_instance_id=$instance->id;


			



			$contenu=file_get_contents($chemin_relatif);
		//	echo $contenu;

			$contenus=explode("\n",$contenu); //we are the count of line in the variable $contenus
			
			//var_dump($contenus);

			
			
			
			$i=0;
			

			foreach ($contenus as $ligne) {
				

				if($i==0)
				{
					$colonnes=explode("\t", $ligne);

						/******STRUCTURE********/
						$list_choice = array();
						$list_option = array();
						$list_bid = array();
						$list_argument = array();
						$list_preference = array();
						$general_information=array();



						/*********DATA*************/
						$list_student_data = array();
						$list_vote_data=array( array() );


						/****GENERAL INFORMATION ABOUT STUDENT*****/
						$general_information['reponse_number']=0;
						$general_information['reponse_date']=1;
						$general_information['institution']=2;
						$general_information['department']=3;
						$general_information['course']=4;
						$general_information['group']=5;
						$general_information['id']=6;
						$general_information['name']=7;
						$general_information['user_name']=8;
						$general_information['email']=9;







						for($i=10;$i<sizeof($colonnes);$i++)
						{
							$column_name=$colonnes[$i];
							$decoupage_tab=explode("_", $column_name);
							//echo " longueur : ".sizeof($decoupage_tab)." i = ".$i."-------".$colonnes[$i]."<hr/>";
							$texte_a_analyser=$decoupage_tab[1];



							$decoupage_tab2=explode("->", $texte_a_analyser);




							if(sizeof($decoupage_tab2)>=2)
							{
								//il ne s'agit pas des Debrief
								$type=$decoupage_tab2[0];
								$choice_name=$decoupage_tab2[1];
								$option_name=$decoupage_tab2[2];

								if(strtolower($type)=="mise")
								{
									$list_bid[$option_name]=$i;


									/****************CHOIICE**********************/
									$choix=new Choice($choice_name);
									$choix->register();
									$choix->registerChoiceForConsultation($instance->id,0,$max_bid);

									$new_choice=array(
											'choice_id'=>$choix->id,
											'choice_name'=>$choix->choice_name
									);

									$position_choice=trim((string)array_search($new_choice, $list_choice));

									if($position_choice=="")
									{
										//l'etudiant n'existe pas encore, on l'ajoute
										array_push($list_choice,$new_choice);

									}

									/*************END CHOICE*************************/

									


									/******Enregistrement des choix************/
									/*foreach ($list_choice as $choice) {
										$choix=new Choice($choice['choice_name']);
										var_dump($choice);
										$choice['choice_id']=$choix->register();
										var_dump($choice);
									}*/


									/***************************************************/
									$option=new Option(trim($option_name));
									$option->register();

									$option->choice_id=$choix->id;
									$option->registerChoiceForConsultation($instance->id);

									array_push($list_option,$option);

								}
								else if(strtolower($type)=="arg1" || strtolower($type)=="arg2" || strtolower($type)=="arg3")
								{
									$list_argument[$option_name][$type]=$i;
								}
								else if(strtolower($type)=="pref")
								{
									$list_preference[$option_name]=$i;
								}

							}
							

							
						}


						



						
				}
				else 
				{

					/*********Definition of data************/

					$colonnes=explode("\t", $ligne);
					if(sizeof($colonnes)!=1)
					{

						//echo "cours : ".$colonnes[4]."/";
					
						//$list_vote_data[]
						


						$login=$colonnes[ $general_information['id'] ];
						$names=explode("(",$colonnes[ $general_information['name'] ]); //there is parenthesis in the value of name, so we must recover the name only
						$name=$names[0];


						$student_add=new Student(trim($name),$login);
						$student_add->remaining_token=$jeton_a_ajouter;
						$student_add->remaining_token=$jeton_a_ajouter;
						$student_add->register();


						$new_student=array(
							'student_id'=>$student_add->id,
							'name'=>$student_add->name,
							'login'=>$student_add->login
						);


						$position_student=trim((string)array_search($new_student, $list_student_data));

						if($position_student=="")
						{
							//l'etudiant n'existe pas encore, on l'ajoute
							array_push($list_student_data,$new_student);

							$connexion->registerUseToken($student_add->remaining_token, $student_add->id,0,$consultation_name);


						}
						
						
						$student=new Student($name,$login);
						$password=$student->password;
						
						$nom_sans_accent=str_replace("é","e",$name);
						$nom_sans_accent=str_replace("è","e",$nom_sans_accent);
						$nom_sans_accent=str_replace("ê","e",$nom_sans_accent);
						$nom_sans_accent=str_replace("à","a",$nom_sans_accent);
						$nom_sans_accent=str_replace("â","a",$nom_sans_accent);
						$nom_sans_accent=str_replace("ô","o",$nom_sans_accent);
						$nom_sans_accent=str_replace("î","i",$nom_sans_accent);
						$nom_sans_accent=str_replace("û","u",$nom_sans_accent);
						
						$contenu_fichier_login_password[$nom_sans_accent]= array('login' => $login, 'password'=>$password );

						

						

						/************************************************/
						/**********LES ARGUMENTS*************************/
						/************************************************/

						foreach ($list_option as $option) {

							$choice_id=$option->choice_id;
							$option_id=$option->id;
							$argument1=$colonnes[ $list_argument[$option->name]['Arg1'] ];
							$argument2=$colonnes[ $list_argument[$option->name]['Arg2'] ];
							$argument3=$colonnes[ $list_argument[$option->name]['Arg3'] ];
							$bid=$colonnes[ $list_bid[ $option->name ] ];
							$pref=$colonnes[ $list_preference [ $option->name ] ];



							$vote=new Vote(
								$bid,
								$argument1,
								$argument2,
								$argument3,
								$student_add->id,
								$option_id,
								$choice_id,
								$instance->id,
								$pref

								
							);

							$vote->register();

							$list_vote_data[ $option->name ][$student_add->id]['bid']=$bid;
							$list_vote_data[ $option->name ][$student_add->id]['pref']=$pref;
							$list_vote_data[ $option->name ][$student_add->id]['arg1']=$argument1;
							$list_vote_data[ $option->name ][$student_add->id]['arg2']=$argument2;
							$list_vote_data[ $option->name ][$student_add->id]['arg3']=$argument3;

							

						}

						
					}
					

				



				}
				
				
				$i++;
			}

			

			//Creating file of login/password
			$texte_json=json_encode($contenu_fichier_login_password);
			$texte_json=str_replace(",",",\n",$texte_json);
			$texte_json=str_replace("{","{\n\t",$texte_json);
			$texte_json=str_replace("}","\n}",$texte_json);

			

			file_put_contents("login_password.txt",$texte_json);

			$_SESSION['importation']=1;



















		foreach ($list_choice as $choice) 
		{

			$query_list_option_for_choice=$connexion->getListOfOptionForChoice($consultation_instance_id,$choice['choice_id']);
			$number_of_option=$query_list_option_for_choice->rowCount();
			$options=$query_list_option_for_choice->fetchAll();


			

		?>

			<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $choice['choice_name'] ?> </h3>
                                <div class="text-right">
                                		Min bid : 
                                		<span class="min_bid_value_<?php echo $choice['choice_id'] ?>" > <?php echo "0" //$min_bid ?> </span>
                                		<a href="#">
                                			<span  data-toggle="modal" data-target="#min_bid<?php echo $choice['choice_id'] ?>" title="Edit minimum bid of <?php echo $choice['choice_name'] ?>"  alt="<?php echo $choice['choice_id'] ?>" class="glyphicon glyphicon-pencil modifier_min_bid_choix" aria-hidden="true" style="cursor:pointer">
                                			</span> 
										</a>  
										| 
										Max bid : 
                                		<span class="max_bid_value_<?php echo $choice['choice_id'] ?>" > <?php echo $max_bid ?> </span>
                                		<a href="#">
                                			<span  data-toggle="modal" data-target="#max_bid<?php echo $choice['choice_id'] ?>" title="Edit maximum bid of <?php echo $choice['choice_name'] ?>"  alt="<?php echo $choice['choice_id'] ?>" class="glyphicon glyphicon-pencil modifier_max_bid_choix" aria-hidden="true" style="cursor:pointer">
                                			</span> 
										</a> 












										<div class="row modal fade" role="dialog" id="min_bid<?php echo $choice['choice_id'] ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Min bid</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6">
                                                                <input type="text" name="" class="valeur_min_bid_en_modification<?php echo $choice['choice_id'] ?>" value="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default bouton_valider_modification_min_bid" alt="<?php echo $choice['choice_id'] ?>" data-dismiss="modal">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="row modal fade" role="dialog" id="max_bid<?php echo $choice['choice_id'] ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Max bid</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6">
                                                                <input type="text" name="" class="valeur_max_bid_en_modification<?php echo $choice['choice_id'] ?>" value="" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default bouton_valider_modification_max_bid" alt="<?php echo $choice['choice_id'] ?>" data-dismiss="modal">OK</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>






                                		
                                		 
                                	
                                	
                                </div>
                            </div>

                            <div class="panel-body">
                            		<div class="table-responsive">
		                                    <table class="table table-bordered table-hover table-striped">
		                                        <thead>
		                                            <tr>
		                                                <th  rowspan="2">N°</th>
		                                                <th  rowspan="2"> Students </th>
		                                                <th  rowspan="2">ID</th>
		                                                
		                                                <?php 
		                                                for($j=0;$j<$number_of_option;$j++)
		                                                {
		                                                ?>
		                                                	<th colspan="4"> <?php echo $options[$j]['option_name'] ?>  </th>
		                                                	
		                                                <?php 
		                                                }
		                                                ?>
		                                                <th rowspan="2"></th>
		                                            </tr>

		                                            <tr>
		                                            	<?php 
		                                                for($j=0;$j<$number_of_option;$j++)
		                                                {
		                                                ?>
			                                                <th > Bids </th>
			                                                <th > Arguments </th>
			                                                <th > Pref </th>
			                                                <th > </th>
			                                            <?php 
		                                                }
		                                                ?>
		                                            </tr>
		                                        </thead>


		                                        <tbody>
		                                            
				                                        





		                                        	<?php 
				                                        $i=1;
				                                        foreach($list_student_data as $student ) {
				                                        	
				                                       		 ?>
					                                        <tr class="choice_<?php echo $choice['choice_id']."_student_".$student['student_id'] ?> <?php echo "ligne_student".$student['student_id'] ?>">

					                                                <td   ><?php echo $i ?></td>
					                                                <td  class="student_name"><?php echo $student['name'] ?></td>
					                                                <td  class="student_login" align="center" ><?php echo $student['login'] ?></td>

					                                      			<?php 
					                                      			$vote_a_supprimer="";
					                                                for($j=0;$j<$number_of_option;$j++)
					                                                {
					                                                	$votes=$connexion->getListVoteForConsultationOption($student['student_id'],$options[$j]['option_id'],$instance->id);

					                                                	$vote=$votes->fetch();

					                                                	$vote_a_supprimer.=$vote['id_vote']."_";

					                                                ?>          
						                                                <td   
						                                                	class="bid_choice_<?php echo $choice['choice_id']."_student_".$student['student_id']."_option_".$options[$j]['option_id'] ?> 
						                                                			case<?php echo $vote['id_vote'] ?>" 
						                                                	data-student="<?php echo $student['student_id'] ?>">

						                                                		<?php echo $vote['bids'] //." /student : ".$student['student_id']."/option : ".$options[$j]['option_id']."/instance : ".$instance->id ?>
						                                                		
						                                                </td>

						                                                <td  class="argument1 case<?php echo $vote['id_vote'] ?>">
						                                                <?php 
						                                                	$args="";
						                                                	$nb=0;
						                                                	if(trim($vote['argument1'])!='')
						                                                	{
						                                                		$nb++;
						                                                		$args.=$nb." . ".htmlspecialchars($vote['argument1'])."\n\n";
																				//echo " ici ".$vote['argument1']." -- ";
						                                                	}
						                                                	
						                                                	if(trim($vote['argument2'])!='')
						                                                	{
						                                                		$nb++;
						                                                		$args.=$nb." . ".htmlspecialchars($vote['argument2'])."\n\n";
						                                                	}
						                                                	
						                                                	if(trim($vote['argument3'])!='')
						                                                	{
						                                                		$nb++;
						                                                		$args.=$nb." . ".htmlspecialchars($vote['argument3'])."\n\n";


						                                                	}
						                                                ?>



						                                                <a style="text-decoration:none;cursor:pointer" title="<?php echo $args ?>">
						                                                	(<?php echo $nb ?>)
						                                                </a>
						                                                	
						                                                </td>
						                                                <td  
						                                                	class="pref_choice_<?php echo $choice['choice_id']."_student_".$student['student_id']."_option_".$options[$j]['option_id'] ?>
						                                                			case<?php echo $vote['id_vote'] ?>" 
						                                                	data-student="<?php echo $student['student_id'] ?>">

						                                                	<?php echo $vote['pref']  ?>
						                                                		
						                                                </td>

						                                                <td align="center" >
						                                                		
						                                                		<span 
								                                                	style="cursor:pointer" 
								                                                	class="glyphicon glyphicon-ok valider valider<?php echo $vote['id_vote'] ?> hidden" 
								                                                	aria-hidden="true" 
								                                                	title="Validate modification"
								                                                	alt="<?php echo $vote['id_vote'] ?>"  
								                                                	data-choice="<?php echo $choice['choice_id'] ?>" 
								                                                	data-student="<?php echo $student['student_id'] ?>" 
								                                                	data-option="<?php echo $options[$j]['option_id'] ?>">
							                                                	</span>

							                                                	<span
							                                                		style="cursor:pointer"  
							                                                		class="glyphicon glyphicon-remove annuler_modification annuler_modification<?php echo $vote['id_vote'] ?> hidden" 
							                                                		aria-hidden="true"
							                                                		title="Cancel modification"
							                                                		alt="<?php echo $vote['id_vote'] ?>"  
							                                                		data-choice="<?php echo $choice['choice_id'] ?>" 
							                                                		data-student="<?php echo $student['student_id'] ?>" 
							                                                		data-option="<?php echo $options[$j]['option_id'] ?>">		
							                                                	</span>

							                                                	<span 
								                                                	style="cursor:pointer" 
								                                                	class="glyphicon glyphicon-pencil modifier  modifier<?php echo $vote['id_vote'] ?>" 
								                                                	aria-hidden="true" 
								                                                	title="Edit vote"
								                                                	alt="<?php echo $vote['id_vote'] ?>"  
								                                                	data-choice="<?php echo $choice['choice_id'] ?>" 
								                                                	data-student="<?php echo $student['student_id'] ?>" 
								                                                	data-option="<?php echo $options[$j]['option_id'] ?>">
							                                                	</span>

						                                                </td> 

						                                            <?php 
						                                        	}
						                                        	?>
					                                                <td  align="center" >
					                                                	<!--<i  class="fa fa-eye" aria-hidden="true" style="cursor:pointer"></i>-->
					                                                	

					                                                	<span 
					                                                		style="cursor:pointer" 
					                                                		class="glyphicon glyphicon-remove supprimer  supprimer<?php echo $vote['id_vote'] ?> " 
					                                                		aria-hidden="true" 
					                                                		title="Delete <?php echo $student['name']."'s votes for the choice ".$choice['choice_name'] ?>"
					                                                		alt="<?php echo $vote_a_supprimer ?>"  
					                                                		data-choice="<?php echo $choice['choice_id'] ?>" 
					                                                		data-student="<?php echo $student['student_id'] ?>" >		
					                                                	</span>
					                                                </td>
					                                        </tr>

				                                       		<?php 
				                                        	$i++;
				                                        	
				                                        }
				                                        ?>
				                                            
				                                           
		                                            





















































		                                        <!--TBODY-->


		                                        </tbody>
		                                    </table>
		                                </div>

		                     </div>
                        </div> 




                    </div>





                                
               <?php 
           }
           ?>



                                













			
			

























            
           		<div class="clearfix"></div>





           		<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-8 col-xs-11     col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-1">
							
                        <button  class=" btn btn-default bouton_verifier_contraintes">Check constraints</button>
                        <button  class="btn btn-default hidden bouton_valider_and_save" onclick="window.location='validateData.php?consultation_instance_id=<?php echo $consultation_instance_id ?>'">Validate et save</button>
                        <button class="btn btn-default"  onclick="window.location=''" >Cancel the import</button>
                    </div>

                </div>




							
				<div class="row message_error_grand hidden">
					<div class="alert alert-danger error_message">
					  <b>Error</b>(<span class="nombre_error">5</span>)<br/><br/>
					</div>
				</div>

				<div class="row message_success_grand hidden">
					<div class="alert alert-success">
					  <strong>Congrulation, the data are OK. </strong>
					</div>
				</div>


				<div class="row message_warning_grand hidden">
					<div class="alert alert-warning warning_message">

					  <b>Warning</b> (<span class="nombre_warning"></span>)<br/><br/>

					</div>
				</div>

				

				

                
                        	






















        <?php 
		     
		}
		else
		{
			//echo "Pas d'import";
		}

		


		//header('Location:import.php');




		 




	?>





	<input type="hidden" value="<?php echo $instance->id ?>" id="consultation_instance_id">

