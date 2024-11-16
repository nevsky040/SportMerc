<?php
include("config.php");   

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $hall_name= $_POST['hall_name'];;

    // SQL-запрос для добавления тренера
    $sql = "UPDATE halls SET hall_name = '$hall_name' WHERE id ='$id'"; 

    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin.php");
        exit;
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
} else {  
    // Получение текущих данных тарифа  
    $id = $_GET['id'];  
    $result = $conn->query("SELECT * FROM halls WHERE id=$id");  
    $hall = $result->fetch_assoc();  
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать зал</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Редактировать зал</h1>

<form action="" class = "form_action" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($hall['id']); ?>">

    <label for="hall_name">Название зала:</label><br />
    <input type="text" name="hall_name" class = "input" value="<?= htmlspecialchars($hall['hall_name']); ?>" required><br />

    <input type="submit" class="button" value="Сохранить изменения">
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>

<?php
$conn->close();
?>