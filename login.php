<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         $header = 'Login Success!';
         $message[] = 'Welcome <b>admin</b> '.$_SESSION['admin_name'].' !';
         $page_name = "'admin_page.php'";

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         $header = 'Login Success!';
         $message[] = 'Welcome user '.$_SESSION['user_name'].' !'; 
         $page_name = "'home.php'";

      }

   }else{
      $header = 'Error!';
      $message[] = 'Incorrect email or password!';
      $page_name = "'login.php'"; 
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Bootstrap CDN -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/styleWeb.css">

</head>
<body>
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   <?php
   if(isset($message)){
      foreach($message as $message){
         echo '<script>$(document).ready(function(){ $("#myModal").modal("show"); });</script>
         <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title">'.$header.'</h4>
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  
                  <div class="modal-body">
                     <p>'.$message.'</p>
                  </div>
                  
                  <div class="modal-footer">
                     <button type="button" class="btn btn-default" data-dismiss="modal" onclick="window.location.href='.$page_name.'">Close</button>
                  </div>
               </div>

            </div>
         </div>
         ';
      }
   }
   ?>
   <section class="vh-100">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-6 px-0 d-none d-sm-block">
               <img src="./images/login.png"
               alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
            <div class="col-sm-6 p-0 text-black">
               <div class="px-5 ms-xl-4">
                  <i class="fas fa-code text-dark fa-2x me-3 pt-5 mt-xl-4"></i>
                  <span class="h3 font-rubik mb-0 font-weight-600">VNDC Tech</span>
               </div>
               <div class="d-flex p-5 ml-4 ms-xl-4 mt-5 pt-5 pt-xl-5" style="max-width: 40rem;">
                     <form method="post" class="card shadow-lg w-100 p-3 border border-dark text-center">
                        <h3 class="m-auto pb-4 font-rubik">Login now</h3>
                        <input type="email" name="email" placeholder="enter your email" required class="box mx-4 p-2 mb-3 border rounded border-dark">
                        <input type="password" name="password" placeholder="enter your password" required class="box mx-4 mb-3 p-2 border rounded border-dark">
                        <input type="submit" name="submit" value="Login" class="font-baloo btn btn-dark w-25 m-auto  color-white">
                        <p class="mx-auto pt-3 font-rale">Don't have an account? <a href="register.php" class="text-decoration-none">Register Now</a></p>
                     </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   </body>
</html>