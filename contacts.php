<?php
    session_start();
    include ("server/config.php");
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./src/css/contacts/contacts.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
</head>
<body>
  <!-- Модальное окно с выбором формы регистрации и авторизации -->
  <div id="myModal" class="modal">
    <div class="modal__content">
      <a id="closeModalButton" href="#" class="modal__close">×</a>
      <div class="modal__block">
      <a href="./authorization.php" class="modal__link">Войти в кабинет</a>
        <a href="./registration.php" class="modal__link">Регистрация</a>
      </div>
    </div>
  </div>
  <!-- Навигационное меню -->
<header class ="header">
    <div class="header_title">
      <a href="./index.php"><img src="img/logo.svg" alt="logo" class="logo"></a>
      <div class="menu-burger" id="menu-burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
        <nav class="header_nav">
        <ul class="header_ul">
          <li class="header_item"><a href = "./index.php" class="header_link">Главная</a></li>
          <li class="header_item"><a href = "./About Us.php" class="header_link">О клубе</a></li>
          <li class="header_item"><a href = "./Abonemets.php" class="header_link">Тарифы</a></li>
          <li class="header_item"><a href = "#" class="header_link">Контакты</a></li>
          <li class="header_item"><?php if (isset($_SESSION['role'])): ?>
            <?php if ($_SESSION['role'] == 0): ?>
             <a href="./UserAccount.php" class="header_link">Личный кабинет</a>
              <?php elseif ($_SESSION['role'] == 1): ?>
              <a href="./admin.php" class="header_link">Личный кабинет</a>
            <?php endif; ?>
            <?php else: ?>
           <a href="#" class="header_link" id="openModalButton">Личный кабинет</a>
           <?php endif; ?></li>
        </ul>
        </nav>
        <!-- Бургер-Меню для просмотра сайта на телефоне -->
        <nav class="menu-mobile">
          <div class="container">
           <ul class="menu-mobile-top">
             <li class="menu-mobile-item menu-mobile-burger-element"><a href="./index.php" class="menu-mobile-link">Главная</a></li>
             <li class="menu-mobile-item menu-mobile-burger-element"><a href="./About Us.php" class="menu-mobile-link">О клубе</a></li>
             <li class="menu-mobile-item menu-mobile-burger-element"><a href="./Abonemets.php" class="menu-mobile-link">Тарифы</a></li>
           </ul>
          </div>
        </nav>
    </div>
</header> 
<!-- Раздел с контактами -->
<section class="contacts">
    <div class="container">
    <div class="contacts_block">
      <div class="contacts_information">
        <h1 class="contacts_title">Контакты</h1>
        <p class="contacts_adress">123022, г. Москва, 
          ул. Земляной Вал, д. 8, Бизнес-центр</p>
          <p class="contacts_email">SportMercSupport@gmail.com</p>
          <p class="contacts_phone">+7 (968) 566 - 46 - 78</p>
      </div>
      <div class="ad_information">
        <h1 class="ad_title">Реклама</h1>
        <p class="ad_email">SportMercAd@gmail.com</p>
        <p class="ad_phone">+7 (968) 366 - 89 - 33</p>
      </div>
    </div>
    <p class="contacts_time">Время работы: Пн-Вс, 4:00 - 0:00</p>
  </div>
  </section>
  <section class="map">
    <div class="container">
    <img src="img/Group 17.png" alt="map" class="map_company">
</div>
  </section>
  <!-- Подвал -->
  <footer class="footer">
    <div class="container">
    <div class="footer_title">
      <p class="footer_copyright">© 2024 Все права защищены.</p>
      <div class="footer_networks">
        <a href="#"><img src="img/image 15 (1).svg" alt="odnoklassniki" class = "nw"></a>
        <a href="#"><img src="img/image 14 (1).svg" alt="telegram" class = "nw"></a>
        <a href="#"><img src="img/image 13 (1).svg" alt="vk" class = "nw"></a>
      </div>
    </div>
    </div>
</footer>
</body>
<script src="./src/js/main.js"></script>
<script src="./src/js/burgerMenu.js"></script>
</html>