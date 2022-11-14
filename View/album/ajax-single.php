<?php
use App\Entity\Album;
use App\Helper\AlbumHelper;

/** @var Album $album */
$album = $data['album'];

echo '<div class="offcanvas-header">
                <h3 class="offcanvas-title fs-3" id="offcanvasBottomLabel">'.$album->getName().' Albums</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                '.AlbumHelper::toHTML($album).'
            </div>';
