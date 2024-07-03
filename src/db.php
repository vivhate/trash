<?php
// Установка параметров подключения к базе данных
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "mydb";

// Создаем соединение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
