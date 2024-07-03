<?php
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "mydb";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Закрываем соединение
$conn->close();
?>
