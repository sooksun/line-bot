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
$pesan=str_replace(" ", "%20", $pesan_datang);
$key = 'YOUR-API-KEY-SIMSIMI'; //API SimSimi
$url = 'http://sandbox.api.simsimi.com/request.p?key='.$key.'&lc=id&ft=1.0&text='.$pesan;
$json_data = file_get_contents($url);
$url=json_decode($json_data,1);
$diterima = $url['response'];
if($message['type']=='text')
{
if($url['result'] == 404)
	{
		$balas = array(
							'UserID' => $profil->userId,	
                                                        'replyToken' => $replyToken,													
							'messages' => array(
								array(
										'type' => 'text',					
										'text' => 'Mohon Gunakan Bahasa Indonesia Yang Benar :D.'
									)
							)
						);
				
	}
else
if($url['result'] != 100)
	{
		
		
		$balas = array(
							'UserID' => $profil->userId,
                                                        'replyToken' => $replyToken,														
							'messages' => array(
								array(
										//'type' => 'text',					
										//'text' => 'สวัสดีครับ '.$profil->displayName.' มีอะไรให้รับใช้ครับ'
									  	 'type'=> 'template',
										  'altText'=>  'this is a buttons template',
										  'template'=> {
										    'type'=>  'buttons',
										    'actions'=>  [
										      {
											'type'=>  'message',
											'label'=>  'แนะนำตัวเอง',
											'text'=> 'Action 1'
										      },
										      {
											'type'=> 'message',
											'label'=>  'พบผู้ปกครอง',
											'text'=>  'Action 2'
										      },
										      {
											'type'=>  'message',
											"label"=>  'พบ ผู้อำนวยการ',
											"text"=>  'Action 3'
										      }
										    ],
										    'thumbnailImageUrl'=> 'http://www.obec.go.th/sites/obec.go.th/files/document/attachment/34589/logo_obec_color.jpg',
										    'title'=> 'ระบบการบริหารผลการปฏิบัติงานครู สพฐ',
										    'text'=> 'ยินดีต้อนรับค่ะ'
										  }
									
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
