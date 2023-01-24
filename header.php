  <!-- ======= Header ======= -->
<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  if (!isset($_SESSION['over18']) || ($_SESSION['over18'])) : ?>
      <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">
        <div class="logo">
            <h1><a href="index.php"><img src="assets/img/logoadult-BIANCO.png" alt="logo" class="img-fluid"></a></h1>
        </div>
<?php
else :
?>   
        <header id="header" class="fixed-top d-flex align-items-center header-transparent-j ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.php"><img src="assets/img/logojunior-bianco.png" alt="logo" class="img-fluid"></a></h1>
      </div>
<?php
  endif; 
?>  
    
<?php 
  // get current url (ex. /LimelightCinema_SF/index.php, split in array by delimiter /, get last value, ex. index.php)
  $currentPage = explode("/", $_SERVER['REQUEST_URI']);
  $currentPage = end($currentPage);
?>
      <nav id="navbar" class="navbar">
        <ul>
          <?php
          if  (!isset($_SESSION['over18']) || ($_SESSION['over18'])) : ?>

          <li><a class="nav-link scrollto
          <?php if ($currentPage == "index.php") { echo(" active"); } ?>"
           href="index.php">Home</a></li>
           <li><a class="nav-link scrollto
          <?php if ($currentPage == "index-junior.php") { echo(" active"); } ?>"
           href="index-junior.php">Junior</a></li>

           <?php else :
            ?>

          <li><a class="nav-link scrollto
          <?php if ($currentPage == "index-junior.php") { echo(" active"); } ?>"
           href="index-junior.php">Junior</a></li>
           <?php
  endif; 
?> 

          <li><a class="nav-link scrollto
          <?php if ($currentPage == "films.php") { echo(" active"); } ?>"
           href="films.php">Films</a></li>
<?php
  if (isset($_SESSION['username'])) : ?>
          <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>    
<?php
  else : ?>   
          <li><a class="nav-link scrollto
          <?php if ($currentPage == "login.php" || $currentPage == "register.php") { echo(" active"); } ?>"
            href="login.php">Register/Login</a></li>     
<?php
  endif; ?>       
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->