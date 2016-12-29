<?php
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
			
			$messages = [
				'type' => 'text',
				'text' => 'Hello, world'
			],[
				'type' => 'image',
				'originalContentUrl' => 'https://scontent.fbkk2-2.fna.fbcdn.net/v/t1.0-9/15780827_10208479621532807_8092597677472327998_n.jpg?oh=b24ab20b4bf8d4f8547d9c9ae1956f2e&oe=58E3965E'
				'previewImageUrl' => 'https://scontent.fbkk2-2.fna.fbcdn.net/v/t1.0-9/15780827_10208479621532807_8092597677472327998_n.jpg?oh=b24ab20b4bf8d4f8547d9c9ae1956f2e&oe=58E3965E'
			];

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
