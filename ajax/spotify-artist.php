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
        $image = "/assets/spotify.jpg";
        if (count($artist->getImage()) > 0) {
            $image = $artist->getImage()[0]->getUrl();
        }
        $badges = '';
        foreach ($artist->getGenres() as $genre) {
            $badges .= '<span class="badge bg-secondary text-dark mx-2 my-1">'.$genre.'</span>';
        }

        echo '<div class="offcanvas-header">
                <h3 class="offcanvas-title fs-3 fw-semibold text-light pb-3 mb-3 border-bottom">'.$artist->getName().'</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="flex-shrink-0 p-3 bg-dark d-flex flex-column">
                       <a href="'.$artist->getExternalUrl()->getSpotify().'" target="_blank">
                    <img src="'.$image.'" alt="artist image">
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
                </div>
                
                <h5 class="fs-5 fw-semibold text-light pb-4 mb-4 border-bottom">Genres</h5>
                <div class="badge-list">
                    '.$badges.'
                </div>
                
                <button type="button" class="album-list btn-secondary app-btn fs-3  rounded p-4 mt-4">
                    <span class="open-album"><i class="bi bi-music-note-list"></i></span>
                    <span class="fw-bold">Voir les Albums</span>
                </button>
                </div>
            </div>';
    } else {
        echo $result;
    }

} else {
    echo '{}';
}
