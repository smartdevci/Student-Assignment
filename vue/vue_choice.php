<?php 
$_SESSION['page']="choice";
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
                            <?php echo $p->name ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-money fa-fw"></i> Wallet
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable <?php echo ($p->password_changed)?'hidden':'' ?>">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>   Your password has been generated automatically, Please modify it immediately 
                            
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                
                   
                <!-- /.row -->

                <div class="row">
                    
                    <div class="col-lg-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Wallet state</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    <a href="" class="list-group-item">
                                        <span class="badge"><?php echo $p->remaining_token ?></span>
                                        <i class="fa fa-fw fa-user"></i> Remaining tokens
                                    </a>
                                    <a href="" class="list-group-item">
                                        <span class="badge"><?php echo $p->regret_point ?></span>
                                        <i class="fa fa-fw fa-user"></i> Regret point
                                    </a>
                                    <a href="" class="list-group-item">
                                        <span class="badge"><?php echo $p->date_inscription ?></span>
                                        <i class="fa fa-fw fa-calendar"></i>  Date of last use of tokens
                                    </a>
                                    <!--<a href="" class="list-group-item">
                                        <span class="badge">Non</span>
                                        <i class="fa fa-fw fa-truck"></i> Mobilité entrante
                                    </a>-->
                                     
                                </div>
                                <!--<div class="text-right">
                                    <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                                </div>-->
                            </div><?php //afficher du texte ici ?>
                        </div>

                    </div>
                    <div class="col-lg-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> History of wallet use</h3>
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



                               <!-- <div class="text-right">
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
