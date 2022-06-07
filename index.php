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
                    <span class="text"> <h1>Dashboard</span>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Liste des employés.</span>
                </div>';

                echo '
                
                <div class="container activity-data">
                    <div class="row">
                        <table class="table">
                            <thead class="activity_thead">
                                <tr class="activity_tr">
                                    <th class="activity_th" scope="col">#</th>
                                    <th class="activity_th" scope="col">Prénom</th>
                                    <th class="activity_th" scope="col">Nom</th>
                                    <th class="activity_th" scope="col">Rôle</th>
                                    <th class="activity_th" scope="col">Groupe</th>
                                    <th class="activity_th" scope="col">E-mail</th>
                                    
                                    <th class="activity_th" scope="col">Date d inscription</th>
                                </tr>
                            </thead>
                
                            <tbody>
                                ';
                                $personnages = json_decode(file_get_contents("assets/users.json"), true);
                                foreach ($personnages as $personnage) {
        
                                    echo "<tr>";
                                        echo ' <th scope="row" class="activity_th">'.$personnage['id'].'</th>';
                                        echo ' <td class="activity_td">'.$personnage['prenom'].'</td>';
                                        echo ' <td class="activity_td">'.$personnage['nom'].'</td>';
                                        echo ' <td class="activity_td">'.$personnage['role'].'</td>';
                                        echo ' <td class="activity_td">'.$personnage['groupe'].'</td>';
                                        echo ' <td class="activity_td">'.$personnage['email'].'</td>';
                                        echo ' <td class="activity_td">'.$personnage['date'].'</td>';
                                        if($_SESSION['role'] == 'admin'){ 
                                            echo ' <td style="border: none"><a href="utilisateurs/supprimer_perso.php?id='.$personnage['id'].'" class="btn btn-sm btn-danger material-icons">Suppprimer</a></td>';
                                        }
                                    echo "</tr>";
        
                                }
                            echo ' 
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                ';

                if($_SESSION['role'] == 'admin'){
                    echo '
                    <div>
                    <div>
                    <div class="title">
                        <span class="text">Ajouter un utilisateur.</span>
                    </div>
                                    <form action="utilisateurs/ajouter_perso.php">
                                        <div class="form-row my-4">
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder="Prénom" name="prenom" required>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder="Nom" name="nom" required>
                                            </div>
                                            <div class="col-3">
                                                <input type="text" class="form-control" placeholder="motdepasse" name="motdepasse" required>
                                            </div>
                                            <div class="col-3">
                                            <select class="form-select" aria-label="Default select example" name="role">
                                                <option value="Utilisateur" name="Utilisateur">Utilisateur</option>
                                                <option value="Moderateur" name="Moderateur">Moderateur</option>
                                                <option value="Admin" name="Admin">Admin</option>
                                            </select>
                                            <select class="form-select" aria-label="Default select example" name="groupe">
                                                <option value="Communication" name="Communication">Communication</option>
                                                <option value="Contrats RH" name="contrats_rh">Contrats RH</option>
                                                <option value="Paies RH" name="Paies RH">Paies RH</option>
                                                <option value="Contrats Partenaires" name="Contrats Partenaires">Contrats Partenaires</option>
                                                <option value="Avant Vente" name="Avant Vente">Avant Vente</option>
                                                <option value="Service Technique" name="Service Technique">Service Technique</option>
                                            </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="submit" class="btn btn-success" value="Ajouter">
                                            </div>
                                        </div>
                                    </form>
                    </div> 
                </div>
                    ';
                }

                if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'Moderateur'){
                    $user = json_decode(file_get_contents("assets/users.json"), true);
                    echo '
                    <div class="title">
                        <span class="text">Modifier un role.</span>
                    </div>
                    <form action="utilisateurs/modifier_role.php">
                        <div class="form-row my-4">  
                            <div class="col-3"> 
                                <select class="form-select" aria-label="Default select example" name="nom">
                                    <option selected="selected">Sélectionner une valeur</option>';
                                    foreach($user as $value){
                                        echo '<option value="'.$value['nom'].'">'.$value['nom'].'</option>';
                                    }
                                echo '
                                </select>
                            </div>

                            <div class="col-3"> 
                                <select class="form-select" aria-label="Default select example" name="role">
                                    <option value="Utilisateur" name="Utilisateur">Utilisateur</option>
                                    <option value="Moderateur" name="Moderateur">Moderateur</option>
                                    <option value="Admin" name="Admin">Admin</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="submit" class="btn btn-success" value="Ajouter">
                            </div>
                        </div>
                    </form>
                    ';
                }
            echo '</div>
        </div>
    </section>

    <script src="assets/script.js"></script>
</body>';
}else{
    header("Location: conn/connexion.php");
}
?>
</html>