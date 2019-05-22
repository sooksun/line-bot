<?php

include(‘conect_db.php’);

date_default_timezone_set(“Asia/Bangkok”);

$datef = date(‘Y-m-d’);

$json = file_get_contents(‘php://input’);

$request = json_decode($json, true);

$queryText = $request[“queryResult”][“queryText”];

$userId = $request[‘originalDetectIntentRequest’][‘payload’][‘data’][‘source’][‘userId’];

$query = “INSERT INTO line_log(user_id,text,date_time) VALUE (‘$userId’,’$queryText’,NOW())”;

$resource = mysql_query($query) or die (“error”.mysql_error());

?>
