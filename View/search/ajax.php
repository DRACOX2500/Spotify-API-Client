<?php

use App\Entity\Album;
use App\Entity\Artist;
use App\Helper\CardHelper;

$divs_array = array();

/** @var Artist[] $artists */
$artists = $data['artists'];

/** @var Album[] $albums */
$albums = $data['albums'];

if (isset($artists)) {
    $divs_artist = array_map(function ($artist) {
        return '<div class="col">
                    '.CardHelper::toHTML($artist).'
                </div>';
    }, $artists);

    $divs_array = array_merge($divs_array, $divs_artist);
}

if (isset($albums)) {
    $divs_albums = array_map(function ($album) {
        return '<div class="col">
                    '.CardHelper::toHTML($album).'
                </div>
            </div>';
    }, $albums);
    $divs_array = array_merge($divs_array, $divs_albums);
}

echo implode('', $divs_array);
