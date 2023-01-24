
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

<body class="body-adult d-flex">
    <div class="sidebar px-4 pt-4">
        <h1><a href="index.php"><img src="assets/img/logoadult-BIANCO.png" alt="logo" class="img-fluid logo-footer"></a></h1>
        <div class="pt-4">
            <a class="d-block " href="memberPanel.php">
                <div class="menu-option "><i class="bi bi-people-fill"></i>
                    Members
                </div>
            </a>
            <a class="d-block" href="filmPanel.php">
                <div class="menu-option"><i class="bi bi-film"></i>Films</div>
            </a>
        </div>
    </div>
    <div class="d-flex main">
        <div class="inner">
            <h1>Members</h1>
            <div class="toprow">
                <BR>
                <a href="#add-new" class="add-button">+ ADD</a>
            </div>

<?php 
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SESSION['username'] != "admin")
{
    header("location: index.php");
}
//connection to db
$conn = mysqli_connect('localhost', 'HNCWEBMR13', '9gw5LHHYkn', 'HNCWEBMR13')
or die ("can't connect");

//update to the db
if (isset($_POST["update"])) 
{
    $username =$_POST["username"];
    $password =$_POST["password"];
    $DOB = date('Y-m-d', strtotime ($_POST['DOB']));
    $email = $_POST['email'];

    $today =(date('Y-m-d'));
    $diff = date_diff(date_create($DOB), date_create($today));
    $age = ($diff->format('%y'));

    $updateQuery = "UPDATE Members_LLCINEMA SET username = '$username', password = '$password', email = '$email', DOB = '$DOB', age = '$age' WHERE ID ='$_POST[ID]'";
    mysqli_query($conn, $updateQuery);
}

//delete from the db
if (isset($_POST["delete"]))
{
    $deleteQuery = "DELETE FROM Members_LLCINEMA WHERE ID = '$_POST[ID]'";
    mysqli_query($conn, $deleteQuery);
}

//add to the db
if (isset($_POST["add"]))
{
    $username =$_POST["username"];
    $password =$_POST["password"];
    $DOB = date('Y-m-d', strtotime ($_POST['DOB']));
    $email = $_POST['email'];

    $today =(date('Y-m-d'));
    $diff = date_diff(date_create($DOB), date_create($today));
    $age = ($diff->format('%y'));

     //check if there are other username similar to the new one
    $sql = "SELECT * FROM Members_LLCINEMA WHERE username = '{$username}'";

    $result = mysqli_query($conn, $sql);
  
    $count = mysqli_num_rows($result);

    if ($count>=1) {
        echo ("Sorry, this username is already taken");
    }
    else 
    {
        $insertQuery = "INSERT INTO Members_LLCINEMA (username, password, DOB, email, age) 
        VALUES ('$username', '$password', '$DOB', '$email', '$age')";
        mysqli_query($conn, $insertQuery);
    }
}

$result = mysqli_query($conn, "SELECT * FROM Members_LLCINEMA");
//table 
echo "<table border =1>
<tr>
<th>Username</th>
<th>Password</th>
<th>DOB</th>
<th>Email</th>
<th>Add</th>
<th>Update</th>
<th>Delete</th>
</tr>";

//while loop to show values 
while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC))
{
    echo "<form action ='memberPanel.php' method='post'>";
    echo "<tr>";
    echo "<td><input type='text' name='username' value='" . $row['username'] . "'></td>";
    echo "<td><input type='text' name='password' value='" . $row['password'] . "'></td>";
    echo "<td><input type='date' name='DOB' value='" . $row['DOB'] . "'></td>";
    echo "<td><input type='email' name='email' value='" . $row['email'] . "'></td>";
    echo "<td><input type='hidden' name='ID' value='" . $row['ID'] . "'></td>";
    echo "<td><input type='submit' name='update' value='update'></td>";
    echo "<td><input type='submit' name='delete' value='delete'></td>";
    echo "</tr>";
    echo "</form>";
}
//initial form
echo "<form action='memberPanel.php' method='post'>";
echo "<td><input required type='text' name='username' value=''></td>";
echo "<td><input required type='text' name='password' value=''></td>";
echo "<td><input required type='date' name='DOB' value=''></td>";
echo "<td><input required type='email' name='email' value=''></td>";
echo "<td><input id='add-new' type='submit' name='add' value='add'></td>";
echo "</form>";
echo "</table>";
mysqli_close($conn);

?>
            
        </div>
    </div>
            <!-- Vendor JS Files-->
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

<!--

            <table>
                <thead>
                    <tr>
                        <th class="name-col">Name</th>
                        <th class="institution-col">DOB</th>
                        <th class="email-col">Email Address</th>
                        <th class="date-col">Password</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="name-col"></td>
                        <td class="institution-col"></td>
                        <td class="email-col"></td>
                        <td class="date-col"></td>
                        <td class="action-col">
                            <div class="actions text-white">
                                
                                <form action="https://www.w3docs.com/">
                                    <button type="submit" class="bg-update size-button"><i class="bi bi-arrow-bar-up"></i></button>
                                 </form>
                                <form action="https://www.w3docs.com/">
                                    <button type="submit" class="bg-danger size-button"><i class="bi bi-x-lg"></i></button>
                                 </form>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
            <section id="add-new" class="center-form">
                <form class="card-form-admin p-4 d-flex flex-column" action="./login.php" method="POST" id="test">
                    <h1 class=" form-header font-weight-bold ">+ ADD NEW</h1>
                    <div class="form-group mt-2">
                        <label for="usernameInput">Username</label>
                        <input type="text" name="username" class="form-control" id="usernameInput" placeholder="Enter Username">
                    </div>
                    <div class="form-group mt-2">
                        <label for="institutionInput">Date of Birth</label>
                        <input type="date" name="DOB" class="form-control" id="dob"
                            placeholder="Enter DOB">
                    </div>
                    <div class="form-group mt-2">
                        <label for="emailInput">Email address</label>
                        <input type="email" name="email" class="form-control" id="emailInput" placeholder="Enter email">
                    </div>
                    <div class="form-group mt-2">
                        <label for="passwordInput">Password</label>
                        <input type="text" name="password" class="form-control" id="passwordInput" placeholder="Password">
                    </div>

                    <button type="submit" name='submit' class="btn btn-form-submit mt-4 font-weight-bold">Submit</button>
                </form>
            </section>
        </div>
    </div>-->
    <!--Form-->
    

        <!-- Vendor JS Files
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="assets/js/cardSlider.js"></script>
      
</body>
      
</html>-->
 