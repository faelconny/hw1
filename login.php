<?php
	session_start();
  	if (isset($_SESSION['id'])) {
    	header("Location: profile_picture.php");
    	exit;
  	}
  	if (isset($_POST['login-username']) && isset($_POST['login-password'])) {
		$conn = mysqli_connect("localhost", "root", "", "hw1_db");
		$username = mysqli_real_escape_string($conn, $_POST['login-username']);
		$password = mysqli_real_escape_string($conn, $_POST['login-password']);
		$query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";
		$res1 = mysqli_query($conn, $query);
		if (mysqli_num_rows($res1) > 0) {
			$query = "SELECT id FROM users WHERE username = '".$username."'";
			$res2 = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($res2);
			$_SESSION['id'] = $row['id'];
			header("Location: profile_picture.php");
			mysqli_free_result($res1);
			mysqli_free_result($res2);
    		mysqli_close($conn);
			exit;
		} else {
      		$error = true;
    	}
		mysqli_free_result($res1);
    	mysqli_close($conn);
  	}
	if (isset($_POST['name']) && isset($_POST['surname']) && 
		isset($_POST['signup-username']) && isset($_POST['signup-password']) &&
		isset($_POST['email'])) {
		$conn = mysqli_connect("localhost", "root", "", "hw1_db");
		$username = mysqli_real_escape_string($conn, $_POST['signup-username']);
		$password = mysqli_real_escape_string($conn, $_POST['signup-password']);
		$first_name = mysqli_real_escape_string($conn, $_POST['name']);
		$last_name = mysqli_real_escape_string($conn, $_POST['surname']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$query = "SELECT username FROM users where username = '".$username."'";
		$res1 = mysqli_query($conn, $query);
		if (mysqli_num_rows($res1) == 0) {
			$query = "INSERT INTO users(username, email, password, name, surname) VALUES (
				'".$_POST['signup-username']."',
				'".$_POST['email']."',
				'".$_POST['signup-password']."',
				'".$_POST['name']."',
				'".$_POST['surname']."'
			)";
			mysqli_query($conn, $query);
			$query = "SELECT id FROM users WHERE username = '".$username."'";
			$res2 = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($res2);
			$_SESSION['id'] = $row['id'];
			mysqli_free_result($res1);
			mysqli_free_result($res2);
			header('Location: profile_picture.php');
			exit;
		} else {
			$sign_up_error = true;
		}
		mysqli_free_result($res1);
    	mysqli_close($conn);
  	}
?>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
        <meta name="viewport"content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="styles/common_style.css">
		<link rel="stylesheet" href="styles/login.css">
		<link rel="shortcut icon" href="img/favicon.ico">
		<script src="scripts/login.js" defer></script>
		<title>Blog del Cinema - Accedi</title>
	</head>
	<body>
		<div id="login">
			<div class="hidden overlay">
				<div class="box">
					<div id="close-icon">
						<img src="img/close.png">
					</div>
					<main id="sign-up">
						<h1>Registrazione</h1>
						<?php
							if (isset($sign_up_error)) {
								echo "<p class='errore'>";
								echo "Username già in uso!";
								echo "</p>";
							}
						?>
						<p class="hidden" id="form-error">Compilare tutti i campi!</p>
						<form name='signup-form' method='post'>
							<label>Nome <input type='text' name='name'></label>
							<label>Cognome <input type='text' name='surname'></label>
							<label>Email <input type='text' name='email' id="email"></label>
							<p class="hidden" id="invalid-email">Email non valida!</p>
							<p class="hidden" id="duplicate-email">Email già in uso!</p>
							<label>Nome utente <input type='text' name='signup-username' id="username"></label>	
							<ul class="hidden" id="invalid-username">
								Il nome utente può contenere solo:
								<li>Lettere minuscole</li>
								<li>Numeri</li>
								<li>Trattino basso ( _ )</li>
								<li>Punto ( . )</li>
							</ul>
							<p class="hidden" id="duplicate-username">Username già in uso!</p>
							<label>Password <input type='password' name='signup-password' id="password"></label>
							<p class="hidden" id="password-error">La password non rispetta i requisiti necessari!</p>
							<label>Conferma password <input type='password' name='confirm-password' id="confirm-password"></label>
							<p class="hidden" id="confirm-password-error">Le password non coincidono!</p>
							<label>Requisiti password <img id="password-info" src="img/info.png"></label>
							<ul id="info" class="hidden">
								<li>lunghezza compresa tra 8 e 20 caratteri</li>
								<li>caratteri alfanumerici (almeno una maiuscola)</li>
								<li>almeno un carattere speciale</li>
							</ul>
							<label>&nbsp;<input type='submit' value='Registrati' id="sign-up-submit">&nbsp;</label>
						</form>
					</main>
				</div>
			</div>
			<div id="login-background"></div>
			<div id="login-area">
				<h1>Accedi al Blog del Cinema</h1>
				<?php
					if (isset($error)) {
						echo "<p id=\"failed-login\">";
						echo "Username o password errati!";
						echo "</p>";
					}
				?>
				<p class="hidden" id="login-error">Compilare tutti i campi!</p>
				<main>
					<form name='login-form' method='post'>
						<label>Nome utente <input type='text' name='login-username'></label>
						<label>Password <input type='password' name='login-password'></label>
						<label>&nbsp;<input type='submit' value='Accedi'>&nbsp;</label>
					</form>
				</main>
				<p>Non sei ancora registrato?</p>
				<button id="signup-button">Registrati</button>
			</div>
		</div>
	</body>
</html>