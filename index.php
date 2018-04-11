<?PHP
$strAccessToken = "c7W/6apDMEwyg2Px5x6dRnT4uvzxBY+ESRIigI57kOY/dvyR0Wbi6SG6jPGJTLvTt35PlSuoBuBjeDvSbJCWAfcpiz1ErocHOOO25kNVOQcDdT9yW1aWTG73cm/tuzqWKv//M1kBOS1lRW6UYVIY8gdB04t89/1O/w1cDnyilFU=";
 
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
 
$strUrl = "https://api.line.me/v2/bot/message/reply";
 
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$_msg = $arrJson['events'][0]['message']['text'];
 
 
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
  }
}else{
  if($isData >0){
   foreach($data as $rec){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = $rec->answer;
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
        $arrPostData['messages'][0]['text'] = 'อ๋อ เหมือนเพื่อนเลย';
        break;
      case 14:
        $arrPostData['messages'][0]['text'] = 'ว่าแต่ คุณเป้นหรือเปล่า';
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

  }
}
 
 
$channel = curl_init();
curl_setopt($channel, CURLOPT_URL,$strUrl);
curl_setopt($channel, CURLOPT_HEADER, false);
curl_setopt($channel, CURLOPT_POST, true);
curl_setopt($channel, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($channel, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($channel, CURLOPT_RETURNTRANSFER,true);
curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($channel);
curl_close ($channel);
?>
