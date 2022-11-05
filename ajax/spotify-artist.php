<?php

require '../auth-spotify.php';
require '../Autoloader.php';

use App\Autoloader;
use App\Entity\Artist;

Autoloader::register();

if (!empty($_GET) && !empty($_GET['artist_id'])) {
    define("ARTIST_ID", $_GET['artist_id']);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/" . ARTIST_ID);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    if ($_GET['format'] === 'html') {
        $artist = Artist::fromJson(json_decode($result, true));
        echo '<h1 class="fs-1 fw-semibold text-light pb-3 mb-3 border-bottom">'.$artist->getName().'</h1>
                <a href="'.$artist->getExternalUrl()->getSpotify().'">
                    <img src="'.$artist->getImage()[0]->getUrl().'" alt="artist image">
                </a>

                <div class="d-flex flex-row justify-content-evenly py-4">
                    <div class="stats fs-4  d-flex flex-column bg-main p-4 rounded">
                        <span class="fw-bold">Followers : </span>
                        <span class="followers-value">'.$artist->getFollower()->getTotal().'</span>
                    </div>
                    <div class="stats fs-4  d-flex flex-column bg-main p-4 rounded">
                        <span class="fw-bold">Popularity : </span>
                        <span class="popularity-value">'.$artist->getPopularity().'</span>
                    </div>
                </div>';
    }
    else {
        echo $result;
    }

} else echo '{}';
