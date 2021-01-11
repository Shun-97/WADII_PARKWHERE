<?php

header("Access-Control-Allow-Origin: *");

$url = 'http://datamall2.mytransport.sg/ltaodataservice/CarParkAvailabilityv2';

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL ,$url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($curl, CURLOPT_HEADER, 0);

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   'AccountKey: 6rpF+rxwShKzMMP5I4AVnw==',
   'Content-Type: application/json'
));

$result = curl_exec($curl);

curl_close($curl);

// $json = json_encode($result);

echo $result
?>