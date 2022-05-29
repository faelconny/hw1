<?php
    $conn = mysqli_connect("localhost", "root", "", "hw1_db");
    $query = "SELECT username, picture, name, surname, p.id, content, time, num_likes FROM users u JOIN posts p ON u.id = user ORDER BY time DESC;";
    $res = mysqli_query($conn, $query);

    $posts = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $row['time'] = calculateTime($row['time']);
        $posts[] = $row;
    }

    echo json_encode($posts);

    mysqli_free_result($res);
    mysqli_close($conn);

    exit;

    function calculateTime($time_string)
    {
        $time = strtotime($time_string);
        $sec = time() - $time;
        if ($sec < 60) {
            return $sec." sec";
        } else if (intval($sec / 60) < 60) {
            $min = intval($sec / 60);
            return $min." min";
        } else if (intval($sec / 3600) < 24) {
            $h = intval($sec / 3600);
            return $h." h";
        } else if (intval($sec / 86400) < 30) {
            $d = intval($sec / 86400);
            return $d." g";
        }
    }
?>