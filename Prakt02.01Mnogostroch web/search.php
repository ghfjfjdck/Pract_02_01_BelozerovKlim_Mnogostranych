<?php
// search.php
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

$book_name = $_POST['search'];

$sql = "SELECT * FROM Книги WHERE Наименование LIKE '%$book_name%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результаты поиска книг</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .no-results {
            color: #ff0000;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Результаты поиска книг</h1>

<?php
if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr>
            <th>Номер</th>
            <th>Наименование</th>
            <th>Автор</th>
            <th>Жанр</th>
            <th>Год издания</th>
            <th>Издательство</th>
          </tr>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row["Номер"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["Наименование"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["Автор"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["Жанр"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["Год_издания"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["Издательство"]) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p class="no-results">Книга не найдена.</p>';
}

$conn->close();
?>

</body>
</html>
