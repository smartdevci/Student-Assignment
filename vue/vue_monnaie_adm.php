<?php 
$_SESSION['page']="monnaie_adm";
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
                                    <?php 
                                    while($st=$list_student->fetch())
                                    {
                                        ?>
                                        <a href="" class="list-group-item">
                                            <span class="badge"><?php //echo $p->remaining_token ?></span>
                                         <i class="fa fa-fw fa-user"></i> <?php $student['name'] ?>
                                        </a>

                                        <?php 

                                    }
                                    ?>

                                    
                                   
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
                                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> History of wallet unsing</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" >Date</th>
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
                                               <!-- <td><?php echo $donnees_utilisation_monnaie["date"]  ?></td>
                                                <td><?php echo $current_token ?></td>
                                                <td><?php echo $current_token ?></td>
                                                <td><?php  echo $token_remaining ?></td>
                                                
                                                <td><?php echo $current_regret_point ?></td>
                                                <td><?php echo $current_regret_point ?></td>
                                                
                                                <td><?php  echo $regret_point_remaining ?></td> -->




                                                <td><?php echo $donnees_utilisation_monnaie["date"]  ?></td>
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
