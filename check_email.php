<?php
    if (isset($_GET['q'])) {
        $conn = mysqli_connect("localhost", "root", "", "hw1_db");

        $email = mysqli_real_escape_string($conn, $_GET['q']);

        $query = "SELECT * FROM users where email = '".$email."'";
        $res = mysqli_query($conn, $query);

        if (mysqli_num_rows($res) > 0) {
            echo json_encode(true);
        } else {
            echo json_encode(false);
        }

        mysqli_free_result($res);
        mysqli_close($conn);
    }
?>