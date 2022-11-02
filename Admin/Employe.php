<?php
session_start();

$session=$_SESSION['login'];


    require_once('access.php');
    $ac = new access();
    $con = $ac->connection();


    if (!$session) {
      header("location:404.html");
    }
    

$req=$con->prepare("SELECT * FROM `user`");

$req->execute();

$data = $req->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Liste des Employés</title>

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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Accueil.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="Accueil.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Accueil</span></a>
      </li>

      <!-- Divider -->
      <!-- Nav Item - Pages Collapse Menu -->

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="Clients.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Clients</span></a>
      </li>

        <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link =" href="Employe.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Liste Employés</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item ">
        <a class="nav-link" href="ListeDevise.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Liste Devises</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="listransac.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Liste Transactions</span></a>
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

          <!-- Topbar Search -->
           <form class="">
            <div class="input-group">
            <h4>Gérez vos employés</h4>  
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

         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employés</h1>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >Ajouter Employe</button>
          </div>

          <!-- Modal form -->

          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enregistrer Employe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
               <form class="user" action="ajoutemploye.php" method="POST">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="nom"  class="form-control form-control-user" id="exampleFirstName" placeholder="Nom">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="prenom" class="form-control form-control-user" id="exampleLastName" placeholder="Prenom">
                  </div>
                </div>
              <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="telephone" class="form-control form-control-user" id="exampleFirstName" placeholder="Telephone">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="email" class="form-control form-control-user" id="exampleLastName" placeholder="Email">
                  </div>
                </div>

                 <div class="form-group">
                  <input type="adresse" name="adresse" class="form-control form-control-user" id="exampleInputEmail" placeholder="Address">
                </div>
                 <div class="form-group">
                  <input type="text" name="password" class="form-control form-control-user" id="exampleInputEmail" placeholder="mot de passe">
                </div>
               
                 <div style="text-align: center;">
                 <button type="submit" class="btn btn-primary">Enregistrer Employe</button>
                 </div>
                </form>
      </div>
    </div>
  </div>
</div>

              
        <!-- End Modal --><!-- End Form-->

        <!-- Begin Page Content -->
        <div class="container-fluid">


          <!-- Page Heading -->
     
        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tableau des Employes</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Telephone</th>
                      <th>Email</th>
                     <th>mot de passe</th>
                      <th>Adresse</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                     <th>ID</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Telephone</th>
                      <th>Email</th>
                      <th>mot de passe</th>
                      <th>Adresse</th>
                      <th>Actions</th>
                    </tr>
                  </tfoot>
                  <tbody>
                     <?php
            foreach ($data as $elt) { ?>
    <tr>
      <td><?php echo $elt['id'] ?></td>
     
  
    
      <td><?php echo $elt['nom_user'] ?></td>
     
    
    
      <td><?php echo $elt['prenom_user'] ?></td>
    
  
      <td><?php echo $elt['tel_user'] ?></td>
    
    
      <td><?php echo $elt['email'] ?></td>


      <td><?php echo $elt['password'] ?></td>
    
   
      <td><?php echo $elt['adresse_user'] ?></td>
     <td class="">
              <a  href="modifemploye.php?id=<?php echo $elt['id'] ?>" > <button type="button"class="btn btn-success"><i class="fas fa-edit"></i></button></a>
           <a class="" href="#" data-toggle="modal" data-target="#SupModal"> <button type="button"class="btn btn-danger"><i class="far fa-trash-alt"></i></button></a>
            </td>
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

  <!-- Suppress Modal-->

  <div class="modal fade" id="SupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form class="user" action="supemploye.php" method="POST">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vraiment supprimer cet employé ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <div class="modal-body">Choisir "Supprimer "si vous voulez supprimer l'employé
               <form class="user" action="supemploye.php" method="POST" enctype="multipart/form-data">
        <input type="number" name="id" placeholder="Rentrez l'ID de l'employé">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
           <button class="btn btn-primary" type="submit" >Supprimer</button>
        </form>
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
