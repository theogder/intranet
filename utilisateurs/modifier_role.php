<?
session_start();
if (!isset($_GET["nom"]) || !isset($_GET["role"])) {
    echo ("Il manque des arguments !");
    echo ("<pre>");
    var_dump($_GET);
    echo ("</pre>");
    die();
}

$employe = json_decode(file_get_contents("../assets/users.json"), true);

echo ("<pre>");
var_dump($_GET);
echo ("</pre>");

foreach($employe as $pelo) {
    if($pelo['nom'] == $_GET['nom']) {
        echo 'Employe existant';
        print_r(array_replace($pelo,array('role' => $_GET['role'])));
        unset($employe[$pelo['id']]);
        array_push($employe, array_replace($pelo,array('role' => $_GET['role'])));
    }
}


file_put_contents("../assets/users.json", json_encode($employe));
echo "<br> changement fait";
//header("Location: ../index.php");