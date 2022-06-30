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
      <title>about</title>

      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

      <!-- Bootstrap CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <!-- custom admin css file link  -->
      <link rel="stylesheet" href="css/styleWeb.css">
   </head>
   
   <body>
      
   <?php include 'header.php'; ?>

   <!-- header about -->

   <div style="
      background-color: rgba(0, 0, 0, 0.5); 
      height: 70vh;
      background-image: url('https://images.unsplash.com/photo-1593062096033-9a26b09da705');
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center center;">
      <div class="d-flex justify-content-center align-items-center h-100">
         <div class="text-center font-weight-bold font-rubik">
            <p class="text-uppercase text-white" style="font-size: 3.5rem;">about us</p>
            <h4 class="text-light"><a href="home.php" class="text-decoration-none text-white text-uppercase" style="font-weight:600" >home /</a> about </h4>
         </div>
      </div>
   <div> 

   <section class="about">
      <div class="container card my-5 shadow">
         <div class="row g-0">
            <div class="col-lg-6 p-0">
               <img src="./images/clay-banks-zH9kK6wNC20-unsplash.jpg" class="img-fluid rounded-start" alt="img." 
               style="
               background-repeat: no-repeat;
               background-size: cover;
               background-position: center center;"
               >
            </div>
            <div class="col-lg-6 my-auto">
               <div class="card-body">
                  <h2 class="card-title text-center font-rubik pb-3 font-weight-bold text-uppercase">VNDC Tech</h2>
                  <p class="card-text">
                     This is an e-commerce site used to sell technology or related products. VNDC Tech aims to improve user experience, easy to manage and user-friendly. We are constantly upgrading as well as expanding the quantity and quality of products currently sold on the shop
                     <br/>
                     This is an e-commerce site used to sell technology or related products. VNDC Tech aims to improve user experience, easy to manage and user-friendly. We are constantly upgrading as well as expanding the quantity and quality of products currently sold on the shop
                  </p>
                  <a href="contact.php" class="btn btn-secondary text-capitalize font-rubik">contact us <i class="fa-solid fa-phone-flip ml-1"></i></a>
               </div>
            </div>
         </div>
         </div>
   </section>


   <section class="team">
      <div class="container-fluid py-4 mb-5 "> 
         <p class="text-uppercase text-dark text-center font-rubik" style="font-size: 3.5rem; font-weight:700">Meet the team</p>
         <div class="row p-0 d-flex flex-wrap my-5 justify-content-center align-items-center">
            <div class="col-lg-2 text-center font-rubik mx-4">
               <img src="images/cuong.jpg" alt="member-1 picture" class="rounded-circle img-fluid mb-2" style="filter: grayscale(100%);">
               <p><span class="font-size-20">Cuong</span><br/>Dev</p>
            </div>
            <div class="col-lg-2 text-center font-rubik mx-4">
               <img src="images/dan.jpg" alt="member-1 picture" class="rounded-circle img-fluid mb-2" style="filter: grayscale(100%);">
               <p><span class="font-size-20">Dan</span><br/>Programmer</p>
            </div>
            <div class="col-lg-2 text-center font-rubik mx-4">
               <img src="images/nhut.jpg" alt="member-1 picture" class="rounded-circle img-fluid mb-2" style="filter: grayscale(100%);">
               <p><span class="font-size-20">Nhut</span><br/>Coder</p>
            </div>
            <div class="col-lg-2 text-center font-rubik mx-4">
               <img src="images/vu.jpg" alt="member-1 picture" class="rounded-circle img-fluid mb-2" style="filter: grayscale(100%);">
               <p><span class="font-size-20">Vu</span><br/>Developer</p>
            </div>
         </div>
      </div>
   </section>

   <?php include 'footer.php'; ?>

   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   </body>
</html>