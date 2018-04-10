<?php
/*
copyright @ medantechno.com
Modified by Ilyasa
2017
*/
require_once('line_class.php');

$channelAccessToken = 'c7W/6apDMEwyg2Px5x6dRnT4uvzxBY+ESRIigI57kOY/dvyR0Wbi6SG6jPGJTLvTt35PlSuoBuBjeDvSbJCWAfcpiz1ErocHOOO25kNVOQcDdT9yW1aWTG73cm/tuzqWKv//M1kBOS1lRW6UYVIY8gdB04t89/1O/w1cDnyilFU='; //Your Channel Access Token
$channelSecret = '3163eae7704dfcf9894d608ca489bc32';//Your Channel Secret

$client = new LINEBotTiny($channelAccessToken, $channelSecret);

$userId 	= $client->parseEvents()[0]['source']['userId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$message 	= $client->parseEvents()[0]['message'];
$profil = $client->profil($userId);
$pesan_datang = $message['text'];

if($message['type']=='sticker')
{	
	$balas = array(
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
//$pesan=str_replace(" ", "%20", $pesan_datang);
//$key = '0a7f12df-3ed0-4b46-985a-5d8fa72f0a1b'; //API SimSimi
//$url = 'http://api.simsimi.com/request.p?key='.$key.'&lc=th&ft=1.0&text='.$pesan;

//$json_data = file_get_contents($url);
//$url=json_decode($json_data,1);
//$diterima = $url['response'];

$ch = curl_init();                    
$url = 'http://banpayapraischool.ac.th/answer/find_answer.php';
$req='ข้าว';
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, true);  
curl_setopt($ch, CURLOPT_POSTFIELDS, "req=".$req); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$diterima = curl_exec ($ch); 
curl_close ($ch); 

if($message['type']=='text')
{
if($diterima == '')
	{
		$balas = array(
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
		$balas = array(
							'UserID' => $profil->userId,
                            'replyToken' => $replyToken,														
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => ''.$diterima.''
									)
							)
						);
						
	}
}
 
$result =  json_encode($balas);

file_put_contents('./reply.json',$result);


$client->replyMessage($balas);
?>
