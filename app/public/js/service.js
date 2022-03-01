function checkAuthData(login, password) {
    return $.ajax({
        method: 'POST',
        dataType: 'json',
        url: `\/auth`,
        data: {
            auth_login: login,
            auth_password: password
        }
    });
}

function checkRegistData(name, email, login, passwordOne, passwordTwo) {
    return $.ajax({
        method: 'POST',
        dataType: 'json',
        url: `\/registration`,
        data: {
            regist_name: name,
            regist_email: email,
            regist_login: login,
            regist_password_one: passwordOne,
            regist_password_two: passwordTwo
        }
    });
}
