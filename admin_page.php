<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin</title>

      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

      <!-- Bootstrap CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <!-- custom admin css file link  -->
      <link rel="stylesheet" href="css/styleWeb.css">
      

   </head>
   <body>
      
   <?php include 'admin_header.php'; ?>

   <!-- admin dashboard section starts  -->

   <section class="dashboard" style="margin-top: 50px;">
      <h1 class="text-center font-rubik py-5 font-weight-bold text-uppercase ">
         Dashboard
      </h1>

      <div class="container">
         <div class="row d-flex flex-wrap justify-content-center">
            <div class="col-lg-4 text-center px-2 py-3 border rounded border-dark m-2">
               <?php
                  $total_pendings = 0;
                  $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
                  if(mysqli_num_rows($select_pending) > 0){
                     while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                        $total_price = $fetch_pendings['total_price'];
                        $total_pendings += $total_price;
                     };
                  };
               ?>
               <p class="font-size-20 font-rubik font-weight-bold text-capitalize py-1 my-auto">total pendings</p>
               <h1 class="font-rubik my-auto font-weight-bold text-danger">$<?php echo $total_pendings; ?></h1>
            </div>

            <div class="col-lg-4 text-center px-2 py-3 border rounded border-dark m-2">
               <?php
                  $total_completed = 0;
                  $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
                  if(mysqli_num_rows($select_completed) > 0){
                     while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                        $total_price = $fetch_completed['total_price'];
                        $total_completed += $total_price;
                     };
                  };
               ?>
               <p class="font-size-20 font-rubik font-weight-bold text-capitalize py-1 my-auto">completed payments</p>
               <h1 class="font-rubik my-auto font-weight-bold text-success">$<?php echo $total_completed; ?></h1>
            </div>

            <div class="col-lg-4 text-center px-2 py-3 border rounded border-dark m-2">
               <?php 
                  $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                  $number_of_orders = mysqli_num_rows($select_orders);
               ?>
               <p class="font-size-20 font-rubik font-weight-bold text-capitalize py-1 my-auto">order placed</p>
               <h1 class="font-rubik my-auto font-weight-bold"><?php echo $number_of_orders; ?></h1>
            </div>

            <div class="col-lg-4 text-center px-2 py-3 border rounded border-dark m-2">
               <?php 
                  $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                  $number_of_products = mysqli_num_rows($select_products);
               ?>
               <p class="font-size-20 font-rubik font-weight-bold text-capitalize py-1 my-auto">products added</p>
               <h1 class="font-rubik my-auto font-weight-bold"><?php echo $number_of_products; ?></h1>
            </div>

            <div class="col-lg-4 text-center px-2 py-3 border rounded border-dark m-2">
               <?php 
                  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                  $number_of_users = mysqli_num_rows($select_users);
               ?>
               <p class="font-size-20 font-rubik font-weight-bold text-capitalize py-1 my-auto">normal users</p>
               <h1 class="font-rubik my-auto font-weight-bold"><?php echo $number_of_users; ?></h1>
            </div>

            <div class="col-lg-4 text-center px-2 py-3 border rounded border-dark m-2">
               <?php 
                  $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                  $number_of_admins = mysqli_num_rows($select_admins);
               ?>
               <p class="font-size-20 font-rubik font-weight-bold text-capitalize py-1 my-auto">admin users</p>
               <h1 class="font-rubik my-auto font-weight-bold"><?php echo $number_of_admins; ?></h1>
            </div>

            <div class="col-lg-4 text-center px-2 py-3 border rounded border-dark m-2">
               <?php 
                  $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                  $number_of_account = mysqli_num_rows($select_account);
               ?>
               <p class="font-size-20 font-rubik font-weight-bold text-capitalize py-1 my-auto">total accounts</p>
               <h1 class="font-rubik my-auto font-weight-bold"><?php echo $number_of_account; ?></h1>
            </div>

            <div class="col-lg-4 text-center px-2 py-3 border rounded border-dark m-2">
               <?php 
                  $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                  $number_of_messages = mysqli_num_rows($select_messages);
               ?>
               <p class="font-size-20 font-rubik font-weight-bold text-capitalize py-1 my-auto">new messages</p>
               <h1 class="font-rubik my-auto font-weight-bold"><?php echo $number_of_messages; ?></h1>
               
            </div>
         </div>
      </div>

   </section>


   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   </body>
</html>