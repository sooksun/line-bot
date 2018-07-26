<?php
/*
copyright @ medantechno.com
Modified by Ilyasa
2017
Modified by Sooksun Sonnual
2018
*/
require_once('line_class.php');
$channelAccessToken = 'c7W/6apDMEwyg2Px5x6dRnT4uvzxBY+ESRIigI57kOY/dvyR0Wbi6SG6jPGJTLvTt35PlSuoBuBjeDvSbJCWAfcpiz1ErocHOOO25kNVOQcDdT9yW1aWTG73cm/tuzqWKv//M1kBOS1lRW6UYVIY8gdB04t89/1O/w1cDnyilFU='; //Your Channel Access Token
$channelSecret = '3163eae7704dfcf9894d608ca489bc32';//Your Channel Secret

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$channelAccessToken}";
$_msg = $arrJson['events'][0]['message']['text'];
$msg =trim($_msg);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId']; //new
$replyToken 	= $client->parseEvents()[0]['replyToken'];
$message 	= $client->parseEvents()[0]['message'];
$profil 	= $client->profil($userId);
$mess_text 	= $message['text'];

if($message['type']=='sticker')
{	
	$callback = array(
			'UserID' => $profil->userId,	
                        'replyToken' => $replyToken,							
			'messages' => array(
					array(
					'type' => 'sticker',									
					'packageId' => '1' ,										
					'stickerId' => '13'
					)
					)
				);						
}else if($message['type']=='text') {
//เริ่มตัด
$api_key="xC7mzpTf6-RWaaCVPjDwYxa3rwAtpvc-";
$url = 'https://api.mlab.com/api/1/databases/tokapi/collections/conversation?apiKey='.$api_key.'';
$json = file_get_contents('https://api.mlab.com/api/1/databases/tokapi/collections/conversation?apiKey='.$api_key.'&q={"question":"'.$_msg.'"}');
$data = json_decode($json);
$isData=sizeof($data);
 
    $_userId=$userId;
	$_groupId=$groupId;
    $_msg=$_msg;
    //Post New Data
    $newData = json_encode(
      array(
        'userId' => $_userId,
		'groupId' => $_groupId,
        'msg'=> $_msg
      )
    );
    $opts = array(
      'http' => array(
          'method' => "POST",
          'header' => "Content-type: application/json",
          'content' => $newData
       )
    );
    $context = stream_context_create($opts);
    $returnValue = file_get_contents($url,false,$context);

?>
