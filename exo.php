<?php $exoPage = 'active'; ?>
<?php require_once('require' . DIRECTORY_SEPARATOR . 'functions.php') ?>
<?php require('require' . DIRECTORY_SEPARATOR . 'header.php') ?>
<section>
    <div class="container px-4 px-lg-5 mt-5 mb-5">
        <h2 class="mx-3">Site OnePage d'une liste de films</h2>
        <h4 class="mx-3">Détails du Projet</h4>
        <table>
            <thead class="text-white bg-dark">
                <tr>
                    <th>CHAMPS</th>
                    <th>`titre_film`<br>(primary key)</th>
                    <th>`date_sortis`</th>
                    <th>`genre`</th>
                    <th>`duree`</th>
                    <th>`affiche`<br>(optionnel)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th> </th>
                    <td>full Metal Jacket</td>
                    <td>1987</td>
                    <td>Guerre</td>
                    <td>116</td>
                    <td>img/affiche/FMJ.jpg</td>
                </tr>
            </tbody>
            <tfoot class="text-white bg-dark">
                <tr>
                    <th>TABLE</th>
                    <th colspan="5">`film`</th>
                </tr>
            </tfoot>
        </table>
        <p class="mx-3 mt-3 mb-1 fs-5">Sur la page:</p>
        <ul class="mx-3">
            <li>une liste de films sous forme de card.</li>
            <li>Les données sont récupérés depuis la BDD.</li>
            <li>Deux boutons editer et supprimer sous chaque card.</li>
            <li>Editer envois vers un formulaire d’édition don la confirmation redirige vers la homepage où le film édité devrait afficher les nouvelles données.</li>
            <li>Supprimer supprime le film et le rafraichissment de la homepage n'affiche plus le film supprimé.</li>
        </ul>
    </div>
</section>
<?php require('require' . DIRECTORY_SEPARATOR . 'footer.php') ?>