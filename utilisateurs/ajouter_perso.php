<?php
session_start();
/* Auteur : Séverin Messiaen */
if(isset($_SESSION['username'])){
    if($_SESSION['role'] == 'admin'){
        if (!isset($_GET["prenom"]) || !isset($_GET["nom"]) || !isset($_GET["motdepasse"]) || !isset($_GET["role"]) || !isset($_GET["groupe"])) {
            echo ("Il manque des arguments !");
            echo ("<pre>");
            var_dump($_GET);
            echo ("</pre>");
            die();
        }
        $date = date('d-m-y h:i:s');
        $personnages = json_decode(file_get_contents("../assets/users.json"), true);
        array_push($personnages, array(
            "id" => end($personnages)['id'] + 1,
            "nom" => $_GET['nom'],
            "prenom" => $_GET['prenom'],
            "email" => $_GET['prenom'].".".$_GET['nom']."@cbdmalo.fr",
            "motdepasse" => password_hash($_GET['motdepasse'], PASSWORD_ARGON2I),
            "role" => $_GET['role'],
            "groupe" => $_GET['groupe'],
            "date" => $date
        ));

        file_put_contents("../assets/users.json", json_encode($personnages));
        header("Location: ../index.php");
    }else{
        header("Location: ../index.php");
    }
}else{
    header("Location: ../conn/connexion.php");
}