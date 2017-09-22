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
                    
                    
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><!--<i class="fa fa-money fa-fw"></i>--> Liste des Etudiants</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>N°</th>
                                                <th>Nom & Prénoms</th>
                                                <th>ID</th>
                                                <th>Automatic password</th>
                                                <th>Remaining token</th>
                                                <th>Regret point</th>
                                                <th>Special needs</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php 
                                        $i=1;
                                        while ($student=$list_of_students->fetch() ) {
                                        ?>
                                        <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo utf8_encode($student['name']) ?></td>
                                            <td><?php echo $student['login'] ?></td>
                                            <td><?php echo ($student['password_changed']==0)?$student['password']:"None" ?></td>
                                                <td><?php echo $student['remaining_token'] ?></td>
                                                <td><?php echo $student['regret_point'] ?></td>
                                                <td><?php echo ($student['extra_case']==1)?'Oui':'Non' ?></td>
                                                <td><i onclick="window.location='etudiant_plus.php?st=<?php echo $student['student_id'] ?>'" class="fa fa-eye" aria-hidden="true" style="cursor:pointer"></i></td>
                                        </tr>

                                        <?php 
                                        $i++;
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

</body>

</html>
