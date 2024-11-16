<?php
include("config.php");   

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $hall_name= $_POST['hall_name'];;

    // SQL-запрос для добавления тренера
    $sql = "INSERT INTO halls (hall_name) 
            VALUES ('$hall_name')";

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
    <title>Добавить зал</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Добавить зал</h1>

<form action="" class = "form_action" method="POST">
    <label for="hall_name">Название зала:</label><br />
    <input type="text" class = "input" name="hall_name" required><br />

    <input type="submit"  class="button" value="Добавить">
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>

<?php
$conn->close();
?>