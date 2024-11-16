<?php 
include("config.php");    

session_start(); 

// Получение данных для выпадающего списка тарифов
$tariffs = $conn->query("SELECT id, Tariff_name FROM tariffs");

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Получение данных из формы 
    $username = $_POST['username']; 
    $email = $_POST['email']; 
    $password = $_POST['password']; 
    $phone = $_POST['phone']; 
    $role = $_POST['role']; 
    $subscription_start_date = $_POST['subscription_start_date']; 
    $subscription_end_date = $_POST['subscription_end_date']; 
    $tariff_id = $_POST['tariff_id']; 
    $balance = $_POST['balance']; 

    // SQL-запрос для добавления клиента 
    $sql = "INSERT INTO clients (username, email, password, phone, role, subscription_start_date, subscription_end_date, tariff_id, balance)  
            VALUES ('$username', '$email', '$password', '$phone', '$role', '$subscription_start_date', '$subscription_end_date', 
            '$tariff_id', '$balance')"; 

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
    <title>Добавить клиента</title>
    <link rel="stylesheet" href="../src/css/action/action.css">
</head>
<body>

<h1>Добавить клиента</h1>

<form action="" class = "form_action" method="POST">
    <label for="username">Имя клиента:</label><br />
    <input type="text" class = "input" name="username" required><br />

    <label for="email">Email:</label><br />
    <input type="email" class = "input" name="email" required><br />

    <label for="password">Пароль:</label><br />
    <input type="password" class = "input" name="password" required><br />

    <label for="phone">Номер телефона:</label><br />
    <input type="tel" class = "input" name="phone" required><br />

    <label for="role">Роль:</label><br />
    <input type="number" class = "input" name="role" required><br />

    <label for="tariff_id">Тариф:</label><br />
    <select name="tariff_id" class = "input" required>
        <option value="">Выберите тариф</option>
        <?php while ($tariff = $tariffs->fetch_assoc()): ?>
            <option value="<?php echo $tariff['id']; ?>"><?php echo $tariff['Tariff_name']; ?></option>
        <?php endwhile; ?>
    </select><br />

    <label for="subscription_start_date">Дата начала действия тарифа:</label><br />
    <input type="date" class = "input" name="subscription_start_date" required><br />

    <label for="subscription_end_date">Дата завершения действия тарифа:</label><br />
    <input type="date" class = "input" name="subscription_end_date" required><br />

    <label for="balance">Баланс:</label><br />
    <input type="number" class = "input" name="balance" required><br />

    <button type="submit" class="button" >Добавить</button>
</form>

<a href="../admin.php">Назад к админ-панели</a>

</body>
</html>