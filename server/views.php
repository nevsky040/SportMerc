<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/views/views.css">
    <title>Регистрация</title>
</head>
<body>
<a href="../admin.php" class="header_btn">Назад</a>
</body>
</html>
<?php
include("config.php"); // Подключение к базе данных

// Массив с именами представлений
$views = ["all_clients", 
"trainings_on_date", 
"trainers_with_contacts",
"clientworkoutlist", 
"trainer_total_trainings",
"active_subscriptions",
"subscriptions_ending_in_month",
"subscriptions_expiring_soon", 
"active_subscriptions_no_trainings",
 "trainings_in_hall_at_time"];

// Проходим по массиву представлений и выводим данные
foreach ($views as $viewName) {
    $query = "SELECT * FROM $viewName";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<h2>Данные из $viewName:</h2>";
        echo "<table border='1' cellspacing='0' cellpadding='5'>";
        echo "<tr>";

        // Заголовки таблицы
        while ($field = $result->fetch_field()) {
            echo "<th>" . htmlspecialchars($field->name) . "</th>";
        }
        echo "</tr>";

        // Вывод строк данных
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>Данные из $viewName отсутствуют.</h2>";
    }
}

$conn->close();
?>
