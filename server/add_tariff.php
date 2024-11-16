<?php
include("config.php");   

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $tariff_name= $_POST['Tariff_name'];
    $price = $_POST['price'];

    // SQL-запрос для добавления тренера
    $sql = "INSERT INTO tariffs (Tariff_name, price) 
            VALUES ('$tariff_name', '$price')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin.php");
        exit;
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить тариф</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Добавить тариф</h1>

<form action="" class = "form_action" method="POST">
    <label for="tariff_name">Название тарифа:</label><br />
    <input type="text" class = "input" name="Tariff_name" required><br />

    <label for="price">Введите цену</label><br />
    <input type="number" class = "input" name="price" required><br />

    <input type="submit" class="button" value="Добавить">
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>

<?php
$conn->close();
?>