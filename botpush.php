<?php
require "vendor/autoload.php";
$access_token = 'c7W/6apDMEwyg2Px5x6dRnT4uvzxBY+ESRIigI57kOY/dvyR0Wbi6SG6jPGJTLvTt35PlSuoBuBjeDvSbJCWAfcpiz1ErocHOOO25kNVOQcDdT9yW1aWTG73cm/tuzqWKv//M1kBOS1lRW6UYVIY8gdB04t89/1O/w1cDnyilFU=';
$channelSecret = '3163eae7704dfcf9894d608ca489bc32';

$pushID = $_GET["groupid"]; //"C284df1adfe47a5ba29b9ac11507b77df";  ///'U2b93ab733cb923742937b1ddc1afb328';
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("เรียนคณะครูโรงเรียน ".$_GET["name"]."\n วันนี้มีข่าวสารดังนี้ค่ะ".$_GET["msg"]);
$response = $bot->pushMessage($pushID, $textMessageBuilder);
echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
exit;
?>
