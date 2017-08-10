<?php 
 include 'redirect.php';
// include 'all_class.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Assignation</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <link href="css/plugins/morris.css" rel="stylesheet">


    

  

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
             <?php include 'menu.php'; ?>    
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Mot de passe
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Tableau de bord</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-lock"></i> Mot de passe
                            </li>
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-1">
                        <div class="form-group">
                           <label for="old_password">Ancien mot de passe</label>
                           <input class="form-control input-lg" id="old_password" type="password">
                         </div>
                    </div>
                </div>

                <div class="alert alert-danger ancien_mot_de_passe_incorrect hidden col-lg-8 col-md-8 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-1">
                  <strong> Votre mot de passe est incorrect</strong> 
                </div>

                
  
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-1">
                        <div class="form-group">
                           <label for="new_password">Nouveau mot de passe</label>
                           <input class="form-control input-lg" id="new_password" type="password">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-1">
                        <div class="form-group">
                           <label for="retaper_nouveau">Retaper nouveau mot de passe</label>
                           <input class="form-control input-lg" id="retaper_nouveau" type="password">
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-lg-offset-2 col-md-offset-2 col-sm-offset-3">
                         <input class="btn btn-primary btn-lg" type="button" id="valider_changement_mot_de_passe" style="width: 160px;" value="VALIDER" alt="1"/>
                    </div>
                </div>

                
                <div class="alert alert-success modification_reussie hidden">
                  <strong>Votre mot de passe a été modifié avec succès</strong>
                </div>

                <div class="alert alert-danger mots_de_passe_non_conforme hidden">
                  <strong> Les deux mots de passe ne sont pas conformes</strong>
                </div>





            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/mot_de_passe.js"></script>

</body>

</html>
