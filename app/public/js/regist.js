// Создание формы для регистрации

let div_regist = document.getElementById("registration");
let br = document.createElement("br");

let form = document.createElement("form");
form.setAttribute("method", "POST");
div_regist.appendChild(form);

let div_name = document.createElement("div");
div_name.setAttribute("id", "name_message");
form.appendChild(div_name);
div_name.innerHTML = "Имя";

let input_name = document.createElement("input");
input_name.setAttribute("type", "text");
input_name.setAttribute("id", "regist_name");
input_name.setAttribute("minlength", "2");
input_name.setAttribute("maxlength", "30");
input_name.setAttribute("value", "");
input_name.setAttribute("required", "");
form.appendChild(input_name);

form.appendChild(br);

let div_email = document.createElement("div");
div_email.setAttribute("id", "email_message");
form.appendChild(div_email);
div_email.innerHTML = "Email";

let input_email = document.createElement("input");
input_email.setAttribute("type", "email");
input_email.setAttribute("id", "regist_email");
input_email.setAttribute("minlength", "6");
input_email.setAttribute("maxlength", "40");
input_email.setAttribute("value", "");
input_email.setAttribute("required", "");
form.appendChild(input_email);

form.appendChild(br);

let div_login = document.createElement("div");
div_login.setAttribute("id", "login_message");
form.appendChild(div_login);
div_login.innerHTML = "Логин";

let input_login = document.createElement("input");
input_login.setAttribute("type", "text");
input_login.setAttribute("id", "regist_login");
input_login.setAttribute("minlength", "6");
input_login.setAttribute("maxlength", "30");
input_login.setAttribute("value", "");
input_login.setAttribute("required", "");
form.appendChild(input_login);

form.appendChild(br);

let div_password_one = document.createElement("div");
div_password_one.setAttribute("id", "password_message_one");
form.appendChild(div_password_one);
div_password_one.innerHTML = "Пароль";

let input_password_one = document.createElement("input");
input_password_one.setAttribute("type", "password");
input_password_one.setAttribute("id", "regist_password_one");
input_password_one.setAttribute("minlength", "6");
input_password_one.setAttribute("maxlength", "30");
input_password_one.setAttribute("value", "");
input_password_one.setAttribute("required", "");
form.appendChild(input_password_one);

form.appendChild(br);

let div_password_two = document.createElement("div");
div_password_two.setAttribute("id", "password_message_two");
form.appendChild(div_password_two);
div_password_two.innerHTML = "Ещё раз";

let input_password_two = document.createElement("input");
input_password_two.setAttribute("type", "password");
input_password_two.setAttribute("id", "regist_password_two");
input_password_two.setAttribute("minlength", "6");
input_password_two.setAttribute("maxlength", "30");
input_password_two.setAttribute("value", "");
input_password_two.setAttribute("required", "");
form.appendChild(input_password_two);

form.appendChild(br);

let button_regist = document.createElement("button");
button_regist.setAttribute("id", "regist_enter");
form.appendChild(button_regist);
button_regist.innerHTML = "Регистрация";



// Отслеживание полей

$('form').submit(function () {
    return false;
});

let registEnter = document.querySelector("#regist_enter");
let registName = document.querySelector("#regist_name");
let registEmail = document.querySelector("#regist_email")
let registLogin = document.querySelector("#regist_login");
let registPasswordOne = document.querySelector("#regist_password_one");
let registPasswordTwo = document.querySelector("#regist_password_two");

registEnter.addEventListener("click", () => {
    let data = checkRegistData(
        registName.value,
        registEmail.value,
        registLogin.value,
        registPasswordOne.value,
        registPasswordTwo.value);
    data.then(registDataProcessing);
});

function registDataProcessing(response) {
    if (typeof response.admission !== 'undefined') {
        window.location = "http://localhost/";
    }
    else {
        var messageName = document.querySelector('#name_message');
        messageName.innerHTML = response.result_check_name;
        
        var messageEmail = document.querySelector('#email_message');
        messageEmail.innerHTML = response.result_check_email;

        var messageLogin = document.querySelector('#login_message');
        messageLogin.innerHTML = response.result_check_login;
        
        var messagePasswordOne = document.querySelector('#password_message_one');
        messagePasswordOne.innerHTML = response.result_check_password_one;
        
        var messagePasswordTwo = document.querySelector('#password_message_two');
        messagePasswordTwo.innerHTML = response.result_check_password_two;
    }
}
