<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $product_option = $_POST['product_option'];
   $product_nameWithOption = $_POST['product_name'] . ' - ' . $product_option;

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image, nameWithOption) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image', '$product_nameWithOption')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Bootstrap CDN -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <!-- slick -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/styleWeb.css">

</head>
<body>
   
<?php include 'header.php'; ?>

 
<section class="heading">
   <div style="
   background-color: rgba(0, 0, 0, 0.3);
   height: 90vh;
   background-image: url('https://images.unsplash.com/photo-1578258789061-354f25c13631');
   background-repeat: no-repeat;
   background-size: cover;
   background-position: center center;">
      <div class="d-flex justify-content-center align-items-center h-100">
         <div class="text-center font-weight-bold font-rubik">
            <p class="text-uppercase text-white" style="font-size: 3.5rem;">our shop</p>
            <h4 class="text-dark"><a href="home.php" class="text-decoration-none text-white text-uppercase" style="font-weight:600" >home /</a> shop </h4>
         </div>
      </div>
   <div>
</section>

<!-- carousel -->
<section>
   <div class="style">
      <div class="container pt-5">
      <h1 class="text-start font-rubik py-2 text-capitalize">Lastest product</h1>
         <div class="row slider">
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/iphone.jpg" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/iphone2.jpg" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/laptop.jpg" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/iphone5.jpg" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/iphone4.jpg" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/iphone3.jpg" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
         </div>
      </div>
   </div>
</section>

<section class="products">
   <h1 class="text-center font-rubik pt-5 pb-2 font-weight-bold text-uppercase"> products</h1>
   <div class="container d-flex flex-wrap justify-content-center align-items-center mb-5">
      <div class="row d-flex justify-content-center">
         <?php  
            $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
         <form action="" method="post" class="card col-lg-3 p-4 font-rubik border rounded border-dark shadow m-3">
            <div class="my-auto">
               <img class="image d-block w-100" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="product">
            </div> 
            <div class="font-weight-bold font-size-20 text-capitalize my-2"><?php echo $fetch_products['name']; ?></div>
            <div class="font-weight-bold font-size-20 text-white position-absolute btn btn-danger py-1" style="top:5px; left:5px">$<?php echo $fetch_products['price']; ?></div>
            <input type="number" min="1" name="product_quantity" value="1" class="px-2 py-2 border rounded border-dark mb-3">
            <?php
               $item_id = $fetch_products['id'];
               $select_products_opt = mysqli_query($conn, "SELECT * FROM `product_opts` WHERE product_id = '$item_id'") or die('query failed');
               while($fetch_options = mysqli_fetch_assoc($select_products_opt)){
                  $option1 = $fetch_options['option_one'];
                  $option2 = $fetch_options['option_two'];
                  $option3 = $fetch_options['option_three'];
               }
            ?>
            <div class="row d-flex flex-wrap justify-content-center">
               <p class="my-auto mr-2 font-weight-bold">Color:</p>
                  <!-- Dropdown options -->
                  <select name="product_option" id="product_option" class="border rounded border-dark w-50 py-2 px-2">
                     <option value="<?php echo $option1; ?>"><?php echo $option1; ?></option>
                     <option value="<?php echo $option2; ?>"><?php echo $option2; ?></option>
                     <option value="<?php echo $option3; ?>"><?php echo $option3; ?></option>
                  </select>
            </div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn btn-primary text-capitalize mt-3">
         </form>
         <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>
   </div>
</section>

<!-- carousel -->
<section>
   <div class="style">
      <div class="container pt-5">
         <h1 class="text-start font-rubik py-2 text-capitalize">News</h1>
         <div class="row slider2">
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/Banner1.png" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/Banner2.png" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/Banner1.png" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/Banner2.png" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/Banner1.png" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
            <div class="col-md-12 text-center">
               <div class="item">
                  <img src="./images/Banner2.png" class="d-block w-100 rounded" alt="banner_1">
               </div>  
            </div>
         </div>
      </div>
   </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- custom js file link  -->
<script src="js/index.js"></script>

</body>
</html>