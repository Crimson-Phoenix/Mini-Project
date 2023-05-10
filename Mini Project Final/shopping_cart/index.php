<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../Registration_Login/loginuser.html');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:../Registration_Login/loginuser.html');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }
};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}
?>

<!DOCTYPE html>
 <html>
 <head>
 <title>Shopping Cart</title>
 <link rel="stylesheet" type="text/css" href="../nav.css">
 <link rel="stylesheet" type="text/css" href="../Shopping_cart/style.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
 integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="shortcut icon" type="image/x-icon" href="../logo_.png" />
 </head>
 <body>

    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="../logo.png" alt="Logo"></a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../Homepage/Homepage.php">HOME</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Select/Select.html">SERVICES</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Blog/Blog.html">BLOG</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../About us/About us_dev.html">ABOUT US</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Contact/contact.html">CONTACT</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Launching/Launching.html">PROJECTS</a></li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="../Bookings/Bookings.html">BOOKING</a></li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="../Registration_Login/Registration.html">REGISTER</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Registration_Login/loginuser.html">LOGIN</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Homepage/Homepage.html">LOGOUT</a></li>
                  </ul>
            </div>
        </div>
      </nav>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
<div class="container">
<div class="user-profile">
   <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>
   <p> Username: <span><?php echo $fetch_user['name']; ?></span> </p>
   <p> Email: <span><?php echo $fetch_user['email']; ?></span> </p>
</div>

<div class="products">
   <h1 class="heading">Our Services</h1>
   <div class="box-container">

   <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
   ?>
      <form method="post" class="box" action="">
         <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_product['name']; ?></div>
         <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
         <input type="number" min="1" name="product_quantity" value="1">
         <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
      </form>
   <?php
      };
   };
   ?>
   </div>
</div>

<div class="shopping-cart">
   <h1 class="heading">My Cart</h1>
   <table>
      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>People</th>
         <th>total price</th>
         <th>action</th>
      </thead>
      <tbody>
      <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>
         <tr>
            <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>$<?php echo $fetch_cart['price']; ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                  <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                  <input type="submit" name="update_cart" value="update" class="option-btn">
               </form>
            </td>
            <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('remove item from cart?');">remove</a></td>
         </tr>
      <?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
      <tr class="table-bottom">
         <td colspan="4">Grand Total :</td>
         <td>$<?php echo $grand_total; ?>/-</td>
         <td><a href="index.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">delete all</a></td>
      </tr>
   </tbody>
   </table>
   <div class="cart-btn">  
      <a href="../Bookings/Bookings.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Proceed to Payment</a>
</div>
</div>
</div>
 </body>
 </html> 