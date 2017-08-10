<?php
		
		
		



		$list_number_Option = array();


		
		if(isset($_GET['c']) )
		{ 
			
			
			$consultation_instance_id=$_GET['c'];
			



		foreach ($list_choice as $choice) 
		{

			$query_list_option_for_choice=$connexion->getListOfOptionForChoice($consultation_instance_id,$choice['choice_id']);
			$number_of_option=$query_list_option_for_choice->rowCount();
			$options=$query_list_option_for_choice->fetchAll();


			$min_bid=$choice['locmin_bid'];
			$max_bid=$choice['locmax_bid'];
			

		?>

			<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $choice['choice_name'] ?> </h3>
                                <div class="text-right">
                                		Min bid : 
                                		<span class="min_bid_value_<?php echo $choice['choice_id'] ?>" > <?php echo $min_bid ?> </span>
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
				                                        foreach($list_student as $student ) {
				                                        	
				                                       		 ?>
					                                        <tr class="choice_<?php echo $choice['choice_id']."_student_".$student['student_id'] ?> ">

					                                                <td   ><?php echo $i ?></td>
					                                                <td  class="student_name"><?php echo $student['name'] ?></td>
					                                                <td  class="student_login" align="center" ><?php echo $student['login'] ?></td>

					                                      			<?php 
					                                      			$vote_a_supprimer="";
					                                                for($j=0;$j<$number_of_option;$j++)
					                                                {
					                                                	$votes=$connexion->getListVoteForConsultationOption($student['student_id'],$options[$j]['option_id'],$consultation_instance_id);

					                                                	$vote=$votes->fetch();

					                                                	$vote_a_supprimer.=$vote['id_vote']."_";

					                                                ?>          
						                                                <td  
						                                                	class="bid_choice_<?php echo $choice['choice_id']."_student_".$student['student_id']."_option_".$options[$j]['option_id'] ?>" 
						                                                	data-student="<?php echo $student['student_id'] ?>">

						                                                		<?php echo $vote['bids'] //." /student : ".$student['student_id']."/option : ".$options[$j]['option_id']."/instance : ".$instance->id ?>
						                                                		
						                                                </td>

						                                                <td  class="argument1">
						                                                <?php 
						                                                	$args="";
						                                                	$nb=0;
						                                                	if(trim($vote['argument1'])!='')
						                                                	{
						                                                		$nb++;
						                                                		$args.=$nb." . ".htmlspecialchars($vote['argument1'])."\n\n";
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
						                                                	class="pref_choice_<?php echo $choice['choice_id']."_student_".$student['student_id']."_option_".$options[$j]['option_id'] ?>" 
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



                                













			
			

























            

							
				<div class="row message_error_grand hidden">
					<div class="alert alert-danger error_message">
					  
					</div>
				</div>

				<div class="row message_success_grand hidden">
					<div class="alert alert-success">
					  <strong>Congrulation, the data are OK. </strong>
					</div>
				</div>


				

                <div class="row">
					<div class="col-lg-6 col-md-6 col-sm-8 col-xs-11     col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-xs-offset-1">
							
                        <button  class=" btn btn-default bouton_verifier_contraintes">Check contraints</button>
                        <button  class="btn btn-default hidden bouton_valider_and_save">Validate et save</button>
                        <button class="btn btn-default">Cancel the import</button>
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





	<input type="hidden" value="<?php echo $consultation_instance_id ?>" id="consultation_instance_id">

