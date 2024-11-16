<?php
include("server/config.php");   

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
$client_id = $_SESSION['id'];

$username = $_SESSION['username'];

$clients = $conn->query("SELECT * FROM clients");
$halls = $conn->query("SELECT * FROM halls");
$tariffs = $conn->query("SELECT * FROM tariffs");
$trainers = $conn->query("SELECT * FROM trainers");
$trainings = $conn->query("SELECT * FROM trainings");
$workout_types = $conn->query("SELECT * FROM workout_types");
$appeals = $conn->query("SELECT * FROM appeals");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="src/css/admin/admin.css">
    <title>Личный кабинет Администратора</title>
</head>
<!-- Шапка профиля -->
<header class ="header">
        <div class="container">
            <header class="header_title">
                <a href="./index.php"><img src="img/logo.svg" alt="logo" width="127" height="91"></a>
                <p class="header_name">Добро пожаловать, <?php echo htmlspecialchars($username); ?></p>
                <a href="./server/views.php" class="header_btn views">Вывод представлений</a>
                <a href="./server/logout.php" class="header_btn">Выйти из кабинета</a>
            </header>
        </div>
    </header>
    <!-- Выведенные таблицы-->
    <div class="container">
<h2>Клиенты</h2>
<div class="tables">
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Телефон</th>
        <th>Дата начала подписки</th>
        <th>Дата окончания подписки</th>
        <th>Тариф</th>
        <th>Баланс</th>
        <th>Панель редактирования</th>
    </tr>
    <?php while ($client = $clients->fetch_assoc()): ?>
        <tr>
            <td><?php echo $client['id']; ?></td>
            <td><?php echo $client['username']; ?></td>
            <td><?php echo $client['email']; ?></td>
            <td><?php echo $client['phone']; ?></td>
            <td><?php echo $client['subscription_start_date']; ?></td>
            <td><?php echo $client['subscription_end_date']; ?></td>
            <td><?php $tariff_id = $client['tariff_id']; 
            if (!empty($tariff_id)) {
                    $tariff = mysqli_query($conn, "SELECT tariff_name FROM tariffs WHERE id = $tariff_id");
                    $tariff_name = mysqli_fetch_assoc($tariff)['tariff_name'];
                    echo $tariff_name; }
                    else {
                        echo "Нет тарифа"; 
                    }
                ?></td>
            <td><?php echo $client['balance']; ?></td>
            <td>
                <a href="server/edit_client.php?id=<?php echo $client['id']; ?>"class = "actions">Редактировать</a>
                <a href="server/delete_client.php?id=<?php echo $client['id']; ?>"class = "actions">Удалить</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="server/add_client.php" class = "actions add_action">Добавить клиента</a>
 </div>
 <h2>Обращения клиентов</h2>
<div class="tables ">
<table>
    <tr>
        <th>ID</th>
        <th>Имя клиента</th>
        <th>Обращение</th>
    </tr>
    <?php while ($appeal = $appeals->fetch_assoc()): ?>
        <tr>
            <td><?php echo $appeal['id']; ?></td>
            <td><?php echo $appeal['username']; ?></td>
            <td><?php echo $appeal['appeal_text']; ?></td>
        </tr>
    <?php endwhile; ?>
</table>
</div>
<h2>Тренеры</h2>
<div class="tables">
<table>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Специализация</th>
        <th>Информация</th>
        <th>Панель редактирования</th>
    </tr>
    <?php while ($trainer = $trainers->fetch_assoc()): ?>
        <tr>
            <td><?php echo $trainer['id']; ?></td>
            <td><?php echo $trainer['name']; ?></td>
            <td><?php echo $trainer['specialization']; ?></td>
            <td><?php echo $trainer['contact_info']; ?></td>
            <td>
                <a href="server/edit_trainer.php?id=<?php echo $trainer['id']; ?>" class = "actions">Редактировать</a>
                <a href="server/delete_trainer.php?id=<?php echo $trainer['id']; ?>" class = "actions">Удалить</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="server/add_trainer.php" class = "actions add_action">Добавить тренера</a>
