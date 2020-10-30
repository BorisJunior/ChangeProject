<?php  
require_once('access.php');
$ac = new Access();
$con= $ac->connection();

if (!empty($_POST['nom']&&$_POST['code']&&$_POST['symbole']&&$_POST['achat']&&$_POST['vente']&&$_POST['capital']&&$_POST['taux_achat']&&$_POST['taux_vente'])) {

$nom=$_POST['nom'];
$code=$_POST['code'];
$symbole=$_POST['symbole'];
$achat=$_POST['achat'];
$vente=$_POST['vente'];
$capital=$_POST['capital'];
$tauxa=$_POST['taux_achat'];
$tauxv=$_POST['taux_vente'];

$req = $con->prepare("INSERT INTO `devise` (`nom`, `code`, `symbole`, `achat`, `vente`, `capital`, `taux_achat`, `taux_vente`)
					VALUES('$nom','$code','$symbole', '$achat', '$vente', '$capital', '$tauxa', '$tauxa')");

$req->execute();

header("location: Currency.php");
}  else {
  echo "<div class='alert alert-danger' role='alert'><center>
      VEUILLEZ RENSEIGNER TOUS LES CHAMPS
     </center></div>";
  }

?>