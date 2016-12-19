<?php
$access_token = 'w6xXZ8b65DEfUrmLLxKf/dFI1AwSlF66fByVVIe2OO7/NWq925L8ISa5E+yQ1AB+YnBOcWJ55BBAlNAmdG9CYbUhybnVQomXsYv/7CfQJInYMqPCBIRr2R9zuObBUkZBWoJac9Kcex9ToaV9qV0pdAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;