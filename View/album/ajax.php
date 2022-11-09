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
        $artistTag = implode(', ', array_map(function ($item) use ($track) {
            $artistUrl = $track->getArtists()[0]->getExternalUrl()->getSpotify() ?? '#';
            return '<a class="link-secondary text-decoration-none hover-underline" href="'.$artistUrl.'" target="_blank">'.$item->getName().'</a>';
        }, $track->getArtists()));

        $divTracks .= '<tr>
                              <th scope="row" class="row-track text-center vertical-align-middle">'.($j + 1).'</th>
                              <td>
                                    <div class="d-flex flex-column justify-content-between">
                                        <a class="link-light text-decoration-none" href="'.$track->getExternalUrls()->getSpotify().'" target="_blank">'.$track->getName().'</a>
                                        <div class="text-secondary">'.$artistTag.'</div>
                                    </div>
                              </td>
                              <td class="vertical-align-middle">'.Utils::millisecondToMinSecFormat($track->getDurationMs()).'</td>
                       </tr>';
    }

    $divs .= '<div class="accordion-item bg-main">
                        <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.$i.'" aria-expanded="true" aria-controls="collapse-'.$i.'">
                                <span class="badge text-dark bg-main-darker px-2 mx-2">#'.($i + 1).'</span>
                                '.$album->getName().'
                              </button>
                        </h2>
                        <div id="collapse-'.$i.'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                              <div class="accordion-body p-0">
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
                                    <table class="table grey-color mt-3">
                                          <thead>
                                                <tr>
                                                  <th scope="col" class="text-center">#</th>
                                                  <th scope="col">TITRE</th>
                                                  <th scope="col"><i class="bi bi-clock px-2"></i></th>
                                                </tr>
                                          </thead>
                                          <tbody class="tbody-no-border-bottom">
                                            '.$divTracks.'
                                          </tbody>
                                    </table>
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
