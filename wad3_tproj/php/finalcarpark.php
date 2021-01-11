<?php
require_once 'include/common.php';
// print_r($_POST);
// print_r(json_decode($_POST)) 
$query = $_POST['query'];
$check = [];
$phparray = json_decode($query);
// var_dump($phparray);

// var_dump(json_last_error());
foreach ($phparray as $phpObj) {
   // print_r($phpObj);
   $carparkid = $phpObj->carparkid;
   $carparkname = $phpObj->carparkname;
   $sat_rate = $phpObj->sat_rate;
   $wkdy_rate = $phpObj->wkdy_rate;
   $lat = $phpObj->lat;
   $lng = $phpObj->lng;
   $dao = new AccountDAO();
   $dao->insertCP($carparkid, $carparkname, $sat_rate, $wkdy_rate, $lat, $lng);

   
}
if ($dao) {
   echo 'true';
}
else {
   echo 'false';
}
// $carparkid = $phpObj->carparkid;
// $carparkname = $phpObj->carparkname;
// $sat_rate = $phpObj->sat_rate;
// $wkdy_rate = $phpObj->wkdy_rate;
// $lat = $phpObj->lat;
// $lng = $phpObj->lng;
// $dao = new AccountDAO();
// $dao->insertCP($carparkid, $carparkname, $sat_rate, $wkdy_rate, $lat, $lng);
?>