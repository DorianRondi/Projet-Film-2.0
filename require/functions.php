<?php
require_once 'connect.php';
$BR = "</br>";
function homepage(){
    header("Location:.");
    exit();
}

// Etablis la liste des Genre pour le <select> du formulaire. //
function genreList (){
    $query = "SELECT * FROM genre ORDER BY genreID";
    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->query($query);
    $genreList = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $genreList;
}
// Etablis la liste des Réalisateurs pour le <select> du formulaire. //
function realsList (){
    $query = "SELECT realisatorFirst, realisatorLast FROM realisator ORDER BY realisatorLast";
    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->query($query);
    $realisatorList = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($realisatorList as $entity) {
        $imploded = implode(" ",$entity);
        $reals[] = $imploded;
    }
    return $reals;
}
// Etablis la liste des Acteurs pour le <select> du formulaire. //
function actorsList (){
    $query = "SELECT actorFirst, actorLast FROM actor ORDER BY actorLast";
    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->query($query);
    $actorList = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($actorList as $entity) {
        $imploded = implode(" ",$entity);
        $actors[] = $imploded;
    }
    return $actors;
}

// List des Films pour la HomePage //
function videothequeList (){
    $query = "SELECT * FROM film ORDER BY titre";
    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->query($query);
    $videotheque = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $videotheque;
}

// Déployeur //
function deploy (string $string):array{
    $phase1 = explode(",",$string);
    foreach ($phase1 as $value) {
        $unpack = explode(" ",$value);
        $phase2[] = $unpack;
    }
    return $phase2;
}

// Etablis la liste des ACTOR et REALISATOR lié à chaque FILM. //
function bigSelect (){
    $query = "SELECT f.*, a.*, r.* FROM film AS f INNER JOIN realsOFfilm AS rOf ON f.filmID = rOf.film_id INNER JOIN realisator AS r ON rOf.real_id = r.realisatorID INNER JOIN actorsINfilm AS aIf ON f.filmID = aIf.film_id INNER JOIN actor AS a ON aIf.actor_id = a.actorID;";

    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->query($query);
    $bigSelectAll = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $bigSelectAll;
    }

    // Etablis la liste des REALISATOR par FILM. //
function filmTOreal ($filmID){
    $query = "SELECT r.realisatorFirst, r.realisatorLast FROM film AS f INNER JOIN realsOFfilm AS rOf ON f.filmID = rOf.film_id INNER JOIN realisator AS r ON rOf.real_id = r.realisatorID WHERE filmID=$filmID ORDER BY r.realisatorLast;";
    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->query($query);
    $bigSelectReal = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $bigSelectReal;
    }

    // Etablis la liste des ACTOR par FILM. //
function filmTOactor ($filmID){
    $query = "SELECT a.actorFirst, a.actorLast FROM film AS f INNER JOIN actorsINfilm AS aIf ON f.filmID = aIf.film_id INNER JOIN actor AS a ON aIf.actor_id = a.actorID WHERE filmID=$filmID ORDER BY a.actorLast;";
    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->query($query);
    $bigSelectActor = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $bigSelectActor;
    }

// Recupère l'ID du film à modifier pour pré-remplir les champs du formulaire d'édition. //
function filmEditor ($filmID){
    $query = "SELECT * FROM film WHERE filmID=$filmID;";
    $pdo = new PDO(DSN, USER, PASS);
    $statement = $pdo->query($query);
    $movie = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $movie[0];
}

// Créer un élément dans la table film //
function create (array $createdFilm, string $affiche = NULL){
    $titre = trim($createdFilm['titre']);
    $sortie = $createdFilm['sortie'];
    $genre = trim($createdFilm['genre']);
    $duree = $createdFilm['duree'];
    if(is_null($affiche)){$affiche = $createdFilm['affiche'];}
    $createFilm = "INSERT INTO film (titre,sortie,genre,duree,affiche) VALUES (:titre,:sortie,:genre,:duree,:affiche)";
    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->prepare($createFilm);
    $statement->bindValue(':titre', $titre, \PDO::PARAM_STR);
    $statement->bindValue(':sortie', $sortie, \PDO::PARAM_STR);
    $statement->bindValue(':genre', $genre, \PDO::PARAM_STR);
    $statement->bindValue(':duree', $duree, \PDO::PARAM_STR);
    $statement->bindValue(':affiche', $affiche, \PDO::PARAM_STR);
    $statement->execute();
    $list = videothequeList();
    foreach ($list as $filmBDD) {
        if($filmBDD['titre'] === $createdFilm['titre']){
            $createdFilm['create'] = "";
            $createdFilm['update'] = "1";
            $filmID = $filmBDD['filmID'];
        }
    }
    if($createdFilm['realisator']){
        $real = prepareVIP($createdFilm['realisator'],'realisator');
        linkVIP($filmID,$real,'realsOFfilm');
    }
    if($createdFilm['actor']){
        $actor = prepareVIP($createdFilm['actor'],'actor');
        linkVIP($filmID,$actor,'actorsINfilm');
    }
}

// prépare mise a jour //
function prepareVIP (string $theVIP, string $table):string{
    $vipID = $table."ID";
    $vip = trim($theVIP);
    $vip = explode(" ",$vip);
    $vip = findID($vip,$table);
    $vip = $vip[0][$vipID];
    return $vip;
}

