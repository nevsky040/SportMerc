// Получаем элементы модального окна
var modal = document.getElementById("Mymodal");
var btn = document.getElementById("openModalBtn");
var span = document.getElementsByClassName("close")[0];

  // Открытие модального окна
document.getElementById('openModalBtn').onclick = function() {
    document.getElementById('Mymodal').style.display = "block";
  };

  // Закрытие модального окна
  document.querySelector('.Myclose').onclick = function() {
    document.getElementById('Mymodal').style.display = "none";
  };

