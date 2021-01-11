<?php

header("Access-Control-Allow-Origin: *");

$url = 'https://www.ura.gov.sg/uraDataService/invokeUraDS?service=Car_Park_Details';

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($curl, CURLOPT_HEADER, 0);

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Token: NsMaA6ZQ-TZJ76ke45ZaBCJ9VVcbj0jeaqn33jpScG--05face+d6503b86CYc2j8eAPV27XwWP1gH-hE-V3n-Xamy404FjDYcTm',
    'AccessKey: 39c047a5-a05f-4625-baf7-1c350b060870',
    'Content-Type: application/json'
));

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$result = curl_exec($curl);

curl_close($curl);

// echo ($result);

// $json = json_encode($result);

echo $result;
