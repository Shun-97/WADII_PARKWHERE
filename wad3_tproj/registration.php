<?php 
require_once 'php/include/common.php';

$msg = '';
if (isset($_SESSION['error'])) {
    $msg = $_SESSION['error'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Cinzel Decorative' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15.0.0/dist/smooth-scroll.polyfills.min.js">
    </script>
    <title>ParkWhere</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script src="js/main.js"></script>
    <!-- <script src="js/in-view.min.js"></script> -->
</head>

<body>
        <div class="container-fluid" id="login">
            <div class="row">
                <div class="col-xs-12 popup-background">
                    <div class="popup-login p-5 m-auto bg-secondary">
                    <?php 
                    if (isset($_SESSION['error'])){
                        echo "
                            <ul>"; 
                            foreach ($msg as $err) {
                                echo "<li>$err</li>";
                            }
                            "</ul>

                    ";
                    unset($_SESSION['error']);
                    }
                    ?>
                        
                        
                    </div>
                </div>
            </div>
        </div>


    <script>
        user_role = 'Guest'

        // add animation when user scroll to the segment
        // inView("#login")
        //     .on('enter', function(){
        //         document.getElementsByClassName("popup-login")[0].classList.add("animate__bounceInUp", "animate__animated");
        //     });
        console.log(document.getElementById("register"))
            
        
        

    </script>
    </body>

</html>