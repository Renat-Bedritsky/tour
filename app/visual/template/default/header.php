<?php $user = $_POST['userData']; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_POST['title'] ?></title>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script defer src="/app/public/js/service.js"></script>
    <link rel="shortcut icon" href="/app/public/images/site-images/icon.jpg" type="image/png">
    <link rel="stylesheet" href="/app/public/css/style.css">
    <link rel="stylesheet" href="/app/public/css/media.css">
</head>

<body>

<div class="window">
    <div class="window_wrapper">
        <div class="header">
            <div class="header_wrapper width">
                <div class="welcome">
                    <?= $_POST['greeting']; ?>
                </div>

                <div class="header_nav">
			        <button class="header_nav_toggle"><label for="header_nav_toggle"></label></button>
				    <input type="checkbox" id="header_nav_toggle">
                    <ul>
                        <li><a href="/main">Главная</a></li>
                        <li><a href="/foto">Фото</a></li>
                        <li><a href="/contacts">Контакты</a></li>
                    </ul>
                </div>

                <div class="enter_account">
                    <?php if (isset($user['login']) && $user['access'] == 'allowed') { ?>
                        <li><a href="/logout">Выход</a></li>
                    <?php } else { ?>
                        <li><a href="/auth">Войти</a></li>
                    <?php } ?>
                </div>
            </div>
        </div>
