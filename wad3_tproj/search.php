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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/inview.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOziaqUNIy8TWTVVHjM3O7befp8RcSrq8&libraries=places"></script>
</head>

<body>
    <div class="container-fluid" id="search">
        <div class="row content">
            <div class="col-xs-12 col-md-7" id="wherego">
                <p class="my-5 display-4 text-light"><span>Hello </span><span id='isUser'><?= $username ?></span>!</p>
                <form>
                    <div class="form-group">
                        <i class="fas fa-search" aria-hidden="true"></i>
                        <input id="search_text" class="form-control form-control-sm ml-2 w-100 col-sm-12 col-md-6 d-inline mr-4" type="text" placeholder="Where would you like to go?" aria-label="Search">
                        <div class="btn-group" role="group" aria-label="Basic example">

                            <button id='search_button' class='btn btn-danger btn-lg mr-3' href="maps.php">Show on Map </button>
                            <button id="ShowCards" type="button" class="btn btn-danger text-left btn-lg">Show carpark only</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div id="results" class="w-100 px-4"></div>
            <div id='card_output' class="card-columns"></div>
        </div>

    </div>

</body>

<script src="js/getCarparks.js"></script>
<script src="js/search.js"></script>

</html>