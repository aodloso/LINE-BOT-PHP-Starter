<?php
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('w6xXZ8b65DEfUrmLLxKf/dFI1AwSlF66fByVVIe2OO7/NWq925L8ISa5E+yQ1AB+YnBOcWJ55BBAlNAmdG9CYbUhybnVQomXsYv/7CfQJInYMqPCBIRr2R9zuObBUkZBWoJac9Kcex9ToaV9qV0pdAdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => 'e91746b34406abede897718c3c18dfb4']);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
$response = $bot->replyMessage('<replyToken>', $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
