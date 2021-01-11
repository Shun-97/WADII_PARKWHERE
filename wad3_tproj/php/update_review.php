<?php
require_once 'include/common.php';
var_dump($_SESSION);
if (isset($_SESSION['username']) && isset($_GET['cp'])){
    $carparkname = $_GET['cp'];
    $carparkname = str_replace("%20"," ",$carparkname);
    $stars = $_GET['rating'];
    $info = $_GET['info'];
    $username = $_SESSION['username'];
    $dao = new AccountDAO();
    $updateBio = $dao->insertPost($username, $carparkname, $info ,$stars);
    header("Location: ../Review.php?Carpark=$carparkname");
} else {
    header("Location: logout.php");
    exit;
}


?>