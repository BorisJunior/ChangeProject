<?php  
require_once('access.php');
$ac = new Access();
$con= $ac->connection();

if (!empty($_POST['nom']&&$_POST['prenom']&&$_POST['telephone']&&$_POST['email']&&$_POST['adresse']&&$_POST['prenom']&&$_FILES)) {

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$telephone=$_POST['telephone'];
$email=$_POST['email'];
$adresse=$_POST['adresse'];
$num = $_POST['nump'];



 $file_name1= $_FILES['copie_pass']['name'];
   
     $file_tmp_name1= $_FILES['copie_pass']['tmp_name'];
        
    $file_dest1='FichierClient/'.$file_name1;
      

      $file_extension= strrchr(  $file_name1,".");
    $extensions_autorisees= array('.pdf','.docx',);
    if(in_array($file_extension, $extensions_autorisees)){
        if (move_uploaded_file($file_tmp_name1, $file_dest1)) {

$req = $con->prepare("INSERT INTO client (nom_client, prenom_client, telephone_client, email, adresse,numero_pass,copie_pass)
          VALUES('$nom','$prenom','$telephone','$email','$adresse','$num' ,'$file_dest1')");

$req->execute();

header("location: ClientsE.php");
} 
} 
}else {
  echo "<div class='alert alert-danger' role='alert'><center>
      VEUILLEZ RENSEIGNER TOUS LES CHAMPS
     </center></div>";
  }

?>