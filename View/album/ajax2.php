<?php
use App\Core\Utils;

$album = $data['album'];

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

echo '<div class="offcanvas-header">
                <h3 class="offcanvas-title fs-3" id="offcanvasBottomLabel">'.$album->getName().' Albums</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body small">
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
            </div>';
