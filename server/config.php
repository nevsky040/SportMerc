<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'sportmerc';

    $conn = mysqli_connect($host, $user, $password, $db_name);

    if ($conn->connect_error) {
        die("Ошибка подключения" . $conn->connect_error);
    }
?>