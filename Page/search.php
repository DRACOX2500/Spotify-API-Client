<?php

require '../auth-spotify.php';
require '../Autoloader.php';

use App\Autoloader;
use App\Entity\ArtistSearch;

Autoloader::register();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.spotify.com/v1/search?q=alestorm&type=artist");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $_SESSION['token']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

$json = json_decode($result, true);

$artist = ArtistSearch::fromJson($json['artists']);

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
    <title>Spotify Artiste</title>
</head>

<body>
    <header class="py-3 mb-3 border-bottom">
        <div class="container-fluid align-items-center" style="grid-template-columns: 1fr 2fr;">

            <div class="d-flex align-items-center">
                <form action="search.php" class="w-100 me-3 d-flex align-items-center flex-row justify-content-evenly" role="search">
                    <input type="search" class="form-control w-75 p-2" placeholder="Search..." aria-label="Search">

                    <button type="submit" class="btn btn-primary p-2">Search</button>
                </form>
            </div>
        </div>
    </header>
    <main>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?= $artist->display() ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>