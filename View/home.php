<?php


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/albums/6wCzeOFPJTsMuKo2x1vNJy/tracks");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token'] ));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
echo $result;
curl_close($ch);