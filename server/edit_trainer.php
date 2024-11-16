<?php
include("config.php");   

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $id = $_POST['id'];
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $contact_info = $_POST['contact_info'];

    $sql = "UPDATE trainers SET name='$name', specialization='$specialization', contact_info='$contact_info' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../admin.php");
        exit;
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }

} else {
    // Получение текущих данных тренера
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM trainers WHERE id=$id");
    $trainer = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать тренера</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Редактировать тренера</h1>

<form action="" class = "form_action" method="POST">
    <input type="hidden" name="id" value="<?php echo $trainer['id']; ?>">
    
    <label for="name">Имя:</label><br />
    <input type="text" name="name" class = "input" value="<?php echo $trainer['name']; ?>" required><br />

    <label for="specialization">Специализация:</label><br />
    <input type="text" name="specialization" class = "input" value="<?php echo $trainer['specialization']; ?>" required><br />

    <label for="contact_info">Контактная Информация:</label><br />
    <input type="text" name="contact_info" class = "input" value="<?php echo $trainer['contact_info']; ?>" required><br />

    <input type="submit" class="button" value="Сохранить изменения">
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>
<?php
$conn->close();
?>