<?php  
include("config.php");     

session_start();  

// Получение данных для выпадающего списка тарифов 
$tariffs = $conn->query("SELECT id, Tariff_name FROM tariffs"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Получение данных из формы  
    $id = $_POST['id'];  
    $username = $_POST['username'];  
    $email = $_POST['email'];  
    $password = $_POST['password'];  
    $phone = $_POST['phone'];  
    $role = $_POST['role'];  
    $subscription_start_date = $_POST['subscription_start_date'];  
    $subscription_end_date = $_POST['subscription_end_date'];  
    $tariff_id = $_POST['tariff_id'];  
    $balance = $_POST['balance'];  

    // SQL-запрос для обновления данных клиента  
    $sql = "UPDATE clients SET 
                username='$username', 
                email='$email', 
                password='$password', 
                phone='$phone', 
                role='$role', 
                subscription_start_date='$subscription_start_date', 
                subscription_end_date='$subscription_end_date', 
                tariff_id='$tariff_id', 
                balance='$balance' 
            WHERE id=$id";  

    if ($conn->query($sql) === TRUE) {  
        header("Location: ../admin.php");  
        exit;  
    } else {  
        echo "Ошибка: " . $sql . "<br>" . $conn->error;  
    }  
} else {  
    // Получение текущих данных клиента  
    $id = $_GET['id'];  
    $result = $conn->query("SELECT * FROM clients WHERE id=$id");  
    $client = $result->fetch_assoc();  

} 
?>   

<!DOCTYPE html> 
<html lang="ru"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Редактировать клиента</title> 
    <link rel="stylesheet" href="../src/css/action/action.css"> 
</head> 
<body> 

<h1>Редактировать клиента</h1> 

<form action=""  class = "form_action" method="POST"> 
    <input type="hidden" name="id" value="<?= htmlspecialchars($client['id']); ?>"> 

    <label for="username">Имя клиента:</label><br /> 
    <input type="text" name="username" class = "input" value="<?= htmlspecialchars($client['username']); ?>" required><br /> 

    <label for="email">Email:</label><br /> 
    <input type="email" name="email" class = "input" value="<?= htmlspecialchars($client['email']); ?>" required><br /> 

    <label for="password">Пароль:</label><br /> 
    <input type="password" name="password" class = "input" value="<?= htmlspecialchars($client['password']); ?>" required><br /> 

    <label for="phone">Номер телефона:</label><br /> 
    <input type="tel" name="phone" class = "input" value="<?= htmlspecialchars($client['phone']); ?>" required><br /> 

    <label for="role">Роль:</label><br /> 
    <input type="number" name="role" class = "input" value="<?= htmlspecialchars($client['role']); ?>" required><br /> 

    <label for="tariff_id">Тариф:</label><br /> 
    <select name="tariff_id" class = "input" required> 
        <option value="">Выберите тариф</option> 
        <?php while ($tariff = $tariffs->fetch_assoc()): ?> 
            <option value="<?= $tariff['id']; ?>" <?= ($tariff['id'] == $client['tariff_id']) ? 'selected' : ''; ?>> 
                <?= htmlspecialchars($tariff['Tariff_name']); ?> 
            </option> 
        <?php endwhile; ?> 
    </select><br /> 

    <label for="subscription_start_date">Дата начала действия тарифа:</label><br /> 
    <input type="date" name="subscription_start_date" class = "input" value="<?= htmlspecialchars($client['subscription_start_date']); ?>" required><br /> 

    <label for="subscription_end_date">Дата завершения действия тарифа:</label><br /> 
    <input type="date" name="subscription_end_date" class = "input" value="<?= htmlspecialchars($client['subscription_end_date']); ?>" required><br /> 

    <label for="balance">Баланс:</label><br /> 
    <input type="number" name="balance" class = "input" value="<?= htmlspecialchars($client['balance']); ?>" required><br /> 

    <button type="submit" class="button">Сохранить изменения</button> 
</form> 

<a href="../admin.php">Назад к админ-панели</a> 

</body> 
</html>