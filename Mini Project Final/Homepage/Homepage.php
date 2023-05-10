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
?>

<!DOCTYPE html>
 <html>
 <head>
 <title>Dream Wedding Planners</title>
 <link rel="stylesheet" href="./Homepage.css">
 <link rel="stylesheet" href="../Blog/Blog.css">
 <link rel="stylesheet" type="text/css" href="../nav.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
 integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="shortcut icon" type="image/x-icon" href="../logo_.png" />
 </head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
$select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select_user) > 0){
$fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

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
                <a class="nav-link" href="Homepage.php?logout=<?php echo $user_id; ?>" 
                onclick="return confirm('Are you sure you want to logout?');">LOGOUT</a></li>
            </ul>
        </div>
    </div>
  </nav>

<!-- home section starts  -->

<section id="home" class="home container-fluid p-0">
<div class="row hero">
  <div class="col pl-3 ml-sm-5 p-0">
    <h1 class="text1">Dream Wedding Planners</h1>
    <h3 class="text2">Plan your own dream event</h3>
  </div>
</div>

<div class="counting">
<div class="box">
  <h1 class="count" data-count="1200">1200+</h1>
  <h3>working hours</h3>
</div>

<div class="box">
  <h1 class="count" data-count="15">15+</h1>
  <h3>awards</h3>
</div>

<div class="box">
  <h1 class="count" data-count="1000">1000+</h1>
  <h3>clients</h3>
</div>

<div class="box">
  <h1 class="count" data-count="840">840+</h1>
  <h3>projects</h3>
</div>
</div>
</section>

<!-- service section starts  -->

<section id="service" class="service">
<h1 class="heading">our services</h1>
<div class="box-container mx-auto">

  <div class="box">
    <div ><img src="register.png" alt=""></div>
    <p><a href="../Registration_Login/Registration.html"> Register</a></p>
  </div>

  <div class="box">
    <div><img src="./login.png" alt=""></div>    
    <p><a href="../Registration_Login/loginuser.html">User Login</a></p>
  </div>

  <div class="box">
    <div class="fas fa-house-user"></div>
    <p><a href="../Select/Select.html">Events</a></p>
  </div>
</div>
</section>

<!-- service section ends -->

<!-- footer section starts  -->

<section class="container-fluid footer">

  <div class="row">
  <div class="col-md-3">
    <h2><img src="../logo.png" height="75px" width="75px" alt=""></h2>
  </div>
  
  <div class="col-md-3">
    <h2>Dev Savla</h2>
    <div class="list">
      <a href="#">dev.savla</a>
      <a href="#">+91 7208303089</a>
      <a href="#">India, Mumbai</a>
      <a href="#">dev.savla@gmail.com</a>
    </div>
  </div>
  
  <div class="col-md-3">
    <h2>Mrudula Sawant</h2>
    <div class="list">
      <a href="#">mrudula.lov3</a>
      <a href="#">+91 8564959517</a>
      <a href="#">Mumbai, Andheri</a>
      <a href="#">mrudula.s@somaiya.edu</a>
    </div>
  </div>
  
  <div class="col-md-3">
    <h2>Aditi Sambrekar</h2>
    <div class="list">
      <a href="#">aditisam9</a>
      <a href="#">+91 8564959517</a>
      <a href="#">Mumbai, Andheri</a>
      <a href="#">aditi9@rediffmail.com</a>
    </div>
  </div>
  </div>
  </section>
  

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="../Homepage/Homepage.js"></script>
</body>
</html>