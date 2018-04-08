<?php



require "vendor/autoload.php";

$access_token = 'c7W/6apDMEwyg2Px5x6dRnT4uvzxBY+ESRIigI57kOY/dvyR0Wbi6SG6jPGJTLvTt35PlSuoBuBjeDvSbJCWAfcpiz1ErocHOOO25kNVOQcDdT9yW1aWTG73cm/tuzqWKv//M1kBOS1lRW6UYVIY8gdB04t89/1O/w1cDnyilFU=';

$channelSecret = '3163eae7704dfcf9894d608ca489bc32';

$pushID = 'U2b93ab733cb923742937b1ddc1afb328';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('สวัสดีค่ะ '.$_POST["name"].'\n e-mail ของคุณคือ :'.$_POST["email"]);
$response = $bot->pushMessage($pushID, $textMessageBuilder);

$imageMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder('http://www.kruupdate.com/administator/myfile/9990386128.jpg','http://www.kruupdate.com/administator/myfile/9990386128.jpg');
$response = $bot->pushMessage($pushID, $imageMessageBuilder);

//$stickerMessageBuilder = new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder('1','13');
//$response = $bot->pushMessage($pushID, $stickerMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();



header("location:javascript://history.go(-1)");
exit;

?>



