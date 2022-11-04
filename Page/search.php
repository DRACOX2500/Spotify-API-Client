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
curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?q='.$q.'&type='.$type);
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
    <link rel="stylesheet" href="/theme/style.css">
    <title>Spotify Search</title>
</head>

<body>
    <header class="py-3 bg-main-darker">
        <div class="container-fluid align-items-center" style="grid-template-columns: 1fr 2fr;">

            <div class="d-flex align-items-center">
                <form action="search.php" class="w-100 me-3 d-flex align-items-center flex-row justify-content-evenly" role="search">
                    <img src="/assets/spotify_logo.png" class="header-logo">

                    <div class="w-75 d-flex align-items-center flex-row justify-content-evenly">
                        <input type="search" class="form-control w-100 p-2 bg-dark border border-0" placeholder="Search..." aria-label="Search" name="q">

                        <button type="submit" class="btn bg-secondary p-2">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <main class="bg-main">
        <div class="album">
            <div class="container py-5">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?= $artist->toHTML('bg-main-darker artist-card') ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>