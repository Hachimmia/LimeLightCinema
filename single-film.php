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
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon-llc.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Mulish:wght@200;300;400&family=Poor+Story&family=Poppins:ital,wght@0,400;1,300&display=swap" rel="stylesheet">

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
  <style> @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Mulish:wght@200;300;400&family=Poor+Story&family=Poppins:ital,wght@0,400;1,300&display=swap'); </style>

</head>

<body body-adult>

  <!-- ======= Header ======= -->
  <?php include("header.php") ?>
<!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <?php
    $conn = mysqli_connect('localhost', 'HNCWEBMR13', '9gw5LHHYkn', 'HNCWEBMR13')
    or die ("can't connect");

    $ID = $_GET["ID"];
    if (is_numeric($ID))
    {
      $query = "SELECT * FROM Films_LLCINEMA WHERE ID=$ID";
      $result = mysqli_query ($conn, $query)
      or die ("couldn't run query");

      if (mysqli_num_rows($result) == 0)
      {
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo "FILM NOT IN DB";
      }
      else
      {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if (isset($_SESSION['over18']) && (!$_SESSION['over18']) && $row["ageR"] > 18)
        {
          header("location: index-junior.php");
        }

        echo '<section id="hero" class="d-flex flex-column justify-content-end align-items-center">';
        echo '<div id="hero-img">';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo "<img style='height:390px; width:auto;' src='{$row['coverImgFilePath']}' alt='cover-film'> ";
        echo '</div>';
        echo '<div class="play-button">';
        echo "<a href='{$row['trailer']}'' target='_blank'><i class='bi bi-play-circle fa-lg'></i></a>";
        echo '</div>';
        echo '</section>';

        echo '<section id="about" class="about">';
        echo '<div class="container">';

        echo '<div class="section-title" data-aos="zoom-out">';
        echo "<h2>{$row['title']}</h2>";
        echo '</div>';

        echo '<div class="row content" data-aos="fade-up">';
        echo '<div class="col-lg-6 color-text">';
        echo "<p>{$row['description']}</p>";
          
        echo '</div>';
        echo '<div class="col-lg-6 pt-4 pt-lg-0 color-text">';
        echo '<ul>';
        echo "<li><i class='bi bi-dash-circle'></i>{$row['ageR']}A</li>";
        echo "<li><i class='bi bi-clock'></i>{$row['time']}</li>";
        echo "<li><i class='bi bi-calendar-event'></i>{$row['date']}</li>";
        echo '</ul>';
        echo '<div class="row">';
        if ($row['tickets'] > 0)
        {
          if (isset($_SESSION['over18']) && ($_SESSION['over18']))
          {
            echo "<form action='print-page.php?ID={$row['ID']}' method='post'>";
            echo "<input class='booki-numb' type='number' name='bookedTicket' min='1' max='{$row['tickets']}' value='1'>";    
            echo "<input name='submit' type='submit' value='BOOK NOW'>";
            echo '</form>';
          }
        }
        else
        {
          echo 'FULLY BOOKED';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo "  </div></section><!-- End About Section -->";
      }
    }
    else
    {
      header("location: index.php");
    }
  ?>

    <!--footer-->
    <?php include("footer.php") ?>

<div class="bg-box">
  <p class="">©Copyright LimeLight Cinema 2023</p>
<!-- End Footer -->
    
      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
      <!-- Vendor JS Files -->
      <script src="assets/vendor/aos/aos.js"></script>
      <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
      <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
      <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    
      <script src="assets/js/main.js"></script>
    
    </body>
    
    </html>