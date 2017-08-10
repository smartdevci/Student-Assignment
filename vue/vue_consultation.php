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
                        <h1 class="page-header">
                            
                        </h1>
                       <!-- <ol class="breadcrumb">
                             <li class="active">
                               <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>-->
                    </div>
                </div>
                <!-- /.row -->

                
                <!-- /.row -->

                
                   
                <!-- /.row -->

                <div class="row">
                    
                    
                    <div class="col-lg-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><!--<i class="fa fa-money fa-fw"></i><!List des consultation--> </h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Consultations</th>
                                                <th>Level</th>
                                                <th>Academic year</th>
                                                <th>Semester</th>
                                                <th>Importation date</th>
                                                <th>Assignment date</th>
                                                <th></th>
                                                <th>Source data file</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php 
                                        while ($consultation=$list_of_consultation->fetch() ) {
                                        ?>
                                        <tr>
                                                <td><?php echo utf8_encode($consultation['consultation_name']) ?></td>
                                                <td><?php echo $consultation['year_level_label'] ?></td>
                                                <td><?php echo $consultation['academic_year_label'] ?></td>
                                                <td><?php echo $consultation['semester_name'] ?></td>
                                                <td><?php echo $consultation['date'] ?></td>
                                                <td><?php echo $consultation['assignment_date'] ?></td>
                                                <td>
                                                    <i title="Show details of this consultation" onclick="window.location='consultations_plus.php?c=<?php echo $consultation['instance_id'] ?>'" class="fa fa-eye" aria-hidden="true" style="cursor:pointer"></i> 

                                                    <?php 
                                                    if($consultation['json'])
                                                    {
                                                    ?>
                                                        <a download href="<?php echo "export/consultation".$consultation['instance_id'] ?>.json" style="text-decoration:none;">
                                                             <span class="glyphicon glyphicon-download" title="Download JSON file for this consultation" style="cursor:pointer" aria-hidden="true"></span>
                                                        </a>
                                                   
                                                    <?php 
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <i  alt="<?php echo $consultation['instance_id'] ?>" title="Export consultation's data to JSON file " class="glyphicon glyphicon-export lien_exporter_donnees_vers_app_affectation " aria-hidden="true" style="cursor:pointer"></i> 
                                                        
                                                    <?php 
                                                    }
                                                    ?>
                                                    

                                                    
                                                    

                                                    



                                                     <?php 
                                                    if($consultation['resultat'])
                                                    {
                                                    ?>
                                                        <i title="Show Details of assignment about this consultation" onclick="window.location='assignment.php?c=<?php echo $consultation['instance_id'] ?>'" class="glyphicon glyphicon-education" aria-hidden="true" style="cursor:pointer"></i> 
                                                   
                                                    <?php 
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                        <i  data-toggle="modal" data-target="#importation_assignment<?php echo $consultation['instance_id'] ?>" title="Import assignment data of this consultation"  class="glyphicon glyphicon-import" aria-hidden="true" style="cursor:pointer"></i> 
                                                    <?php 
                                                    }
                                                    ?>

                                                    
                                                    
                                                   
                                                    
                                                   
  
                                                </td>
                                                <td>
                                                    <?php echo $consultation['source_data_file']  ?>
                                                    <a download href="<?php echo "vote_file/".$consultation['source_data_file'] ?>">
                                                        <span class="glyphicon glyphicon-download" title="Download file" style="cursor:pointer" aria-hidden="true"></span>
                                                    </a>
                                                    
                                                </td>
                                                
                                        </tr>



                                        <div class="row modal fade" role="dialog" id="importation_assignment<?php echo $consultation['instance_id'] ?>">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Import of assignment file</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12">
                                                                <!-- Advanced Tables -->
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                      
                                                                    </div>
                                                                    <div class="panel-body">
                                                                        

                                                                            <form role="form" method="POST" action="importation_assignment.php" enctype="multipart/form-data">

                                                                                
                                                                                <div class="form-group">
                                                                                    <label for="fichier_vote">Vote file (.csv)</label>
                                                                                    <input type="file" id="fichier_vote" class="form-control" name="fichier" value="ok" />
                                                                                </div>

                                                                                <input type="hidden" name="consultation_instance_id" value="<?php echo $consultation['instance_id'] ?>" />


                                                                                <div class="alert alert-danger  alert_format_incorrect hidden"> <a data-dismiss="alert" class="close">×</a>
                                                                                  Please select a csv file
                                                                                 </div>
                                                                                 

                                                                                <button type="submit" class="btn btn-default">Import</button>
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
    <script src="js/exporter.js"></script>
    <script src="js/a.js"></script>

</body>

</html>
