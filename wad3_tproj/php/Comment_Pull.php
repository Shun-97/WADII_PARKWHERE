<?php
require_once 'include/common.php';

$username = $_GET['username'];
// $username = "adminboy";
$dao = new AccountDAO();

$comments = $dao->Comment($username);
// var_dump($comments);
$jsonob = json_encode($comments);

echo $jsonob;

?>