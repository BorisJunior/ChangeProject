<?php  
require_once('./access.php');
$ac = new Access();
$con= $ac->connection();

if (!empty($_POST['idcli']&&$_POST['nom']&&$_POST['prenom']&&$_POST['telephone']&&$_POST['email']&&$_POST['adresse'])) {
$id=$_POST['idcli'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$telephone=$_POST['telephone'];
$email=$_POST['email'];
$adresse=$_POST['adresse'];


$req = $con->prepare("UPDATE `client` SET `nom_client` = '$nom'
										  WHERE `id_client` = '$id'");
$req->execute();



$req2 = $con->prepare("UPDATE `client` SET `prenom_client` = '$prenom'
										  WHERE `id_client` = '$id'");
$req2->execute();


$req3 = $con->prepare("UPDATE `client` SET `telephone_client` = '$telephone'
										  WHERE `id_client` = '$id'");
$req3->execute();


$req4 = $con->prepare("UPDATE `client` SET `email` = '$email'
										  WHERE `id_client` = '$id'");
$req4->execute();


$req5 = $con->prepare("UPDATE `client` SET `adresse` = '$adresse'
										  WHERE `id_client` = '$id'");
$req5->execute();



header("location: ClientsE.php");
}  else {
  echo "<div class='alert alert-danger' role='alert'><center>
      VEUILLEZ RENSEIGNER TOUS LES CHAMPS
     </center></div>";
  }

?>