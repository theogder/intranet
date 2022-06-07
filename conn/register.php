<?php 

session_start();
error_reporting(0);

$user = json_decode(file_get_contents("../assets/users.json"), true);
if (isset($_SESSION['username'])) {
    header("Location: ../page01.php");
}

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['cpassword']) && isset($_POST['email'])){
    $username = $_POST['username'];
	$username2 = $_POST['username2'];
    $password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$email = $_POST['email'];
    
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		if(preg_match("/^([a-zA-Z0-9\.]+@cbdmalo.fr)$/", $email)){
			if($password == $cpassword){
				
				//Vérifier les identifiants
				foreach ($user as $pelo) {
					if($username == $pelo['nom']){
						echo "Compte déja existant.";
						break;
					}else{
						echo "compte crée";
						$destinataire = 'theo.godier@gmail.com';
						$expediteur = 'register@cbdmalo.fr';
						$objet = 'Creation de compte sur CBD MALO'; // Objet du message
						$headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME   
						$message = 'Nous vous confirmons que votre compte a bien été crée.'. "\n".'Vous pouvez vous connectez avec ces identifiants'. "\n".'Identifiant : '.$username. "\n".'Mot de passe : '.$password;
						mail($destinataire, $objet, $message, $headers);
						
						$date = date('d-m-y h:i:s');
						array_push($user, array(
							"id" => end($user)['id'] + 1,
							"nom" => $username,
							"prenom" => $username2,
							"email" => $email,
							"motdepasse" => password_hash($password, PASSWORD_ARGON2I),
							"role" => 'utilisateur',
							"groupe" => '',
							"date" => $date
						));
						file_put_contents("../assets/users.json", json_encode($user));
		
						header("Location: connexion.php");
						break;
					}
				}



				
				
			}else{
				echo "Mot de passe différents";
			}
		}else{
			echo "email non valdie.";
		}
	}
	
}else{
    echo "Veuillez remplir tous les champs";
}

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
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Nom" name="username" value="<?php echo $username; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="prenom" name="username2" value="<?php echo $username2; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="connexion.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>