<?php
session_start();
if(isset($_SESSION['username'])){
    if($_SESSION['role'] == 'admin'|| $_SESSION['role'] == 'Moderateur'){ 
        if(isset($_GET["id"])){
            if( file_exists ($_GET["id"]))
                unlink( $_GET["id"] ) ;
                header("Location: ../share.php");
                exit;
                
        }else{
            echo 'The file does not exist.';
        }
    }
}else{
    header("Location: ../conn/connexion.php");
}
?>