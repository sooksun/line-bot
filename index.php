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


$userId 	= $client->parseEvents()[0]['source']['userId'];
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
$url = 'https://api.mlab.com/api/1/databases/tokapi/collections/autoanswer?apiKey='.$api_key.'';
$json = file_get_contents('https://api.mlab.com/api/1/databases/tokapi/collections/autoanswer?apiKey='.$api_key.'&q={"question":"'.$_msg.'"}');
$data = json_decode($json);
$isData=sizeof($data);
 
if (strpos($_msg, 'สอนว่า') !== false) {
  if (strpos($_msg, 'สอนว่า') !== false) {
    $x_tra = str_replace("สอนว่า","", $_msg);
    $pieces = explode("|", $x_tra);
    $_question=str_replace("[","",$pieces[0]);
    $_answer=str_replace("]","",$pieces[1]);
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
  }
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
}else{
  if($isData >0){
   foreach($data as $rec){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = $rec->answer;
	$answer = $rec->answer;
   }
  }else{
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    switch (rand(1,20)) {
    case 1:
        $arrPostData['messages'][0]['text'] = 'คิดเหมือนกันเลย !';
        break;
    case 2:
        $arrPostData['messages'][0]['text'] = 'น่าสนใจนะ';
        break;
    case 3:
        $arrPostData['messages'][0]['text'] = 'อืม! ...เอไงดี';
        break;
    case 4:
        $arrPostData['messages'][0]['text'] = 'สักครู่';
        break;
    case 5:
        $arrPostData['messages'][0]['text'] = 'เออ..แบบว่ายังไม่อยากคุยอะ';
        break;
   case 6:
        $arrPostData['messages'][0]['text'] = 'งุงงิงๆๆ';
        break;
   case 7:
        $arrPostData['messages'][0]['text'] = 'ผมจะตั้งใจฟัง';
        break;
   case 8:
        $arrPostData['messages'][0]['text'] = 'ไม่อยากคุยเรื่องส่วนตัว';
        break;
  case 9:
        $arrPostData['messages'][0]['text'] = 'คุณก็น่ารักดีนะ คุยสนุกด้วย';
        break;
  case 10:
        $arrPostData['messages'][0]['text'] = 'พูดถูกใจ';
        break;
   case 11:
        $arrPostData['messages'][0]['text'] = 'ฟินสุดๆ';
        break;
    case 12:
        $arrPostData['messages'][0]['text'] = 'พี่ก็เป็นเหรอ';
        break;
      case 13:
        $arrPostData['messages'][0]['text'] = '55555..';
        break;
      case 14:
        $arrPostData['messages'][0]['text'] = 'ว่าแต่ คุณเป็นหรือเปล่า';
        break;
     case 15:
        $arrPostData['messages'][0]['text'] = 'แบบนี้ตอบ เอาไว้ตอบรวบยอดเลย ละกัน';
        break;
     case 16:
        $arrPostData['messages'][0]['text'] = 'อุ้ยตาย ลืมไป ไรนะ...ะ';
        break;
    case 17:
        $arrPostData['messages'][0]['text'] = 'ก็..คุยสนุก ๆ ไปเรื่อยๆ';
        break;
    case 18:
        $arrPostData['messages'][0]['text'] = 'ใจดีจัง';
        break;
    case 19:
        $arrPostData['messages'][0]['text'] = 'แหล่มเลย !!';
        break;
    default:
        $arrPostData['messages'][0]['text'] = 'เก่งจัง น่ารักสุดๆ';
    }
	$answer = $arrPostData['messages'][0]['text'];
	
  }
		date_default_timezone_set("Asia/Bangkok");
		$callback = array(
			'UserID' => $profil->userId,
                        'replyToken' => $replyToken,	
			'messages' => array(
				array(
					'type' => 'text',	
					'text' => "INSERT INTO linebot (user_id, user_name, messages) VALUES ('".$profil->userId."','".$profil->displayName."','".$_msg."')"
					
				     )
				)
				);
}
//สิ้นสุดตัด
}
$result =  json_encode($callback);
file_put_contents('./reply.json',$result);
$client->replyMessage($callback);
file_get_contents("http://banpayapraischool.ac.th/cron/ins_linebot.php?msg=".$_msg."&user_id=".$userId);
//file_get_contents("http://banpayapraischool.ac.th/cron/ins_linebot.php?user_id=".$profil->userId."&name=".$profil->displayName."&msg=".$_msg);
//include ("http://banpayapraischool.ac.th/cron/ins_linebot.php?user_id=".$profil->userId."&name=".$profil->displayName."&msg=".$_msg);
//header( "Location: http://banpayapraischool.ac.th/cron/ins_linebot.php?user_id=".$profil->userId."&name=".$profil->displayName."&msg=".$_msg);
?>
