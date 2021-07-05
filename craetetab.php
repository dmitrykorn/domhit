<?php
require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "CREATE TABLE classics (
    idus int NOT NULL PRIMARY KEY , 
    surname varchar (32) NOT NULL , 
    named varchar (32) NOT NULL , 
    patronymic varchar (32) NOT NULL,
    photo varchar (32) NOT NULL)";

if ($conn->query($sql) === TRUE) {
    echo "Таблица priters создана успешно";
 } else {
    echo "Ошибка создания таблицы: " . $conn->error;
 }

 // Закрыть подключение
$conn->close();

?>