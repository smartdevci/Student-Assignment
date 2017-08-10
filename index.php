<?php
session_start();
if(isset($_SESSION['student']))
{
    if($_SESSION['student']['type']==0)
    {
        include 'modele/modele_index.php';
        include 'vue/vue_index.php';

    }
    else if($_SESSION['student']['type']==1)
    {
        include 'modele/modele_index_student.php';
        include 'vue/vue_index_student.php';
    }
}
else
{
    header('Location:./login/');
}

?>