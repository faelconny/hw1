<?php
    if (isset($_GET['movie'])) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://imdb-api.com/en/API/SearchMovie/k_64j467tl/".$_GET['movie']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        echo $result;
    }
?>