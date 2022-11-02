<?php
session_start();
$message = "";
?>



<?php
require_once('./access.php');
$ac = new Access();
$con= $ac->connection();

if (isset($_POST['ps']) && isset($_POST['pwd'])) {

    $login = $_POST['ps'];
    $password = $_POST['pwd'];
  
    
$login1 = htmlspecialchars($login);
    
 $password1 = htmlspecialchars($password);
    $req2 = $con->prepare("SELECT * FROM admin WHERE Login=('$login1') AND Password =('$password1')");
    $req2->execute();
    $res = $req2->fetch();

    $req = $con->prepare("SELECT * FROM user WHERE email=('$login1') AND password =('$password1')");
    $req->execute();
    $res2 = $req->fetch();

    if ($res) {
        $_SESSION['login'] = $login;
        header("location:Admin/Accueil.php");
    } 

    else if ($res2)
    {
 $_SESSION['login'] = $login;
        header("location:Employe/AccueilE.php");


    }
    else
        {
        
echo ' <script>alert("Mot de passe ou identifiant incorrect ❌!")</script>';


    }
}





?>