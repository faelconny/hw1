<?php
    session_start();

    if (isset($_SESSION['id']) && isset($_GET['action']) && isset($_GET['q']) &&
        $_GET['action'] == "add") {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");
        $id = mysqli_real_escape_string($conn, $_GET['q']);
        $query = "INSERT INTO likes VALUES(".$_SESSION['id'].", ".$id.")";
        mysqli_query($conn, $query);
        mysqli_close($conn);
    }

    if (isset($_SESSION['id']) && isset($_GET['action']) && isset($_GET['q']) &&
        $_GET['action'] == "remove") {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");
        $id = mysqli_real_escape_string($conn, $_GET['q']);
        $query = "DELETE FROM likes WHERE user = ".$_SESSION['id']." AND post = ".$id."";
        mysqli_query($conn, $query);
        mysqli_close($conn);
    }

    if ($_GET['action'] == "check") {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");

        $query = "SELECT post FROM likes WHERE user = ".$_SESSION['id']."";
        $res = mysqli_query($conn, $query);

        $posts = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $posts[] = $row;
        }
        
        mysqli_free_result($res);
        mysqli_close($conn);

        echo json_encode($posts);
    }
?>