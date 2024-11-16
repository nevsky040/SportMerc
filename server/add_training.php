<?php
include("config.php");

session_start();

// Получение данных для выпадающих списков
function getOptions($conn, $table, $id_column, $name_column) {
    $options = "";
    $query = "SELECT $id_column, $name_column FROM $table";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row[$id_column] . "'>" . $row[$name_column] . "</option>";
        }
    }
    return $options;
}

// Опции для выпадающих списков
$trainer_options = getOptions($conn, "trainers", "id", "name");
$hall_options = getOptions($conn, "halls", "id", "hall_name");
$client_options = getOptions($conn, "clients", "id", "username");
$workout_type_options = getOptions($conn, "workout_types", "id", "type_name");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $date = $_POST['date'];
    $trainer_id = $_POST['trainer_id'];
    $hall_id = $_POST['hall_id'];
    $client_id = $_POST['client_id'];
    $status = $_POST['status'];
    $workout_type_id = $_POST['workout_type_id'];

    // SQL-запрос для добавления тренировки
    $sql = "INSERT INTO trainings (date, trainer_id, hall_id, client_id, status, workout_type_id)
            VALUES ('$date', '$trainer_id', '$hall_id', '$client_id', '$status', '$workout_type_id')";

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
    <title>Добавить тренировку</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Добавить тренировку</h1>

<form action="" class = "form_action" method="POST">
    <label for="date">Дата:</label><br />
    <input type="datetime-local" class = "input" name="date" required><br />

    <label for="trainer_id">Выберите Тренера:</label><br />
    <select name="trainer_id" class = "input" required>
        <option value=""></option>
        <?= $trainer_options; ?>
    </select><br />

    <label for="hall_id">Выберите Зал:</label><br />
    <select name="hall_id" class = "input" required>
        <option value=""></option>
        <?= $hall_options; ?>
    </select><br />

    <label for="client_id">Выберите Клиента:</label><br />
    <select name="client_id" class = "input" required>
        <option value=""></option>
        <?= $client_options; ?>
    </select><br />

    <label for="status">Статус:</label><br />
    <input type="text" name="status" required><br />

    <label for="workout_type_id">Выберите Тип тренировки:</label><br />
    <select name="workout_type_id" class = "input" required>
        <option value=""></option>
        <?= $workout_type_options; ?>
    </select><br />

    <input type="submit" class="button" value="Добавить">
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>

<?php
$conn->close();
?>