<?php
include("config.php");   

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $contact_info = $_POST['contact_info'];

    // SQL-запрос для добавления тренера
    $sql = "INSERT INTO trainers (name, specialization, contact_info) 
            VALUES ('$name', '$specialization', '$contact_info')";

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
    <title>Добавить тренера</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Добавить тренера</h1>

<form action="" class = "form_action" method="POST">
    <label for="name">Имя тренера:</label><br />
    <input type="text" class = "input" name="name" required><br />

    <label for="specialization">Специлизация:</label><br />
    <input type="text" class = "input" name="specialization" required><br />

    <label for="contact_info">Специлизация:</label><br />
    <input type="text" class = "input" name="contact_info" required><br />

    <input type="submit" class="button" value="Добавить">
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>

<?php
$conn->close();
?>