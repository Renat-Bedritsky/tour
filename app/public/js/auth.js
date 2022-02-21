// Создание формы для авторизации

let div_auth = document.getElementById("auth");
let br = document.createElement("br");

let form = document.createElement("form");
form.setAttribute("method", "POST");
div_auth.appendChild(form);

let div_login = document.createElement("div");
div_login.setAttribute("id", "login_message");
form.appendChild(div_login);
div_login.innerHTML = "Логин";

let input_login = document.createElement("input");
input_login.setAttribute("type", "text");
input_login.setAttribute("id", "auth_login");
input_login.setAttribute("value", "");
input_login.setAttribute("required", "");
form.appendChild(input_login);

form.appendChild(br);

let div_password = document.createElement("div");
div_password.setAttribute("id", "password_message");
form.appendChild(div_password);
div_password.innerHTML = "Пароль";

let input_password = document.createElement("input");
input_password.setAttribute("type", "password");
input_password.setAttribute("id", "auth_password");
input_password.setAttribute("value", "");
input_password.setAttribute("required", "");
form.appendChild(input_password);

form.appendChild(br);

let button_auth = document.createElement("button");
button_auth.setAttribute("id", "auth_enter");
form.appendChild(button_auth);
button_auth.innerHTML = "Войти";

let button_registration = document.createElement("button");
button_registration.setAttribute("id", "registration_enter");
form.appendChild(button_registration);
button_registration.innerHTML = "Регистрация";



// Отслеживание полей

$('form').submit(function () {
    return false;
});

let authEnter = document.querySelector("#auth_enter");
let authLogin = document.querySelector("#auth_login");
let authPassword = document.querySelector("#auth_password");

authEnter.addEventListener("click", () => {
    let data = checkAuthData(authLogin.value, authPassword.value);
    data.then(authDataProcessing);
});

function authDataProcessing(response) {
    if (typeof response.admission !== 'undefined') {
        window.location = "http:\/\/localhost\/";
    }
    else {
        var messageLogin = document.querySelector('#login_message');
        messageLogin.innerHTML = response.result_check_login;
        
        var messagePassword = document.querySelector('#password_message');
        messagePassword.innerHTML = response.result_check_password;
    }
}

let registWay = document.querySelector("#registration_enter");

registWay.addEventListener("click", () => {
    window.location = "http:\/\/localhost\/registration";
});
