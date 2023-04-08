<?php require_once('require'.DIRECTORY_SEPARATOR.'functions.php') ?>
<a href=".">index.php</a>
<?php
if($_POST["supprimeFilm"]){
    supprime($_POST["supprimeFilm"]);
    homepage();
}
if($_POST['create']){
    if($_FILES['afficheUser']['error'] === 4){
        create($_POST);
        homepage();
    }else{
        $tmp_name = $_FILES["afficheUser"]["tmp_name"];
        $destination = DIRECTORY_SEPARATOR."home".DIRECTORY_SEPARATOR."dorian".DIRECTORY_SEPARATOR."Programmation".DIRECTORY_SEPARATOR."DonkeySchool".DIRECTORY_SEPARATOR."PHP".DIRECTORY_SEPARATOR."Projet Films 2.0".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."affiches".DIRECTORY_SEPARATOR.$_FILES["afficheUser"]["name"];
        $affiche = ".".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."affiches".DIRECTORY_SEPARATOR.$_FILES["afficheUser"]["name"];
        if(!move_uploaded_file($tmp_name,$destination)){
            echo 'create() => move_uploaded_file ECHEC'."</BR>"."Error ";
            echo $_FILES["afficheUser"]["error"]."</BR>";
        }
        create($_POST,$affiche);
        homepage();
    }
}
if($_POST["update"]){
    if($_FILES["afficheUser"]['error'] === 4){
        update($_POST);
        homepage();
    }else{
        $tmp_name = $_FILES["afficheUser"]["tmp_name"];
        $destination = DIRECTORY_SEPARATOR."home".DIRECTORY_SEPARATOR."dorian".DIRECTORY_SEPARATOR."Programmation".DIRECTORY_SEPARATOR."DonkeySchool".DIRECTORY_SEPARATOR."PHP".DIRECTORY_SEPARATOR."Projet Films 2.0".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."affiches".DIRECTORY_SEPARATOR.$_FILES["afficheUser"]["name"];
        $affiche = ".".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."affiches".DIRECTORY_SEPARATOR.$_FILES["afficheUser"]["name"];
        if(!move_uploaded_file($tmp_name,$destination)){
            echo 'update() => move_uploaded_file ECHEC'."</BR>"."Error ";
            echo $_FILES["afficheUser"]["error"]."</BR>";
        }
        update($_POST,$affiche);
        homepage();
    }
}
if($_POST['addVIP']){
    if($_POST['realisatorFirst'] && $_POST['realisatorLast']){
        $rf = $_POST['realisatorFirst'];
        $rl = $_POST['realisatorLast'];
        addVIP($rf,$rl,'realisator');
    }
    if($_POST['actorFirst'] && $_POST['actorLast']){
        $af = $_POST['actorFirst'];
        $al = $_POST['actorLast'];
        addVIP($af,$al,'actor');
    }
    homepage();
}
?>