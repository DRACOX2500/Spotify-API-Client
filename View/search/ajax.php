<?php
$divs_array = array();

$artists = $data['artists'];
$albums = $data['albums'];
if (isset($artists)) {
    $i = 0;
    $divs_artist = array_map(function ($artist) {
        $image = "/assets/spotify.jpg";
        if (count($artist->getImage()) > 0) {
            $image = $artist->getImage()[0]->getUrl();
        }
        return '<div class="col">
                <div id="' . $artist->getIdSpotify() . '" class="card bg-main-darker artist-card" style="width: 18rem;">
                    <img src="' . $image . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold d-block text-truncate">' . $artist->getName() . '</h5>
                        <p class="card-text text-secondary fs-5">
                            ' . ucfirst($artist->getType()) . '
                        </p>
                        <button type="button"
                            href="#"
                            class="btn bg-secondary stretched-link w-75 d-flex flex-row align-items-center card-btn">
                            <i class="bi bi-plus-square-fill p-2"></i>
                            More details...
                        </button>
                    </div>
                </div>
            </div>';
    }, $artists);

    $divs_array = array_merge($divs_array, $divs_artist);
}

if (isset($albums)) {
    $i = 0;
    $divs_albums = array_map(function ($album) {
        $image = "/assets/spotify.jpg";
        if (count($album->getImages()) > 0) {
            $image = $album->getImages()[0]->getUrl();
        }
        return '<div class="col">
                <div id="' . $album->getId() . '" class="card bg-main-darker album-card" style="width: 18rem;">
                    <img src="' . $image . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold d-block text-truncate">' . $album->getName() . '</h5>
                        <p class="card-text text-secondary fs-5">
                            ' . ucfirst($album->getType()) . '
                        </p>
                        <button type="button"
                            href="#"
                            class="btn bg-secondary stretched-link w-75 d-flex flex-row align-items-center card-btn">
                            <i class="bi bi-plus-square-fill p-2"></i>
                            More details...
                        </button>
                    </div>
                </div>
            </div>';
    }, $albums);
    $divs_array = array_merge($divs_array, $divs_albums);
}

shuffle($divs_array);


echo implode('', $divs_array);
