<?php
echo "qa";
    session_start();
    if (isset($_SESSION['id']) && isset($_GET['q'])) {
        echo "ora qua";
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");
		$url = mysqli_real_escape_string($conn, $_GET['q']);
		$query = "UPDATE users SET picture = '".$url."' WHERE id = ".$_SESSION['id']."";
        echo $query;
		mysqli_query($conn, $query);
        mysqli_close($conn);
    }
    echo "ciao";
?>