<?php
require_once 'include/common.php';

$query = $_POST['query'];

$phparray = json_decode($query);
// print_r($phparray);
$id = $phparray->ID;
$username = $phparray->username;
$location = $phparray->location;
$time = $phparray->time;

$dao = new AccountDAO(); 
$dao->Schedule($id,$username,$location,$time);


// print_r([$id,$username,$location, $time])

?>