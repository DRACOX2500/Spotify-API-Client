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
            <form id="search-form" class="w-100 me-3 d-flex align-items-center flex-row justify-content-evenly"
                  role="search">
                <img src="/assets/spotify_logo.png" class="header-logo" alt="app_logo">

                <div class="w-75 d-flex align-items-center flex-row justify-content-evenly">
                    <input id="search-bar" type="search" class="form-control w-100 p-2 text-light bg-dark border border-0"
                           placeholder="Search..." aria-label="Search" name="q">

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
<!--<nav class="navbar navbar-expand-lg navbar-light bg-light">-->
<!--    <a class="navbar-brand" href="/">Mes pages</a>-->
<!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"-->
<!--            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
<!--        <span class="navbar-toggler-icon"></span>-->
<!--    </button>-->
<!---->
<!--    <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
<!--        <ul class="navbar-nav mr-auto">-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/">Accueil</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/test">Test</a>-->
<!--            </li>-->
<!--            <li class="nav-item">-->
<!--                <a class="nav-link" href="/search">Search</a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--</nav>-->

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

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>

</body>

</html>