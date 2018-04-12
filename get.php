<?PHP
require "vendor/autoload.php";

$access_token = 'c7W/6apDMEwyg2Px5x6dRnT4uvzxBY+ESRIigI57kOY/dvyR0Wbi6SG6jPGJTLvTt35PlSuoBuBjeDvSbJCWAfcpiz1ErocHOOO25kNVOQcDdT9yW1aWTG73cm/tuzqWKv//M1kBOS1lRW6UYVIY8gdB04t89/1O/w1cDnyilFU=';

$channelSecret = '3163eae7704dfcf9894d608ca489bc32';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$response = $bot->getMessageContent('<messageId>');
if ($response->isSucceeded()) {
    $tempfile = tmpfile();
    fwrite($tempfile, $response->getRawBody());
} else {
    error_log($response->getHTTPStatus() . ' ' . $response->getRawBody());
}

?>
