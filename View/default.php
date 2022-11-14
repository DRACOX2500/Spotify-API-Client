<?php

use App\Entity\Script;
use App\Helper\ScriptHelper;

// JavaScript Bundle with Popper
ScriptHelper::addBootstrap();

// jQuery & jQuery-UI
//ScriptHelper::addJQuery();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
          crossorigin="anonymous">
    <!-- Icons only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/theme/style.css">
    <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    <title>Titre</title>

</head>

<body>
<header class="py-3 bg-main-darker">
    <div class="container-fluid align-items-center" style="grid-template-columns: 1fr 2fr;">

        <div class="d-flex align-items-center">
            <form action="/search/index/" id="search-form" class="w-100 me-3 d-flex align-items-center flex-row justify-content-evenly"
                  role="search">
                <img src="/assets/spotify_logo.png" class="header-logo" alt="app_logo">

                <div class="w-75 d-flex align-items-center flex-row justify-content-evenly">
                    <input id="search-bar" type="search" class="form-control w-100 p-2 text-light bg-dark border border-0"
                           placeholder="Search..." aria-label="Search" name="q" required>

                    <button id="search-btn" type="submit"
                            class="btn bg-secondary p-2 d-flex flex-row align-items-center">
                        <i class="bi bi-search p-1"></i>
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>
</header>
<nav class="d-none">
    <ul class="dropdown-menu dropdown-menu-dark bg-main-darker d-block position-static mx-0 border-0 shadow w-220px">
        <li>
            <a class="dropdown-item d-flex gap-2 align-items-center" href="/">
                <i class="bi bi-house"></i>
                Home
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex gap-2 align-items-center" href="/search">
                <i class="bi bi-search"></i>
                Search
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <div class="fs-5 ps-3 fw-bold">Favorites</div>
        <li>
            <a class="dropdown-item d-flex gap-2 align-items-center" href="/artist/favorites">
                <i class="bi bi-person-heart"></i>
                Artists
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex gap-2 align-items-center" href="/album/favorites">
                <i class="bi bi-bookmark-heart-fill"></i>
                Albums
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex gap-2 align-items-center" href="/track/favorites">
                <i class="bi bi-disc-fill"></i>
                Tracks
            </a>
        </li>
    </ul>
</nav>

    <main class="bg-main">
        <!--        --><?php //if(!empty($_SESSION['erreur'])): ?>
        <!--            <div class="alert alert-danger" role="alert">-->
        <!--                --><?php //echo $_SESSION['erreur']; unset($_SESSION['erreur']); ?>
        <!--            </div>-->
        <!--        --><?php //endif; ?>
        <!--        --><?php //if(!empty($_SESSION['message'])): ?>
        <!--            <div class="alert alert-success" role="alert">-->
        <!--                --><?php //echo $_SESSION['message']; unset($_SESSION['message']); ?>
        <!--            </div>-->
        <!--        --><?php //endif; ?>
        <?= $contenu ?>
    </main>

    <script src="/js/nav.js"></script>
    <?= ScriptHelper::toHTML() ?>

</body>

</html>