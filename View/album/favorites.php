<?php

use App\Entity\Album;
use App\Helper\CardHelper;

/** @var Album[] $albums */
$albums = $data['albums'];
$divs_albums = array();

if (isset($albums)) {
    $divs_albums = array_map(function ($album) {
        return '<div class="col">
                    '.CardHelper::toHTML($album).'
                </div>
            </div>';
    }, $albums);
}

$cards = implode('', $divs_albums);
?>

<aside id="aside-album-list" class="offcanvas offcanvas-bottom bg-main" tabindex="-1" aria-labelledby="offcanvasBottomLabel">

</aside>

<div class="favorite-header">
    <div><i class="bi bi-bookmark-heart-fill"></i></div>
    <div>
        <span class="fav-section text-light">Favorites</span>
        <span class="fav-section-name text-light">Albums</span>
        <span> <?= count($albums) . ' ' . (count($albums) > 1 ? 'Albums' : 'Album') ?> </span>
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
ScriptHelper:: add("/js/favorites.js");

