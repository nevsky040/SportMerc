<?php 
include("config.php"); 

session_start(); 

// Получение данных для выпадающих списков 
function getOptions($conn, $table, $id_column, $name_column, $selected_id) { 
    $options = ""; 
    $query = "SELECT $id_column, $name_column FROM $table"; 
    $result = $conn->query($query); 

    if ($result && $result->num_rows > 0) { 
        while ($row = $result->fetch_assoc()) { 
            $selected = ($row[$id_column] == $selected_id) ? "selected" : ""; 
            $options .= "<option value='" . $row[$id_column] . "' $selected>" . $row[$name_column] . "</option>"; 
        } 
    } 
    return $options; 
} 

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $id = $_POST['id']; 
    $date = $_POST['date']; 
    $trainer_id = $_POST['trainer_id']; 
    $hall_id = $_POST['hall_id']; 
    $client_id = $_POST['client_id']; 
    $status = $_POST['status']; 
    $workout_type_id = $_POST['workout_type_id']; 

    // SQL-запрос для обновления данных тренировки 
    $sql = "UPDATE trainings SET date='$date', trainer_id='$trainer_id', hall_id='$hall_id',  
            client_id='$client_id', status='$status', workout_type_id='$workout_type_id' WHERE id=$id"; 

    if ($conn->query($sql) === TRUE) { 
        header("Location: ../admin.php"); 
        exit; 
    } else { 
        echo "Ошибка: " . $sql . "<br>" . $conn->error; 
    } 
} else { 
    // Получение текущих данных тренировки 
    $id = $_GET['id']; 
    $result = $conn->query("SELECT * FROM trainings WHERE id=$id"); 
    $training = $result->fetch_assoc(); 


    // Получение опций с учётом текущих данных
    $trainer_options = getOptions($conn, "trainers", "id", "name", $training['trainer_id']); 
    $hall_options = getOptions($conn, "halls", "id", "hall_name", $training['hall_id']); 
    $client_options = getOptions($conn, "clients", "id", "username", $training['client_id']); 
    $workout_type_options = getOptions($conn, "workout_types", "id", "type_name", $training['workout_type_id']); 
} 
?> 

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать тренировку</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Редактировать тренировку</h1>

<form action=""  class = "form_action" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($training['id']); ?>">

    <label for="date">Дата:</label><br />
    <input type="datetime-local" name="date"  class = "input" value="<?= htmlspecialchars($training['date']); ?>" required><br />

    <label for="trainer_id">Тренер:</label><br />
    <select name="trainer_id" class = "input" required>
        <?= $trainer_options; ?>
    </select><br />

    <label for="hall_id">Зал:</label><br />
    <select name="hall_id" class = "input" required>
        <?= $hall_options; ?>
    </select><br />

    <label for="client_id">Клиент:</label><br />
    <select name="client_id" class = "input" required>
        <?= $client_options; ?>
    </select><br />

    <label for="status">Статус:</label><br />
    <input type="text" name="status" class = "input" value="<?= htmlspecialchars($training['status']); ?>" required><br />

    <label for="workout_type_id">Тип тренировки:</label><br />
    <select name="workout_type_id" class = "input" required>
        <?= $workout_type_options; ?>
    </select><br />

    <input type="submit" class="button" value="Сохранить изменения">
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>

<?php 
$conn->close(); 
?>