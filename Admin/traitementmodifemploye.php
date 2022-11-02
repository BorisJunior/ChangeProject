<?php  
require_once('./access.php');
$ac = new Access();
$con= $ac->connection();

if (!empty($_POST['idemp']&&$_POST['nom']&&$_POST['prenom']&&$_POST['telephone']&&$_POST['email']&&$_POST['adresse'])) {
$id=$_POST['idemp'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$telephone=$_POST['telephone'];
$email=$_POST['email'];
$adresse=$_POST['adresse'];
$password=$_POST['pwd'];


$req = $con->prepare("UPDATE `user` SET `nom_user` = '$nom'  WHERE `id` = '$id'");
$req->execute();

$req = $con->prepare("UPDATE `user` SET `prenom_user` = '$prenom'  WHERE `id` = '$id'");
$req->execute();

$req = $con->prepare("UPDATE `user` SET `tel_user` = '$telephone'  WHERE `id` = '$id'");
$req->execute();

$req = $con->prepare("UPDATE `user` SET `email` = '$email'  WHERE `id` = '$id'");
$req->execute();

$req = $con->prepare("UPDATE `user` SET `password` = '$password'  WHERE `id` = '$id'");
$req->execute();

$req = $con->prepare("UPDATE `user` SET `adresse_user` = '$adresse'  WHERE `id` = '$id'");
$req->execute();



header("location: Employe.php");
}  else {
  echo "<div class='alert alert-danger' role='alert'><center>
      VEUILLEZ RENSEIGNER TOUS LES CHAMPS
     </center></div>";
  }

?>