<?php 
  session_start();

if (isset($_SESSION['username']))
{
  header("location: index.php");
}
else
{
if (!isset($_POST["submit"])) : ?>
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
  </header><!-- End Header -->


        <!-- Login container starts -->
    <section class="center-form">
        <form class="card-form p-4 d-flex flex-column" action="register.php" method="POST" id="register">
            <h1 class="text-center form-header font-weight-bold ">Register</h1>
            <div class="form-group mt-2 sub-titles">
                <label >Username</label>
                <input type="text" required name="username" class="form-control" id="usernameInput" placeholder="Enter Username">
            </div>
            <div class="form-group mt-2 sub-titles">
                <label>Date of Birth</label>
                <input type="date" name="DOB" class="form-control" id="dob"
                    placeholder="Enter DOB" required>
            </div>
            <div class="form-group mt-2 sub-titles">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" id="emailInput" placeholder="Enter email">
            </div>
            <div class="form-group mt-2 sub-titles">
                <label >Password</label>
                <input type="text" name="password" class="form-control" id="passwordInput" placeholder="Enter Password" required>
            </div>
            <button type="submit" name="submit" value="Login" class="btn btn-form-submit mt-4 font-weight-bold text-2xl">Submit</button>
            <a class="text-center mt-1" href="login.php">Would you like to sign in?</a>
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
<?php    else : 
  
  $conn = mysqli_connect('localhost', 'HNCWEBMR13', '9gw5LHHYkn', 'HNCWEBMR13')
  or die ("can't connect"); //connection to the database


  //variables for data from html form
  $username = $_POST['username'];
  $password = $_POST['password'];
  $DOB = date('Y-m-d', strtotime ($_POST['DOB']));
  $email = $_POST['email'];

  $today =(date('Y-m-d'));
  $diff = date_diff(date_create($DOB), date_create($today));
  $age = ($diff->format('%y'));
  /*//explode the date to get month, day and year
  $DOBArray = explode("-", $DOB);
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $DOBArray[0], $DOBArray[1], $DOBArray[2]))) > date("md")? ((date("Y") - $DOBArray[2]) - 1): (date("Y") - $DOBArray[2]));*/

  //check if there are other username similar to the new one
  $sql ="SELECT * FROM Members_LLCINEMA WHERE username = '{$username}'";

  $result = mysqli_query($conn, $sql);

  $count = mysqli_num_rows($result);
  if ($count>=1) {
    echo "<script>alert('Sorry, this username is already taken. Please provide a new username.'); window.location.href='register.php'; </script>";
  }
  else {
    //insert data in db
    $sqlRegister = "INSERT INTO Members_LLCINEMA (username, password, DOB, email, age)
    VALUES ('$username', '$password', '$DOB', '$email', '$age')";

    //check if data are inserted in the db
    if (mysqli_query($conn, $sqlRegister)) {
      if($age >=18)
      {
        $_SESSION['over18'] = 1;
        echo "<script>alert('Your Registration is complete! Now you can navigate on Limelight Cinema'); window.location.href='index.php'; </script>";
      }
      else
      {
        $_SESSION['over18'] = 0;
        echo "<script> alert('Your Registration is complete! Now you can navigate on Limelight Cinema'); window.location.href='index-junior.php'; </script>";
      }

      $_SESSION['username'] = $username;
    }
    else {
      "Error: " . $sqlRegister . "<br>" . mysqli_error($conn);
    }
  }

  mysqli_close($conn);

endif;
}
?>