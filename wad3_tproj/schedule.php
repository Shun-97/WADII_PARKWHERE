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
</head>
<body>
    <div id="isUser" style="display:none;"><?=$username?></div>
    <div class="container-fluid" id='schedule'>
        <div class="row d-flex">

            <div class="col-sm-12 col-md-4 content">
                <div class="desc">
                    <h1>Need to be somewhere later?</h1>
                    <p>No problem! With ParkWhere scheduling services, set the time and location in advance and we'll bring the carpark information to you at the scheduled time.</p>
                </div>

                <h1 class="mt-2">Current Time</h1>
                <time>
                    <div class="clock">
                        <div class="dial-container dial-container--hh js-clock" data-cur="9" data-start="0" data-end="12"
                             data-dur="hh">
                        </div> &nbsp;
                        <div class="dial-container dial-container--mm js-clock" data-cur="2" data-start="0" data-end="5"
                             data-dur="mm">
                        </div>
                        <div class="dial-container dial-container--m js-clock" data-cur="3" data-start="0" data-end="9"
                             data-dur="m">
                        </div>
                        &nbsp;
                        <div class="dial-container dial-container--ss js-clock" data-cur="4" data-start="0" data-end="5"
                             data-dur="ss">
                        </div>
                        <div class="dial-container dial-container--s js-clock" data-cur="8" data-start="0" data-end="9"
                             data-dur="s">
                        </div>
                    </div>
                </time>

                <form>
                    <div class="form-group d-flex flex-column">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> Departing Time (24HR)</div>
                            </div>
                            <input type="time" class="form-control" id="Time">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> Location: </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Where would you like to go?"
                                   id="place">
                        </div>
                        <div class="input-group mt-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text"> How long do you need to prepare (mins): </div>
                            </div>
                            <input type="number" class="form-control" placeholder="30" id="prep">
                        </div>
                    </div>
                    <div id="iamUser"></div>
                </form>
                <div id="checkUser"></div>
                <div id='reminder_output'>
                </div>
            </div>
            

        <script type="text/javascript">

        </script>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>

<link rel="stylesheet" href="css/clock.css">
    
    <script src="js/clock.js"></script>
    <script src="js/Notification.js"></script>
</html>