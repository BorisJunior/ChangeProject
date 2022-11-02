 <?php
session_start();
$message = "";
?>

<?php
$idd = $_GET['id'];

 

    require_once('access.php');
    $ac = new access();
    $con = $ac->connection();

 $req=$con->prepare("DELETE FROM `client` WHERE `client`.`id_client` = '$idd'");
$req->execute();

header("location: Clients.php");
 


?>