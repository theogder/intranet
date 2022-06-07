<?php
session_start();
error_reporting(0);

$ok=true;
$messages[] = array();

$user = json_decode(file_get_contents("../assets/users.json"), true);
if(isset($_POST['user']) && isset($_POST['password'])){
    $username = $_POST['user'];
    $password = $_POST['password'];
    if($username !== "" && $password !== ""){    
        //Vérifier les identifiants
        foreach ($user as $perso) {
            if($username == $perso['nom']){
                if (password_verify($password, $perso['motdepasse'])){
                    $ok = true;
                    $messages[] = "GG";
                    $_SESSION['username'] = $perso['nom'] ;
                    $_SESSION['prenom'] = $perso['prenom'] ;
                    $_SESSION['role'] = $perso['role'] ;
                    header("Location: ../index.php");
                    break;
               }else{
                    $ok = false;
                    $messages[] = "Mauvais mot de passe";
                    break;
                }
            }else{
                $ok = false;
                $messages[] = "Mauvais identifiant";
                break;
            }
        }
        //FIN DE VERIF
    }else{
        $ok = false;
        echo "Utilisateur ou mot de passe vide";
    }
}else{
    $ok = false;
    $messages[] = "Veuillez saisir un utilisateur et un mot de passe";
}
echo json_encode(
    array(
        'ok' => $ok,
        'messages' => $messages
));
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="../assets/styles.css">
    
    

	<title>CBD-MALO Intranet</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <ul id="form_messages"></ul>
			<div class="input-group">
				<input type="text" placeholder="Identifiant" id="user" name="user" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" id="password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button id="submit" name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>


    
</body>
</html>