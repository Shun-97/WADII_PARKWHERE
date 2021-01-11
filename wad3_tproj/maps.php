<?php
require_once 'php/include/common.php';
$username = "Guest";
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkWhere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://fonts.googleapis.com/css?family=Cinzel Decorative' rel='stylesheet'>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div id="isUser" style="display:none;"><?=$username?></div>
    <div class="container-fluid" id="maps">
        <div class="row content" style="height:91vh">
            <div class="col-md-12 p-0">
                <div class="map-wrapper" style="height:100%">
                    <div id="map" style="height:100%">

                    </div>
                </div>
            </div>
        </div>


    </div>

    <script defer
        src="https://maps.googleapis.com/maps/api/js?&libraries=geometry&key=AIzaSyCOziaqUNIy8TWTVVHjM3O7befp8RcSrq8"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="js/main.js"></script>
    <script src="Carpark_API/OneMap_search.js"></script> <!-- added onemap api search -->
    <script src="Carpark_API/Api_pull.js"></script> <!-- added onemap api search -->
    <script src="js/getCarparks.js"></script>
    <script src="js/maps.js"></script>
</body>

</html>