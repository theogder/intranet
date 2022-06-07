<?php 
session_start();
?>
<!DOCTYPE html>
<!--=== Coding by CodingLab | www.codinglabweb.com === -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>CBD-MALO Intranet</title>
</head>
<?php
if(isset($_SESSION['username'])){
    echo '
    <body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
            </div>
            <span class="logo_name">CBD MALO</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="index.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="share.php">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Partage de Fichiers</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Annuaire</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="conn/logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <span class="text"> <h1>Bienvenu '. $_SESSION['username'].'.</span>
                    <span class="text"> <h1>Partage de fichiers</span>
                </div>
            </div>
        </div>';     

        // "./" représente le dossier actuel où est exécuté le script, par exemple pour accéder au dossier "monDossier", mettez "./monDossier"
        // vous pouvez également aller dans des sous répertoire en mettant "../" au lieu de "./"
        $scandir = scandir("fichiers");
        //Lister toutes images ayant les extensions jpg, jpeg, png, gif, bmp et tif
        echo '
        <div class="container activity-data">
                    <div class="row">
                        <table class="table">
                            <thead class="activity_thead">
                                <tr class="activity_tr">
                                    <th class="activity_th" scope="col">Nom Fichier</th>
                                    <th class="activity_th" scope="col">Upload par</th>
                                    <th class="activity_th" scope="col">Télécharger</th>
                                </tr>
                            </thead>
                
                            <tbody>
                                ';
                                foreach($scandir as $fichier){
                                    if(preg_match("#\.(jpg|jpeg|png|gif|bmp|tif|txt)$#",strtolower($fichier))){
                                        //on passe tout le nom du fichier en caractères minuscules, y compris l'extension
                                        //la preg_match définie: \.(jpg|jpeg|png|gif|bmp|tif)$
                                        //commence par un point (.) (doit être échappé avec anti-slash \ car le point veut dire "tous les caractères" sinon)
                                        //(|) parenthèses avec des barres obliques dit "ou" (plusieurs possibilités)
                                        //le $ dit que ce doit se trouver à la fin du nom du fichier, par exemple un fichier nommé "monFichier.jpg.php" ne sera pas accepté car il ne se termine pas par .jpg, ou .jpeg ou .png ou...        
                                        echo '<tr>';
                                        echo ' <th scope="row" class="activity_th">'.(preg_split("/[-\.]/",$fichier))[0].".".(preg_split("/[-\.]/",$fichier))[2].'</th>';
                                        echo ' <th scope="row" class="activity_th">'.(preg_split("/[-\.]/",$fichier))[1].'</th>';
                                        echo ' <td  ><a href="fichiers/downloadFile.php?id='.$fichier.'" class="btn btn-sm btn-danger material-icons">Télécharger</a></td>';
                                        if($_SESSION['role'] == 'admin'){ 
                                            echo ' <td style="border: none"><a href="fichiers/deleteFile.php?id='.$fichier.'" class="btn btn-sm btn-danger material-icons">Suppprimer</a></td>';
                                        }
                                        echo "</tr>";
                                    }
                                }
                                
                            echo ' 
                            </tbody>
                        </table>
                    </div>
                </div>';
                 
                if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Moderateur'){
                    echo '
                    <div class="dash-content">
                        <div class="activity">
                            <div class="title">
                                <i class="uil uil-clock-three"></i>
                                <span class="text">Upload un fichier.</span>
                            </div>
                                <form action="fichiers/upload.php" method="post" enctype="multipart/form-data">
                                    <div class="form-row my-4">
                                        <div class="col-3">
                                            <div class="title">
                                                <span class="text">Fichier:</span>
                                            </div>
                                        </div>
                                            <input type="file" name="fichier" id="fileUpload" class="form-control">
                                            <input type="submit" name="submit" value="Upload" class="form-control">
                                            <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .jpeg, .gif, .png sont autorisés jusqu à une taille maximale de 5 Mo.</p>
                                    </div
                                </form>
                        </div>
                    </div>';
                }
    echo '                            
    </section>
    <script src="assets/script.js"></script>
</body>';
}else{
    header("Location: conn/connexion.php");
}
?>
</html>
