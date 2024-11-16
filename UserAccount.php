<?php
include("server/config.php");   

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
$client_id = $_SESSION['id'];

$username = $_SESSION['username'];
$sql = "SELECT  
    c.username AS username,  
    c.subscription_end_date,  
    c.balance,  
    t.tariff_name,  
    tr.name AS trainer_name,  
    (
        SELECT wt.type_name
        FROM trainings tr
        JOIN workout_types wt ON tr.workout_type_id = wt.id
        WHERE tr.client_id = c.id
        ORDER BY tr.date DESC
        LIMIT 1
    ) AS workout_type,
    (
        SELECT date
        FROM trainings
        WHERE client_id = c.id
        ORDER BY date DESC
        LIMIT 1
    ) AS training_date
FROM clients c
LEFT JOIN tariffs t ON c.tariff_id = t.id
LEFT JOIN trainers tr ON tr.id = (
    SELECT trainer_id
    FROM trainings
    WHERE client_id = c.id
    ORDER BY date DESC
    LIMIT 1
)
WHERE c.id = $client_id;";


// Выполнение запроса
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) 
    $row = mysqli_fetch_assoc($result);

if (isset($_POST['submitBalance'])) {
    $balance = $_POST['balance'];

    // Проверка, что баланс является положительным числом
    if (is_numeric($balance) && $balance > 0) {
        // Обновление баланса в базе данных (в таблице clients)
        $sql = "UPDATE clients SET balance = balance + $balance WHERE id = $client_id"; 

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Баланс успешно оформлен.');
    window.location.href = 'useraccount.php';</script>";
        } else {
            echo "<script>alert('Ошибка в пополнении баланса.');
    window.location.href = 'useraccount.php';</script>" . $conn->error;
        }
    } else {
        echo "Пожалуйста, введите корректную сумму.";
    }
}

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Стартуем сессию для получения данных пользователя
    session_start();

    // Получаем данные из POST-запроса
    $appeal_text = $_POST['appeal_text']; 

    // Проверяем, есть ли данные о пользователе в сессии
    if (isset($_SESSION['id']) && isset($_SESSION['username'])) {

        // SQL-запрос для вставки данных в таблицу appeals
        $sql_appeal = "INSERT INTO appeals (client_id, username, appeal_text) VALUES ( '$client_id', '$username', '$appeal_text')";

        if ($conn->query($sql_appeal) === TRUE) {
            echo "<script>alert('Обращение успешно отправлено.'); 
            window.location.href = 'useraccount.php';</script>";
        } else {
            echo "<script>alert('Ошибка в отправке обращения'); 
            window.location.href = 'useraccount.php';</script>" . $conn->error;
        }
    } else {
        echo "<script>alert('Ошибка: данные пользователя не найдены.'); 
        window.location.href = 'login.php';</script>";
    }
}

// Закрытие соединения с базой данных
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="src/css/useraccount/useraccount.css">
    <title>Личный кабинет</title>
</head>
<body>
    <!-- Шапка профиля -->
    <header class ="header">
        <div class="container">
            <header class="header_title">
                <a href="./index.php"><img src="img/logo.svg" alt="logo" width="127" height="91"></a>
                <p class="header_name">Добро пожаловать, <?php echo htmlspecialchars($username); ?></p>
                <p class="header_name">Ваш баланс: <?php echo ($row['balance'] ? $row['balance'] : "Не указан")  ?></p>
                <a href="./server/logout.php" class="header_btn">Выйти из кабинета</a>
            </header>
        </div>
    </header>
    <!-- Раздел с информацией о пользователе, услугами -->
    <section class="info">
    <div class="information">
        <div class="information_line-1">
            <div class="information_item">
                <p class="information_text">Активный тариф: <?php echo ($row['tariff_name'] ? $row['tariff_name'] : "Нет информации")  ?></p>
            </div>
                <div class="information_item">
                    <p class="information_text">Вид тренировки: <?php echo ($row['workout_type'] ? $row['workout_type'] : "Нет информации") ?></p>
                </div>
                <div class="information_item">
                    <p class="information_text">Ваш тренер: <?php echo ($row['trainer_name'] ? $row['trainer_name'] : "Нет информации") ?></p>
            </div>
            <div class="information_item">
                <p class="information_text">Дата тренировки: <?php echo ($row['training_date'] ? $row['training_date'] : "Нет информации") ?></p>
            </div>
            <div class="information_item">
                <p class="information_text">Тариф истекает: <?php echo ($row['subscription_end_date'] ? $row['subscription_end_date'] : "Нет информации") ?></p>
            </div>
        </div>
        <div class="buttons">        
        <a href="#" class="btn_balance" id="openModalButton">Пополнить баланс</a>
        <a href ='subscribe.php' class="button">Оформить тариф</a>
        <a href="#" class="btn_admin " id="openModalBtn">Обратиться к администратору</a>
        </div>
        </div>
        <!-- Модальное окно для пополнения баланса -->
<div id="modal" class="modal" style="display: none;">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>Введите сумму для пополнения баланса</h3>
    <form  class = "balanceForm" id="balanceForm" method="POST">
      <label for="balance">Сумма:</label>
      <input type="number" id="balance" name="balance" required>
      <button class = "button_balance" type="submit" name="submitBalance">Пополнить</button>
    </form>
  </div>
</div>
<!-- Модальное окно для обращения к администраторам -->
<div id="Mymodal" class="Mymodal" style="display: none;">
    <div class="modal-content">
        <span class="Myclose">&times;</span>
        <h3>Оставьте ваше обращение</h3>
        <form action="" method="POST">
            <textarea name="appeal_text" rows="4" cols="50" placeholder="Введите ваше обращение..." required></textarea><br>
            <button type="submit" class="appeal_btn">Отправить</button>
</section>
<script src="./src/js/balance.js"></script>
<script src="./src/js/appeal.js"></script>
</body>
</html>
