<?php
// Буферезация выода
    ob_start();
    session_start();

    // Выставляем временную зону
    $timezone = date_default_timezone_set("Europe/Moscow");

    // Соединение с БД
    // (Куда, имя пользователя, пароль, имя базы данных)
    $con = mysqli_connect("localhost", "root", "", "levinmusicdb");

    if(mysqli_connect_errno()){
        echo "Failed to connect: " + mysql_connect_errno();
    }

?>