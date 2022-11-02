<?php
session_start();
$session=$_SESSION['login'];


    require_once('access.php');
    $ac = new access();
    $con = $ac->connection();


    if (!$session) {
      header("location:404.html");
    }
    

$req=$con->prepare("SELECT * FROM `transaction`  INNER JOIN `client` ON `client`.`id_client` = `transaction`.`id_client`  INNER JOIN `devise` ON `devise`.`id_devise` = `transaction`.`id_devise`");

$req->execute();


$data = $req->fetchAll();



$req2=$con->prepare("SELECT * FROM `devise`");

$req2->execute();

$data2 = $req2->fetchAll();






$req3=$con->prepare("SELECT * FROM `transaction` INNER JOIN `devise` ON `devise`.`id_devise` = `transaction`.`id_devise` WHERE `type` ='Ajout de Capital' ");

$req3->execute();


$data3 = $req3->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Liste des transactions</title>

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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="AccueilE.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item ">
        <a class="nav-link" href="AccueilE.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Accueil</span></a>
      </li>

      <!-- Divider -->
     
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item ">
        <a class="nav-link =" href="ClientsE.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Clients</span>
        </a>
      </li>


      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="ListeDeviseE.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Liste Devises</span></a>
      </li>


      <li class="nav-item active">
        <a class="nav-link" href="listransacE.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Liste Transactions</span></a>
      </li>

      <!-- Nav Item - Tables -->

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

          <!-- Topbar Search -->
          <form class="">
            <div class="input-group">
            <h4>Consultez toutes les transactions effectuées</h4>  
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Administrateur</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
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

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Capital</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
               <form class="user" action="ajoutcapitalE.php" method="POST">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" name="montant"  class="form-control form-control-user" id="exampleFirstName" placeholder="montant">
                  </div>
                  <div class="col-sm-6">
                    <select class="form-control" name="devise">

                    <?php 
                     foreach ($data2 as $key ) {
                    
                        echo "<option value='".$key['id_devise']."'>".$key['nom']."</option>";
                                                }
                    ?>
                    
                  </select>
                  </div>
                </div>
               
                 <div style="text-align: center;">
                 <button type="submit" class="btn btn-primary">Ajouter Capital</button>
                 </div>
                </form>
      </div>
    </div>
  </div>
</div>

              <!-- Page Heading -->
         
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Transactions</h1>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >Ajouter Capital</button>
          </div>

        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste de transactions</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Type Transaction</th>
                      <th>Montant</th>
                      <th>Devise</th>
                      <th>Nom Client</th>
                      <th>Prenom Client</th>
                      <th>Adresse</th>
                      <th>Date</th>
                      <th>Actions</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>ID</th>
                      <th>Type Transaction</th>
                      <th>Montant</th>
                      <th>Devise</th>
                      <th>Nom Client</th>
                      <th>Prenom Client</th>
                      <th>Adresse</th>
                      <th>Date</th>
                      <th>Actions</th>
                     
                    </tr>
                  </tfoot>
                  <tbody>


                     <?php
            foreach ($data as $elt) { ?>
    <tr>
      <td><?php echo $elt['id_transaction'] ?></td>
     
  
    
      <td><?php echo $elt['type'] ?></td>
     
    
    
      <td><?php echo $elt['montant'] ?></td>


      <td><?php echo $elt['nom'] ?></td>
    
  
      <td><?php echo $elt['nom_client'] ?></td>
    
    
      <td><?php echo $elt['prenom_client'] ?></td>
    
   
      <td><?php echo $elt['adresse'] ?></td>


      <td><?php echo $elt['date_operation'] ?></td>


      <td class="">
       
           <a  href="imprimertranscE.php?id=<?php echo $elt['id_transaction'] ?>" >  <button type="button" data-toggle="modal" data-target="#exampleModal"  class="btn btn-info"><i class="fas fa-print"></i></button></a>
        </td>

    
    </tr>
  <?php
            } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>


                    <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Liste des ajouts de capitaux</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Type Transaction</th>
                      <th>Montant</th>
                      <th>Devise</th>
                      <th>Date</th>
                      <th></th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>ID</th>
                      <th>Type Transaction</th>
                      <th>Montant</th>
                      <th>Devise</th>
                      <th>Date</th>
                      <th></th>
                     
                    </tr>
                  </tfoot>
                  <tbody>


                     <?php
            foreach ($data3 as $elt) { ?>
    <tr>
      <td><?php echo $elt['id_transaction'] ?></td>
     
  
    
      <td><?php echo $elt['type'] ?></td>
     
    
    
      <td><?php echo $elt['montant'] ?></td>


      <td><?php echo $elt['nom'] ?></td>
    

      <td><?php echo $elt['date_operation'] ?></td>

    
    </tr>
  <?php
            } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>



        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      
      <!-- Footer -->
    
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Se déconnecter?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Choisir "Logout"si vous voulez quitter la session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
