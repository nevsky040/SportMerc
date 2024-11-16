<?php
include("config.php");   

session_start();

if (!isset($_SESSION['id'])) {
    die("Доступ запрещен. Пожалуйста, войдите в систему.");
}
$tariff_id = $_POST['tariff_id'];
$trainer_id = $_POST['trainer_id'];
$workout_type_id = $_POST['workout_type_id'];
$subscription_end_date = $_POST['subscription_end_date'];
$training_date = $_POST['training_date'];
$hall_id = $_POST['hall_id'];
$client_id = $_SESSION['id']; // Идентификатор авторизованного пользователя

// Установка даты начала подписки на текущую дату
$subscription_start_date = date('Y-m-d');

// Получение цены выбранного тарифа
$sql_tariff = "SELECT price FROM tariffs WHERE id = '$tariff_id'";
$result_tariff = mysqli_query($conn, $sql_tariff);
$tariff = mysqli_fetch_assoc($result_tariff);

if (!$tariff) {
    die("Тариф не найден.");
}
$tariff_price = $tariff['price'];

// Получение баланса пользователя
$sql_balance = "SELECT balance FROM clients WHERE id = '$client_id'";
$result_balance = mysqli_query($conn, $sql_balance);
$client = mysqli_fetch_assoc($result_balance);

if (!$client) {
    die("Клиент не найден.");
}

$client_balance = $client['balance'];

// Проверка, достаточно ли средств на балансе
if ($client_balance < $tariff_price) {
    echo "<script>alert('Недостаточно средств на балансе для оформления тарифа.'); window.location.href = '../UserAccount.php';</script>";
    exit;
}
// Оформление тарифа, обновление баланса клиента
$new_balance = $client_balance - $tariff_price;

// Обновление данных о подписке и балансе в таблице clients
$sql_client = "UPDATE clients  SET subscription_start_date='$subscription_start_date',  subscription_end_date='$subscription_end_date', 
tariff_id='$tariff_id', balance='$new_balance' WHERE id='$client_id'";
mysqli_query($conn, $sql_client);


// Вставка данных о тренировке в таблицу trainings
$sql_training = "INSERT INTO trainings (date, trainer_id, client_id, hall_id, workout_type_id) VALUES ('$training_date', '$trainer_id', '$client_id', '$hall_id','$workout_type_id')";
mysqli_query($conn, $sql_training);

// Закрытие соединения с базой данных
mysqli_close($conn);

echo "<script>alert('Тариф успешно оформлен!'); window.location.href = '../UserAccount.php';</script>";
?>