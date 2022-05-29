<?php
    session_start();
    session_destroy();
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
        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="stylesheet" href="styles/common_style.css">
		<link rel="stylesheet" href="styles/logout.css">
        <title>Blog del Cinema - Logout</title>
    </head>
    <body>
        <nav>
            <div id="logo">Blog del Cinema</div>
            <div id="links">
                <a href="login.php">Accedi</a>
            </div>
            <div id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </nav>
        <main>
            <h1>La disconnessione è stata effettuata con successo</h1>
            <a href="login.php">Torna al login</a>
        </main>
    </body>
</html>