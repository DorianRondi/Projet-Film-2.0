<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Donkey"/>
        <meta name="author" content="Moi"/>
        <title>DonkeySchool</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="img/icons/favicon.ico"/>
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Custom CSS-->
        <link href="css/custom.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand fw-bold" href=".">Dorian.R.</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link <?= $select; ?>" href="select.php"  aria-current="page">TEST</a></li>
                        <li class="nav-item"><a class="nav-link <?= $homePage; ?>" href="."  aria-current="page">Vidéothèque</a></li>
                        <li class="nav-item"><a class="nav-link <?= $exoPAge; ?>" href="exo.php"  aria-current="page">A propos</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header class="bg-dark py-4">
            <div class="container px-4 px-lg-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">DonkeySchool</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Projet PHP</p>
                </div>
            </div>
        </header>
