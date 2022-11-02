 <?php
session_start();
$message = "";
?>



<?php
	$id = $_POST['id'];

 

    require_once('./access.php');
    $ac = new access();
    $con = $ac->connection();

 $req=$con->prepare("DELETE FROM `user` WHERE `user`.`id` = '$id'");
$req->execute();

header("location: Employe.php");
 


?>