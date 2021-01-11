<?php
require_once 'php/include/common.php';
$error = '';
$success = '';



if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    
}

else if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script src="js/main.js"></script>
    <script src="js/in-view.min.js"></script>
</head>

<body>
    <div class="container-fluid" id="login">
        <div class="row">
            <div class="col-xs-12 popup-background">
                <div class="popup-login p-5 m-auto bg-secondary">
<<<<<<< HEAD
                    <?php if (isset($error)) { echo " <font color='red'><h2>$error</h2></font>";}if (isset($success)) {echo "<font color='blue'><h2>$success</h2></font>";}?>
=======
                <?php
                    if (isset($_SESSION['error'])) {  
                        echo "
                            <ul>"; 
                        foreach ($error as $err) {
                            echo "<li>$err</li>";
                        }
                        echo "</ul>
                        ";
                        unset($_SESSION['error']);
                    } else if(isset($success)){
                        echo $success;
                    }
                    ?>
>>>>>>> a9f541c5b99abcf998013d06c0759c5246848d37
                    <form method="POST" action="php/process_login.php">

                        <label for="username" class="divlabel my-2 ">Username</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name='username' id="username" placeholder="Enter your username" aria-describedby="inputGroupPrepend" required>
                        </div>

                        <label for="password" class="divlabel my-2 ">Password</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name='password' id="password" placeholder="Enter your password" aria-describedby="inputGroupPrepend2" required>
                        </div>


                        <div>
                            <button input type="submit" class='btn btn-primary'>Log In</button>
                        </div>
                    </form>
                    <a href="index.html" class="btn btn-outline-info btn-sm" style="color: teal;">Back</a>
                    <a href="registration.php" class="border-bottom border-warning" >Don't have an account yet? <i>Sign Up</i> here!</a>
                </div>
            </div>
        </div>
    </div>


    <script>
        // add animation when user scroll to the segment
        inView("#login")
            .on('enter', function() {
                document.getElementsByClassName("popup-login")[0].classList.add("animate__bounceInUp", "animate__animated");
            });
    </script>
</body>

</html>