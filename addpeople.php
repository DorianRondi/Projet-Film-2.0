<?php $formPage = 'active'; ?>
<?php require_once('require' . DIRECTORY_SEPARATOR . 'functions.php') ?>
<?php require('require' . DIRECTORY_SEPARATOR . 'header.php') ?>

        <!-- Section-->
        <section>
            <div class="container px-4 px-lg-5 mt-5">

                <!-- Debut FORM -->
                <form enctype="multipart/form-data" action="redirect.php" method="POST">
                    <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-1 row-cols-xl-3 justify-content-center">

                        <div class="col mb-5">
                            <div class="card h-100">
                                <form action="redirect" method="POST">
                                    <div class="card-body p-4">
                                        <div class="text-center d-flex flex-column">
                                            <h5>Ajouter un réalisateur</h5>
                                            <label for="firstname">Prénom</label>
                                            <input type="text" id="firstname" name="realisatorFirst">
                                            <label for=""lastname"">Nom</label>
                                            <input type="text" id="lastname" name="realisatorLast">
                                            <h5 class="mt-4">Ajouter un Acteur</h5>
                                            <label for="">Prénom</label>
                                            <input type="text" id="firstname" name="actorFirst">
                                            <label for="lastname">Nom</label>
                                            <input type="text" id="lastname" name="actorLast">
                                        </div>
                                    </div>
                                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent mt-4">
                                        <input type="text" name="addVIP" value="TRUE">
                                        <input type="submit" class="btn btn-outline-dark mt-auto w-100" value="ajouter">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        
<?php require('require' . DIRECTORY_SEPARATOR . 'footer.php') ?>