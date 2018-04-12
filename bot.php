<?PHP
require "vendor/autoload.php";
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('c7W/6apDMEwyg2Px5x6dRnT4uvzxBY+ESRIigI57kOY/dvyR0Wbi6SG6jPGJTLvTt35PlSuoBuBjeDvSbJCWAfcpiz1ErocHOOO25kNVOQcDdT9yW1aWTG73cm/tuzqWKv//M1kBOS1lRW6UYVIY8gdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '3163eae7704dfcf9894d608ca489bc32']);


    $actions =array[ 
              array( 
                "type"=>"message",
                "label"=> "Yes",
                "text"=> "Yes"
                  ),
              array( 
                "type"=> "message",
                "label"=> "No",
                "text"=> "No"
                  )
            ];



$confirmTemplateBuilder = new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder('hello?',$actions);
$response = $bot->pushMessage('U2b93ab733cb923742937b1ddc1afb328', $confirmTemplateBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

?>
