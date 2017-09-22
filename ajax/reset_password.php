<?php
/**
 * Created by PhpStorm.
 * User: Melaine
 * Date: 03/08/2017
 * Time: 13:41
 */


session_start();
if(isset($_GET['student_id']))
{

    $student_id=$_GET['student_id'];
    include '../all_class.php';
    $password=Student::resetPassword();
    $connexion=DAO::getConnection();

    $query=$connexion->prepare("
        UPDATE students SET password=:password, password_changed=0 WHERE student_id=:student_id
    ");

    $query->bindValue(':password',$password,PDO::PARAM_STR);
    $query->bindValue(':student_id',$student_id,PDO::PARAM_INT);
    $query->execute();


    echo $password;
}
else
{

}



?>