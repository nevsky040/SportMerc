<?php
include("config.php");   

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id= $_POST['id'];
    $type_name= $_POST['type_name'];

    // SQL-запрос для добавления тренера
    $sql = "UPDATE workout_types SET type_name = '$type_name' WHERE id = '$id'"; 

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin.php");
        exit;
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
} else {  
    // Получение текущих данных тарифа  
    $id = $_GET['id'];  
    $result = $conn->query("SELECT * FROM workout_types WHERE id=$id");  
    $workout_type = $result->fetch_assoc();  
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать Вид тренировки</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Редактировать Вид тренировки</h1>

<form action=""  class = "form_action" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($workout_type['id']); ?>">

    <label for="type_name">Название:</label><br />
    <input type="text" name="type_name"  class = "input" value="<?= htmlspecialchars($workout_type['type_name']); ?>" required><br />

    <input type="submit" class="button" value="Сохранить изменения">
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>

<?php
$conn->close();
?>