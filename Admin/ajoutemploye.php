<?php  
require_once('access.php');
$ac = new Access();
$con= $ac->connection();

if (!empty($_POST['nom']&&$_POST['prenom']&&$_POST['telephone']&&$_POST['email']&&$_POST['adresse'])) {

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$telephone=$_POST['telephone'];
$email=$_POST['email'];
$adresse=$_POST['adresse'];
$pwd= $_POST['password'];



$req = $con->prepare("INSERT INTO user (email,password,nom_user, prenom_user, tel_user, adresse_user)
					VALUES('$email','$pwd','$nom','$prenom','$telephone','$adresse')");

$req->execute();

header("location: Employe.php");
}  
else {
  echo "<div class='alert alert-danger' role='alert'><center>
      VEUILLEZ RENSEIGNER TOUS LES CHAMPS
     </center></div>";
  }

?>