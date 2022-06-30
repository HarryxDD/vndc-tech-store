<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $address = mysqli_real_escape_string($conn, 'flat no. '. $_POST['flat'].', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
   $placed_on = date('d-M-Y');
   $order_id = md5($placed_on . $name);

   $cart_total = 0;
   $cart_products[] = '';
   

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['nameWithOption'].' ('.$cart_item['quantity'].') ';
         $item_name = $cart_item['name'];
         $item_quantity = $cart_item['quantity'];
         $sold_query = mysqli_query($conn, "SELECT sold FROM `products` WHERE name = '$item_name'") or die('query failed');
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
         while ($item_sold = mysqli_fetch_assoc($sold_query)) {
            $sold_amount = $item_sold['sold'];
         }
         $sold_amount += $cart_item['quantity'];
         mysqli_query($conn, "UPDATE `products` SET sold = '$sold_amount' WHERE name = '$item_name'");
         // mysqli_query($conn, "UPDATE `products` SET sold = ")
      }
   }

   $total_products = implode(', ',array_slice($cart_products,1));

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on, order_id) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on', '$order_id')") or die('query failed');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
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
      <title>checkout</title>

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
      height: 50vh;
      background-image: url('https://images.unsplash.com/photo-1561715276-a2d087060f1d');
      background-repeat: no-repeat;
      
      background-size: cover;
      background-position: center center;">
         <div class="d-flex justify-content-center align-items-center h-100">
            <div class="text-center font-weight-bold font-rubik">
               <p class="text-uppercase text-white" style="font-size: 3.5rem;">checkout</p>
               <h4 class="text-dark"><a href="home.php" class="text-decoration-none text-white text-uppercase" style="font-weight:600" >home /</a> checkout </h4>
            </div>
         </div>
      <div>
   </section>

   <section class="container d-flex justify-content-center mt-5">
      <div class="card d-flex justify-content-center p-4 font-rubik border rounded border-dark shadow mx-3">
         <?php  
            $grand_total = 0;
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_cart) > 0){
               while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                  $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                  $grand_total += $total_price;
         ?>
         <p> <?php echo $fetch_cart['nameWithOption']; ?> <span>(<?php echo '$'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span> </p>
         <?php
            }
         }else{
            echo '<p class="empty">your cart is empty</p>';
         }
         ?>
         <div class="font-weight-bold font-size-16 text-capitalize text-center font-size-20"> grand total : <span class="text-danger">$<?php echo $grand_total; ?></span> </div>
      </div>
   </section>

   <section class="container p-5 d-flex justify-content-center">
      <form action="" method="post" class="col-lg-8 card d-flex justify-content-center p-4 font-rubik border rounded border-dark shadow mx-3">
         <h3 class="text-center font-rubik py-5 font-weight-bold text-uppercase">Place your order</h3>
         <div class="row d-flex justify-content-center flex-wrap">
            <div class="col-lg">
               <div class="py-1">
                  <span class="font-weight-bold font-size-16 text-capitalize">Your Name <span class="text-danger">*</span></span>
                  <br/>
                  <input class="w-100 px-2 py-2 border rounded border-dark" type="text" name="name" required placeholder="Full-name">
               </div>
               <div class="py-4 row-md d-flex flex-wrap">
                  <span class="col-lg-4 font-weight-bold font-size-16 text-capitalize my-auto p-0">Your Number <span class="text-danger">*</span></span>
                  <br/>
                  <input class="col-lg-8 py-2 border rounded border-dark" type="number" name="number" required placeholder="(000) 000 0000">
               </div>
               <div class="py-4 row-md d-flex flex-wrap">
                  <span class="col-lg-4 font-weight-bold font-size-16 text-capitalize my-auto p-0">Your Email <span class="text-danger">*</span></span>
                  <br/>
                  <input class="col-lg-8 py-2 border rounded border-dark" type="email" name="email" required placeholder="abc@gmail.com">
               </div>
               <div class="py-1 row-md d-flex flex-wrap">
                  <span class="font-weight-bold font-size-16 text-capitalize">Address <span class="text-danger">*</span></span>
                  <br/>
                  <input class="w-100 px-2 py-2 border rounded border-dark" type="number" min="0" name="flat" required placeholder="e.g. flat no.">
               </div>
               <div class="py-1">
                  <span class="font-weight-bold font-size-16 text-capitalize">Street Name :</span>
                  <br/>
                  <input class="w-100 px-2 py-2 border rounded border-dark" type="text" name="street" required placeholder="e.g. street name">
               </div>
               <div class="py-1">
                  <span class="font-weight-bold font-size-16 text-capitalize">City :</span>
                  <br/>
                  <input class="w-100 px-2 py-2 border rounded border-dark" type="text" name="city" required placeholder="e.g. mumbai">
               </div>
               <div class="py-1">
                  <span class="font-weight-bold font-size-16 text-capitalize">State :</span>
                  <br/>
                  <input class="w-100 px-2 py-2 border rounded border-dark" type="text" name="state" required placeholder="e.g. maharashtra">
               </div>
               <div class="py-1">
                  <span class="font-weight-bold font-size-16 text-capitalize">Country :</span>
                  <br/>
                  <input class="w-100 px-2 py-2 border rounded border-dark" type="text" name="country" required placeholder="e.g. india">
               </div>
               <div class="py-1">
                  <span class="font-weight-bold font-size-16 text-capitalize">pin code :</span>
                  <br/>
                  <input class="w-100 px-2 py-2 border rounded border-dark" type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
               </div>
               <div class="py-1">
                  <span class="font-weight-bold font-size-16 text-capitalize">Payment Method :</span>
                  <br/>
                  <select name="method" class="w-100 px-2 py-2 border rounded border-dark">
                     <option value="cash on delivery">cash on delivery</option>
                     <option value="credit card">credit card</option>
                     <option value="paypal">paypal</option>
                     <option value="paytm">paytm</option>
                  </select>
               </div>
            </div>
            </div>
            <hr class="dropdown-divider px-0 py-2">
            <input type="submit" value="order now" class="btn btn-success text-capitalize w-50 mx-auto" data-toggle="modal" data-target="#exampleModal" name="order_btn">

            <!-- Modal order success-->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Order Successfully</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body text-center">
                   <h2><i class="fa-solid fa-circle-check text-success fa-5x"></i></h2>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal"><a href="orders.php" class="text-white text-decoration-none">Check!</a></button>
                  </div>
               </div>
            </div>
            </div>
         </form>
         
   </section>
      
   <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

   <?php include 'footer.php'; ?>

   </body>
</html>