
  <!-- ======= Footer ======= -->
  <section id="footer">
    <div class="container">
        <div class="row ">
            <div class="col">
                <h2>Contact Us</h2>
                <p>LimelightCinema@info.com</p>
                <p>2 Millerhill Rd, Dalkeith</p>
                <p>07010101</p>
                <br>
            </div>
            <?php
              if (isset($_SESSION['username'])) {
                if ($_SESSION['username'] == "admin") {
                  echo '<div class="col">';
                  echo '<br>';
                  echo '<br>';
                  echo '<a href="https://www.gov.uk/help/privacy-notice">Privacy Policy</a>';
                  echo '<br>';
                  echo '<br>';
                  echo '<a href="https://www.gov.uk/help/terms-conditions">Terms & Conditions</a>';
                  echo '<br>';
                  echo '<br>';
                  echo ' <a class="nav-link" href="memberPanel.php" alt="admin login"><i class="bi bi-people-fill"></i>Admin Area</a>';
                  echo '</div>';
                }
                else {
                    echo '<div class="col">';
                    echo '<br>';
                    echo '<br>';
                    echo '<a href="https://www.gov.uk/help/privacy-notice">Privacy Policy</a>';
                    echo '<br>';
                    echo '<br>';
                    echo '<a href="https://www.gov.uk/help/terms-conditions">Terms & Conditions</a>';
                    echo '</div>';
                  }
                  
                  }
                  else {
                    echo '<div class="col">';
                    echo '<br>';
                    echo '<br>';
                    echo '<a href="https://www.gov.uk/help/privacy-notice">Privacy Policy</a>';
                    echo '<br>';
                    echo '<br>';
                    echo '<a href="https://www.gov.uk/help/terms-conditions">Terms & Conditions</a>';
                    echo '</div>';
                  }
              ?>
                
            <div class="col">
              <br>
              <br>
                <a  href="https://www.youtube.com/"><i class="bi bi-youtube"></i></a>
                <a  href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
                <a  href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
                <a  href="https://twitter.com/"><i class="bi bi-twitter"></i></a>
                <br>
                <br>
                <div class="logo">
                  <h1><a href="index.php"><img src="assets/img/logoadult-BIANCO.png" alt="logo" class="img-fluid logo-footer"></a></h1>
                </div>
            </div>
        </div>
      </div>
    </div>
</section>