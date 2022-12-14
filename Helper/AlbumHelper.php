<?php

namespace App\Helper;

use App\Core\Utils;
use App\Entity\Album;
use App\Entity\Track;

class AlbumHelper
{

    private static function getTypeSymbol(string $type): string {
        if ($type === 'P') return '℗';
        else if ($type === 'R') return '®';
        else return '©';
    }

    private static function getCopyRights(Album $album): string
    {
        $cr = $album->getCopyrights();
        if (!empty($cr)) {

            $copyrights = implode('', array_map(function ($item) {
                return '<span>' . self::getTypeSymbol($item->getType()) . ' ' . $item->getText() . '</span>';
            }, $album->getCopyrights()));
            return '<div class="d-flex flex-column text-secondary py-3">'.$copyrights.'</div>';
        }
        return '';
    }

    /**
     * @param Track $track
     * @param int|null $index
     * @return string
     */
    public static function getTableCellTrack(Track $track, ?int $index = null, bool $isAllFavorite = false): string
    {
        $artistTag = implode(', ', array_map(function ($item) use ($track) {
            $artistUrl = $track->getArtists()[0]->getExternalUrl()->getSpotify() ?? '#';
            return '<a class="link-secondary text-decoration-none hover-underline" href="'.$artistUrl.'" target="_blank">'.$item->getName().'</a>';
        }, $track->getArtists()));
        return '<tr id="t-'.$track->getIdSpotify().'"> 
                              <th scope="row" class="track-first-index row-track text-center vertical-align-middle">
                                <span class="pos-num">'.($index ?? '#').'</span>
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
                              <td class="d-flex flex-row align-items-center justify-content-between">
                                    <div class="d-flex flex-column justify-content-between">
                                        <a class="link-light text-decoration-none" href="'.$track->getExternalUrls()->getSpotify().'" target="_blank">'.$track->getName().'</a>
                                        <div class="text-secondary">'.$artistTag.'</div>
                                    </div>
                                    <button type="button" class="like-track-btn '.($track->isFavorite() || $isAllFavorite ? 'track-fav' : '').'">
                                        <i class="bi bi-heart '.($track->isFavorite() || $isAllFavorite ? 'd-none' : '').'"></i>
                                        <i class="bi bi-heart-fill secondary-color '.($track->isFavorite() || $isAllFavorite ? '' : 'd-none').'"></i>
                                    </button>
                              </td>
                              <td class="vertical-align-middle">'.Utils::millisecondToMinSecFormat($track->getDurationMs()).'</td>
                       </tr>';
    }

    /**
     * @param array $tracks
     * @return string
     */
    public static function getTableTracks(array $tracks, bool $isAllFavorite = false): string
    {
        $divTracks = '';
        for ($j = 0; $j < count($tracks); $j++) {
            $track = $tracks[$j];
            $divTracks .= self::getTableCellTrack($track, $j + 1, $isAllFavorite);
        }

        return '<table class="table tracks grey-color mt-3">
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
                                    </table>';
    }

    public static function toHTML(Album $album): string
    {

        $artistTag = implode(' • ', array_map(function ($item) {
            $artistUrl = $item->getExternalUrl()->getSpotify() ?? '#';
            return '<a class="link-light text-decoration-none hover-underline fw-bold" href="'.$artistUrl.'" target="_blank">'.$item->getName().'</a>';
        }, $album->getArtists()));

        return '<div id="a-'.$album->getIdSpotify().'" class="album-data">
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
                                        <button type="button" class="album-fav-btn favorite-button fav-btn-rounded '.($album->isFavorite() ? 'is-fav' : '').'">
                                            <i class="bi bi-star'.($album->isFavorite() ? '-fill' : '').'"></i>
                                        </button>
                                    </div>'
            .self::getTableTracks($album->getTracks())
            .self::getCopyRights($album);
    }
}