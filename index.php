<?php
$access_token = 'I2lWl/T3XmN5orfzlcPMtKVevDPhe+HQzHpTsZj0FRY1iK4yVv5tZScn862+xYmSZ9ei1iMCD0xniyqQ8v6OZd849MrBEOkckchLmvbBSmXjnWMUYwKL7SFlJgwZEyfYDspyeAWo398e2tMzUpDJWAdB04t89/1O/w1cDnyilFU=';
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
			$command = $text;
			$command = substr($command,0,2);
			$id = $text;
			$id = substr($text,2);

			
			if($command =="->")
			{
				$text_reply ="ผู้ป่วย  ".$id."   ชื่อ ".$name."".$surname;
			}
			
			
			if($text =="->")
			{
				$text_reply =" Bot ready for command";
			}
			
			if($text =="->ค้นหา->ผิดนัด->ยะลา->ยะหา")
			{
				$text_reply =" พบผู้ป่วยผิดนัด 2 ราย";
			}
			
			if($text =="->ค้นหา->ผิดนัด->ยะลา->รามัน")
			{
				$text_reply =" พบผู้ป่วยผิดนัด 0 ราย";
			}

			if($text =="->ค้นหา->ผิดนัด->ยะลา->กาบัง")
			{
				$text_reply =" พบผู้ป่วยผิดนัด 0 ราย";
			}
			
			if($text =="->ค้นหา->ผิดนัด->ยะลา")
			{
				$text_reply =" พบผู้ป่วยผิดนัด 2 ราย";
			}
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text_reply
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
