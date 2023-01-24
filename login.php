<?php 
  session_start();

if (isset($_SESSION['username']))
{
  header("location: index.php");
}

if (!isset($_SESSION['username']) && !isset($_POST["submit"])) : ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!--Silvia Figliozzi - Edinburgh College EC1940906 - Educational project -->
    <title>LimelightCinema</title>
  <meta content="Silvia Figliozzi - College project 2022-2023" name="description">


  <!-- Favicons -->
  <link href="assets/img/favicon-llc.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2family=Montserrat&family=Mulish:wght@200;300;400&family=Poor+Story&family=Poppins:ital,wght@0,400;1,300&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">
  <style> @import url('https://fonts.googleapis.com/css2family=Montserrat&family=Mulish:wght@200;300;400&family=Poor+Story&family=Poppins:ital,wght@0,400;1,300&display=swap'); </style>

</head>

<body class="body-adult">
    <!-- ======= Header ======= -->
    <?php include("header.php") ?>
    <!-- End Header -->


        <!-- Login container starts -->
    <section class="center-form">
        <form class="card-form p-4 d-flex flex-column" action="./login.php" method="POST" id="test">
            <h1 class="text-center form-header font-weight-bold">Login</h1>
            <div class="form-group my-2">
                <label for="usernameInput" class="sub-titles">Username</label>
                <input type="" name="username" class="form-control" id="emailInput" aria-describedby="emailHelp"
                    placeholder="Enter Username" required>
            </div>
            <div class="form-group mt-2 sub-titles">
                <label for="passwordInput" >Password</label>
                <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password" required>
            </div>
            <div class="form-group">
                <a href="register.php">Forgot your password?</a>
            </div>
            <button type="submit" name="submit" class="btn btn-form-submit mt-4 font-weight-bold text-2xl">Submit</button>
            <a class="text-center mt-1" href="register.php">Don't have an account?</a>
        </form>
    </section>
        <!-- Login container ends -->

<div class="bg-box">
  <p class="">©Copyright LimeLight Cinema 2023</p>
</div>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/cardSlider.js"></script>

</body>

</html>
<?php
elseif (!isset($_SESSION['username'])) :

  $conn = mysqli_connect('localhost', 'HNCWEBMR13', '9gw5LHHYkn', 'HNCWEBMR13')
    or die ("can't connect"); //connection to the database

    //variables for data from html form
    $username = $_POST['username'];
    $password = $_POST['password'];

    //searching username into db
    //if $result matched $username, the $count =1
    $sql ="SELECT * FROM Members_LLCINEMA WHERE username = '{$username}' AND password = '{$password}'";
    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);
    if($count==1)  {
        //fetch the age value from db
        $age = $row = mysqli_fetch_array ($result, MYSQLI_ASSOC)['age'];

       if($age >=18)
        {
          $_SESSION['over18'] = 1;
          header("location: index.php");
        }
        else
        {
          $_SESSION['over18'] = 0;
          header("location: index-junior.php");
        }
  
        $_SESSION['username'] = $username;
      }
    else {
      echo "<script>alert('Wrong Username or Password. Please, Try again.'); window.location.href='login.php'; </script>";
    }
    mysqli_close($conn);
endif;
?>