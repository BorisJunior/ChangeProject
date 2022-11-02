 <?php
session_start();
$message = "";
?>

<?php
$idd = $_POST['id'];

 

    require_once('access.php');
    $ac = new access();
    $con = $ac->connection();

 $req=$con->prepare("DELETE FROM `devise` WHERE `devise`.`id_devise` = '$idd'");
$req->execute();

header("location: ListeDevise.php");
 


?>