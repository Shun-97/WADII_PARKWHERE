<?php
require_once 'include/common.php';
header("Access-Control-Allow-Origin: *");

var_dump($_POST);

if (isset($_POST)){
   $carparkname = $_POST['cpname'];
   $wkdy_rate   = $_POST['rates1'];
   $sat_rate = $_POST['rates2'];
   $coord = $_POST['coord_Lat'];
   $coord = explode(", " , $coord);

   $lat = $coord[0];
   $lng = $coord[1];

   if ($wkdy_rate == '') {
      $wkdy_rate = 'Missing Information';
   }
   if ($sat_rate == '') {
      $sat_rate = 'Missing Information';
   }
   if ($lat == '' || $lng == '') {
      $searchcp = str_replace(' ','%20',$carparkname);
      
      $url = "https://developers.onemap.sg/commonapi/search?searchVal=$searchcp&returnGeom=Y&getAddrDetails=Y&pageNum=1";

      $curl = curl_init();
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      
      curl_setopt($curl, CURLOPT_URL ,$url);

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

      curl_setopt($curl, CURLOPT_HEADER, 0);

      curl_setopt($curl, CURLOPT_HTTPHEADER, array(
         'Content-Type: application/json'
      ));

      $result = curl_exec($curl);
      // var_dump(curl_error($curl));
      if (json_decode($result)->found == 0) {
         $_SESSION['status'] = 'Carpark not found! Please try again';
         header('Location:../addsecretlocation.php');
         exit;
      }

      $jsonobj = json_decode($result)->results;

      $lat = $jsonobj[0]->LATITUDE;
      $lng = $jsonobj[0]->LONGITUDE;
   }
   $dao = new AccountDAO;
   $carparkid = 'UserInsert';

   $success = $dao->insertCP($carparkid, $carparkname, $sat_rate, $wkdy_rate, $lat, $lng);

   if($success) {
      $_SESSION['status'] = 'Carpark Successfully Added';
      header('Location:../addsecretlocation.php');
   }
   else {
      $_SESSION['status'] = 'Oh dear, something went wrong. The carpark is already added' ;
      header('Location:../addsecretlocation.php');
   }

}



?>