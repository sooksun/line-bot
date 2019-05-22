<?php


$curl = curl_init();

curl_setopt_array($curl, array(
 CURLOPT_URL => “https://api.line.me/v2/bot/message/push",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => “”,
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => “POST”,
 CURLOPT_POSTFIELDS => “Oh my god!”,
 CURLOPT_HTTPHEADER => array(
 “authorization: Bearer Line_token”,
 “cache-control: no-cache”,
 “content-type: application/json”,
 “postman-token: 71e40b26–87b8–5f38–477c-9bbb4cbffa88”
 ),
));
}

$response = curl_exec($curl);

$err = curl_error($curl);

curl_close($curl);

?>
