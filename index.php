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

if($message['type']=='text')
{
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

    switch (rand(1,20)) {
    case 1:
        $answer = 'เยี่ยม !';
        break;
    case 2:
        $answer = 'น่าสนใจนะ';
        break;
    case 3:
        $answer = 'เยี่ยมมาก';
        break;
    case 4:
        $answer = 'สักครู่';
        break;
    case 5:
        $answer = 'ยอดเลย';
        break;
   case 6:
        $answer = 'ว้าว';
        break;
   case 7:
        $answer = 'สุดยอด';
        break;
   case 8:
        $answer = 'ว้าว';
        break;
  case 9:
        $answer = 'เจ๋ง';
        break;
  case 10:
        $answer = 'แจ๋วเลยครับ';
        break;
   case 11:
        $answer = 'ฟินสุดๆ';
        break;
    case 12:
        $answer = 'perfect !';
        break;
      case 13:
        $answer = '55555..';
        break;
      case 14:
        $answer = 'สวยงาม';
        break;
     case 15:
       $answer = 'ที่หนึ่งเลย';
        break;
     case 16:
        $answer = 'อย่างนี้ใช่เลย';
        break;
    case 17:
        $answer = 'มาเรื่อยๆครับ';
        break;
    case 18:
        $answer = 'ใจดีจัง';
        break;
    case 19:
        $answer = 'แหล่มเลย !!';
        break;
    default:
        $answer = 'เก่งจัง น่ารักสุดๆ';
    }

	
	
		$callback = array(
			'UserID' => $profil->userId,
                        'replyToken' => $replyToken,	
			'messages' => array(
				array(
					'type' => 'text',	
					'text' => $answer.$profil->displayName
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
