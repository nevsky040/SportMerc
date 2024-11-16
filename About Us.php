
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
<link rel="stylesheet" href="./src/css/about/about.css">
    <title>О клубе</title>
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
          <nav class="header_nav" id="nav">
            <ul class="header_ul">
              <li class="header_item"><a href = "./index.php" class="header_link">Главная</a></li>
              <li class="header_item"><a href = "#" class="header_link">О клубе</a></li>
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
               <li class="menu-mobile-item menu-mobile-burger-element"><a href="./index.php" class="menu-mobile-link">Главная</a></li>
               <li class="menu-mobile-item menu-mobile-burger-element"><a href="./Abonemets.php" class="menu-mobile-link">Тарифы</a></li>
               <li class="menu-mobile-item menu-mobile-burger-element"><a href="./contacts.php" class="menu-mobile-link">Контакты</a></li>
             </ul>
            </div>
          </nav>
        </div>
    </header>
    <!-- Раздел с историй клуба -->
<section class="history">
    <div class="container">
        <h2 class="history_h2">Наша история</h2>
        <div class="history_text">
            <p class="history_text-p"> Добро пожаловать в <span class="history_span">SPORTMERC</span>  — ваш идеальный фитнес-клуб, где здоровье и активный образ жизни становятся частью повседневности! Основанный в 2020 году, <span class="history_span">SPORTMERC</span> быстро завоевал репутацию места, где каждый может найти свою мотивацию и достичь поставленных целей.</p> 
            <p class="history_text-p"> Наш клуб расположен в самом сердце города, в уютном и современном здании, где вас ждут просторные залы для тренировок, новейшее оборудование и разнообразные групповые занятия. Мы гордимся нашей командой профессиональных тренеров, которые с радостью помогут вам разработать индивидуальную программу тренировок, учитывая ваши цели и уровень подготовки.</p> 
            <p class="history_text-p"> В <span class="history_span">SPORTMERC</span> мы верим, что фитнес — это не только физическая активность, но и сообщество. Поэтому мы организуем регулярные мероприятия, мастер-классы и соревнования, чтобы наши члены могли общаться и поддерживать друг друга на пути к здоровью и гармонии.</p> 
            <p class="history_text-p"> Присоединяйтесь к <span class="history_span">SPORTMERC</span> и откройте для себя мир возможностей для улучшения своего здоровья и физической формы. 
            Здесь каждый шаг на пути к вашим целям станет увлекательным путешествием!</p>
        </div>
    </div>
</section>
<!-- Раздел с фотографиями клуба -->
<section class="hall">
    <div class="container">
        <h2 class="hall_h2">Наш зал</h2>
        <div class="hall_album">
            <img src="img/image 16.png" alt="hall1" class="hall_photo" width="510" height="312">
            <img src="img/зал1 1.png" alt="hall2" class="hall_photo" width="515" height="312">
            <img src="img/зал2 1.png" alt="hall3" class="hall_photo" width="511" height="311">
            <img src="img/зал3 1.png" alt="hall4" class="hall_photo" width="515" height="311">
        </div>
    </div>
</section>
<!-- Раздел с сертификатами клуба -->
<section class="awards">
    <div class="container">
        <h2 class="awards_h2">Наши награды</h2>
        <div class="awards_album">
            <img src="img/СЕРТИФИКАТ 1.png" alt="award1" class="awards_photo" width="511" height="375">
            <img src="img/СЕРТИФИКАТ2 1.png" alt="award2" class="awards_photo" width="516" height="375">
            <img src="img/сертфиикат3 1.png" alt="award3" class="awards_photo" width="511" height="352">
            <img src="img/сертификат4 1.png" alt="award4" class="awards_photo" width="515" height="352">
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