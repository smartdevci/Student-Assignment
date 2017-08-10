<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top" style="color: #ffd700; margin-right: 50px; margin-top: 0; position: relative; top: -10px;">
                <img src="../image/logo.png" width="60">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="navbar-collapse collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <!--<li class="pull-left" style="position: relative; left: -250px; font-size: 1.5em;">
                    <h4 style="font-size: inherit; color: #ffec0f; margin-top: 12px;">Tontine 50</h4>
                </li>-->
                <li>
                    <a class="page-scroll" <?php echo(isset($_SESSION["accueil"])) ? 'href="../#about"':'href="../#about"'; ?>>Présentation</a>
                </li>
                <li>
                    <a class="page-scroll" <?php echo(isset($_SESSION["accueil"])) ? 'href="../#services"':'href="../#services"'; ?>>Comment participer</a>
                </li>
                <li>
                    <a class="page-scroll" <?php echo(isset($_SESSION["accueil"])) ? 'href="../#inscription"':'href="../#inscription"'; ?>>Inscription</a>
                </li>
                <li>
                    <a class="page-scroll" href="">Mon compte</a>
                </li>
                <li>
                    <a class="page-scroll" <?php echo(isset($_SESSION["accueil"])) ? 'href="../#contact"':'href="../#contact"'; ?>>Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
