<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://laravel.build/example-app?with=mysql,redis');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);
echo $response;