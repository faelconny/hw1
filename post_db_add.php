<?php
    session_start();

    if (isset($_SESSION['id']) && isset($_POST['text']) && isset($_FILES['picture'])) {
        $upload_dir = 'img/';
        $tmp_name = $_FILES['picture']['tmp_name'];
        $name = $_FILES['picture']['name'];
        $dest_dir = $upload_dir.$name;

        move_uploaded_file($tmp_name, $dest_dir);

        $data = array("text" => $_POST['text'], "picture" => $dest_dir);
        $content = json_encode($data, JSON_UNESCAPED_UNICODE);

        $query = "INSERT INTO posts(user, content) VALUES (".$_SESSION['id'].", '".$content."')";

        $conn = mysqli_connect("localhost", "root", "", "hw1_db");
        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
?>