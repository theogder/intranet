<?php
session_start();
if(isset($_SESSION['username'])){
    if($_SESSION['role'] == 'admin'){
        if (!isset($_GET["id"])) {
            echo ("Il manque des arguments !");
            echo ("<pre>");
            var_dump($_GET);
            echo ("</pre>");
            die();
        }

        $personnages = json_decode(file_get_contents("../assets/users.json"), true);
        foreach($personnages as $key => $personnage) {
            if($personnage['id'] == $_GET['id']) {
                unset($personnages[$key]);
            }
        }
        file_put_contents("../assets/users.json", json_encode($personnages));
        header("Location: ../index.php");
    }else{
        header("Location: ../index.php");
    }
}else{
    header("Location: ../conn/connexion.php");
}
?>