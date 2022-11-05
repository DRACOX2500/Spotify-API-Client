<?php

require '../auth-spotify.php';
require '../Autoloader.php';

use App\Autoloader;
use App\Entity\ArtistSearch;

Autoloader::register();

$q = 'alestorm';
$type = 'artist';

if (!empty($_GET) && !empty($_GET['q'])) {
    $q = str_replace(' ', '+', $_GET['q']);

    if (!empty($_GET['type'])) {
        $type = $_GET['type'];
    }
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?q=' . $q . '&type=' . $type);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$json = json_decode($result, true);
$artist = ArtistSearch::fromJson($json['artists']) ?? array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- Icons only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/theme/style.css">
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <title>Spotify Search</title>
</head>

<body>
    <header class="py-3 bg-main-darker">
        <div class="container-fluid align-items-center" style="grid-template-columns: 1fr 2fr;">

            <div class="d-flex align-items-center">
                <form action="search.php" class="w-100 me-3 d-flex align-items-center flex-row justify-content-evenly" role="search">
                    <img src="/assets/spotify_logo.png" class="header-logo" alt="app_logo">

                    <div class="w-75 d-flex align-items-center flex-row justify-content-evenly">
                        <input type="search" class="form-control w-100 p-2 text-light bg-dark border border-0" placeholder="Search..." aria-label="Search" name="q">

                        <button type="submit" class="btn bg-secondary p-2 d-flex flex-row align-items-center">
                            <i class="bi bi-search p-1"></i>
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <aside>
        <div id="aside-menu" class="flex-shrink-0 p-3 bg-dark draggable" style="width: 280px;">
            <h1 class="fs-1 fw-semibold text-light pb-3 mb-3 border-bottom"></h1>
            <img src="#" alt="artist image">
            <ul class="list-unstyled mb-0">
                <li><span class="fs-4 dropdown-item d-flex align-items-center gap-2 py-2 text-light" href="#">
                        <span class="d-inline-block bg-light rounded-circle p-1"></span>
                        <span class="fw-bold">Followers : </span>
                        <p></p>
                    </span></li>
                <li><span class="fs-4 dropdown-item d-flex align-items-center gap-2 py-2 text-light" href="#">
                        <span class="d-inline-block bg-light rounded-circle p-1"></span>
                        <span class="fw-bold">Popularity : </span>
                        <p></p>
                    </span></li>
            </ul>
        </div>
    </aside>

    <main class="bg-main">
        <div class="album">
            <div class="container py-5">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?= $artist->toHTML('bg-main-darker artist-card') ?>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".draggable").draggable({
                appendTo: "body",
                axis: "x",
                containment: "parent",
            });
        });
    </script>
    <script>
        const cardButtons = document.getElementsByClassName('card-btn');
        const asideMenu = document.getElementById('aside-menu');

        function showHint() {
            const id = this.parentNode.parentElement.id
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (!this.responseText) return
                const result = JSON.parse(this.responseText);
                asideMenu.parentElement.classList.add('show');
                asideMenu.style.left = '490px';

                console.log('JSON', result)
                console.log(asideMenu.children[0])
                asideMenu.children[0].textContent = result.name;
                asideMenu.children[1].src = result.images[0].url;
                asideMenu.children[2].children[0].firstChild.lastChild.textContent = result.followers.total;
                asideMenu.children[2].children[1].firstChild.lastChild.textContent = result.popularity;

            };
            xmlhttp.open("GET", "/Ajax/spotify-search-artist.php?artist_id=" + id, true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send();
        }

        for (let cardButton of cardButtons) {
            cardButton.addEventListener('click', showHint);
        }
    </script>
</body>

</html>