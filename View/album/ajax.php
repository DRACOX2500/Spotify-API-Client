<?php

use App\Core\Utils;
use App\Entity\Album;

$albums = $data['albums'];

$divs = '';
for ($i = 0; $i < count($albums); $i++) {

    /** @var Album $album */
    $album = $albums[$i];

    $divTracks = '';
    for ($j = 0; $j < count($album->getTracks()); $j++) {
        $track = $album->getTracks()[$j];
        $artistName = $track->getArtists()[0]->getName() ?? 'no-body';
        $artistUrl = $track->getArtists()[0]->getExternalUrl()->getSpotify() ?? '#';

        $divTracks .= '<div class="d-flex bg-main-darker flex-row align-item-center justify-content-between rounded py-1 px-5 my-2">
                                    <span class="badge text-dark bg-secondary px-2 mx-2">#'.($j + 1).'</span>
                                    <div class="d-flex flex-column justify-content-between">
                                        <a class="link-light" href="'.$track->getExternalUrls()->getSpotify().'" target="_blank">'.$track->getName().'</a>
                                        <a class="link-secondary" href="'.$artistUrl.'" target="_blank">'.$artistName.'</a>
                                    </div>
                                    <p>
                                        '.$album->getName().'
                                    </p>
                                    <span>
                                        <i class="bi bi-clock px-2"></i>
                                        '.Utils::millisecondToMinSecFormat($track->getDurationMs()).'
                                    </span>
                                </div>';
    }

    $divs .= '<div class="accordion-item bg-main">
                        <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.$i.'" aria-expanded="true" aria-controls="collapse-'.$i.'">
                                <span class="badge text-dark bg-main-darker px-2 mx-2">#'.($i + 1).'</span>
                                '.$album->getName().'
                              </button>
                        </h2>
                        <div id="collapse-'.$i.'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                    <div class="album-data">
                                        <img src="'.$album->getImages()[0]->getUrl().'" alt="album_picture">
                                        <div>
                                             <span class="al-type text-light">'.strtoupper($album->getAlbumType()).'</span>
                                             <span class="al-name text-light">'.$album->getName().'</span>
                                             <span>
                                                '.$album->getReleaseDate().'
                                                •
                                                '.$album->getTotalTracks().' tracks
                                             </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                         '.$divTracks.'
                                    </div>
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
