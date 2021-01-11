<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
require_once 'include/common.php';

$dao = new AccountDAO();

$carparklist = $dao->retrieveCP();
//print_r($carparklist) ;
//var_dump(phpinfo());
//$ab = json_encode($carparklist);
//var_dump(json_last_error());
//var_dump($ab);
echo json_encode($carparklist);
// echo json_last_error()
?>