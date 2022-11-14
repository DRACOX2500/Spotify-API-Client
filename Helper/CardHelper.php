<?php

namespace App\Helper;

use App\Entity\Album;
use App\Entity\Artist;

class CardHelper
{

    private static string $defaultImage = "/assets/spotify.jpg";

    public static function toHTML(Artist|Album $item): string {
        $test = $item->totalTracks ?? null;
        if (empty($test)) {
            return self::ArtistToHTML($item);
        }
        return self::AlbumToHTML($item);
    }

    private static function ArtistToHTML(Artist $artist): string
    {
        $image = self::$defaultImage;
        if (count($artist->getImage()) > 0) {
            $image = $artist->getImage()[0]->getUrl();
        }
        return '<div id="' . $artist->getIdSpotify() . '" class="card bg-main-darker artist-card" style="width: 18rem;">
                    <img src="' . $image . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold d-block text-truncate">' . $artist->getName() . '</h5>
                        <p class="card-text text-secondary fs-5">
                            ' . ucfirst($artist->getType()) . '
                        </p>
                        <button type="button"
                            href="#"
                            class="btn bg-secondary stretched-link w-75 d-flex flex-row align-items-center artist-card-btn">
                            <i class="bi bi-plus-square-fill p-2"></i>
                            More details...
                        </button>
                    </div>
                </div>';
    }

    private static function AlbumToHTML(Album $album): string
    {
        $image = self::$defaultImage;
        if (count($album->getImages()) > 0) {
            $image = $album->getImages()[0]->getUrl();
        }
        return '<div id="' . $album->getIdSpotify() . '" class="card bg-main-darker album-card" style="width: 18rem;">
                    <img src="' . $image . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold d-block text-truncate">' . $album->getName() . '</h5>
                        <p class="card-text text-secondary fs-5">
                            ' . ucfirst($album->getType()) . '
                        </p>
                        <button type="button"
                            href="#"
                            class="btn bg-secondary stretched-link w-75 d-flex flex-row align-items-center album-card-btn">
                            <i class="bi bi-plus-square-fill p-2"></i>
                            More details...
                        </button>
                    </div>
                </div>';
    }
}