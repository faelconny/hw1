<?php
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.nasa.gov/planetary/apod?api_key=kneNgeCyMA2ReyUfNCyrOjEYeUkfdeKVwPYNnLhe&count=9");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);
    echo $result;
?>