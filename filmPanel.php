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
    <div class="d-flex main" style="width: auto;">
        <div class="inner">
            <h1>Films</h1>
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

// file save
$target_dir = "assets/uploads/";
$coverImgTargetFile = "";

if (isset($_FILES["coverImgToUpload"]) && $_FILES["coverImgToUpload"]["name"] != "")
{
    // create random string
    $coverImgTargetFile = $target_dir . bin2hex(openssl_random_pseudo_bytes(4)) . basename($_FILES["coverImgToUpload"]["name"]);
    // COVER
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($coverImgTargetFile,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["coverImgToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Cover File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($coverImgTargetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["coverImgToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["coverImgToUpload"]["tmp_name"], $coverImgTargetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["coverImgToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file ". htmlspecialchars( basename( $_FILES["coverImgToUpload"]["name"]));
            $uploadOk = 0;
        }
    }
    
    $coverImgTargetFile = mysqli_real_escape_string($conn, $coverImgTargetFile);
    if ($uploadOk == 0)
    {
        $coverImgTargetFile = "";
    }
}
// FILM IMG
$filmImgTargetFile = "";
if (isset($_FILES["filmImgToUpload"]) && $_FILES["filmImgToUpload"]["name"] != "")
{
    // create random string
    $filmImgTargetFile = $target_dir . bin2hex(openssl_random_pseudo_bytes(4)) . basename($_FILES["filmImgToUpload"]["name"]);
    // FILM
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($filmImgTargetFile,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["filmImgToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Cover File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($filmImgTargetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["filmImgToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["filmImgToUpload"]["tmp_name"], $filmImgTargetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["filmImgToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file ". htmlspecialchars( basename( $_FILES["filmImgToUpload"]["name"]));
            $uploadOk = 0;
        }
    }

    $filmImgTargetFile = mysqli_real_escape_string($conn, $filmImgTargetFile);
    if ($uploadOk == 0)
    {
        $filmImgTargetFile = "";
    }
}
//

//update to the db
if (isset($_POST["update"])) 
{
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $ageR = mysqli_real_escape_string($conn, $_POST['ageR']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $tickets = mysqli_real_escape_string($conn, $_POST['tickets']);
    $trailer = mysqli_real_escape_string($conn, $_POST['trailer']);

    $updateQuery = "UPDATE Films_LLCINEMA SET title = '$title', description = '$description', date = '$date', ageR = '$ageR', time = '$time', tickets = '$tickets', trailer = '$trailer'";
    if ($coverImgTargetFile != "")
    {
        $updateQuery = $updateQuery . ", coverImgFilePath = '$coverImgTargetFile'";
    }
    if ($filmImgTargetFile != "")
    {
        $updateQuery = $updateQuery . ", filmImgFilePath = '$filmImgTargetFile'";
    }

    $updateQuery = $updateQuery . " WHERE ID ='$_POST[ID]'";
    mysqli_query($conn, $updateQuery);
}

//delete from the db
if (isset($_POST["delete"]))
{
    $deleteQuery = "DELETE FROM Films_LLCINEMA WHERE ID = '$_POST[ID]'";
    mysqli_query($conn, $deleteQuery);
}

//add to the db
if (isset ($_POST["add"]))
{
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $ageR = mysqli_real_escape_string($conn, $_POST['ageR']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $tickets = mysqli_real_escape_string($conn, $_POST['tickets']);
    $trailer = mysqli_real_escape_string($conn, $_POST['trailer']);

    $insertQuery = "INSERT INTO Films_LLCINEMA (title, description, date, ageR, time, tickets, trailer, coverImgFilePath, filmImgFilePath) VALUES ('$title', '$description', '$date', '$ageR', '$time', '$tickets', '$trailer', '$coverImgTargetFile', '$filmImgTargetFile')";

    mysqli_query($conn, $insertQuery);
}

$result = mysqli_query($conn, "SELECT * FROM Films_LLCINEMA");
//table 
echo "<table border =1>
<tr>
<th>Title</th>
<th>Description</th>
<th>Date</th>
<th>Age Rating</th>
<th>Time</th>
<th>Tickets</th>
<th>Trailer</th>
<th>Cover Image</th>
<th>Film Image</th>
<th>Add</th>
<th>Upload</th>
<th>Delete</th>
</tr>";

//while loop to show values 
while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC))
{
    $title = htmlspecialchars($row['title']);
    $description = htmlspecialchars($row['description']);
    $date = htmlspecialchars($row['date']);
    $ageR = htmlspecialchars($row['ageR']);
    $time = htmlspecialchars($row['time']);
    $tickets = htmlspecialchars($row['tickets']);
    $trailer = htmlspecialchars($row['trailer']);

    echo "<form action ='filmPanel.php' method='post' enctype='multipart/form-data'>";
    echo "<input type='hidden' name='ID' value='" . $row['ID'] . "'>";
    echo "<tr>";
    echo "<td><input type='text' name='title' value='" . $title . "'></td>";
    echo "<td><input type='text' name='description' value='" . $description . "'></td>";
    echo "<td><input type='date' name='date' value='" . $date . "'></td>";
    echo "<td><input type='number' name='ageR' value='" . $ageR . "'></td>";
    echo "<td><input type='time' name='time' value='" . $time . "'></td>";
    echo "<td><input type='number' name='tickets' value='" . $tickets . "'></td>";
    echo "<td><input type='text' name='trailer' value='" . $trailer . "'></td>";
    echo '<td><input type="file" name="coverImgToUpload"></td>';
    echo '<td><input type="file" name="filmImgToUpload"></td>';
    echo "<td></td>";
    echo "<td><input type='submit' name='update' value='update'></td>";
    echo "<td><input type='submit' name='delete' value='delete'></td>";
    echo "</tr>";
    echo "</form>";
}
//initial form
echo "<form action='filmPanel.php' method='post' enctype='multipart/form-data'>";
echo "<td><input type='text'  required name='title' value=''></td>";
echo "<td><input type='text'  required name='description' value=''></td>";
echo "<td><input type='date' required name='date' value=''></td>";
echo "<td><input type='number' required name='ageR' value=''></td>";
echo "<td><input type='time' required name='time' value=''></td>";
echo "<td><input type='number' required name='tickets' value=''></td>";
echo "<td><input type='text' required name='trailer' value=''></td>";
echo '<td><input type="file" name="coverImgToUpload"></td>';
echo '<td><input type="file" name="filmImgToUpload"></td>';
echo "<td><input id='add-new' type='submit' name='add' value='add'></td>";
echo "<td></td>";
echo "<td></td>";
echo "</form>";
echo "</table>";
mysqli_close($conn);


?>
            
        </div>
    </div>
            <!--<table>
                <thead>
                    <tr>
                        <th class="name-col">Title</th>
                        <th class="institution-col">Age Rating</th>
                        <th class="desc-col">Description</th>
                        <th class="date-col">Date</th>
                        <th class="time-col">Time</th>
                        <th class="tickets-col">Tickets</th>
                        <th class="imgC-col">Image Cover</th>
                        <th class="imgH-col">Image Hero</th>
                        <th class="trailer-col">Trailer</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="name-col"></td>
                        <td class="institution-col"></td>
                        <td class="desc-col"></td>
                        <td class="date-col"></td>
                        <td class="time-col"></td>
                        <td class="tickets-col"></td>
                        <td class="imgC-col"></td>
                        <td class="imgH-col"></td>
                        <td class="trailer-col"></td>
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
                        <label for="titleInput">Title</label>
                        <input type="titleInput" name="titleInput" class="form-control" id="titleInput" placeholder="Enter Title">
                    </div>
                    <div class="form-group mt-2">
                        <label for="ageInput">Age Rating</label>
                        <input type="number" name="ageInput" class="form-control" id="ageInput"
                            placeholder="Enter Age Rating">
                    </div>
                    <div class="form-group mt-2">
                        <label for="emailInput">Description</label>
                        <input type="descriptionInput" name="descriptionInput" class="form-control" id="descriptionInput" placeholder="Enter Description">
                    </div>
                    <div class="form-group mt-2">
                        <label for="dateInput">Date</label>
                        <input type="date" name="dateInput" class="form-control" id="dateInput" placeholder="Date">
                    </div>
                    <div class="form-group mt-2">
                        <label for="timeInput">Time</label>
                        <input type="timeInput" name="timeInput" class="form-control" id="timeInput"
                            placeholder="Enter Time">
                    </div>
                    <div class="form-group mt-2">
                        <label for="ticketInput">Tickets</label>
                        <input type="number" name="ticketInput" class="form-control" id="ticketInput"
                            placeholder="Enter Tickets">
                    </div>
                    <div class="form-group mt-2">
                        <label for="trailerInput">Trailer</label>
                        <input type="trailerInput" name="trailerInput" class="form-control" id="trailerInput"
                            placeholder="Enter Trailer Link">
                    </div>
                    <div class="form-group mt-2">
                        <label for="timeInput">Image Cover</label>
                        <input type="timeInput" name="timeInput" class="form-control" id="timeInput"
                            placeholder="Enter Time">
                    </div>
                    <div class="form-group mt-2">
                        <label for="timeInput">Image Hero</label>
                        <input type="timeInput" name="timeInput" class="form-control" id="timeInput"
                            placeholder="Enter Time">
                    </div>
                    <button type="submit" class="btn btn-form-submit mt-4 font-weight-bold">Submit</button>
                </form>
            </section>
        </div>
    </div>
Form-->
    

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
