$bot = new \LINE\LINEBot(new CurlHTTPClient('RmaUTHkUaqvs3jvB0kl8c7WlAQZ/IMcnNLgE6ecVjPbKdz3vngs4kbVP3eKMdTerCp/DkYy/UF/tyza3IBFKsOy08NVmIBwAPlfVPIdfF6HqtCFaLb6qCxypQAzARFhM566vP44DTv7UPs8Q5oepHgdB04t89/1O/w1cDnyilFU='), [
    'channelSecret' => '8f930e421d805bb85e40400c647404c2'
]);

$res = $bot->getProfile('user-id');
if ($res->isSucceeded()) {
    $profile = $res->getJSONDecodedBody();
    $displayName = $profile['displayName'];
    $statusMessage = $profile['statusMessage'];
    $pictureUrl = $profile['pictureUrl'];
}
