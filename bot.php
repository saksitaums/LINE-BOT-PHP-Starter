<?php
$access_token = 'XNhkwPW2XEiQ4ucjc0+IHLpHfMVY5UzXvQHJ5v8TwKqg0ME0EinfbyxIqZES7d5BAZ1oooj4uAfd+6W5TLhtR0Q2K2QGH4kP6gGE0PQbwtWgBnos/znVRFdp04e6Kywu9Aw0A/UuJ+3GE9Nso7VYrwdB04t89/1O/w1cDnyilFU=';

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

			$mes = "";
			if($text == "A"){
				$mes = "สวัสดีครับ";
			}
			if($text == "B"){
				$mes = "สบายดีรึป่าว?";
			}
			if($text == "C"){
				$mes = "ทดสอบ";
			}
			else{
				$mes = "ไม่พบข้อมูล CC";
			}
			
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $mes
			];
			
			$images = [
				'type' => 'image',
				'originalContentUrl' => "http://www.scg.com/sufficiency/images/news4.jpg?1504687985",
				'previewImageUrl' => "http://www.scg.com/sufficiency/images/news4.jpg?1504687985"
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
