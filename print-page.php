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
<div style="text-align: center;">
            <h1><a href="index.php"><img src="assets/img/logoadult-BIANCO.png" alt="logo" style="width:150px;" class="img-fluid"></a></h1>
<?php
    $conn = mysqli_connect('localhost', 'HNCWEBMR13', '9gw5LHHYkn', 'HNCWEBMR13')
    or die ("can't connect");

    $ID = $_GET["ID"];
    $bookedTickets = $_POST["bookedTicket"];

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
        echo "FILM NON IN DATABASE";
      }
      else
      {      
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        $tickets = $row['tickets'];

        if ($tickets >= $bookedTickets)
        {
          $newStock = $tickets - $bookedTickets;

          $updateQuery = "UPDATE Films_LLCINEMA SET tickets=$newStock WHERE ID=$ID";
          mysqli_query($conn, $updateQuery);

          echo '<div class="text-print">';
          echo '<br><h1>You have booked</h1><br>'; //aggiungere numero di ticket
          echo "<h2>{$row['title']}</h2>";
          echo "<p>Booked Tickets: {$bookedTickets}<br>Age Rating: {$row['ageR']}A<br>Time: {$row['time']}<br>Date: {$row['date']}</p>";
          echo "<img width=150 src='assets/img/qrcode.png' /><br><br>";

          echo '<button onclick="window.print()" class="btn-learn-more">Print</button>';
          echo "</div>";
            
        }
        else
        {
          echo '<br>';
          echo '<br>';
          echo '<br>';
          echo "Not enough tickets are in stock. You can book up to $tickets";
        }
      }
    }
    else
    {
      header("location: index.php");
    }
  ?>
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
