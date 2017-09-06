<?php
  
  $access_token = 'XNhkwPW2XEiQ4ucjc0+IHLpHfMVY5UzXvQHJ5v8TwKqg0ME0EinfbyxIqZES7d5BAZ1oooj4uAfd+6W5TLhtR0Q2K2QGH4kP6gGE0PQbwtWgBnos/znVRFdp04e6Kywu9Aw0A/UuJ+3GE9Nso7VYrwdB04t89/1O/w1cDnyilFU=';

  $content = file_get_contents('php://input');
  $events = json_decode($content, true);
  if (!is_null($events['events'])) {
    foreach ($events['events'] as $event) {
      if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
        $text = $event['message']['text'];
        $replyToken = $event['replyToken'];
        $mes = "";
        if($text == "A")
        {
          $mes += "OK"
        }
        else{
          $mes += "Error"
        }
        
        $messages = ['type' => 'text','text' => $mes];
        
        $url = 'https://api.line.me/v2/bot/message/reply';   
        $data = ['replyToken' => $replyToken,'messages' => [$messages]];
        
      }
    
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
echo "OK";
?>
