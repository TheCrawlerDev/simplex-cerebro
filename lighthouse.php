<?php

// funciona mesmo

header('Content-Type: application/json');

// include('craw.php');

// $craw = new Craw();

// $_GET['page'] = $craw->formatarURL(['http://','https://'],$_GET['page']);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://lighthouse-dot-webdotdevsite.appspot.com//lh/newaudit');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"url\":\"".$_GET['page']."\",\"replace\":true,\"save\":false}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: lighthouse-dot-webdotdevsite.appspot.com';
$headers[] = 'Pragma: no-cache';
$headers[] = 'Cache-Control: no-cache';
$headers[] = 'Origin: https://web.dev';
$headers[] = 'User-Agent: Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Mobile Safari/537.36';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Accept: */*';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Referer: https://web.dev/measure/';
$headers[] = 'Accept-Encoding: gzip, deflate, br';
$headers[] = 'Accept-Language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

echo $result;

?>
