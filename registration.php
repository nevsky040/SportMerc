
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/css/registration/registration.css">
    <title>Регистрация</title>
</head>
<body> 
    <!-- Форма регистрации -->
   <div class="registration">
    <div class="login__form">
        <form id="registrationForm" class="form" method="POST" action="registration.php"
        onsubmit="return validateRegistration()">
        <h2 class="form__title">Регистрация</h2>
        <div id="errorContainer" class="error"></div>
        <input class="form__input" type="text" id="username" name="username" placeholder="Имя" required>
        <input class="form__input" type="email" id="email" name="email" placeholder="Email" required>
        <input class="form__input" type="tel" id="phone" name="phone" value="+7(___)___-__-__" required>
        <input class="form__input" type="password" id="password" name="password" placeholder="Пароль" required minlength="6">
        <input class="form__input" type="confirm_password" id="confirm_password" name="confirm_password" placeholder="Подтверждение пароля" required minlength="6">
       <button class="form__button" type="submit">Зарегистрироваться</button><br>
       <a href="./authorization.php" class="form__link">Уже зарегистрированы?</a> <br> <br>
       <a href="./index.php" class="form__link">Назад</a>
    </form>
    </div>
        <img src="img/Frame 1 (6).png" alt="logo" class="logo">
    </div>   
</body>
<script src="./src/js/registration.js"></script>
</html>
<?php
session_start();
        include ("server/config.php");  
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {  
            $username = $_POST['username'];  
            $email = $_POST['email'];  
            $phone = $_POST['phone'];  
            $password = $_POST['password'];  
            $confirm_password = $_POST['confirm_password'];  
            $role = 0; // Устанавливаем роль по умолчанию на 0  
          
            // Проверка на совпадение паролей  
            if ($password !== $confirm_password) {  
                echo "Пароли не совпадают!";  
                exit();  
            }  
          
            // Хеширование пароля  
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);  
          
            // Выполнение SQL-запроса  
            $sql = "INSERT INTO clients (username, email, phone, password, role) VALUES ('$username', '$email', '$phone', '$hashed_password', $role)";  
            if ($conn->query($sql) === TRUE) {   
                $_SESSION['id'] = $conn->insert_id;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;

                header("Location: UserAccount.php");   
                exit();   
            } else {   
                echo "Ошибка регистрации: " . $conn->error;   
            }   
        }   
        
        $conn->close();   
        ?>