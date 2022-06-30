<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>orders</title>

      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

      <!-- Bootstrap CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      
      <!-- custom admin css file link  -->
      <link rel="stylesheet" href="css/styleWeb.css">

   </head>
   <body>
      
   <?php include 'header.php'; ?>


   <section class="heading">
      <div style="
      background-color: rgba(0, 0, 0, 0.3);
      height: 70vh;
      background-image: url('https://images.unsplash.com/photo-1549194388-f61be84a6e9e');
      background-repeat: no-repeat;
      
      background-size: cover;
      background-position: center center;">
         <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-center font-weight-bold font-rubik">
               <p class="text-uppercase text-white" style="font-size: 3.5rem;">your orders</p>
               <h4 class="text-light"><a href="home.php" class="text-decoration-none text-white text-uppercase" style="font-weight:600" >home /</a> orders </h4>
            </div>
         </div>
      <div>
   </section>

   <section class="placed-orders ">

      <h1 class="text-center font-rubik pt-4 font-weight-bold text-uppercase">placed orders</h1>

      <div class="container d-flex flex-wrap justify-content-center">

         <?php
            $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($order_query) > 0){
               while($fetch_orders = mysqli_fetch_assoc($order_query)){
         ?>
         <div class="card col-lg-5 px-3 py-3 border rounded border-dark m-4 font-rubik shadow">
            <div class="h-100 col">
               <div class="row">
                  <p  class="font-weight-bold col-md-4"> Name : <span class="font-weight-normal"><?php echo $fetch_orders['name']; ?></span> </p>
                  <p  class="font-weight-bold col-md-6"> Number : <span class="font-weight-normal"><?php echo $fetch_orders['number']; ?></span> </p>
               </div>
               <p  class="font-weight-bold"> Email : <span class="font-weight-normal"><?php echo $fetch_orders['email']; ?></span> </p>
               <p  class="font-weight-bold"> Placed on : <span class="font-weight-normal"><?php echo $fetch_orders['placed_on']; ?></span> </p>
               <p  class="font-weight-bold"> Address : <span class="font-weight-normal"><?php echo $fetch_orders['address']; ?></span> </p>
               <p  class="font-weight-bold"> Payment method : <span class="font-weight-normal"><?php echo $fetch_orders['method']; ?></span> </p>
               <p  class="font-weight-bold"> Order ID : <span class="font-weight-normal text-danger"><?php echo $fetch_orders['order_id']; ?></span> </p>
               <p  class="font-weight-bold"> Your orders : <span class="font-weight-normal"><?php echo $fetch_orders['total_products']; ?></span> </p>
               <p  class="font-weight-bold"> Total price : <span class="font-weight-bold text-success">$<?php echo $fetch_orders['total_price']; ?></span> </p>
            </div>
            <hr class="dropdown-divider p-0">
            <p class="font-weight-bold text-center my-auto"> Payment status : <span class="font-weight-bold text-capitalize" style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">View Details</button> -->
         </div>
         <?php
         }
         }else{
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>

   </section>

   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   <?php include 'footer.php'; ?>

   </body>
</html>