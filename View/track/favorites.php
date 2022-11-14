<?php

use App\Entity\Track;
use App\Helper\AlbumHelper;

/** @var Track[] $tracks */
$tracks = $data['tracks'];

$table = AlbumHelper::getTableTracks($tracks, true)
?>

<div id="over-loading"></div>

<aside id="aside-menu" class="offcanvas offcanvas-start bg-main" tabindex="-1" aria-labelledby="offcanvasExampleLabel">

</aside>

<aside id="aside-album-list" class="offcanvas offcanvas-bottom bg-main" tabindex="-1" aria-labelledby="offcanvasBottomLabel">

</aside>

<div class="favorite-header track-h-color">
    <div><i class="bi bi-disc-fill"></i></div>
    <div>
        <span class="fav-section text-light">Favorites</span>
        <span class="fav-section-name text-light">Tracks</span>
        <span> <?= count($tracks) . ' ' . (count($tracks) > 1 ? 'Tracks' : 'Track') ?> </span>
    </div>
</div>
<?= $table ?>

<?php

use App\Helper\ScriptHelper;

ScriptHelper:: add("/js/ajax.js");
ScriptHelper:: add("/js/aside.js");
ScriptHelper:: add("/js/favorite-tracks.js");

