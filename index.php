<?php $homePage = 'active'; ?>
<?php require_once('require'.DIRECTORY_SEPARATOR.'functions.php') ?>
<?php require('require'.DIRECTORY_SEPARATOR.'header.php') ?>
<?php $videotheque = videothequeList();?>


        <!-- Section-->
        <section>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
                    
                    <!-- Debut ADD CARD -->
                    <div class="col mb-5">
                        <div class="card h-100">
                            <div class="card-body pb-4 pt-0 bg-transparent d-flex flex-column justify-content-center">
                                <a href="form.php" Title="Ajouté">
                                    <img src="./img/icons/plus.png" alt="" class="card-img">
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- fin ADD CARD -->

                    <!-- Debut FILM CARD -->
                    <?php foreach ($videotheque as $film): ?>
                    <div class="col mb-5">
                        <div class="card h-100 d-flex flex-colum justify-content-between">
                            <!-- Affiche -->
                            <img class="card-img-top" src="<?= $film['affiche'] ?>" alt="..."/>
                            <!-- Actions -->
                            <div class="card-footer pb-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center mt-3">
                                    <h5><?= $film['titre'] ?></h5>
                                </div>
                                <form action="form.php" method="GET">
                                    <input type="hidden" name="editeFilm" value="<?= $film['filmID'] ?>">
                                    <input type="submit" value="Editer" class="btn btn-outline-dark mt-1 w-100">
                                </form>
                                <form action="redirect.php" method="POST">
                                    <input type="hidden" name="supprimeFilm" value="<?= $film['filmID'] ?>">
                                    <input type="submit" value="Supprimer" class="btn btn-outline-dark mt-1 w-100">
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <!-- fin FILM CARD -->
                </div>
            </div>
        </section>

<?php require('require'.DIRECTORY_SEPARATOR.'footer.php') ?>