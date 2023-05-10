<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:../Registration_Login/loginuser.html');
};
?>

<!DOCTYPE html>
 <html>
 <head>
 <title>Your Bookings</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
 integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>
<link rel="shortcut icon" type="image/x-icon" href="../logo_.png" />
<link rel="stylesheet" href="Bookings.css">
<link rel="stylesheet" type="text/css" href="../nav.css">
</head>
<body>

<nav class="navbar navbar-expand-md">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="../logo.png" alt="Logo"></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="../Homepage/Homepage.php">HOME</a></li>
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

<div class="wrapper">
    <div class="left">

    <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

    <h1 class="animate__animated animate__bounce">An animated element</h1>
    </div>

    <div class="right">
        <div class="info">
            <h3>Information</h3>
            <div class="info_data">

                <div class="data">
                  <h4>Name</h4>
                  <span><?php echo $fetch_user['name']; ?></span>
                </div>

                <div class="data">
                  <h4>Email</h4>
                  <span><?php echo $fetch_user['email']; ?></span>
                </div>

                <div class="data">
                  <h4>Phone</h4>
                  <span><?php echo $fetch_user['mobile']; ?></span>
                </div>
            </div>
        </div>

      <div class="projects">
      <h3>Your Bookings</h3>
      <table style="width:100%">
      <th><h4>Name</h4></th>
      <th><h4>Price</h4></th>
      <th><h4>Quantity</h4></th>
      <th><h4>Total Price</h4></th>

      <?php
      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      $grand_total = 0;
      if(mysqli_num_rows($cart_query) > 0){
      while($fetch_cart = mysqli_fetch_assoc($cart_query)){
      ?>

      <tr>
      <td><p><?php echo $fetch_cart['name']; ?></p></td>
      <td><p>$<?php echo $fetch_cart['price']; ?>/-</p></td>
      <td><p><?php echo $fetch_cart['quantity']; ?></p></td>
      <td><p>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td></p>
      </tr>
      
      <?php $grand_total += $sub_total;}}?>
      <tr class="table-bottom">
      <td colspan="3">Grand Total:</td>
      <p><th>$<?php echo $grand_total; ?>/-</th></p>
      </tr>

      <?php $discount = 0.15*($grand_total);?>
      <tr class="table-bottom">
      <td colspan="3">After Discount: </td>
      <p><th>$<?php echo $discount; ?>/-</th></p>
      </tr>

      <tr>
      <td colspan="4">Pay only 15% of your Grand Total to Confirm Booking**</td>
      </tr>

      </table>
      </div>

        <div class="form-container">
        <form action="Event_date.php" method="POST">
              <span>Select Your Event Day</span>
              <input type="date" name="event">
              <button type="submit" name="submit" class="btn btn-primary">Save Data</button>
            </form></div><br>

        <div class="social_media">
            <ul>
              <li><a href="../Payment/Payment.html">Confirm booking</a></li>
          </ul>
      </div>
    </div>
</div>
</body>
</html>