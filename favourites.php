<?php
    session_start();
    if (isset($_SESSION['id'])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");
		$query = "SELECT name, surname, username, picture FROM users WHERE id = ".$_SESSION['id']."";
        $res = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($res);
        mysqli_free_result($res);
        mysqli_close($conn);
    } else {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <head>
        <title>Blog del Cinema - Preferiti</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/common_style.css">
        <link rel="stylesheet" href="styles/home.css">
        <link rel="stylesheet" href="styles/favourites.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="img/favicon.ico">
        <script src="scripts/favourites.js" defer></script>
    </head>
    <body>
        <div class="sidebar">
            <img src="img/close_white.png">
            <div>
                <div class="link">
                <a href="home.php">Home</a>
                </div>
                <div class="link">
                    <a href="profile.php">Profilo</a>
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
                <a href="profile.php">Profilo</a>
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
        <div id="profile">
            <img id="photo" src="<?php echo $user['picture']; ?>">
            <div id="name">
                <strong><?php echo $user['name']." ".$user['surname']; ?></strong><br>
                <em>@<?php echo $user['username']; ?></em>
            </div>
        </div>
        <article>
            <main>
                <div class="form-box">
                    <h1>Ricerca un film e aggiungilo ai preferiti!</h1>
                    <form name="movie-form">
                        <label>&nbsp;<input type="text" name="movie" placeholder="Nome del film...">&nbsp;</label>
                        <label>&nbsp;<input type="submit" value="Cerca" name="submit" disabled>&nbsp;</label>
                    </form>
                </div>
            <main>
            <div id="section" class="hidden">
                <div class="movie"></div>
                <div id="star">
                    <img src="img/star.png">
                    <div>Aggiungi ai preferiti</div>
                </div>
                <div id="counter">
                    <em>&#200; tra i preferiti di <span id="num-favourites"></span> utenti</em>
                </div>
            </div>
            <section class="hidden"></section>
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