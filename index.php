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
}
else
//$ask_text=str_replace(" ", "%20", $mess_text);
//$key = '0a7f12df-3ed0-4b46-985a-5d8fa72f0a1b'; //API SimSimi
//$url = 'http://api.simsimi.com/request.p?key='.$key.'&lc=th&ft=1.0&text='.$ask_text;

//$json_data = file_get_contents($url);
//$url=json_decode($json_data,1);
//$answer = $url['response'];

if($message['type']=='text')
{
//เริ่มตัด
$api_key="xC7mzpTf6-RWaaCVPjDwYxa3rwAtpvc-";
$url = 'https://api.mlab.com/api/1/databases/tokapi/collections/conversation?apiKey='.$api_key.'';
$json = file_get_contents('https://api.mlab.com/api/1/databases/tokapi/collections/conversation?apiKey='.$api_key.'&q={"question":"'.$_msg.'"}');
$data = json_decode($json);
$isData=sizeof($data);
 
    $_question=$userId;
    $_answer=$_msg;
    //Post New Data
    $newData = json_encode(
      array(
        'question' => $_question,
        'answer'=> $_answer
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
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = 'ขอบคุณที่สอนครับ';
    $answer = $arrPostData['messages'][0]['text'];

  		$callback = array(
			'UserID' => $profil->userId,
                        'replyToken' => $replyToken,	
			'messages' => array(
				array(
					'type' => 'text',					
					'text' => ''.$answer.''
				     )
				)
				);

		date_default_timezone_set("Asia/Bangkok");
		$callback = array(
			'UserID' => $profil->userId,
                        'replyToken' => $replyToken,	
			'messages' => array(
				array(
					'type' => 'text',	
					'text' => $profil->displayName."\nuserId=".$userId."\ngroupId".$groupId."\ngroupId".$_msg
				     )
				)
				);
		//$strname = ;
		//$username = ereg_replace('[[:space:]]+', '', trim($profil->displayName));

//สิ้นสุดตัด     $callback['messages'][0]['text']
}
$result =  json_encode($callback);
file_put_contents('./reply.json',$result);
$client->replyMessage($callback);

file_get_contents("http://banpayapraischool.ac.th/cron/ins_linebot.php?msg=".$msg."&user_id=".$userId."&groupId=".$groupId);
?>
