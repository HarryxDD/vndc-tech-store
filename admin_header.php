<?php
if(isset($message)){
   foreach($message as $message){
      echo '<script>$(document).ready(function(){ $("#myModal").modal("show"); });</script>
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">Alert</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <div class="modal-body">
                     <p>'.$message.'</p>
                  </div>
                  
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
               </div>

            </div>
         </div>
         ';
   }
}
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
   <!-- Container wrapper -->
   <div class="container">
      <!-- Toggle button -->
      <!-- " -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon font-size-12"></span>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
         <!-- Navbar brand -->
         <a class="navbar-brand mt-2 mt-lg-0 text-decoration-none font-rubik font-size-20 text-dark font-weight-bold" href="admin_page.php"><i class="fas fa-code  fa-1x"></i> VNDC Tech</a>
         <!-- Left links -->
         <ul class="navbar-nav mb-2 mb-md-0 m-auto">
            <li class="nav-item active">
               <a class="nav-link pr-5 text-decoration-none text-dark font-rubik text-capitalize"  href="admin_page.php" >Home</a>
            </li>
            <li class="nav-item">
               <a class="nav-link pr-5 text-decoration-none text-dark font-rubik text-capitalize" href="admin_products.php">Products</a>
            </li>
            <li class="nav-item">
               <a class="nav-link pr-5 text-decoration-none text-dark font-rubik text-capitalize" href="admin_orders.php">orders</a>
            </li>
            <li class="nav-item">
               <a class="nav-link pr-5 text-decoration-none text-dark font-rubik text-capitalize" href="admin_users.php">users</a>
            </li>
            <li class="nav-item">
               <a class="nav-link pr-5 text-decoration-none text-dark font-rubik text-capitalize" href="admin_contacts.php">Feedback</a>
            </li>
         </ul>
      </div>

      <!-- Right elements -->
      <div class="d-flex align-items-center">
         <div class="dropdown">
            <div id="user-btn" class="fas fa-user" data-toggle="dropdown"></div>
            <div class="dropdown-menu p-0 w-auto" aria-labelledby="navbarDropdownMenuLink" style="left:-185px; width:200px">
               <p class="px-3 pt-3">Username : <span class="color-primary font-size-16"><?php echo $_SESSION['admin_name']; ?></span></p>
               <p class="px-3" style="margin-top:-10px;">Email : <span class="color-primary font-size-16"><?php echo $_SESSION['admin_email']; ?></span></p>
               <hr class="dropdown-divider p-0">
               <p class="p-0 text-center font-weight-bold"><a href="logout.php" class="delete-btn text-danger text-decoration-none" onclick="alert('Admin has logged out!');">Logout</a></p>
            </div>
         </div>
      </div>
   </div>
</nav>
