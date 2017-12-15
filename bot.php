<?php
define("serverName","1.179.206.170");
define("userName","sa");
define("userPassword","P@ssw0rd");
define("dbName","NAV2017");

ini_set('display_errors', 1);
error_reporting(~0);
	
$connectionInfo = array("Database"=>dbName, "UID"=>userName, "PWD"=>userPassword, "MultipleActiveResultSets"=>true);
$conWeb = sqlsrv_connect( serverName, $connectionInfo);
if($conWeb){
echo "connect";
}
$access_token = 'w6xXZ8b65DEfUrmLLxKf/dFI1AwSlF66fByVVIe2OO7/NWq925L8ISa5E+yQ1AB+YnBOcWJ55BBAlNAmdG9CYbUhybnVQomXsYv/7CfQJInYMqPCBIRr2R9zuObBUkZBWoJac9Kcex9ToaV9qV0pdAdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			if($text == "ชื่ออะไรครับ"){
			$messages = [
				"type"=> "image",
    				"originalContentUrl" => "https://iq-solution-bot.herokuapp.com/user3.jpg",
    				"previewImageUrl"=> "https://iq-solution-bot.herokuapp.com/user3.jpg"
			];}
			if($text == "1+1"){
			$messages = [
				"type" => "text",
    				"text" => "ง่าวแต้ 1+1 ก็ไม่รู้เรื่อง"
			];}
			if($text == "IQ"){
			$messages = [
				"type" => "text",
    				"text" => "ลูกพ่อออดแม่แอมมี่"
			];}
			if($text == "BG2017#travel#2000"){
			$messages = [
				"type" => "text",
    				"text" => "Budget ใช้ได้"
			];}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
