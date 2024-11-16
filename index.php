
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
  <script type="module" src="/main.js"></script>
  <link rel="stylesheet" href="./src/css/main/main.css">
  <title>Главная</title>
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
      <a href="#"><img src="img/logo.svg" alt="logo" class="logo"></a>
      <div class="menu-burger" id="menu-burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
      <nav class="header_nav" id="nav">
        <ul class="header_ul">
          <li class="header_item"><a href = "#" class="header_link">Главная</a></li>
          <li class="header_item"><a href = "./About Us.php" class="header_link">О клубе</a></li>
          <li class="header_item"><a href = "./Abonemets.php" class="header_link">Тарифы</a></li>
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
           <li class="menu-mobile-item menu-mobile-burger-element"><a href="./About Us.php" class="menu-mobile-link">О клубе</a></li>
           <li class="menu-mobile-item menu-mobile-burger-element"><a href="./Abonemets.php" class="menu-mobile-link">Тарифы</a></li>
           <li class="menu-mobile-item menu-mobile-burger-element"><a href="./contacts.php  " class="menu-mobile-link">Контакты</a></li>
         </ul>
        </div>
      </nav>
    </div>
    <!-- Слайдер-->
    <div class="slider">
      <div class="slider_content">
      <h1 class = "header_h1">Добро пожаловать в <span class ="header_span">SPORTMERC</span></h1>
      <div class="btn_slide btn_right" id="next">
      <img src="img/image 1.png" alt="img_slide-1" class = "img_slide-1">
    </div>
      <div class="btn_slide btn_left" id="prev">
        <img src="img/image 2.png" alt="img_slide-2" class ="img_slide-2">
      </div>
      <p class="header_text">Мы стремимся сделать фитнес доступным и увлекательным для каждого! Присоединяйтесь к нам, чтобы стать лучшей версией себя.</p>
      <?php if (isset($_SESSION['role'])): ?>
        <?php if ($_SESSION['role'] == 0): ?>
          <a href="./useraccount.php" class="btn_lesson">Записаться на пробное занятие</a>
          <?php elseif ($_SESSION['role'] == 1): ?>
          <a href="./admin.php" class="btn_lesson">Записаться на пробное занятие</a>
          <?php endif; ?>
          <?php else: ?>
            <a href="./authorization.php" class="btn_lesson">Записаться на пробное занятие</a>
         <?php endif; ?>
    </div>
    </div>
</header>
<!-- Раздел с предложением вступить в клуб -->
<section class ="join-us">
  <div class="container">
    <div class="join-us_block">
      <div class="join-us_text">
        <h2 class="join-us_h2">Новый образ жизни</h2>
        <p class="join-us_description">Став частью нашей команды, вы сможете изменить привычный ритм жизни и сделать каждый свой день особенным, 
          а формат наших тренировок позволит вам раскрыть потенциал вашего тела на 100%</p>
          <a href="./Abonemets.php" class="btn_abonements">Узнать тарифы</a>
      </div>
      <div class="join-us_images">
        <img src="img/image 5.png" alt="grandma" class = "granny-img">
        <img src="img/image 3.png" alt="girlsboy" class = "girlsboy-img">
      </div>
    </div>
  </div>
</section>
<!-- Раздел с программами клуба -->
<section class="programs">
  <div class="container">
    <div class="programs_list">
      <div class="programs_value-1">
        <img src="img/image 6.png" alt="fitness-img" class = "fitness-img" width="100" height="100">
        <h1 class="h1-value">Фитнес</h1>
        <p class="description-value">Функциональное упражнения с весами и кардио оборудованием</p>
      </div>
      <div class="programs_value">
        <img src="img/image 7.png" alt="stretching-img" class = "stretching-img" width="100" height="100">
        <h1 class="h1-value">Стретчинг</h1>
        <p class="description-value">Упражнения на растяжку и гибкость всех групп мыщц для людей любого уровня подготовки</p>
    </div>
    <div class="programs_value">
      <img src="img/image 8.png" alt="cross-img" class = "cross-img" width="100" height="100">
      <h1 class="h1-value">Кроссфит</h1>
      <p class="description-value">Комлпекс высокоинтенсивных упражнений с элементами из тяжелой атлетики</p>
    </div>
    <div class="programs_value-2">
      <img src="img/image 9.png" alt="run-img" class = "run-img" width="100" height="100">
      <h1 class="h1-value">Бег</h1>
      <p class="description-value">Беговые тренировки для тех, кто хочет перейти на новый уровень с точки зрения техники</p>
    </div>
    <div class="programs_value-3">
      <img src="img/image 10.png" alt="sykling-img" class = "sykling-img" width="100" height="100">
      <h1 class="h1-value">Сайклинг</h1>
      <p class="description-value">Система высокоинтенсивных упражнений на велотренажерах с использованием весов </p>
    </div>
  </div>
</section>
<!-- Раздел с тренерами клуба -->
<section class="trainers">
  <div class="container">
    <h2 class="trainers_h2">Наши тренеры</h2>
    <div class="trainers_our">
      <div class="trainers_value">
        <img src="img/image (23).png" alt="Anna" class="Anna">
        <div class="name-status">
          <h3 class="name-1">Анна Сидорова</h3>
          <p class="status">Йога, стретчинг</p>
        </div>
        <p class="trainers_description">Профессиональный тренер Хатха йоги, 
          закончившая школу йоги в Индии.</p>
      </div>
      <div class="trainers_value">
        <img src="img/image 11 (1).png" alt="Seva" class="Seva">
        <div class="name-status">
          <h3 class="name-2">Всеволод Морозов</h3>
          <p class="status">Сайклинг</p>
        </div>
        <p class="trainers_description">Участник Шоссейных Гонок в 2023 году,
          занявший 1 место.</p>
      </div>
      <div class="trainers_value">
        <img src="img/image 12.png" alt="Dima" class="Dima">
        <div class="name-status">
          <h3 class="name-3">Дмитрий Кузнецов</h3>
          <p class="status">Кроссфит</p>
        </div>
        <p class="trainers_description">Заслуженный мастер спорта 
          по легкой атлетике.</p>
      </div>
    </div>
  </div>
</section>
<!-- Раздел с контактами клуба -->
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
  <img src="img/BE STRONG (1).svg" alt="slogan" class="contacts_slogan">
</div>
</section>
<!-- Подвал сайта -->
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
<script src="./src/js/slide.js"></script>
<script src="./src/js/burgerMenu.js"></script>
</html>
