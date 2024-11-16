function validateAuthorization() {
    // Сброс ошибок
    const errorContainer = document.getElementById('errorContainer');
    errorContainer.textContent = '';

    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    
    let errors = [];

    // Проверка логина
    if (!/@/.test(email)) {
        errors.push('Введите корректный email.');
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

    // Если есть ошибки, выводим их и предотвращаем отправку формы
    if (errors.length > 0) {
        errorContainer.innerHTML = errors.join('<br>');
        return false; // Предотвращаем отправку формы
    }
}