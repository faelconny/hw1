<?php
    session_start();
    if (isset($_SESSION['id'])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");
        $query = "SELECT name, surname, username, email, picture FROM users WHERE id = ".$_SESSION['id']."";
        $res = mysqli_query($conn, $query);
        
        $row = mysqli_fetch_assoc($res);

        mysqli_free_result($res);
        mysqli_close($conn);
        
        echo json_encode($row);
    }
?>