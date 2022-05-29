<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "hw1_db");
    $query = "SELECT * FROM movies WHERE id IN (SELECT movie FROM favourites WHERE user = ".$_SESSION['id'].")";
    $res = mysqli_query($conn, $query);
    $result = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $result[] = $row;
    }
    mysqli_free_result($res);
    mysqli_close($conn);

    echo json_encode($result);
?>