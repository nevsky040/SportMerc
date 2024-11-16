<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="src/css/authorization/authorization.css">
    <title>Авторизация</title>
</head>
<body>
    <!-- Форма авторизации -->
<div class="authorization">
<div class="form">
    <form id="authorizationForm" method="POST" onsubmit="return validateAuthorization();">
        <h2 class="form__title">Авторизация</h2>
        <div id="errorContainer" class="error"></div>
        <input class="form__input" type="email" id="email" name="email" placeholder="Email" required>
        <input class="form__input" type="password" id="password" name="password" placeholder="Пароль" required minlength="6"> 
        <div data-theme="dark" style="transform:scale(0.9); transform-origin:0;" class="g-recaptcha" data-sitekey="6Lfj9HAqAAAAAM_vLi6OkuCB_LAgl011jaKpaYf6"></div>
       <button class="form__button" type="submit">Войти в кабинет</button><br>
       <a href="./registration.php" class="form__link">Нет аккаунта?</a> <br> <br>
       <a href="./index.php" class="form__link">Назад</a>
    </form>
    </div>
        <img src="img/Frame 1 (6).png" alt="logo" class="logo">
    </div>
    <script src="./src/js/authorization.js"></script>
</body>
</html>

<?php
include("server/config.php");   

session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $email = $_POST['email']; 
    $password = $_POST['password']; 

    // Выполняем запрос
    $query = "SELECT * FROM clients WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $client = $result->fetch_assoc();

        // Проверяем пароль
        if (password_verify($password, $client['password'])) { 
            $_SESSION['id'] = $client['id']; 
            $_SESSION['role'] = $client['role']; 
            $_SESSION['username'] = $client['username']; 
            $_SESSION['email'] = $client['email'];               

         if ($_SESSION['role'] == 0) {  
                header("Location: UserAccount.php"); // Для обычного пользователя  
            } elseif ($_SESSION['role'] == 1) {  
                header("Location: admin.php"); // Для администратора  
            }  
            exit();  
        } else {  
            echo '<script>alert("Неверный логин или пароль.");</script>';  
        } 
    } 

    // Закрываем соединение 
    $conn->close(); 
} 
?>