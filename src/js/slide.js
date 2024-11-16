const slider = document.querySelector('.slider');
const imagesCount = 3; // Количество изображений
let currentIndex = 0; 

function updateBackground() {
    slider.setAttribute('data-background', currentIndex); //Функция для начального изображения
}

document.getElementById('next').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % imagesCount; // Переход к следующему изображению
    updateBackground();
});

document.getElementById('prev').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + imagesCount) % imagesCount; // Переход к предыдущему изображению
    updateBackground();
});

// Устанавливаем начальное изображение
updateBackground();