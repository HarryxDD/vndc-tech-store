<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>messages</title>

      <!-- font awesome cdn link  -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

      <!-- Bootstrap CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

      <!-- custom admin css file link  -->
      <link rel="stylesheet" href="css/styleWeb.css">

   </head>
   <body>
      
   <?php include 'admin_header.php'; ?>

   <section class="messages" style="margin-top: 50px;">

      <h1 class="text-center font-rubik py-5 font-weight-bold text-uppercase"> feedback </h1>

      <div class="container d-flex flex-wrap justify-content-center">
      <?php
         $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
         if(mysqli_num_rows($select_message) > 0){
            while($fetch_message = mysqli_fetch_assoc($select_message)){
         
      ?>
      <div class="card col-lg-3 px-3 py-3 border border-4 rounded border-danger m-3 font-rubik position-static shadow font-size-16">
         <div class="h-100">
            <p class="font-weight-bold"> User ID : <span class="font-weight-normal"><?php echo $fetch_message['user_id']; ?></span> </p>
            <p class="font-weight-bold"> Name : <span class="font-weight-normal"><?php echo $fetch_message['name']; ?></span> </p>
            <p class="font-weight-bold"> Number : <span class="font-weight-normal"><?php echo $fetch_message['number']; ?></span> </p>
            <p class="font-weight-bold"> Email : <span class="font-weight-normal text-danger"><?php echo $fetch_message['email']; ?></span> </p>
            <p class="font-weight-bold"> Feedback : <span class="font-weight-normal"><?php echo $fetch_message['message']; ?></span> </p>
         </div>
         <div class="btn btn-danger">
            <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this feedback?');" class="text-white text-decoration-none text-capitalize">delete feedback</a>
         </div>
      </div>
      <?php
         };
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
      ?>
      </div>

   </section>

   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   </body>
</html>