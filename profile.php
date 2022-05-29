<?php
    session_start();

    if (isset($_SESSION['id'])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");
		$query = "SELECT name, surname, username, email, picture FROM users WHERE id = ".$_SESSION['id']."";
        $res = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($res);
        mysqli_free_result($res);
        mysqli_close($conn);
    } else {
        header("Location: login.php");
        exit;
    }

    if (isset($_POST['old-password']) && isset($_POST['new-password']) &&
        isset($_POST['confirm-password'])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");
        $old_passw = mysqli_real_escape_string($conn, $_POST['old-password']);
        $new_passw = mysqli_real_escape_string($conn, $_POST['new-password']);
        $query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."' AND password = '".$old_passw."'";
        $res = mysqli_query($conn, $query);
        if (mysqli_num_rows($res) > 0) {
            $query = "UPDATE users SET password = '".$new_passw."' WHERE id = ".$_SESSION['id']."";
            mysqli_query($conn, $query);
            mysqli_free_result($res);
            mysqli_close($conn);
            header("Location: profile.php");
            exit;
        } else {
            $error = true;
        }
        mysqli_free_result($res);
        mysqli_close($conn);
    }
?>

<html>
    <head>
        <title>Blog del Cinema - Profilo</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/common_style.css">
        <link rel="stylesheet" href="styles/home.css">
        <link rel="stylesheet" href="styles/profile.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="img/favicon.ico">
        <script src="scripts/profile.js" defer></script>
    </head>
    <body>
        <div class="sidebar">
            <img src="img/close_white.png">
            <div>
                <div class="link">
                    <a href="home.php">Home</a>
                </div>
                <div class="link">
                    <a href="favourites.php">Film preferiti</a>
                </div>
                <div class="link">
                    <a href="logout.php">Esci</a>
                </div>
            </div>
        </div>
        <div class="hidden close-sidebar"></div>
        <div class="page">
            <nav>
                <div id="logo">Blog del Cinema</div>
                <div id="links">
                    <a href="home.php">Home</a>
                    <a href="favourites.php">Film preferiti</a>
                    <a href="logout.php">Esci</a>
                </div>
                <div id="menu">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </nav>
            <header>
                <div class="overlay"></div>
            </header>
            <article>
                <main>
                    <div id="info">
                        <img id="photo" src="<?php echo $user['picture']; ?>">
                        <table>
                            <tr><td><strong>Nome:</strong></td><td><?php echo $user['name'] ?></td></tr>
                            <tr><td><strong>Cognome:</strong></td><td><?php echo $user['surname']; ?></td></tr>
                            <tr><td><strong>Username:</strong></td><td><?php echo $user['username']; ?></td></tr>
                            <tr><td><strong>Email:</strong></td><td><?php echo $user['email']; ?></td></tr>
                        </table>
                    </div>
                    <h1>Modifica password</h1>
                    <?php
                        if (isset($error)) {
                            echo "<p class='errore'>";
                            echo "Password errata!";
                            echo "</p>";
                        }
                    ?>
                    <p class="hidden" id="password-error">La password non rispetta i requisiti di sicurezza!</p>
                    <p class="hidden" id="confirm-password-error">Le password non coincidono!</p>
                    <p class="hidden" id="empty-error">Compilare tutti i campi!</p>
                    <div class="form-box">
                        <form name="change-password" method="post">
                            <label id="old-pssw">Password attuale <input type="password" name="old-password"></label>
                            <label>Nuova password <input type="password" name="new-password" id="new-password"></label>
                            <label>Conferma password <input type="password" name="confirm-password" id="confirm-password"></label>
                            <label>&nbsp;<input type='submit' value='Modifica'>&nbsp;</label>
                        </form>   
                    </div> 
                </main>
            </article>
            <footer>
                <div>
                    Università degli Studi di Catania<br>
                    Dipartimento di Ingegneria Elettrica Elettronica e Informatica<br>
                    <a href="https://www.dieei.unict.it/corsi/l-8-inf">Corso di Laurea in Ingegneria Informatica</a>
                </div>
                <div>
                    Felice Simone Coniglio<br>
                    n. matricola: 1000001151<br>
                    e-mail: <a href="mailto:felice.coniglio@studium.unict.it">felice.coniglio@studium.unict.it</a>
                </div>
            </footer>
        </div>
    </body>
</html>