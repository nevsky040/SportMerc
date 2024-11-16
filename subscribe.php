<?php
include("server/config.php");   

session_start();
$client_id = $_SESSION['id'];
// Проверка, есть ли уже активный тариф 
$sql_check = "SELECT * FROM clients WHERE id = $client_id AND subscription_end_date >= CURDATE()";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) > 0) 
    // Если тариф уже оформлен, выводим сообщение
    echo "<script>alert('Вы уже оформили тариф.');
    window.location.href = 'useraccount.php';</script>";
 else 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/subscribe/subscribe.css">
    <title>Оформление тарифа</title>
</head>
<body>
    <!-- Раздел с тарифами -->
    <div class="abonements_blocks">
            <div class="abonements_blocks_value">
                <p class="abonements_blocks_value-p line_1_-1">Стандарт</p>
                <h1 class="abonements_blocks_value-h1 line_1_-2">8000 ₽</h1>
                <p class="abonements_blocks_value-p line_1_-3">Круглосуточный доступ</p>
                <p class="abonements_blocks_value-p line_1_-4">Фитнес бар</p>
                <p class="abonements_blocks_value-p line_1_-5">Бассейн</p>
            </div>
            <div class="abonements_blocks_value">
                <p class="abonements_blocks_value-p line_1_-1">Премиум</p>
                <h1 class="abonements_blocks_value-h1 line_1_-2">16000 ₽</h1>
                <p class="abonements_blocks_value-p line_1_-3">Круглосуточный доступ</p>
                <p class="abonements_blocks_value-p line_1_-4">Фитнес бар</p>
                <p class="abonements_blocks_value-p line_1_-5">Бассейн</p>
                <p class="abonements_blocks_value-p line_1_-6">SPA центр</p>
                </div>
            <div class="abonements_blocks_value">
                <h1 class="abonements_blocks_value-h1 line_2_-1">Пробный тариф</h1>
                <p class="abonements_blocks_value-p-semibold line_2_-2">Только для новичков - 0₽</p>
            </div>
        </div>
        <!-- Форма для оформления тарифа -->
    <div class="container">
    <form class = "subscribeForm" action="server/process_subscription.php" method="POST">
        <h1>Оформление тарифа</h1>
        <label for="tariff">Выберите тариф:</label>
        <select id="tariff" name="tariff_id" required>
        <?php
        $sql = "SELECT id, tariff_name FROM tariffs";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id'] . "'>" . $row['tariff_name'] . "</option>";
            }
        } else {
            echo "<option value=''>Нет доступных тарифов</option>";
        }

        ?>
    </select>

    <label for="trainer">Выберите тренера:</label>
    <select id="trainer" name="trainer_id" required>
    <?php
     // Запрос на получение тренеров
     $sql = "SELECT id, name, specialization FROM trainers";
     $result = mysqli_query($conn, $sql);

     if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
             echo "<option value='" . $row['id'] . "'>" . $row['name'] . " ".  $row['specialization'] . "</option>";
         }
     } else {
         echo "<option value=''>Нет доступных тренеров</option>";
     }

     ?>
 </select>
 <label for="trainer">Выберите зал:</label>
    <select id="hall" name="hall_id" required>
    <?php
     // Запрос на получение тренеров
     $sql = "SELECT id, hall_name FROM halls";
     $result = mysqli_query($conn, $sql);

     if (mysqli_num_rows($result) > 0) {
         while ($row = mysqli_fetch_assoc($result)) {
             echo "<option value='" . $row['id'] . "'>" . $row['hall_name'] .   "</option>";
         }
     } else {
         echo "<option value=''>Нет доступных тренеров</option>";
     }

     ?>
 </select>

 <label for="workout_type">Выберите тип тренировки:</label>
 <select id="workout_type" name="workout_type_id" required>
 <?php
 $sql = "SELECT id, type_name FROM workout_types";
 $result = mysqli_query($conn, $sql);

 if (mysqli_num_rows($result) > 0) {
     while ($row = mysqli_fetch_assoc($result)) {
         echo "<option value='" . $row['id'] . "'>" . $row['type_name'] . "</option>";
     }
 } else {
     echo "<option value=''>Нет доступных типов тренировок</option>";
 }



 mysqli_close($conn);
 ?>
</select>

<label for="subscription_end_date">Дата окончания тарифа:</label>
<input type="date" id="subscription_end_date" name="subscription_end_date" required>

<label for="training_date">Дата тренировки:</label>
<input type="datetime-local" id="training_date" name="training_date" required>

<button type="submit">Оформить</button>
</form>
</div>
</body>
</html>
