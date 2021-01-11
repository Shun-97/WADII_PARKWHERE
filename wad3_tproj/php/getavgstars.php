<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
require_once 'include/common.php';

if(isset($_GET['Carpark'])){
    $carpark = $_GET['Carpark'];
    // $carpark = "Jurong Bird Park";
    $dao = new AccountDAO();
    $avgStars = $dao->retrieveAvgStars($carpark);
    echo json_encode($avgStars);
}


?>