</div>
<h2>Тарифы</h2>
<div class="tables">
<table>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Панель редактирования</th>
    </tr>
    <?php while ($tariff = $tariffs->fetch_assoc()): ?>
        <tr>
            <td><?php echo $tariff ['Id']; ?></td>
            <td><?php echo $tariff['Tariff_name']; ?></td>
            <td><?php echo $tariff['Price']; ?></td>
            <td>
                <a href="server/edit_tariff.php?id=<?php echo $tariff['Id']; ?>" class = "actions">Редактировать</a>
                <a href="server/delete_tariff.php?id=<?php echo $tariff['Id']; ?>" class = "actions">Удалить</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="server/add_tariff.php" class = "actions add_action">Добавить Тариф</a>
</div>
<h2>Залы</h2>
<div class="tables">
<table>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Панель редактирования</th>
    </tr>
    <?php while ($hall = $halls->fetch_assoc()): ?>
        <tr>
            <td><?php echo $hall ['id']; ?></td>
            <td><?php echo $hall['hall_name']; ?></td>
            <td>
                <a href="server/edit_hall.php?id=<?php echo $hall['id']; ?>" class = "actions">Редактировать</a>
                <a href="server/delete_hall.php?id=<?php echo $hall['id']; ?>" class = "actions">Удалить</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="server/add_hall.php" class = "actions add_action">Добавить Зал</a>
</div>
<h2>Тренировки</h2>
<div class="tables">
    <table>
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Тренер</th>
            <th>Зал</th>
            <th>Клиент</th>
            <th>Вид тренировки</th>
            <th>Статус</th>
            <th>Панель редактирования</th>
        </tr>
        <?php while ($training = $trainings->fetch_assoc()): ?>
            <tr>
                <td><?php echo $training['id']; ?></td>
                <td><?php echo $training['date']; ?></td>
                <td><?php 
                    $trainer_id = $training['trainer_id'];
                    $trainer = mysqli_query($conn, "SELECT name FROM trainers WHERE id = $trainer_id");
                    $trainer_name = mysqli_fetch_assoc($trainer)['name'];
                    echo $trainer_name;
                ?></td>
                <td><?php
                    $hall_id = $training['hall_id'];
                    $hall = mysqli_query($conn, "SELECT hall_name FROM halls WHERE id = $hall_id");
                    $hall_name = mysqli_fetch_assoc($hall)['hall_name'];
                    echo $hall_name;
                ?></td>
                <td><?php
                    $client_id = $training['client_id'];
                    $client = mysqli_query($conn, "SELECT username FROM clients WHERE id = $client_id");
                    $client_name = mysqli_fetch_assoc($client)['username'];
                    echo $client_name;
                ?></td>
                <td><?php
                    $workout_type_id = $training['workout_type_id'];
                    $workout_type = mysqli_query($conn, "SELECT type_name FROM workout_types WHERE id = $workout_type_id");
                    $workout_type_name = mysqli_fetch_assoc($workout_type)['type_name'];
                    echo $workout_type_name;
                ?></td>
                <td><?php echo $training['status']; ?></td>
                <td>
                    <a href="server/edit_training.php?id=<?php echo $training['id']; ?>" class="actions">Редактировать</a>
                    <a href="server/delete_training.php?id=<?php echo $training['id']; ?>" class="actions">Удалить</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="server/add_training.php" class="actions add_action">Добавить Тренировку</a>
</div>
<h2>Вид тренировки</h2>
<div class="tables">
    <table>
        <tr>
            <th>ID</th>
            <th>Вид тренировки</th>
            <th>Панель редактирования</th>
        </tr>
        <?php while ($workout_type = $workout_types->fetch_assoc()): ?>
            <tr>
                <td><?php echo $workout_type['id']; ?></td>
                <td><?php echo $workout_type['type_name']; ?></td>
                <td>
                    <a href="server/edit_workout_type.php?id=<?php echo $workout_type['id']; ?>" class="actions">Редактировать</a>
                    <a href="server/delete_workout_type.php?id=<?php echo $workout_type['id']; ?>" class="actions">Удалить</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="server/add_workout_type.php" class="actions add_action">Добавить Вид тренировки</a>
</div>
</body>
        </div>
    </div>
<body>