<?php
session_start();

if(isset($_GET["id"])){
    // Define headers
    header("Cache-Control: public");
    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=".$_GET['id']."");
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: binary");
    
    // Read the file
    readfile($_GET['id']);
    exit;
}else{
    echo 'The file does not exist.';
}

?>