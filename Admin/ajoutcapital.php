  <?php
session_start();
require_once('./access.php');
$dateop =date("Y-m-d H:i:s");
$ac = new access();
$con = $ac->connection();
$mt= $_POST['montant'];
$devise= $_POST['devise'];


 $req003= $con->
  prepare("SELECT capital FROM devise
  WHERE devise.id_devise ='$devise';");
    $req003->execute();
$data2 =$req003->fetch();
$mtd = intval($data2[0]) ;


$req2 = $con->prepare("INSERT INTO transaction(id_devise, montant, type, id_client, date_operation)
                                        VALUES('$devise', '$mt', 'Ajout de Capital', NULL ,'$dateop')
                        ");
    $req2->execute();



$mtf = $mt + $mtd;
$req = $con->prepare("UPDATE devise SET capital= '$mtf' WHERE id_devise= '$devise';
                        ");
    $req->execute();


 header("location:listransac.php");



?>

