   <?php
session_start();
require_once('./access.php');
$dateop =date("Y-m-d H:i:s");
$ac = new access();
$con = $ac->connection();
$idc = $_POST['idc'];
$tp =$_POST['type'] ;
  $devise= $_POST['devise'];
$mt= $_POST['montant'];

  $req001= $con->prepare("SELECT taux_achat FROM devise
  WHERE devise.id_devise ='$devise';");
    $req001->execute();
$data0 =$req001->fetch();
$ta = intval($data0[0]) ; 

  $req002= $con->
  prepare("SELECT taux_vente FROM devise
  WHERE devise.id_devise ='$devise';");
    $req002->execute();
$data1 =$req002->fetch();
$tv = intval($data1[0]) ;

$tach = 'Achat';
$tvente ='Vente';
if( $tp == $tach){
   $req003= $con->
  prepare("SELECT capital FROM devise
  WHERE devise.id_devise ='$devise';");
    $req003->execute();
$data2 =$req003->fetch();
$mtd = intval($data2[0]) ;

  $req004= $con->
  prepare("SELECT capital FROM devise
  WHERE devise.id_devise ='1';");
    $req004->execute();
$data3 =$req004->fetch();
$mtdb = intval($data3[0]) ;

$mtf =$mtd +$mt;
$req = $con->prepare("UPDATE devise SET capital= '$mtf' WHERE id_devise= '$devise';
                        ");
    $req->execute();

$t=$ta * $mt;
if ($t>$mtdb) {
echo ' <script>alert("Transaction impossible ,devise de base insuffisante❌!")</script>';
}
else{
  $cpf = $t -$mtdb;
$req228 = $con->prepare("UPDATE devise SET capital= '$cpf'
                                       
                                    WHERE id_devise= '1';
                        ");
    $req228->execute();

}

}
 elseif( $tp == $tvente) {
   $req003 = $con->prepare("SELECT capital FROM devise
  WHERE devise.id_devise ='$devise';");
    $req003->execute();
$data2 =$req003->fetch();
$mtd = intval($data2[0]) ;

  $req004= $con->
  prepare("SELECT capital FROM devise
  WHERE devise.id_devise ='1';");
    $req004->execute();
$data3 =$req004->fetch();
$mtdb = intval($data3[0]) ;



if ($mt>$mtd) {
echo ' <script>alert("Transaction impossible ,devise  insuffisante❌!")</script>';
}
else{
  $t=$tv* $mt;

$mtf =$mtd - $mt;
$req = $con->prepare("UPDATE devise SET capital= '$mtf'
                                       
                                    WHERE id_devise= '$devise';
                        ");
    $req->execute();
 $cpf = $t +$mtdb;
$req228 = $con->prepare("UPDATE devise SET capital= '$cpf'
                                       
                                    WHERE id_devise= '1';
                        ");
    $req228->execute();


}




}


$req2 = $con->prepare("INSERT INTO transaction(id_devise, montant, type, id_client, date_operation)
                                        VALUES('$devise', '$mt', '$tp', '$idc','$dateop')
                        ");
    $req2->execute();



 header("location:ClientsE.php");



?>

