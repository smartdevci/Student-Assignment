<?php 
$_SESSION['page']="import";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

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
        


        <?php 
        require 'menu.php';
        ?>





        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Import vote file
                        </h1>
                        <ol class="breadcrumb">
                            
                            <li class="active">
                                <i class="fa fa-edit"></i> Import from Moodle 
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" method="POST" action="" enctype="multipart/form-data">

                            
                            <div class="form-group">
                                 <label for="separateur_ligne">Academic year</label>
                                <select class="form-control"  name="academic_year" id="academic_year" >
                                    <?php 
                                    for($annee=date('Y');$annee>=2010;$annee--)
                                    {
                                        ?>
                                        <option value="<?php echo $annee.'-'.($annee+1) ?>" ><?php echo $annee."-".($annee+1) ?></option>
                                        <?php 
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label  for="column_separator">Semester</label>
                                <select class="form-control"  name="semester" id="semester" >
                                <?php echo $list_semester ?>
                                </select>

                                <input class="form-control hidden" placeholder="Saisir le nom du semestre" ="" name="nouveau_semestre" id="nouveau_semestre"  >
                            </div>
                            
                            
                            <div class="form-group">
                                <label  for="column_separator">Level</label>
                                <select class="form-control"  name="level" id="level" >
                                     <?php echo $list_level ?>
                                </select>

                            </div>
                            
                             

                             <div class="form-group">
                                <label  for="column_separator">Consultation name</label>
                                <input class="form-control" value="<?php echo $consultation_name ?>" name="consultation_name" id="consultation_name" required >
                            </div>




                            <div class="form-group">
                                <label for="fichier_vote">Vote file (.csv)</label>
                                <input type="file" id="fichier_vote" class="form-control" name="fichier" value="ok" required />
                            </div>


                            <div class="alert alert-danger  alert_format_incorrect hidden"> <a data-dismiss="alert" class="close">×</a>
                              Please select a csv file
                             </div>
                             
                            

                            <div class="form-group">
                                <label  for="column_separator">Minimal bid</label>
                                <input class="form-control" type="number" value="0" name="min_bid" id="min_bid" required>
                            </div>

                            <div class="form-group">
                                <label  for="column_separator">Maximal bid</label>
                                <input class="form-control"  type="number" value="20" name="max_bid" id="max_bid" required>
                            </div>


                            <div class="form-group">
                                <label  for="column_separator">Nombre de jetons à mettre dans le purse</label>
                                <input class="form-control" type="number"  value="0" name="nombre_jeton_purse" id="nombre_jeton_purse" required >
                            </div>

                            <!--<div class="form-group">
                                <label>Text area</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>-->

                            

                            

                            <button type="submit" class="btn btn-default">Import vote data</button>
                            <button type="reset" class="btn btn-default">Reset</button>

                        </form>

                    </div>
                    
                </div>
                <!-- /.row -->




                <div class="row">
                 <?php 
                    if(isset($_POST['consultation_name']))
                    {
                        require 'importation.php';
                    }
                 ?>

                </div>

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
    <script src="js/import.js"></script>
    <script src="js/modification_import.js"></script>
   

</body>

</html>
