<?php
use App\Core\Utils;
use App\Entity\Album;

/** @var Album $album */
$album = $data['album'];
$favorite = !empty($data['favorites']);

$divTracks = '';
for ($j = 0; $j < count($album->getTracks()); $j++) {
    $track = $album->getTracks()[$j];
    $artistTag = implode(', ', array_map(function ($item) use ($track) {
        $artistUrl = $track->getArtists()[0]->getExternalUrl()->getSpotify() ?? '#';
        return '<a class="link-secondary text-decoration-none hover-underline" href="'.$artistUrl.'" target="_blank">'.$item->getName().'</a>';
    }, $track->getArtists()));

    $divTracks .= '<tr>
                              <th scope="row" class="track-first-index row-track text-center vertical-align-middle">
                                <span class="pos-num">'.($j + 1).'</span>
                                <span>
                                    <button type="button" class="play-btn">
                                        <i class="bi bi-play-fill fs-4 text-white"></i>
                                        <i class="bi bi-pause-fill fs-4 text-white d-none"></i>
                                    </button>
                                    <audio controls class="play-audio d-none">
                                        <source src="'.($track->getPreviewUrl() ?? '#').'" />
                                    </audio>
                                </span>
                              </th>
                              <td>
                                    <div class="d-flex flex-column justify-content-between">
                                        <a class="link-light text-decoration-none" href="'.$track->getExternalUrls()->getSpotify().'" target="_blank">'.$track->getName().'</a>
                                        <div class="text-secondary">'.$artistTag.'</div>
                                    </div>
                              </td>
                              <td class="vertical-align-middle">'.Utils::millisecondToMinSecFormat($track->getDurationMs()).'</td>
                       </tr>';
}

function getTypeSymbol(string $type): string {
    if ($type === 'P') return '℗';
    else if ($type === 'R') return '®';
    else return '©';
}

$artistTag = implode(' • ', array_map(function ($item) {
    $artistUrl = $item->getExternalUrl()->getSpotify() ?? '#';
    return '<a class="link-light text-decoration-none hover-underline fw-bold" href="'.$artistUrl.'" target="_blank">'.$item->getName().'</a>';
}, $album->getArtists()));

$copyrights = implode('', array_map(function ($item) {
    return '<span>' . getTypeSymbol($item->getType()) . ' ' . $item->getText() . '</span>';
}, $album->getCopyrights()));

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
                            '.$artistTag.'
                            •
                            '.$album->getReleaseDate().'
                            •
                            '.$album->getTotalTracks().' tracks
                         </span>
                    </div>
                    <button type="button" class="album-fav-btn favorite-button fav-btn-rounded '.($favorite ? 'is-fav' : '').'">
                        <i class="bi bi-star'.($favorite ? '-fill' : '').'"></i>
                    </button>
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
                <div class="d-flex flex-column text-secondary py-3">'.$copyrights.'</div>
            </div>';
