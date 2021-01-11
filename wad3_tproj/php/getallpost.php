<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
require_once 'include/common.php';

if(isset($_GET['Carpark'])){
    $carpark = $_GET['Carpark'];
    $dao = new AccountDAO();
    $carpark = $dao->getmePost($carpark);
    echo json_encode($carpark);
}


?>