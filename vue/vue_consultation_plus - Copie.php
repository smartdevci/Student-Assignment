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
                        <h3 class="page-header">
                            La consultation <?php  echo $tab_consultation[0]['consultation_name'] ?>
                        </h3>
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
                    
                    <div class="row">
                        <button onclick="window.location='consultations.php'" class="btn btn-default col-lg-offset-11 col-xs-offset-11">Retour</button>
                        <!--<button onclick="window.location='consultations.php'" class="btn btn-default col-lg-offset-11 col-xs-offset-11">Modifier</button>-->

                    </div>

                    <!--<a class="lien_telechargement" download="ok.csv" href="">Lien</a>
                    <button  class="essayer btn btn-default col-lg-offset-11 col-xs-offset-11">Download</button>-->

                    
                    <div class="col-lg-12 col-xs-12">

                    <?php 
                     foreach ($choices as $choice) {

                       
                     ?>
                     <div class="panel panel-default choice_name" alt="<?php echo $choice['choice_id'] ?>">
                            <div class="panel-heading">
                                <h3 class="panel-title"><!--<i class="fa fa-money fa-fw"></i>--> <?php  echo $choice['choice_name'] ?> </h3>
                            </div>
                            <div class="panel-body contenu_a_cacher tableau_contenu<?php echo $choice['choice_id'] ?> hidden">
                                <div class="table-responsive ">
                                    <table class="table table-bordered table-hover table-striped ">
                                        <thead>
                                            <tr>
                                                <th>Etudiant</th>
                                                <th>Options</th>
                                                <th>Mises</th>
                                                <th>Arguments</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        <?php 
                                        foreach ($students as $student) {
                                            $options_list=$connexion->getListOptionForChoice($choice['choice_id'],$consultation_instance_id);
                                        ?>
                                        <tr>  
                                               <td rowspan="<?php echo ($options_list->rowCount()!=0)?$options_list->rowCount():$options_list->rowCount()+1 ?>"><?php echo $student['name'] ?></td>
                                               <?php 

                                               $option=$options_list->fetch();

                                               ?>
                                               <td><?php echo $option['option_name'] ?></td>
                                               <?php 
                                               if(isset($votes[$student['student_id']][$choice['choice_id']][$option['option_id']]))
                                               {
                                                ?>
                                                <td><?php echo $votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['bid'] ?></td>
                                                <td>
                                                    <?php echo $votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument1'] ?> 

                                                    <?php echo (empty(trim($votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument1'])))?"/":"" ?>
                                                    
                                                    <?php echo $votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument2'] ?> 

                                                    <?php echo (empty(trim($votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument2'])))?"/":"" ?>
                                                    
                                                    <?php echo $votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument3'] ?> 
                                                    
                                                </td>
                                                <?php 
                                               }
                                               else 
                                               {
                                                ?>
                                                <td></td>
                                                <td></td>

                                                <?php 
                                               }
                                               ?>
                                        </tr>
                                        <?php 
                                        for($i=0;$i<$options_list->rowCount()-1;$i++)
                                        {
                                            $option=$options_list->fetch();

                                            ?>
                                            <tr>
                                                
                                               <td><?php echo $option['option_name'] ?></td>
                                               <?php 
                                               if(isset($votes[$student['student_id']][$choice['choice_id']][$option['option_id']]))
                                               {
                                                ?>
                                                <td><?php echo $votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['bid'] ?></td>
                                                <td>
                                                    <?php echo $votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument1'] ?> 
                                                    <?php echo (empty(trim($votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument1'])))?"/":"" ?>

                                                    <?php echo $votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument2'] ?> 

                                                    <?php echo (empty(trim($votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument2'])))?"/":"" ?>
                                                    
                                                    <?php echo $votes[$student['student_id']][$choice['choice_id']][$option['option_id']]['argument3'] ?> 
                                                    
                                                </td>
                                                <?php 
                                               }
                                               else 
                                               {
                                                ?>
                                                <td></td>
                                                <td></td>

                                                <?php 
                                               }
                                               ?>
                                            </tr>
                                        <?php 


                                        }

                                        
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

                     <?php 
                     }
                    ?>
                        









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
    <script src="js/reduire.js"></script>

</body>

</html>
