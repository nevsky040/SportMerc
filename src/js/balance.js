// Открытие модального окна
document.getElementById('openModalButton').onclick = function() {
    document.getElementById('modal').style.display = "block";
  };
  
  // Закрытие модального окна
  document.querySelector('.close').onclick = function() {
    document.getElementById('modal').style.display = "none";
  };