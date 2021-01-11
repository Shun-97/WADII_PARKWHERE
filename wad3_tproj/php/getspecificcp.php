<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
require_once 'include/common.php';


$cpname = $_GET['Carpark'];
// $cpname = "Jurong Bird Park";
$dao = new AccountDAO();
$carpark = $dao->getCP($cpname);
echo json_encode($carpark);
?>