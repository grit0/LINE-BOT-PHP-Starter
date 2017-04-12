<?php
$access_token = 'Ix6Et3oEImOG2kDfvI/ZT+8S2x+JDNJRJBX1oNBA6UKWntWtLpa/wOfrq7EFvCd+tbN5Cta3qgSB9zE9o+jjJf3Wolc1E25lM/KUbBozktDcdfdfaBSBDc2T+kVmeZJ0cXkRQRzq4Mmc4QkPj5owXAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
