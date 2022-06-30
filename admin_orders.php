<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'Payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Orders</title>

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
      
   <?php include 'admin_header.php'; ?>

   <section class="orders"style="margin-top: 50px;">

      <h1 class="text-center font-rubik py-5 font-weight-bold text-uppercase">orders summary</h1>

      <div class="container d-flex flex-wrap justify-content-center">
         <?php
         $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
         if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
         ?>
         <div class="card col-lg-5 px-3 py-3 border rounded border-dark m-4 font-rubik position-static shadow">
            <div class="h-100">
               <p class="font-weight-bold"> Order ID : <span class="font-weight-normal text-danger"><?php echo $fetch_orders['order_id']; ?></span> </p>
               <p class="font-weight-bold"> User ID : <span class="font-weight-normal"><?php echo $fetch_orders['user_id']; ?></span> </p>
               <p class="font-weight-bold"> Placed on : <span class="font-weight-normal"><?php echo $fetch_orders['placed_on']; ?></span> </p>
               <p class="font-weight-bold"> Name : <span class="font-weight-normal"><?php echo $fetch_orders['name']; ?></span> </p>
               <p class="font-weight-bold"> Number : <span class="font-weight-normal"><?php echo $fetch_orders['number']; ?></span> </p>
               <p class="font-weight-bold"> Email : <span class="font-weight-normal"><?php echo $fetch_orders['email']; ?></span> </p>
               <p class="font-weight-bold"> Address : <span class="font-weight-normal"><?php echo $fetch_orders['address']; ?></span> </p>
               <p class="font-weight-bold text-warp"> Total products : <span class="font-weight-normal"><?php echo $fetch_orders['total_products']; ?></span> </p>
               <p class="font-weight-bold"> Total price : <span class="font-weight-normal">$<?php echo $fetch_orders['total_price']; ?></span> </p>
               <p class="font-weight-bold"> Payment method : <span class="font-weight-normal"><?php echo $fetch_orders['method']; ?></span> </p>
            </div>
            <form action="" method="post" class="col d-flex d-flex flex-wrap justify-content-center justify-content-center">
               <div class="row w-100 m-auto d-flex justify-content-center text-center">
                  <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                  <select name="update_payment" class=" py-2 mb-2 text-center border rounded border-dark">
                     <option value="" selected disabled>Status: <?php echo $fetch_orders['payment_status']; ?></option>
                     <option value="pending">Changed: pending</option>
                     <option value="completed">Changed: completed</option>
                  </select>
               </div>
               <div class="row d-flex justify-content-center text-center mt-3">
                  <input type="submit" value="Update" name="update_order" class="btn btn-dark px-auto mx-2 mb-2 font-weight-bold my-auto">
                  <button class="px-5 btn btn-danger mx-2 font-weight-semibold "><a class="text-white text-decoration-none" href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('delete this order?');" >Delete</a></button>
               </div>   
            </form>
         </div>
         <?php
            }
         }else{
            echo '<p class="w-50 border rounded border-danger py-3 px-1 font-rubik font-size-20 text-capitalize  text-center m-auto">no orders placed yet!</p>';
         }
         ?>
      </div>
   </section>
   </body>
</html>