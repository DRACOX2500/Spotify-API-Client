<?php

use App\Entity\Artist;
use App\Helper\CardHelper;

/** @var Artist[] $artists */
$artists = $data['artists'];
$divs_artists = array();

if (isset($artists)) {
    $divs_artists = array_map(function ($artist) {
        return '<div class="col">
                    '.CardHelper::toHTML($artist).'
                </div>';
    }, $artists);
}

$cards = implode('', $divs_artists);
?>

<div id="over-loading"></div>

<aside id="aside-menu" class="offcanvas offcanvas-start bg-main" tabindex="-1" aria-labelledby="offcanvasExampleLabel">

</aside>

<aside id="aside-album-list" class="offcanvas offcanvas-bottom bg-main" tabindex="-1" aria-labelledby="offcanvasBottomLabel">

</aside>

<div class="favorite-header artist-h-color">
    <div><i class="bi bi-person-heart"></i></div>
    <div>
        <span class="fav-section text-light">Favorites</span>
        <span class="fav-section-name text-light">Artist</span>
        <span> <?= count($artists) . ' ' . (count($artists) > 1 ? 'Artists' : 'Artist') ?> </span>
    </div>
</div>
<div class="album">
    <div class="container py-5">
        <div id="search-list" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-evenly align-items-center">
            <?= $cards ?>
        </div>
    </div>
</div>

<?php
use App\Helper\ScriptHelper;


ScriptHelper:: add("/js/ajax.js");
ScriptHelper:: add("/js/aside.js");
ScriptHelper:: add("/js/favorite-artists.js");

