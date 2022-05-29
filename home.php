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
        <title>Blog del Cinema - Home</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/common_style.css">
        <link rel="stylesheet" href="styles/home.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Limelight&display=swap" rel="stylesheet">
        <meta name="viewport"content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="img/favicon.ico">
        <script src="scripts/home.js" defer></script>
    </head>
    <body>
        <div class="sidebar">
            <img src="img/close_white.png">
            <div>
                <div class="link">
                    <a href="favourites.php">Film preferiti</a>
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
                <a href="favourites.php">Film preferiti</a>
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
                <strong> <?php echo $user['name']." ".$user['surname']; ?> </strong><br>
                <em>@<?php echo $user['username'] ?></em>
            </div>
        </div>
        <article>
            <div class="form-box">
                <h1>Nuovo post</h1>
                <form name="post-form" method="post" enctype="multipart/form-data">
                    <label><textarea name="text" cols="30" rows="10" placeholder="Inserisci la descrizione..."></textarea></label>
                    <label for="file-upload" class="custom-file-upload">Carica un'immagine</label>
                    <label><input type="file" name="picture" accept="image/*" id="file-upload"></label>
                    <label><input type="submit" name="submit" value="Pubblica" disabled></label>
                </form>
            </div>
            <div id="feed"></div>
            <template>
                <section class="post">
                    <div class="header">
                        <div class="user">
                            <img src="">
                            <div>
                                <span><strong class="name"></strong></span><br>
                                <span><em class="username"></em></span>
                            </div>
                        </div>
                        <div class="date">
                            <span></span>
                        </div>
                    </div>
                    <div class="content">
                        <p></p>
                        <img src="" class="hidden">
                    </div>
                    <div class="bottom">
                        <div class="like">
                            <img src="img/like.png">
                            <span></span>
                        </div>
                    </div>
                    <div class=""></div>
                </section>
            </template>
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