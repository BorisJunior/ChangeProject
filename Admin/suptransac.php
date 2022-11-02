 <?php
session_start();
$message = "";
?>



<?php
	$id = $_POST['id'];

 

    require_once('access.php');
    $ac = new access();
    $con = $ac->connection();

 $req=$con->prepare("DELETE FROM `transaction` WHERE `transaction`.`id_transaction` = '$id'");
$req->execute();

header("location: listransac.php");
 


?>