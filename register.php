<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = 'user';

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'User already exist!';
      $page_name = "'register.php'";
   }else{
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
         $page_name = "'register.php'";
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'Registered successfully!';
         $page_name = "'login.php'";
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>register</title>

      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

      <!-- Bootstrap CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <!-- custom css file link  -->
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
                     <h4 class="modal-title">Alert</h4>
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
               alt="Register image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
            <div class="col-sm-6 p-0 text-black">
               <div class="px-4 pl-2 ms-xl-4">
                  <i class="fas fa-code text-dark fa-2x me-3 pt-1 mt-xl-4"></i>
                  <span class="h3 font-rubik mb-0 font-weight-600">VNDC Tech</span>
               </div>
               <div class="d-flex ml-4 ms-xl-4 mt-5 pt-xl-0 px-5" style="max-width: 40rem;">
                  <form action="" method="post" class="card shadow-lg w-100 p-1 border border-dark text-center">
                     <h3 class="mx-auto py-4 font-rubik font-weight-bold text-capitalize">register now</h3>
                     <input type="text" name="name" placeholder="enter your name" required class="box mx-4 p-2 mb-3 border rounded border-dark">
                     <input type="email" name="email" placeholder="enter your email" required class="box mx-4 p-2 mb-3 border rounded border-dark">
                     <input type="password" name="password" placeholder="enter your password" required class="box mx-4 p-2 mb-3 border rounded border-dark">
                     <input type="password" name="cpassword" placeholder="confirm your password" required class="box mx-4 p-2 mb-3 border rounded border-dark">
                     <!-- <select name="user_type" class="box mx-4 p-2 border rounded border-dark text-capitalize">
                        <option value="user" class="text-capitalize">user</option>
                        <option value="admin" class="text-capitalize">admin</option>
                     </select> -->
                     <input type="submit" name="submit" value="register now" class="font-baloo btn btn-dark mx-auto my-3 color-white text-capitalize">
                     <p class="mx-auto font-rale text-capitalize text-center">already have an account? <a href="login.php" class="text-decoration-none">login now</a></p>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   </body>
</html>