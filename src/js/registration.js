

function validateRegistration() {
    // Сброс ошибок
    const errorContainer = document.getElementById('errorContainer');
    errorContainer.textContent = '';

    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmPassword = document.getElementById('confirm_password').value.trim();

    let errors = [];

    // Проверка имени
    if (!username) {
        errors.push('Имя не может быть пустым.');
    }

    // Проверка email
    if (!/@/.test(email)) {
        errors.push('Введите корректный email.');
    }

    // Проверка телефона
    if (!phone) {
        errors.push('Заполните номер телефона.');
    }

    // Проверка пароля
    if (password.length < 6) {
        errors.push('В пароле должно быть больше 6 символов.');
    }
    
    if (!/[a-zA-Z]/.test(password)) {
        errors.push('Пароль должен содержать хотя бы одну латинскую букву.');
    }

    if (!/[0-9]/.test(password)) {
        errors.push('Пароль должен содержать хотя бы одну цифру.');
    }

    if (!/[!@#$%^&*]/.test(password)) {
        errors.push('Пароль должен содержать хотя бы один специальный символ.');
    }

    // Проверка совпадения паролей
    if (password !== confirmPassword) {
        errors.push('Пароли не совпадают.');
    }

    // Если есть ошибки, выводим их и предотвращаем отправку формы
    if (errors.length > 0) {
        errorContainer.innerHTML = errors.join('<br>');
        return false; // Предотвращаем отправку формы
    }

    return true; // Если ошибок нет, разрешаем отправку формы
}
//Маска ввода для телефона
let inputPhone=document.getElementById("phone");
    inputPhone.oninput=()=>phoneMask(inputPhone)
    function phoneMask(inputEl) {
        let patStringArr = "+7(___)___-__-__".split(''); //Маска
        let arrPush = [3, 4, 5, 7, 8, 9, 11, 12, 14, 15] //Индексы на которые будут помещены цифры из ввода
        let val = inputEl.value; //Текущее значение поля ввода
        let arr = val.replace(/\D+/g, "").split('').splice(1); //Удаление не цифровых символов
        let n; //Переменные для хранения индексов
        let ni;
        arr.forEach((s, i) => { //Прохождение по каждой цифре введенной пользователем
            n = arrPush[i]; //Получение индекса из arrpush
            patStringArr[n] = s //Заполнение маски цифрами введенными пользователем 
            ni = i  //Сохранение текущего индекса
        });
        arr.length < 10 ? inputEl.style.color = '#D72325' : inputEl.style.color = '#249355'; //Длина меньше 10 - красный и наоборот - зеленый
        inputEl.value = patStringArr.join(''); //Обновление input с использованием заполненной маски
        n ? inputEl.setSelectionRange(n + 1, n + 1) : inputEl.setSelectionRange(17, 17) //Установка курсора в правильное положение 
    }