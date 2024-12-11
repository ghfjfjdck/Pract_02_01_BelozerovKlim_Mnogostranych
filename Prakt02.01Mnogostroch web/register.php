<?php
// register.php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Praktika"; // Обновленное имя базы данных

// Подключение к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$surname = $_POST['lastname'];
$name = $_POST['firstname'];
$birthdate = $_POST['birthdate'];
$email = $_POST['email'];
$login = $_POST['login'];
$password = $_POST['password'];

// Проверка на наличие логина
$sql_check = "SELECT * FROM Авторизация WHERE Логин = '$login'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "Такой логин занят.";
} else {
    // Добавление в таблицу Авторизация
    $sql_auth = "INSERT INTO Авторизация (Логин, Пароль) VALUES ('$login', '$password')";
    $conn->query($sql_auth);

    // Получение последнего ID из Авторизация
    $last_id = $conn->insert_id;

    // Добавление в таблицу Данные пользователей
    $sql_user = "INSERT INTO `Данные пользователей` (Номер, Фамилия, Имя, Дата_рождения, Почта, Логин, Пароль) VALUES ('$last_id', '$surname', '$name', '$birthdate', '$email', '$login', '$password')";
    $conn->query($sql_user);

    echo "Регистрация успешна!";
}

$conn->close();
?>