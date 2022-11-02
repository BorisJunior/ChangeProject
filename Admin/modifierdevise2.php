<?php

require_once('./access.php');
$ac = new access();
$con = $ac->connection();

if (isset($_POST['idde'])) {
    $idd= $_POST['idde'];
    $ta = $_POST['taux_achat'];
    $tv = $_POST['taux_vente'];
   


    $req = $con->prepare("UPDATE devise SET taux_achat= '$ta',
                                            taux_vente= '$tv'
                                       
                                    WHERE id_devise= '$idd';
                        ");
    $req->execute();
  header("location:ListeDevise.php");
  
   
}
 
?>
