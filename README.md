# Projet Films 2.0

Nouvelle version de Projet Films.

La base de données à été complexifié.
7 tables dont 2 tables intermédiaire pour les Foreign Keys.

créez un fichier require/connect.php et remplissez le avec les lignes suivante dont vous aurez préalablement complété les champs vierge.
<?php
define('DSN', 'mysql:host=<HOSTNAME>;dbname=film');
define('USER', '<USERNAME>');
define('PASS', '<PASSWORD>');
?>

Ensuite chargez le fichiet "film.sql" sur votre server.