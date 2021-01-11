<?php
require_once 'php/include/common.php';
$username = "Guest";
$pic = "temp.jpg";
$noOfPosts = 0;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $dao = new AccountDAO();
    $pic = $dao->retrievePic($username);
    $bio = $dao->retrieveBio($username);
    $join_date = $dao->retrieveJoinDate($username);
    $noOfPosts = $dao->retrieveNoOfPosts($username);
} else {
    header("Location: search.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>ParkWhere</title>
    <link href='https://fonts.googleapis.com/css?family=Cinzel Decorative' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/gh/cferdinandi/smooth-scroll@15.0.0/dist/smooth-scroll.polyfills.min.js">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/main.css">
    <script src="js/main.js"></script>
    <script src="js/profile.js"></script>



</head>

<body onload='Comment_All()'>
    <div class="container-fluid" id="profile">

        <div class="row" id="about">
            <div class="col-md-6 m-auto text-center">
                <div class="w-100 m-auto" id="image">
                    <img src="images/User/<?= $pic ?>" alt="Circle Image" class="img-raised img-fluid rounded-circle my-3">
                    <i class='far fa-images' data-toggle="modal" data-target="#editImageModal"></i>
                </div>

                <div class="w-100 m-auto" id="membership_status">
                    <p><span id='isUser' class="display-4"><?= $username ?></span><small class="small">(Member)</small></p>
                </div>

                <div class="w-100 m-auto" id="bio-info">
                    <i class='fas fa-pencil-alt' data-toggle="modal" data-target="#editBioModal"></i>
                    <p id="bio_text" class="d-inline-block display-5"><?= $bio ?></p>
                </div>

                <div class="w-100 m-auto border-top border-light" id="user-details">
                    <div class="description text-right" id="user_info">
                        <div class="">
                            <small>Date Joined: <?= $join_date ?></small>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row col-md-6 m-auto text-center" id="posts">
            <div class='w-100 m-auto border-bottom border-light '>
                <p class="display-5">Post History</p>
                <small>Number of posts: <?= $noOfPosts ?></small>
            </div>
            <div class='text-left col-md-12 col-xs-12' id='Post_Output'>
                <!--                        something generates here-->
            </div>
        </div>


    </div>



    <div class="modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="editImageModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload a photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="php/upload_pic.php" enctype="multipart/form-data" method="post">
                        <input type="file" name="fileToUpload" id="fileToUpload">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editBioModal" tabindex="-1" role="dialog" aria-labelledby="editBioModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit bio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="php/edit_bio.php">
                        <div class="form-group">
                            <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>

</body>
<!-- <input type="textarea" id="bio" name="bio" required maxlength="500" value='${value}'> -->


</html>