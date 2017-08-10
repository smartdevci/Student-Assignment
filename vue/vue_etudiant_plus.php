<?php 
$_SESSION['page']="etudiant";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Assignment</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        



        <!--  MENU -->
        <!--  MENU -->
        <!--  MENU -->
       
        <?php 
        include 'menu.php';
        ?>


        <!-- MENU -->
        <!-- MENU -->
        <!-- MENU -->














        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $student->name ;?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

               

                
















                
                   
                <!-- /.row -->
                <button onclick="window.location='etudiant.php'" class="btn btn-default ">Retour</button>

                <div class="row">
                   

                    <div class="student_id hidden"><?php echo $student_id ?></div>
                    
                    <div class="col-lg-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-fw fa-user"></i> Student informations</h3>
                               
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a  class="list-group-item">
                                        <span class="badge"><span class="nom_complet_etudiant"><?php echo $student->name ?> </span><span alt="<?php echo $student->name ?>"  style="cursor:pointer" class="glyphicon glyphicon-pencil edit_name"></span></i></span>
                                        <span class="badge"></span>
                                        <i class="fa fa-fw fa-user"></i> First and Last name
                                    </a>
                                    <a class="list-group-item">
                                        <span class="badge"><?php echo $student->login ?></span>
                                        <i class="fa fa-fw fa-user"></i> ID
                                    </a>
                                    <a  class="list-group-item">
                                        <span class="badge"><?php echo $student->date_inscription ?></span>
                                        <i class="fa fa-fw fa-calendar"></i> Date of first vote
                                    </a>
                                    <a class="list-group-item">

                                        <span class="badge"><span class="extra_case"> <?php echo ($student->extra_case ==0)?" No ":" Yes " ?></span><span alt="<?php echo $student->extra_case ?>"  style="cursor:pointer" class="glyphicon glyphicon-pencil edit_extra_case"></span></span>
                                        <i class="fa fa-fw fa-truck"></i> Special needs
                                    </a>
                                     
                                </div>
                                <!--<div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div>-->
                            </div>
                        </div>
                    </div>
                    


                    <div class="col-lg-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Wallet</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    

                                    <a class="list-group-item">
                                        <span class="badge">

                                            <span class="token_value">
                                                <?php echo $student->remaining_token ?>
                                            </span>

                                            <span  data-toggle="modal" data-target="#edit_token" title="Edit token of <?php echo $student->name ?>"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer">
                                            </span>

                                        </span>
                                        <i class="fa fa-fw fa-user"></i> Remaining tokens
                                    </a>   
                                   

                                    <a  class="list-group-item">
                                        <span class="badge">
                                            
                                            <span class="regret_point_value">
                                                <?php echo $student->regret_point ?>
                                            </span>
                                            
                                            
                                            <span  data-toggle="modal" data-target="#edit_regret_point" title="Edit token of <?php echo $student->name ?>"  class="glyphicon glyphicon-pencil" aria-hidden="true" style="cursor:pointer">
                                            </span>

                                        </span>
                                        <i class="fa fa-fw fa-user"></i> Regret point
                                    </a>


                                    <a  class="list-group-item">
                                        <span class="badge"><?php echo $student->date_inscription ?></span>
                                        <i class="fa fa-fw fa-calendar"></i> Date of last used of tokens
                                    </a>
                                   
                                    






                                    <div class="row modal fade" role="dialog" id="edit_token">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Edit token of <?php echo $student->name ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <input class="form-control token_value_edit" type="number" name="" value="0" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default bouton_reduce_token" data-dismiss="modal"  alt="<?php echo $student->id ?>" >Deduct</button>
                                                        <button type="button" class="btn btn-default bouton_add_token" data-dismiss="modal" alt="<?php echo $student->id ?>" >Add</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>



                                    <div class="row modal fade" role="dialog" id="edit_regret_point">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Edit regret point of <?php echo $student->name ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <input class="form-control regret_point_value_edit" type="number" name="" value="0" />
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default bouton_reduce_regret_point" alt="<?php echo $student->id ?>" data-dismiss="modal">Deduct</button>
                                                        <button type="button" class="btn btn-default bouton_add_regret_point" alt="<?php echo $student->id ?>" data-dismiss="modal">Add</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>















                                     
                                </div>
                                <div class="text-right">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="text-left">
                                                <a class="previous_assignment" style="cursor:pointer;text-decoration:none">Show the previous assignments <!--<i class="fa fa-arrow-circle-right"></i>--></a>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                           <a class="use_of_wallet" style="cursor:pointer;text-decoration:none">Show the use of wallet <!--<i class="fa fa-arrow-circle-right"></i>--></a>
                                        </div>
                                    </div>
                                    
                                </div>
                                

                                
                            </div><?php //afficher du texte ici ?>
                        </div>




                        <!--OK-->
                        <div class="panel panel-default view_previous_assignment hidden">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="glyphicon glyphicon-record"  aria-hidden="true"></span> Previous assignments</h3>
                            </div>
                            <div class="panel-body">
                                


                           
                                <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">  <!--Titre ici -->   </h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Year</th>
                                                            <th>Level</th>
                                                            <th>Semester</th>
                                                            <th>Consultation name</th>
                                                            <th>Choice</th>
                                                            <th>Option</th>
                                                            
                                                        </tr>
                                                        
                                                    </thead>
                                                    <tbody>
                                                        
                                                    <?php 
                                                    


                                                    while ($previous_assignment=$list_previous_assignment->fetch()) 
                                                    {
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $previous_assignment['academic_year_label'] ?></td>
                                                            <td><?php echo $previous_assignment['year_level_label'] ?></td>
                                                            <td><?php echo $previous_assignment['semester_name'] ?></td>
                                                            <td><?php echo $previous_assignment['consultation_name'] ?></td>
                                                            <td><?php echo $previous_assignment['choice_name'] ?></td>
                                                            <td><?php echo $previous_assignment['option_name'] ?></td>
                                                        </tr>

                                                    <?php 
                                                    }
                                                    ?>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                           

                                            
                                        </div><?php //afficher du texte ici ?>
                                    </div>







                                
                               

                                
                            </div><?php //afficher du texte ici ?>
                        </div>








                        <!--OK-->
                        <div class="panel panel-default view_utilisation_porte_monnaie hidden">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Wallet use</h3>
                            </div>
                            <div class="panel-body">
                               

                               <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" >Date</th>
                                                <th rowspan="2" >Reason</th>
                                                <th colspan="3">Tokens</th>
                                                <th colspan="3">Regret point</th>
                                                
                                            </tr>
                                            <tr>
                                                <th >Used</th>
                                                <th >Obtained</th>
                                                <th >Total remaining</th>
                                                 <th >Used</th>
                                                <th >Obtained</th>
                                                <th >Total remaining</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php 
                                        $token_remaining=0;
                                        $regret_point_remaining=0;

                                        $current_token=0;
                                        $current_regret_point=0;

                                        $number_of_token=1;
                                        $number_of_regret_point=1;


                                        foreach ($liste_donnees_utilisation_monnaie as $donnees) 
                                        {
                                            if($donnees['about_token']==1)
                                            {

                                                //about_token==1 then it is a data about token

                                                $current_token=$donnees['number'];
                                                $current_regret_point="";
                                                
                                                if($number_of_token==1)
                                                {
                                                    //the first data is the initial number of Token
                                                    $token_remaining=$current_token;
                                                    $current_token="";
                                                }
                                                else
                                                {
                                                    //After the first data, we are the number of Token used by the Student
                                                    $token_remaining+=$current_token;
                                                }

                                                $number_of_token++;
                                                $number_of_regret_point++;
                                            }
                                            else if($donnees['about_token']==0)
                                            {
                                                //about_token==0 then it is a data about regret_point

                                                $current_token="";
                                                $current_regret_point=$donnees['number'];

                                                if($number_of_regret_point==1)
                                                {
                                                    //the first data is the initial number of Token
                                                    $regret_point_remaining=$current_regret_point;
                                                    $current_regret_point="";

                                                }
                                                else
                                                {
                                                    //After the first data, we are the number of Token used by the Student
                                                    $regret_point_remaining+=$current_regret_point;
                                                }


                                                $number_of_regret_point++;
                                                $number_of_token++;
                                            }



                                        ?>
                                            <tr>
                                               
                                                <td><?php echo $donnees["date"]  ?></td>
                                                <td><?php echo $donnees["reason"]  ?></td>
                                                <td><?php echo ($current_token<0)?abs($current_token):"" ?></td>
                                                <td><?php echo ($current_token>0)?$current_token:"" ?></td>
                                                <td><?php  echo $token_remaining ?></td>
                                                
                                                <td><?php echo ($current_regret_point<0)?abs($current_regret_point):"" ?></td>
                                                <td><?php echo ($current_regret_point>0)?$current_regret_point:"" ?></td>
                                                
                                                <td><?php  echo $regret_point_remaining ?></td>
                                            </tr>

                                        <?php 
                                        }
                                        ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                                

                                
                            </div><?php //afficher du texte ici ?>
                        </div>


                        <div  data-toggle="modal" data-target="#confirm_modal" class="text-right password_init" style="cursor:pointer">
                            <a style="text-decoration: none" >Reset password</a>
                        </div>



                        <div class="row modal fade" role="dialog" id="confirm_modal">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Reset password </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="form-group">
                                               Do you want to reset password of <?php echo $student->name ?> ?
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default bouton_reset_password_yes" data-dismiss="modal" data-id="<?php echo $student->id ?>" >Yes</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>












                    </div>







                    
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
    <script src="js/edit_student.js"></script>
    <script src="js/update_wallet.js"></script>
    <script src="js/reset_password.js"></script>

</body>

</html>
