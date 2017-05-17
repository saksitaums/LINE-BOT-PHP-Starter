<?php
$access_token = 'XNhkwPW2XEiQ4ucjc0+IHLpHfMVY5UzXvQHJ5v8TwKqg0ME0EinfbyxIqZES7d5BAZ1oooj4uAfd+6W5TLhtR0Q2K2QGH4kP6gGE0PQbwtWgBnos/znVRFdp04e6Kywu9Aw0A/UuJ+3GE9Nso7VYrwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
