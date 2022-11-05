<?php

require '../auth-spotify.php';
require '../Autoloader.php';

use App\Autoloader;
use App\Entity\ArtistSearch;

Autoloader::register();

$q = 'alestorm';
$type = 'artist';

if (!empty($_GET) && !empty($_GET['q'])) {
    $q = str_replace(' ', '+', $_GET['q']);

    if (!empty($_GET['type'])) {
        $type = $_GET['type'];
    }
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?q=' . $q . '&type=' . $type);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$json = json_decode($result, true);
$artist = ArtistSearch::fromJson($json['artists']) ?? array();

echo $artist->toHTML('bg-main-darker artist-card');