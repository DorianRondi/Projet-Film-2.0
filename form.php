<?php $formPage = 'active'; ?>
<?php require_once('require' . DIRECTORY_SEPARATOR . 'functions.php') ?>
<?php require('require' . DIRECTORY_SEPARATOR . 'header.php') ?>
<?php
$genreList = genreList();
$create = TRUE;
$update = FALSE;
$validation = "Enregistrer";
$realImploseur = [];
$actImploseur = [];
if (isset($_GET['editeFilm'])) {
    $create = FALSE;
    $update = TRUE;
    $validation = "Editer ce film";
    $editeFilm = intval($_GET['editeFilm']);
    $movie = filmEditor($editeFilm);
    $real = filmTOreal($editeFilm);
    $actor = filmTOactor($editeFilm);
    foreach ($real as $entity) {
        $imploded = implode(" ", $entity);
        $realImploseur[] = $imploded;
    }
    foreach ($actor as $entity) {
        $imploded = implode(" ", $entity);
        $actImploseur[] = $imploded;
    }
}
$realisatorsList = realsList();
$actorsList = actorsList();
var_dump($movie);
?>
<!-- Section-->
<section>
    <div class="container px-4 px-lg-5 mt-5">
        <!-- Debut FORM -->
        <form enctype="multipart/form-data" action="redirect.php" method="POST">
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl-3 justify-content-center">
                <div class="col mb-5">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <label for="affiche" class="fs-5">Uploader l'affiche du film.</label></br>
                                <input id="affiche" name="afficheUser" type="file" accept="imag/.jpg,image/.jpeg,image/.webp"></br>
                                <label for="titre" class="fs-5 mt-2">Titre du film <span class="fst-italic fs-6">(obligatoire)</span></label></br>
                                <input id="titre" name="titre" type="text" placeholder="Full metal Jacket" value="<?= $movie['titre'] ?>" class="w-100" required>
                                <?php if (!isset($_GET['editeFilm'])) : ?>
                                    <label for="reals" class="fs-5 mt-2">Réalisateur</label></br>
                                    <select name="realisator" id="reals">
                                        <option value="">-choisissez le réalisateur-</option>
                                        <?php foreach ($realisatorsList as $name) : ?>
                                            <option value="<?= $name; ?>"><?= $name . $BR ?></option>
                                        <?php endforeach ?>
                                    </select></br>
                                    <label for="reals" class="fs-5 mt-2">1er Rôle</label></br>
                                    <select name="actor" id="actor">
                                        <option value="">-choississez un acteur-</option>
                                        <?php foreach ($actorsList as $name) : ?>
                                            <option value="<?= $name; ?>"><?= $name . $BR ?></option>
                                        <?php endforeach ?>
                                    </select></br>
                                <?php endif ?>
                                <label for="date_sortie" class="fs-5 mt-2">Date de sortie.</label></br>
                                <input id="date_sortie" name="sortie" type="date" value="<?= $movie['sortie'] ?>" class="w-100"></br>
                                <label for="genre" class="fs-5 mt-2">Genre du film.</label></br>
                                <select name="genre" id="genre" class="text-center">
                                    <option value="">- - - Selectionnez - - -</option>
                                    <?php foreach ($genreList as $array) : ?>
                                        <?php foreach ($array as $genre) : ?>
                                            <?php if ($movie['genre'] != $genre) : ?>
                                                <option value="<?= $genre ?>"><?= $genre ?></option>
                                            <?php elseif ($movie['genre'] == $genre) : ?>
                                                <option value="<?= $genre ?>" Selected><?= $genre ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php endforeach ?>
                                </select></br>
                                <label for="duree" class="fs-5 mt-2">Durée du film.</label></br>
                                <input id="duree" name="duree" type="time" value="<?= $movie['duree'] ?>" class="w-100">
                            </div>
                        </div>
                        <div class="card-footer pb-4 pt-0 border-top-0 bg-transparent">
                            <input type="hidden" name="create" value="<?= $create ?>">
                            <input type="hidden" name="update" value="<?= $update ?>">
                            <input type="hidden" name="filmID" value="<?= $movie['filmID'] ?>">
                            <input type="hidden" name="affiche" value="<?= $movie['affiche'] ?>">
                            <input type="submit" class="btn btn-outline-dark mt-auto w-100" value="<?= $validation ?>">
                        </div>
                    </div>
                </div>
                <?php if (isset($_GET['editeFilm'])) : ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img" src="<?= $movie['affiche'] ?>" alt="..." />
                            <div class="card-body p-4">
                            </div>
                        </div>
                    </div>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <label for="reals">
                                        <h5 class="fw-bolder">Réalisateur(s)</h5>
                                    </label></br>
                                    <select name="realisator" id="reals">
                                        <option value="">-choisissez le réalisateur-</option>
                                        <?php foreach ($realisatorsList as $name) : ?>
                                            <option value="<?= $name; ?>"><?= $name . $BR ?></option>
                                        <?php endforeach ?>
                                    </select></br>
                                    <?php foreach ($realImploseur as $name) : ?>
                                        <input type="radio" name="suppReal" value="<?= $name; ?>">
                                        <?= $name . $BR; ?>
                                    <?php endforeach ?>
                                    <label for="actor">
                                        <h5 class="fw-bolder mt-3">Acteurs</h5>
                                    </label></br>
                                    <select name="actor" id="actor">
                                        <option value="">-choississez un acteur-</option>
                                        <?php foreach ($actorsList as $name) : ?>
                                            <option value="<?= $name; ?>"><?= $name . $BR ?></option>
                                        <?php endforeach ?>
                                    </select></br>
                                    <?php foreach ($actImploseur as $name) : ?>
                                        <input type="radio" name="suppActor" value="<?= $name; ?>">
                                        <?= $name . $BR; ?>
                                    <?php endforeach ?>
                                </div>
                            </div>
                            <div class="card-footer pb-4 pt-0 border-top-0 bg-transparent">
                                <a href="addpeople.php" class="btn btn-outline-dark mt-auto w-100">ajouté des Réals ou des Acteurs à la BDD</a>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
            </div>
    </div>
    </form>
    </div>
</section>

<?php require('require' . DIRECTORY_SEPARATOR . 'footer.php') ?>