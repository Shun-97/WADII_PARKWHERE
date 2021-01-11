<?php

$search = $_GET['search'];

$curl = curl_init();

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// curl_setopt($curl,CURLOPT_TIMEOUT,999999);

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.serphouse.com/serp/live",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 99,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => '{"data":{
			"q": "'.$search.'",
			"domain": "google.com",
			"loc": "Singapore",
			"lang": "en",
			"device": "desktop",
			"serp_type": "image",
			"page": "1",
			"verbatim": "0"
}}',
    CURLOPT_HTTPHEADER => array(
        "accept: application/json",
        "authorization: Bearer 1W9o1nVX6sHz7aDEDSWwVii7A8DXMooalGp6edzVmF9SnQwW2BWdck8Bmy9l",
        "content-type: application/json"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
}
else {
    echo $response;
}
?>