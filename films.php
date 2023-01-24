<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    header("location: login.php");
  }
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!--Silvia Figliozzi - Edinburgh College EC1940906 - Educational project -->
    <title>LimelightCinema</title>
  <meta content="Silvia Figliozzi - College project 2022-2023" name="description">


  <!-- Favicons -->
  <link href="assets/img/favicon-llc.png" rel="icon" alt="logo">
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

  <?php include("header.php") ?>

  <?php
    $conn = mysqli_connect('localhost', 'HNCWEBMR13', '9gw5LHHYkn', 'HNCWEBMR13')
    or die ("can't connect");

    if ($_SESSION['over18']) {

      $query = "SELECT * FROM Films_LLCINEMA WHERE ageR >= '18' || ageR < '18'" ;
      $result = mysqli_query ($conn, $query)
      or die ("couldn't run query");
    }
    else  {
      $query = "SELECT * FROM Films_LLCINEMA WHERE ageR < '18'" ;
      $result = mysqli_query ($conn, $query)
      or die ("couldn't run query");
    }

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
      echo '<section id="about" class="about" style= " padding-top: 25px!important;">';
      echo '<div class="container">';
      echo '<div class="section-title" data-aos="zoom-out">';
      echo "<h2>{$row['title']}</h2>";
      echo '</div>';

      echo '<div class="row content" data-aos="fade-up">';
      echo '<div class="col-lg-6 color-text">';
      echo "<a><img style='max-height: 250px; max-width: 250px;' src='{$row['filmImgFilePath']}' alt='film'></a>";
      echo '</div>';
      echo '<div class="col-lg-6 pt-4 pt-lg-0 color-text">';
      echo '<ul>';
      echo "<li><i class='bi bi-dash-circle'></i>{$row['ageR']}A</li>";
      echo "<li><i class='bi bi-clock'></i>{$row['time']}</li>";
      echo "<li><i class='bi bi-calendar-event'></i>{$row['date']}</li>";
      echo "</ul>";
      echo '<div class="row">';
      echo "<a href='single-film.php?ID={$row['ID']}' target='_blank' class='btn-learn-more col-4'>See more</a>";
      echo "</div>";
      echo "</div>";
      echo '<hr style= " color:yellow; margin-top:90px;">';
      echo "</div>";
      echo "</div></section><!-- End About Section -->";
    }
  ?>


    <!--footer-->
    <?php include("footer.php") ?>
    
<div class="bg-box">
  <p class="">©Copyright LimeLight Cinema 2023</p>
  <!--<footer id="footer">
    <div class="container">
      <h3>Contact us</h3>
      <p>Don't hesitate to contact us for any query you might have.</p>
      <a href="contact-us.html" class="btn-learn-more">Contact Us</a>
      <div class="social-links">
        <a href="https://twitter.com/" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="https://www.facebook.com/" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>Limelight Cinema</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer>--><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
