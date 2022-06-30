<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

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
   background-image: url('https://images.unsplash.com/photo-1617900906639-cab7adceb499');
   background-repeat: no-repeat;
   opacity: 0.9;
   background-size: cover;
   background-position: center center;">
      <div class="d-flex justify-content-center align-items-center h-100">
         <div class="text-center font-weight-bold font-rubik">
            <p class="text-uppercase text-white" style="font-size: 3.5rem;">search page</p>
            <h4 class="text-dark"><a href="home.php" class="text-decoration-none text-white text-uppercase" style="font-weight:600" >home /</a> <span class="text-light">search</span>  </h4>
         </div>
      </div>
   <div>
</section>

<section class="container d-flex flex-wrap justify-content-center py-5">
   <form action="" method="post" class="w-100 row d-flex">
      <input type="text" name="search" placeholder="search products..." class="col-md-9 px-2 py-3 border rounded border-dark m-auto">
      <input type="submit" name="submit" value="search" class="col-md-2 btn btn-secondary py-2 text-capitalize m-auto text-center">
   </form>
</section>

<section class="products">
   <div class="container d-flex justify-content-center mb-5">
      <div class="row d-flex justify-content-center">
         <?php
            if(isset($_POST['submit'])){
               $search_item = $_POST['search']; // ?? 
               $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_item}%'") or die('query failed');
               if(mysqli_num_rows($select_products) > 0){
               while($fetch_product = mysqli_fetch_assoc($select_products)){
         ?>
         <form action="" method="post" class="card col-lg-3 d-flex justify-content-center p-4 font-rubik border rounded border-dark shadow mx-3">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="product" class="image d-block w-100">
            <div class="font-weight-bold font-size-20 text-capitalize my-2"><?php echo $fetch_product['name']; ?></div>
            <div class="font-weight-bold font-size-20 text-white position-absolute btn btn-danger py-1" style="top:5px; left:5px">$<?php echo $fetch_product['price']; ?></div>
            <input type="number"  class="qty px-2 py-2 border rounded border-dark mb-3" name="product_quantity" min="1" value="1">
            
            
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn btn-primary text-capitalize mt-3" value="add to cart" name="add_to_cart">
         </form>
         <?php
                  }
               }else{
                  echo '<p class="empty font-weight-bold font-size-20 text-capitalize text-danger">no result found!</p>';
               }
            }else{
               echo '<p class="empty font-size-20 text-capitalize">search something!</p>';
            }
         ?>
      </div>
   </div>
  

</section>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<?php include 'footer.php'; ?>

</body>
</html>