<?php
    session_start();
    if ($_GET['action'] == "add" && isset($_GET['title']) && 
        isset($_GET['desc']) && isset($_GET['poster'])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");

        $title = mysqli_real_escape_string($conn, $_GET['title']);
        $description = mysqli_real_escape_string($conn, $_GET['desc']);
        $poster = mysqli_real_escape_string($conn, $_GET['poster']);

        $query = "SELECT * FROM movies WHERE title = '".$title."'";
        $res1 = mysqli_query($conn, $query);

        if (mysqli_num_rows($res1) == 0) {
            $query = "INSERT INTO movies(title, description, poster) VALUES(\"$title\", \"$description\", \"$poster\")";
            mysqli_query($conn, $query);
        }

        $query = "SELECT id FROM movies WHERE title = '".$title."'";
        $res2 = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($res2);

        $query = "INSERT INTO favourites VALUES(".$_SESSION['id'].", ".$row['id'].")";
        mysqli_query($conn, $query);

        mysqli_free_result($res1);
        mysqli_free_result($res2);
        mysqli_close($conn);
    }

    if ($_GET['action'] == "remove" && isset($_GET['title'])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");

        $title = mysqli_real_escape_string($conn, $_GET['title']);

        $query = "SELECT id FROM movies WHERE title = '".$title."'";
        $res1 = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($res1);

        $query = "DELETE FROM favourites WHERE user = ".$_SESSION['id']." AND movie = ".$row['id']."";
        mysqli_query($conn, $query);

        $query = "SELECT num_favourites FROM movies WHERE title = '".$title."'";
        $res2 = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($res2);

        if ($row['num_favourites'] == 0) {
            $query = "DELETE FROM movies WHERE title = '".$title."'";
            mysqli_query($conn, $query);
        }

        mysqli_close($conn);
    }

    if ($_GET['action'] == "check" && isset($_GET['title'])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");

        $title = mysqli_real_escape_string($conn, $_GET['title']);

        $query = "SELECT * FROM favourites WHERE user = '".$_SESSION['id']."' AND movie = (SELECT id FROM movies WHERE title = '".$title."')";
        $res1 = mysqli_query($conn, $query);

        if (mysqli_num_rows($res1) == 0) {
            $present = false;
        } else {
            $present = true;
        }

        $query = "SELECT num_favourites FROM movies WHERE title = '".$title."'";
        $res2 = mysqli_query($conn, $query);

        if (mysqli_num_rows($res2) > 0) {
            $row = mysqli_fetch_assoc($res2);
            $num = $row['num_favourites'];
        } else {
            $num = 0;
        }

        $result = array(
            "number" => $num,
            "present" => $present
        );

        mysqli_free_result($res1);
        mysqli_free_result($res2);
        mysqli_close($conn);

        echo json_encode($result);
    }
?>