// Met à jour un element de la table film. //
function update (array $updatedFilm, string $affiche = NULL){
    $filmID = intval($updatedFilm['filmID']);
    $titre = trim($updatedFilm['titre']);
    $sortie = $updatedFilm['sortie'];
    $genre = trim($updatedFilm['genre']);
    $duree = $updatedFilm['duree'];
    if(!$affiche){
        $affiche = $updatedFilm['affiche'];
    }
    if($updatedFilm['realisator']){
        $real = prepareVIP($updatedFilm['realisator'],'realisator');
        linkVIP($filmID,$real,'realsOFfilm');
    }
    if($updatedFilm['actor']){
        $actor = prepareVIP($updatedFilm['actor'],'actor');
        linkVIP($filmID,$actor,'actorsINfilm');
    }
    if($updatedFilm['suppReal']){
        $suppreal = prepareVIP($updatedFilm['suppReal'],'realisator');
        unlinkVIP($filmID,$suppreal,'realsOFfilm');
    }
    if($updatedFilm['suppActor']){
        $suppActor = prepareVIP($updatedFilm['suppActor'],'actor');
        unlinkVIP($filmID,$suppActor,'actorsINfilm');
    }
    $updateFilm = "UPDATE film SET titre = :titre, sortie = :sortie, genre = :genre, duree = :duree, affiche = :affiche WHERE filmID = :filmID";
    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->prepare($updateFilm);
    $statement->bindValue(':filmID', $filmID, \PDO::PARAM_INT);
    $statement->bindValue(':titre', $titre, \PDO::PARAM_STR);
    $statement->bindValue(':sortie', $sortie, \PDO::PARAM_STR);
    $statement->bindValue(':genre', $genre, \PDO::PARAM_STR);
    $statement->bindValue(':duree', $duree, \PDO::PARAM_STR);
    $statement->bindValue(':affiche', $affiche, \PDO::PARAM_STR);
    $statement->execute();
}

// Supprime un element de la table film. //
function supprime (string $doomedFilm){
    $doomedFilm = intval($doomedFilm);
    $deletelinkedReals = "DELETE FROM realsOFfilm WHERE film_id=$doomedFilm";
    $deletelinkedActors = "DELETE FROM actorsINfilm WHERE film_id=$doomedFilm";
    $deleteDoomedFilm = "DELETE FROM film WHERE filmID=$doomedFilm";
    $pdo = new \PDO(DSN, USER, PASS);
    $pdo->exec($deletelinkedReals);
    $pdo->exec($deletelinkedActors);
    $pdo->exec($deleteDoomedFilm);
}

// Retrouve les ID des acteurs ou des réalisateur selon la table choisis //
function findID(array $LostID, string $table):array {
    $requette = "SELECT * FROM $table WHERE {$table}First = :first AND {$table}Last = :last";
    $pdo = new PDO(DSN, USER, PASS);
    $statement = $pdo->prepare($requette);
    $statement->bindParam(':first', $LostID[0]);
    $statement->bindParam(':last', $LostID[1]);
    $statement->execute();
    $foundID = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $foundID;
}

//J'ajoute le $VIP_id_dans la table qui lie le film aux VIP. //
function linkVIP (int $filmID,int $vip, string $table){
    $x = NULL;
    switch ($table) {
        case 'actorsINfilm':
            $x = "actor_id";
            break;
        case 'realsOFfilm':
            $x = "real_id";
            break;
        default:
            return "Insertion ECHEC !!";
            break;
    }
    $requette = "INSERT INTO {$table} (film_id,{$x}) VALUES (:filmID,:VIP);";
    $pdo = new PDO(DSN, USER, PASS);
    $statement = $pdo->prepare($requette);
    $statement->bindParam(':filmID',$filmID,\PDO::PARAM_INT);
    $statement->bindParam(':VIP',$vip,\PDO::PARAM_INT);
    $statement->execute();
}

//Je supprime le $VIP_id_dans la table qui lie le film aux VIP. //
function unlinkVIP (int $filmID,int $vip, string $table){
    $x = NULL;
    switch ($table) {
        case 'actorsINfilm':
            $x = "actor_id";
            break;
        case 'realsOFfilm':
            $x = "real_id";
            break;
        default:
            return "Insertion ECHEC !!";
            break;
    }
    $requette = "DELETE FROM {$table} WHERE film_id=:filmID AND {$x}=:VIP;";
    $pdo = new PDO(DSN, USER, PASS);
    $statement = $pdo->prepare($requette);
    $statement->bindParam(':filmID',$filmID,\PDO::PARAM_INT);
    $statement->bindParam(':VIP',$vip,\PDO::PARAM_INT);
    $statement->execute();
}

// ajoute les reals et les acteurs //
function addVIP(string $first, string $last, string $table){
    $first = trim($first);
    $last = trim($last);
    $addVIP = "INSERT INTO {$table} ({$table}First,{$table}Last) VALUES (:first,:last)";
    $pdo = new \PDO(DSN, USER, PASS);
    $statement = $pdo->prepare($addVIP);
    $statement->bindValue(':first', $first, \PDO::PARAM_STR);
    $statement->bindValue(':last', $last, \PDO::PARAM_STR);
    $statement->execute();
}