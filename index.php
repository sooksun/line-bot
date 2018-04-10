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

$userId 	= $client->parseEvents()[0]['source']['userId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$message 	= $client->parseEvents()[0]['message'];
$profil = $client->profil($userId);
$mess_text = $message['text'];

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
$ask_text=str_replace(" ", "%20", $mess_text);
$key = '0a7f12df-3ed0-4b46-985a-5d8fa72f0a1b'; //API SimSimi
$url = 'http://api.simsimi.com/request.p?key='.$key.'&lc=th&ft=1.0&text='.$ask_text;

$json_data = file_get_contents($url);
$url=json_decode($json_data,1);
$answer = $url['response'];
if($message['type']=='text')
{
if($url['result'] == 404)
	{
		$callback = array(
							'UserID' => $profil->userId,	
                                                        'replyToken' => $replyToken,													
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'อืม!!!ก้อยังสงสัยอยู่นะ..'
									)
							)
						);
				
	}
else
if($url['result'] != 100)
	{
		$callback = array(
			'UserID' => $profil->userId,
                        'replyToken' => $replyToken,														
			'messages' => array(
				array(
					'type' => 'text',					
					'text' => 'สวัสดีครับ '.$profil->displayName.' มีอะไรให้รับใช้ครับ'						
				     )
					   )
				);
				
	}
	else{
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
						
	}
}
 
$result =  json_encode($callback);

file_put_contents('./reply.json',$result);


$client->replyMessage($callback);
?>
