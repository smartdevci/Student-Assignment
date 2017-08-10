<?php 
$_SESSION['page']="consultation";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Affectation</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                        <h4 class="page-header">
                            <b>Consultation : </b><?php   echo $consultation_name ?>
                            <br/><b>Consultation importation date : </b><?php echo $consultation_importation_date ?>
                            <?php 
                            if(sizeof($assignments)!=0)
                            {
                            ?>
                                <br/><b>Assignment importation date : </b><?php echo $assignment_importation_date ?>
                            <?php 
                            }
                            ?>

                            
                        </h4>
                       <!-- <ol class="breadcrumb">
                             <li class="active">
                               <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>-->
                    </div>
                </div>
                <!-- /.row -->

                
                <!-- /.row -->

                <div class="row">
                    <div class="text-right">
                         <button data-toggle="modal" data-target="#assignment_result_file" class="btn btn-default ">Generate result CSV file</button>
                         

                         <a href="result_assignment/result_assignment<?php echo $_GET['c'] ?>.csv" download class="<?php echo ($activate_download==0)?'hidden':'' ?>" >
                            <button class="btn btn-default ">Download result CSV file</button>
                        </a>    
                         

                         <button onclick="window.location='consultations.php'" class="btn btn-default ">Retour</button>
                    </div>
                   
                </div>








                


                                        <div class="row modal fade" role="dialog" id="assignment_result_file">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Data separator of assignment result file</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12">
                                                                <!-- Advanced Tables -->
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                      
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        

                                                                            <form role="form" method="POST" action="generate_assignment_result_file.php">

                                                                                
                                                                                

                                                                                <input type="hidden" name="consultation_instance_id" value="<?php echo $_GET['c'] ?>" />

                                                                               
                                                                                
                                                                                <div class="form-group">
                                                                                
                                                                                    <select class="form-control"  name="separator" id="separator"  required >
                                                                                        <option value="" disabled selected >Select the data separator character</option>
                                                                                        <option value="tab">Tabulation</option>
                                                                                        <option value="pvirgule">A semi-colon (;)</option>
                                                                                        <option value="Autre">Other</option>
                                                                                    </select>
                                                                                    <input class="form-control hidden"  name="other_separator" id="other_separator" placeholder="Type the character">
                                                                                </div>

                                                                                
                                                                                <button type="submit" class="btn btn-default">Generate</button>
                                                                                <button type="reset" class="btn btn-default">Reset</button>

                                                                            </form>


                                                                    </div>
                                                                </div>
                                                                <!--End Advanced Tables -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                











                
                <?php 
                if(sizeof($assignments)==0)
                {
                    
                ?>
                <div class="alert alert-info">
                  The treatment of assignments is in progress, so the results are not yet available
                </div>

                <?php
                }
                else 
                {
                ?>




                    <div class="row">
                    
                    
                        <div class="col-lg-12 col-xs-12">

                        <div class="panel panel-default choice_name" alt="">
                                <div class="panel-heading">
                                    <h3 class="panel-title">   Assignment <?php echo $consultation_name ?> </h3>
                                </div>
                                <div class="panel-body contenu_a_cacher tableau_contenu">
                                    <div class="table-responsive ">
                                        <table class="table table-bordered table-hover table-striped ">
                                            <thead>
                                                <tr>
                                                    <th>Etudiant</th>
                                                    <th>ID</th>
                                                     
                                                    <?php 
                                                    for($j=0;$j<sizeof($choices);$j++)
                                                    {
                                                    ?>
                                                        <th><?php echo $choice[$j]['choice_name'] ?> </th>
                                                    <?php 
                                                    }
                                                    ?>

                                                    
                                                </tr>
                                            </thead>






                                            <tbody>
                                                


                                            <?php 
                                            foreach ($students as $student) {
                                            ?>
                                            <tr>  
                                                 <td><?php echo $student['name'] ?></td>  
                                                 <td><?php echo $student['login'] ?></td> 

                                                 
                                                 <?php 
                                                 for($j=0;$j<sizeof($choices);$j++)
                                                 {
                                                    if(isset($assignments[$student['student_id']][$choice[$j]['choice_id']]))
                                                    {
                                                      ?>  
                                                      <td><?php echo $assignments[$student['student_id']][$choice[$j]['choice_id']]; ?></td> 
                                                      <?php 
                                                    } 
                                                 }
                                                 ?>
                                            </tr>
                                            <?php 
                                            }
                                            ?>
                                            </tbody>

                                        </table>
                                    </div>
                                    <!--<div class="text-right">
                                        <a href="#">Voir évolution du porte monnaie <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>-->
                                </div>
                            </div>

                         









                        </div>
                    </div>
                    <!-- /.row -->



                <?php 
                }
                ?>
                


                   
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
    <script src="js/reduire.js"></script>

</body>

</html>
