<?php

header('Content-Type: application/json');

include('craw.php');

$craw = new Craw();

$data = array();

$_GET['page'] = $craw->formatarURL(['http://','https://'],$_GET['page']);

// $craw->carregar('https://tls-observatory.services.mozilla.com/api/v1/scan',['rescan'=>false,'target'=>$_GET['page']], null, 'POST');

$data['r1'] = $craw->carregar('https://http-observatory.security.mozilla.org/api/v1/analyze?host='.$_GET['page']);

$data['r2'] = $craw->carregar('https://hstspreload.org/api/v2/status?domain='.$_GET['page']);

$data['r3'] = $craw->carregar('https://hstspreload.org/api/v2/preloadable?domain='.$_GET['page']);

// $data[] = $craw->carregar('https://www.immuniweb.com/ssl/api/v1/check/1579894205634.html');
https://http-observatory.security.mozilla.org/api/v1/getScanResults?scan=13069196

$data['r4'] = $craw->carregar('https://api.ssllabs.com/api/v2/analyze?publish=off&fromCache=on&maxAge=24&host='.$_GET['page']);
// echo 'https://http-observatory.security.mozilla.org/api/v1/getScanResults?scan='.$data['r1']['scan_id'];
$data['r5'] = $craw->carregar('https://http-observatory.security.mozilla.org/api/v1/getScanResults?scan='.$data['r1']['scan_id']);

$data['r6'] = $craw->carregar('https://http-observatory.security.mozilla.org/api/v1/getHostHistory?host='.$_GET['page']);

$data['r7'] = $craw->carregar('https://tls-observatory.services.mozilla.com/api/v1/results?id='.$_GET['page']);

echo json_encode($data);

?>