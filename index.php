<?php
  session_start();

  if (isset($_SESSION['over18']) && (!$_SESSION['over18']))
  {
    header("location: index-junior.php");
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

  <?php include("header.php") ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

      
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">WELCOME TO <br><span>LimeLight Cinema</span></h2>
        </div>
      </div>

      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Coming Soon</h2>
          <p class="animate__animated animate__fadeInUp">Discover some of the new films for the next months!</p>
          <a href="#coming-soon" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
        </div>
      </div>

     
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Play with your kids</h2>
          <p class="animate__animated animate__fadeInUp">It will be fun!</p>
          <a href="index-junior.php#games" class="btn-get-started animate__animated animate__fadeInUp scrollto">PLAY NOW</a>
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
      </a>

    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#010F2B">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

<!-- ======= FILM Section ======= -->
<div class="container">
  <div class="section-title" data-aos="zoom-out">
    <h2>WHAT'S ON</h2>
  </div>
</div>
<section id="cards">
  <div class="container swiper">
          <div class="slide-container">
              <div class="card-wrapper swiper-wrapper">
                
  <?php
    $conn = mysqli_connect('localhost', 'HNCWEBMR13', '9gw5LHHYkn', 'HNCWEBMR13')
    or die ("can't connect");

    $query = "SELECT * FROM Films_LLCINEMA" ;
    $result = mysqli_query ($conn, $query)
    or die ("couldn't run query");

    $index = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
      $index += 1;
      if ($index > 8)
      {
        break;
      }

      echo "<div class='card swiper-slide' data-aos='fade-up' onClick='location.href=&#39;single-film.php?ID={$row['ID']}&#39;;' style='cursor:pointer;'>";
      echo '    <div class="image-box">                            '; 
      echo "<img src='{$row['filmImgFilePath']}' />";
      echo '    </div>                                             '; 
      echo '    <div class="name-story">                           ';     
      echo '                                                       ';   
      echo "            <h3 class='name'>{$row['title']}</h3> ";   
      echo '                                                       ';       
      echo '    </div>                                             ';   
      echo '</div>                                                 ';    
    }
  ?>
              </div>
          </div>
          <div class="swiper-button-next swiper-navBtn" data-aos="zoom-out"></div>
          <div class="swiper-button-prev swiper-navBtn" data-aos="zoom-out"></div>
          <div class="swiper-pagination" data-aos="zoom-out"></div>
      </div>
   </div>   
  </section>
  <!-- End FILM Section -->
<!--coming soon-->
<section id="coming-soon" >
  <div class="container">

    <div class="section-title2" data-aos="zoom-out">
      <h2>COMING SOON</h2>
    </div>

    <div class="row">

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up">
          <div class="member-img">
            <img src="assets/img/film/minions.jpg" class="img-fluid" alt="coming">
          </div>
          <div class="member-info">
            <h4>MINIONS</h4>

          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="100">
          <div class="member-img">
            <img src="assets/img/film/matilda.jpg" class="img-fluid" alt="coming">
          </div>
          <div class="member-info">
            <h4>MATILDA</h4>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="200">
          <div class="member-img">
            <img src="assets/img/film/strange-world.jpg" class="img-fluid" alt="coming">
          </div>
          <div class="member-info">
            <h4>STRANGE WORLD</h4>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="300">
          <div class="member-img">
            <img src="assets/img/film/home-alone.jpg" class="img-fluid" alt="coming">
          </div>
          <div class="member-info">
            <h4>HOME ALONE</h4>
          </div>
        </div>
      </div>

    </div>
  </div>
  
</section>
    <!--end coming soon-->
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
  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/cardSlider.js"></script>
</body>

</html>
