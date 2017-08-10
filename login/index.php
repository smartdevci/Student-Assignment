<?php

    session_start();
    session_unset();
?>


<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">

<?php
    include 'Inc/head-balise.php';
?>
<body>

<div style="margin-bottom: 100px;">
<?php
    //include 'Inc/navbar.php';
?>
</div>

<?php
    include 'Inc/login-section.php';
?>

<div class="navbar-fixed-bottom" style="padding: 0; margin: 0;">
    <?php
        //include 'Inc/footer.php';
    ?>
</div>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="js/connexion.js"></script>
	
<!-- Scrolling Nav JavaScript -->

</body>
</html>

<?php
session_destroy();
?>
