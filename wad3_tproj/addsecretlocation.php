<?php
require_once 'php/include/common.php';
$msg = '';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    if ($username == 'Guest') {
        header('Location:search.php');
        exit;
    }
}
else {
    header('Location:search.php');
    exit;
}

// Adding User Session
if (isset($_SESSION['status'])) {
    $msg = $_SESSION['status'];
    unset( $_SESSION['status']);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ParkWhere</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/addsecretlocation.js"></script>
</head>

<body id="addcarpark_user">
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-12">

                <form method="POST" action="php/process_add_cp.php">
                <p class="my-3 display-4"><span>Hello </span><span id='isUser'><?= $username ?>!</span></p>

                    <label for="cpname" class="divlabel my-2 ">Enter secret carpark name</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name='cpname' id="cpname" placeholder="Enter the carpark name" required>
                    </div>

                    <label for="rates1" class="divlabel my-2 ">Do you know the weekday parking rate? (Not required)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-dollar-sign"></i></span>
                        </div>
                        <input type="text" class="form-control" name='rates1' id="rates1" placeholder="Enter the parking rates">
                    </div>

                    <label for="rates2" class="divlabel my-2 ">Do you know the Sat/Sun/PH parking rate? (Not required)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-dollar-sign"></i></span>
                        </div>
                        <input type="text" class="form-control" name='rates2' id="rates2" placeholder="Enter the parking rates">
                    </div>

                    <label for="coord" class="divlabel my-2 ">Since it's so secret, do you happen to know the exact lat/lng coordinates? (Not required)</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control btn btn-dark" value="Pin on Map" name='coord_Lat' id="coord" placeholder="">
                    </div>


<!--                    <div class="input-group mb-3">-->
<!--                        <div class="input-group-prepend">-->
<!--                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-map-signs"></i>&nbspLatitude</span>-->
<!--                        </div>-->
<!--                        <input type="text" class="form-control" name='coord_Lat' id="coord" placeholder="">-->
<!--                    </div>-->
<!--                    <div class="input-group mb-3">-->
<!--                        <div class="input-group-prepend">-->
<!--                            <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-map-signs"></i>&nbspLongitude</span>-->
<!--                        </div>-->
<!--                        <input type="text" class="form-control" name='coord_Lng' id="coord" placeholder="">-->
<!--                    </div>-->


                    <div>
                        <button input type="submit" class='btn btn-primary'>Add my Secret Carpark</button>
                    </div>
                    <div>
                        <h3><?=$msg?></h3>
                    </div>
                </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pinOnMap" tabindex="-1" role="dialog" aria-labelledby="pinOnMap" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body" id="map" style="height:60vh">
            </div>
            <div class="modal-footer">
                <button type="button" id="submit-pin" class="btn btn-primary" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<script defer
        src="https://maps.googleapis.com/maps/api/js?&libraries=geometry&key=AIzaSyCOziaqUNIy8TWTVVHjM3O7befp8RcSrq8"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="Carpark_API/Api_pull.js"></script> <!-- added onemap api search -->
<script src="js/getCarparks.js"></script>
</body>


</html>