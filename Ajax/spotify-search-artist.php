<?php
session_start();

if (!empty($_GET) && !empty($_GET['artist_id'])) {
    define("ARTIST_ID", $_GET['artist_id']);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/" . ARTIST_ID);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;
}
else echo 'non';
