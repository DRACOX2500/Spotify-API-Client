<?php

use App\Entity\Album;
use App\Helper\AlbumHelper;

$albums = $data['albums'];

$divs = '';
for ($i = 0; $i < count($albums); $i++) {

    /** @var Album $album */
    $album = $albums[$i];


    $divs .= '<div class="accordion-item bg-main">
                        <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.$i.'" aria-expanded="true" aria-controls="collapse-'.$i.'">
                                <span class="badge text-dark bg-main-darker px-2 mx-2">#'.($i + 1).'</span>
                                '.$album->getName().'
                              </button>
                        </h2>
                        <div id="collapse-'.$i.'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                              <div class="accordion-body p-0">
                                    '.AlbumHelper::toHTML($album).'
                              </div>
                        </div>
                  </div>';
}

echo '<div class="offcanvas-header">
                <h3 class="offcanvas-title fs-3" id="offcanvasBottomLabel">'.count($albums).' Albums</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
                <div id="accordionAlbums" class="accordion">
                    '.$divs.'
                </div>
            </div>';
