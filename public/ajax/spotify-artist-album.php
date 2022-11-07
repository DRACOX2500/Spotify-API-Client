<?php
session_start();

require __DIR__.'/../../Autoloader.php';

use App\Autoloader;
use App\Entity\SpotifyAPIResult;

Autoloader::register();

if (!empty($_GET) && !empty($_GET['artist_id'])) {
    define("ARTIST_ID", $_GET['artist_id']);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/artists/" . ARTIST_ID . '/albums');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($result, true);
    $albums = SpotifyAPIResult::fromJsonAlbum($json);
    echo '<div class="offcanvas-header">
                <h3 class="offcanvas-title fs-3" id="offcanvasBottomLabel">'.count($albums->getItems()).' Albums</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <div id="accordionAlbums" class="accordion">
                    '.$albums->toHTMLAlbum('bg-main-darker artist-card').'
                </div>
            </div>';
} else {
    echo '{}';
}