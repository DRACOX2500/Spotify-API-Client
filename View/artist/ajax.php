<?php

use App\Entity\Artist;

/** @var Artist $artist */
$artist = $data['artist'];
$image = "/assets/spotify.jpg";
if (count($artist->getImage()) > 0) {
    $image = $artist->getImage()[0]->getUrl();
}

$badges = '';
foreach ($artist->getGenres() as $genre) {
    $badges .= '<span class="badge bg-secondary text-dark mx-2 my-1">'.$genre.'</span>';
}

echo '<div class="offcanvas-header">
                <h3 class="offcanvas-title fs-3 fw-semibold text-light pb-3 mb-3 border-bottom">'.$artist->getName().'</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="flex-shrink-0 p-3 bg-dark d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-center position-relative">
                        <a href="'.$artist->getExternalUrl()->getSpotify().'" target="_blank">
                                <img src="'.$image.'" alt="artist image">
                            </a>
                        <button type="button" class="abs-btn fav-btn-rounded favorite-button '.($artist->isFavorite() ? 'is-fav' : '').'">
                            <i class="bi bi-star'.($artist->isFavorite() ? '-fill' : '').'"></i>
                        </button>
                    </div>
                       

                <div class="d-flex flex-row justify-content-evenly py-4">
                    <div class="stats fs-4  d-flex flex-column bg-main p-4 rounded">
                        <span class="fw-bold">Followers : </span>
                        <span class="followers-value">'.$artist->getFollower()->getTotal().'</span>
                    </div>
                    <div class="stats fs-4  d-flex flex-column bg-main p-4 rounded">
                        <span class="fw-bold">Popularity : </span>
                        <span class="popularity-value">'.$artist->getPopularity().'</span>
                    </div>
                </div>
                
                <h5 class="fs-5 fw-semibold text-light pb-4 mb-4 border-bottom text-center">Genres</h5>
                <div class="badge-list d-flex flex-wrap justify-content-center">
                    '.$badges.'
                </div>
                
                <button type="button" class="album-list-btn btn-secondary app-btn fs-3  rounded p-4 mt-4">
                    <span class="open-album"><i class="bi bi-music-note-list"></i></span>
                    <span class="fw-bold">Voir les Albums</span>
                </button>
                </div>
            </div>';
