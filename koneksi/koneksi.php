<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "db_penyewaan";

    $conn = new mysqli($server, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    date_default_timezone_set('Asia/Jakarta');
?>