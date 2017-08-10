<?php 
$_SESSION['page']="password";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Password</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        


        <?php 
        require 'menu.php';
        ?>





        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Password
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="./">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-lock"></i> Password
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable mot_de_passe_genere <?php echo ($p->password_changed)?'hidden':'' ?>">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>   Your password has been generated automatically, Please modify it immediately 
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" method="POST" action="">

                            <div class="form-group">
                                 <label for="separateur_ligne">Actual password</label>
                                <input class="form-control" placeholder=""   name="old_password" id="old_password" type="password" />
                                <!--<p class="help-block">Example block-level help text here.</p>-->
                            </div>

                            <div class="alert alert-danger  alert_format_incorrect ancien_mot_de_passe hidden"> <a data-dismiss="alert" class="close">×</a>
                              password wrong
                            </div>

                            <div class="form-group">
                                <label  for="new_password">New password</label>
                                <input class="form-control" placeholder="" name="new_password" id="new_password" type="password"/>
                            </div>

                            <div class="form-group">
                                <label  for="retaper_new_password">Retype new password</label>
                                <input class="form-control" placeholder="" name="new_password" id="retaper_new_password" type="password">
                            </div>

                            
                            <div class="alert alert-danger  alert_message_erreur hidden"> <a data-dismiss="alert" class="close">×</a>
                              
                            </div>
                            
                            <div class="alert alert-success  alert_message_password_modifie hidden"> <a data-dismiss="alert" class="close">×</a>
                                Your password has been changed successfully 
                            </div>
 

                            <input type="button"  class="btn bouton_valider_modification_password btn-default" value="Valider" />
                            <button type="reset" class="btn btn-default">Reset</button>

                        </form>

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
    <script src="js/a.js"></script>


</body>

</html>





