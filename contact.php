<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Feedback us</title>

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
      
   <?php include 'header.php'; ?>

   <section class="heading">
      <div style="
      background-color: rgba(0, 0, 0, 0.3);
      height: 70vh;
      background-image: url('https://images.unsplash.com/photo-1484807352052-23338990c6c6');
      background-repeat: no-repeat;
      
      background-size: cover;
      background-position: center center;">
         <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-center font-weight-bold font-rubik">
               <p class="text-uppercase text-white" style="font-size: 3.5rem;">connect us</p>
               <h4 class="text-light"><a href="home.php" class="text-decoration-none text-white text-uppercase" style="font-weight:600" >home /</a> contact </h4>
            </div>
         </div>
      <div>
   </section>

   <section class="py-auto">
      <div class="container d-flex justify-content-center my-5">
         <form action="" method="post" class="card col-lg-6 d-flex justify-content-center p-4 font-rubik border rounded border-dark shadow">
            <h4 class="text-capitalize text-center font-weight-bold mb-4">Feedback !</h3>
            <input type="text" name="name" required placeholder="Name" class="px-2 py-2 border rounded border-dark mb-3">
            <input type="email" name="email" required placeholder="Email" class="px-2 py-2 border rounded border-dark mb-3">
            <input type="number" name="number" required placeholder="Number" class="px-2 py-2 border rounded border-dark mb-3">
            <textarea name="message" class="px-2 py-2 border rounded border-dark mb-3" placeholder="Feedback" id="" cols="30" rows="5"></textarea>
            <input type="submit" value="send feedback" name="send" class="btn btn-primary px-2 py-1 text-capitalize">
         </form>
      </div>

   </section>

   <?php include 'footer.php'; ?>

   </body>
</html>