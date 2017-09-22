 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Wallet Management</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
               
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $p->name ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!--<li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>-->
                       <li class="divider"></li>
                        <li>
                            <a href="logout/"><i class="fa fa-fw fa-power-off"></i> Disconnect</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                <?php 
                if($p->type==0)
                {
                ?>
                <!-------------------------SECTION ADMIN-------------------------->
                <!-------------------------SECTION ADMIN-------------------------->
                <!-------------------------SECTION ADMIN-------------------------->
               
                    <li class="<?php echo (isset($_SESSION['page']) && $_SESSION['page']=="index")?"active":"" ?> admin">
                        <a href="./"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="<?php echo (isset($_SESSION['page']) && $_SESSION['page']=="import")?"active":"" ?> admin">
                        <a href="import.php"><i class="fa fa-fw fa-edit"></i> Import from Moodle</a>
                    </li>
                    <li class="<?php echo (isset($_SESSION['page']) && $_SESSION['page']=="consultation")?"active":"" ?> admin">
                        <a href="consultations.php"><i class="glyphicon glyphicon-list-alt"></i> Consultations</a>
                    </li>
                    <li class="<?php echo (isset($_SESSION['page']) && $_SESSION['page']=="etudiant")?"active":"" ?> admin">
                        <a href="etudiant.php"><i class="fa fa-users"></i> Students</a>
                    </li>

                    <li class="<?php echo (isset($_SESSION['page']) && $_SESSION['page']=="user")?"active":"" ?> user">
                        <a href="user.php"<i class="fa fa-user"></i> Users </a>
                    </li>


                   <!-- <li class="admin <?php echo (isset($_SESSION['page']) && $_SESSION['page']=="password")?"active":"" ?> user" >
                        <a href="javascript:;"><i class="fa fa-user"></i> Users</a>
                        <ul id="demo" class="collapse">
                            <li  class="all_users" >
                                <a href="password.php">Change my password</a>
                            </li>
                            <li  class="admin" >
                                <a href="">Reset student password</a>
                            </li>

                        </ul>
                    </li>
                    <!--<li class="admin">
                        <a href="monnaie_adm.php"><i class="fa fa-money fa-fw"></i> Students Wallet </a>
                    </li>-->
                    <!--
                    <li class="<?php echo (isset($_SESSION['page']) && $_SESSION['page']=="password")?"active":"" ?> all_users">
                        <a href="password.php"><i class="glyphicon glyphicon-lock"></i> Password</a>
                    </li>
                    -->
                    
                    <li class="all_users <?php echo (isset($_SESSION['page']) && $_SESSION['page']=="password")?"active":"" ?> " >
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="glyphicon glyphicon-lock"></i> Password <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li  class="all_users" >
                                <a href="password.php">Change my password</a>
                            </li>
                            <!--<li  class="admin" >
                                <a href="">Reset student password</a>
                            </li>-->
                             
                        </ul>
                    </li>
                    
                    <!--<li class="admin">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-database"></i> Data <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="etudiant.php">Students</a>
                            </li>
                            <li>
                                <a href="consultations.php">Consultations</a>
                            </li>
                             
                        </ul>
                    </li>-->
                    <li class="all_users">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="glyphicon glyphicon-question-sign"></i> Help <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo2" class="collapse">
                            <li>
                                <a href="etudiant.php">Faire une importation</a>
                            </li>
                            <li>
                                <a href="consultations.php">Modifier une consultation</a>
                            </li>
                            <li>
                                <a href="vider.php"><i class="glyphicon glyphicon-trash"></i> Vider base de données</a>
                            </li>
                             
                        </ul>
                    </li>
                    <li class="all_users">
                        <a href="logout/"><i class="fa fa-power-off"></i> Disconnect</a>
                    </li>
                <?php 

                }
                else if($p->type==1)
                {
                ?>
                <!-------------------------SECTION ETUDIANT-------------------------->
                <!-------------------------SECTION ETUDIANT-------------------------->
                <!-------------------------SECTION ETUDIANT-------------------------->

                    <li class=" student <?php echo (isset($_SESSION['page']) && $_SESSION['page']=="index")?"active":"" ?>">
                        <a href="./"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li class="student <?php echo (isset($_SESSION['page']) && $_SESSION['page']=="monnaie")?"active":"" ?>">
                        <a href="monnaie.php"><i class="fa fa-money fa-fw"></i> Wallet</a>
                    </li>
                   <li class="student <?php echo (isset($_SESSION['page']) && $_SESSION['page']=="choice")?"active":"" ?>">
                        <a href="choice.php"><i class="fa fa-money fa-fw"></i> Choices</a>
                    </li>
                    <li class="all_users <?php echo (isset($_SESSION['page']) && $_SESSION['page']=="password")?"active":"" ?>">
                        <a href="password.php"><i class="glyphicon glyphicon-lock"></i> Password</a>
                    </li>

                   
                   <!--<li class="all_users <?php echo (isset($_SESSION['page']) && $_SESSION['page']=="index")?"active":"" ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo2"><i class="glyphicon glyphicon-question-sign"></i> Help <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo2" class="collapse">
                            <li>
                                <a href="etudiant.php">Faire une importation</a>
                            </li>
                            <li>
                                <a href="consultations.php">Modifier une consultation</a>
                            </li>
                            
                        </ul>
                    </li>-->
                    <li class="all_users ">
                        <a href="logout/"><i class="fa fa-power-off"></i> Disconnect</a>
                    </li>




                <?php 
                }
                ?>
                    



                    


                    
                   <!--<li>
                        <a href="profile.php"><i class="glyphicon glyphicon-user"></i> Profile</a>
                    </li>-->
                    

                    
                   
                    
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>


        