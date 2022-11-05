<?php

require_once 'auth-spotify.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/3OpqU68JpZlzvjAJj3B2Da/albums");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
