<?php
include("config.php");   

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $type_name= $_POST['type_name'];;

    // SQL-запрос для добавления тренера
    $sql = "INSERT INTO workout_types (type_name) 
            VALUES ('$type_name')";

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
    <title>Добавить Вид тренировки</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Добавить Вид тренировки</h1>

<form action="" class = "form_action" method="POST">
    <label for="type_name">Название:</label><br />
    <input type="text" class = "input" name="type_name" required><br />

    <input type="submit" class="button" value="Добавить">
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>

<?php
$conn->close();
?>