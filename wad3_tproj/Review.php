<?php
require_once 'php/include/common.php';
$username = "Guest";
$carpark = "";
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $carpark = $_GET['Carpark'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkWhere</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/main.css">
    <script src="js/Review.js"></script>
    <script src="js/main.js"></script>
    <script src="Carpark_API/Api_pull.js"></script>
</head>

<body id="review">
    <div id="isUser" style="display:none;"><?= $username ?></div>
    <div class="container-fluid">

<!--        <div id='image_output' class="row content flex-justify d-flex justify-content-around" style='margin-bottom: 2rem;'>-->
<!--            <img class='col-md-2' style='border:1px solid black;' src='images/poorteam.jpg'>-->
<!--            <img class='col-md-2' style='border:1px solid black;' src='images/poorteam.jpg'>-->
<!--            <img class='col-md-2' style='border:1px solid black;' src='images/poorteam.jpg'>-->
<!--        </div>-->
        <h4 id="avgStars"></h4>

        <div id="display"></div>

        <div id="membersForm"></div>
    </div>
    </div>
</body>

</html>