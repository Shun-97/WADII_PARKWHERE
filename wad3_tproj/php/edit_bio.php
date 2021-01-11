<?php
require_once 'include/common.php';
if(isset($_POST)) {
    $bio = $_POST['bio'];
    var_dump($bio);
    $username = $_SESSION['username'];
    $dao = new AccountDAO();
    $updateBio = $dao->updateBio($bio, $username);
    // var_dump($updateBio);
    header("Location: ../profile.php");
}

?>