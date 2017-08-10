<?php 
$_SESSION['page']="user";
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
                            User's management
                        </h1>
                        <ol class="breadcrumb">
                            
                            <li class="active">
                                <i class="fa fa-edit"></i> Users
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->


                <div class="row hidden block_action_effectue">
                    <div class="col-lg-12">
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>
                            <span class="texte_action">

                            </span>

                        </div>
                    </div>
                </div>

                <div class="row">





                    <div class="col-lg-6 col-md-6 ">

                        <form role="form" method="POST" action="">

                            
                            <fieldset>

                                <legend>Add new user</legend>



                                <!--<div class="form-group">
                                    <label  for="column_separator">User type</label>
                                    <select class="form-control"  name="user_type" id="user_type" >
                                         <?php //echo $list_user_type ?>
                                    </select>


                                </div>-->




                                 <div class="form-group">
                                    <label  for="name">Name</label>
                                    <input class="form-control" value="" name="name" id="name" required >
                                </div>









                                <div class="form-group">
                                    <label  for="login">Login</label>
                                    <input class="form-control" type="text" value="" name="login" id="login" required>
                                </div>

                                <div class="form-group">
                                    <label  for="password">Password</label>
                                    <input class="form-control"  type="password" value="" name="password" id="password" required>
                                </div>




                                <!--<div class="form-group">
                                    <label>Text area</label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>-->




                                <div class="boutons_pour_ajouter ">
                                    <button type="button" class="btn btn-default bouton_add_user">Add user</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>

                                <div class="boutons_valider_annuler hidden">
                                    <button type="button" class="btn btn-default bouton_edit_user_ok">OK</button>
                                    <button type="reset" class="btn btn-default bouton_cancel">Cancel</button>
                                </div>
                            </fieldset>

                        </form>

                    </div>








                    <div class="col-lg-6 col-md-6">

                        <fieldset>

                            <legend>Update/Delete user</legend>




                                <div class="form-group ">
                                    <label  for="column_separator">Users</label>
                                    <select class="form-control"  name="users_list" id="users_list"  multiple style="font-size: 1.5em; cursor: pointer; max-height: 100%" >
                                        <?php echo $list_user ?>
                                    </select>


                                </div>









                                <div class="hidden boutons_delete_edit">
                                    <button type="button" class="btn btn-default bouton_edit_user" id="bouton_edit">Edit user</button>
                                    <button type="reset" class="btn btn-default bouton_delete_user"  id="bouton_delete">Delete user</button>
                                </div>

                        </fieldset>

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
    <script src="js/users.js"></script>
   

</body>

</html>
