<?php
    session_start();
    if (isset($_SESSION['id'])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");
        $query = "SELECT picture FROM users WHERE id = ".$_SESSION['id']."";
        $res1 = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($res1);
        if ($row['picture'] != null) {
            header("Location: home.php");
            exit;
        }
        $query = "SELECT name FROM users WHERE id = ".$_SESSION['id']."";
        $res2 = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($res2);
        mysqli_free_result($res1);
        mysqli_free_result($res2);
        mysqli_close($conn);
    } else {
        header("Location: login.php");
        exit;
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
		<link rel="stylesheet" href="styles/profile_picture.css">
        <link rel="shortcut icon" href="img/favicon.ico">
        <title>Blog del Cinema - Immagine del profilo</title>
        <script src="scripts/profile_picture.js" defer></script>
    </head>
    <body>
        <nav id="profile-picture-nav">
            <div id="logo">Blog del Cinema</div>
            <div id="links">
                <a>Home</a>
                <a>Recensioni</a>
                <a>Classifiche</a>
                <a href="logout.php">Esci</a>
            </div>
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>
        <main id="profile-picture-main">
            <section id="profile-picture-box" class="box">
            <h1><span><?php echo $user['name']; ?></span>, scegli un'immagine del profilo</h1>
                <img src="" data-id="one">
                <img src="" data-id="two">
                <img src="" data-id="three">
                <img src="" data-id="four">
                <img src="" data-id="five">
                <img src="" data-id="six">
                <img src="" data-id="seven">
                <img src="" data-id="eight">
                <img src="" data-id="nine">
                <button>Invia</button>
            </section>
        </main>
    </body>
</html>