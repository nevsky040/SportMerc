
<?php
    session_start();
    include ("server/config.php");
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./src/css/abonements/abonements.css">
    <title>Тарифы</title>
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
              <li class="header_item"><a href = "#" class="header_link">Тарифы</a></li>
              <li class="header_item"><a href = "./contacts.php" class="header_link">Контакты</a></li>
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
               <li class="menu-mobile-item menu-mobile-burger-element"><a href="./contacts.php" class="menu-mobile-link">Контакты</a></li>
             </ul>
            </div>
          </nav>
        </div>
    </header>
    <!-- Раздел с информацией про тарифы -->
<section class="abonements">
    <div class="container">
    <h1 class="abonements_title">Приобретите абонементную карту</h1>
    <p class="abonements_text">Мы предлагаем гибкую систему 
        тарифов:</p>
        <div class="abonements_blocks">
            <div class="abonements_blocks_value">
                <p class="abonements_blocks_value-p line_1_-1">Стандарт</p>
                <h1 class="abonements_blocks_value-h1 line_1_-2">8000 ₽</h1>
                <p class="abonements_blocks_value-p line_1_-3">Круглосуточный доступ</p>
                <p class="abonements_blocks_value-p line_1_-4">Фитнес бар</p>
                <p class="abonements_blocks_value-p line_1_-5">Бассейн</p>
                <?php if (isset($_SESSION['role'])): ?>
          <?php if ($_SESSION['role'] == 0): ?>
           <a href="./UserAccount.php" class="button btn_month">Оформить</a>
            <?php elseif ($_SESSION['role'] == 1): ?>
            <a href="./admin.php" class="button btn_month">Оформить</a>
          <?php endif; ?>
          <?php else: ?>
         <a href="./authorization.php" class="button btn_month">Оформить</a>
         <?php endif; ?>
            </div>
            <div class="abonements_blocks_value">
                <p class="abonements_blocks_value-p line_1_-1">Премиум</p>
                <h1 class="abonements_blocks_value-h1 line_1_-2">16000 ₽</h1>
                <p class="abonements_blocks_value-p line_1_-3">Круглосуточный доступ</p>
                <p class="abonements_blocks_value-p line_1_-4">Фитнес бар</p>
                <p class="abonements_blocks_value-p line_1_-5">Бассейн</p>
                <p class="abonements_blocks_value-p line_1_-6">SPA центр</p>
                <?php if (isset($_SESSION['role'])): ?>
          <?php if ($_SESSION['role'] == 0): ?>
           <a href="./UserAccount.php" class="button btn_year">Оформить</a>
            <?php elseif ($_SESSION['role'] == 1): ?>
            <a href="./admin.php" class="button btn_year">Оформить</a>
          <?php endif; ?>
          <?php else: ?>
         <a href="./authorization.php" class="button btn_year">Оформить</a>
         <?php endif; ?>
                </div>
            <div class="abonements_blocks_value">
                <h1 class="abonements_blocks_value-h1 line_2_-1">Пробное занятие</h1>
                <p class="abonements_blocks_value-p-semibold line_2_-2">Только для новичков</p>
                <?php if (isset($_SESSION['role'])): ?>
          <?php if ($_SESSION['role'] == 0): ?>
           <a href="./UserAccount.php" class="button btn_lesson">Оформить</a>
            <?php elseif ($_SESSION['role'] == 1): ?>
            <a href="./admin.php" class="button btn_lesson">Оформить</a>
          <?php endif; ?>
          <?php else: ?>
         <a href="./authorization.php" class="button btn_lesson">Оформить</a>
         <?php endif; ?>
            </div>
        </div>
        </div>
    </div>
</section>    
<!-- Раздел с контактами -->
<section class="contacts">
    <div class="container">
        <h1 class="contacts_title-question">Остались вопросы?</h1>
    <div class="contacts_block">
      <div class="contacts_information">
        <h1 class="contacts_title">Контакты</h1>
        <p class="contacts_adress">123022, г. Москва, 
          ул. Земляной Вал, д. 8, Бизнес-центр</p>
          <p class="contacts_email">SportMercSupport@gmail.com</p>
          <p class="contacts_phone">+7 (968) 566 - 46 - 78</p>
      </div>
    </div>
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