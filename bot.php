<?php
$access_token = 'Ix6Et3oEImOG2kDfvI/ZT+8S2x+JDNJRJBX1oNBA6UKWntWtLpa/wOfrq7EFvCd+tbN5Cta3qgSB9zE9o+jjJf3Wolc1E25lM/KUbBozktDcdfdfaBSBDc2T+kVmeZJ0cXkRQRzq4Mmc4QkPj5owXAdB04t89/1O/w1cDnyilFU=';

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
			if($text=="ดีจ้า")
				$messages = ['type' => 'text','text' => "สวัสดีดีครัซ.."];
			else if($text=="t"){
				$page=[['353', '404', '407', '434', '559', '673', '805', '990', '1041', '1180', '1284', '1389', '1482', '1582', '1656', '1741', '1803', '1900', '1954', '2023', '2109', '2173', '2250', '2314', '2399', '2447', '2524'],['2580', '2603', '2637', '2727', '2786', '2833', '2894', '2938', '2996', '3088', '3131', '3194', '3237', '3285', '3311', '3340', '3368', '3398', '3463', '3509', '3570', '3589', '3612', '3634', '3659', '3692', '3707', '3713', '3754', '3787', '3835', '3864', '3877', '3897', '3920', '3952', '3967', '3991', '4010', '4024', '4046', '4055', '4079', '4101', '4133', '4180', '4240', '4267', '4305', '4350', '4381', '4398', '4406', '4433', '4469', '4502', '4538', '4586', '4631', '4693', '4768', '4800', '4829', '4887', '4958', '4990', '5025', '5063', '5147', '5185', '5232', '5289', '5319'],['5360', '5399', '5466','5552']];
				$ranPageGroup = rand(0,2);
				$ranPage = rand(0,count($page[$ranPageGroup])-1);
				$url = 'http://www.watthakhanun.com/webboard/archive/index.php/t-'.$page[$ranPageGroup][$ranPage].'.html';
				$output =iconv("tis-620", "utf-8",file_get_contents($url)); 
				$pieces = explode("<hr />", $output);
				$rand=rand(2,count($pieces)-2);
				// $rand=2;
				$select=strip_tags($pieces[$rand]);
				$select=str_replace("เถรี","",$select);
				$select=str_replace("&quot;","",$select);
				$select=substr($select,20);
				$from="\n ｡◕‿◕｡==>".substr(strip_tags($pieces[1]),24);
				$messages = ['type' => 'text','text' => $select.$from];
			}
			else{
			$messages = [
				'type' => 'text',
				'text' => $text
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
