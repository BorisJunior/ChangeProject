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



 header("location:Clients.php");



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Clients</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
  <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="Accueil.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Accueil</span></a>
      </li>

      
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link =" href="Clients.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Clients</span>
        </a>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="ListeDevise.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Liste</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="Employe.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Employes</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <form class="form-inline">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>
          </form>

          

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto"><!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrateura</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        

        <!-- Modal  -->

          <!-- Modal form -->


              
        <!-- End Modal --><!-- End Form-->

        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Transactions</h1>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Transactions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
               <form class="user" action="Clients.php" method="POST">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">

             
  
      <div class="form-group">
                  <input type="number" name="taux" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo $t ?>" disabled >
                </div>

               
                 <div style="text-align: center;">
                 <button type="submit" class="btn btn-primary">Enregistrer Transaction</button>
                 </div>
                </form>
      </div>
    </div>



        </div>
    

      </div>

      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
  
    


  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script><!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
