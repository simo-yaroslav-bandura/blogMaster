<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $website_title = "Register page";
    require "blocks/head.php"; ?>
</head>
<body>
<?php require 'blocks/header.php'; ?>

<div class="container">
    <div class="row g-4">
        <main class="col-12 col-md-8 col-lg-9">
            <h1>Регестрация</h1>
            <form>
                <label for="username">Your name</label>
                <input type="text" name="username" id="username">

                <label for="email">Email</label>
                <input type="email" name="email" id="email">

                <label for="login">Login</label>
                <input type="text" name="login" id="login">

                <label for="password">Password</label>
                <input type="password" name="password" id="password">

                <div class="error-message" id="error-block"></div>
                <button type="button" id="reg_user">Registration</button>
            </form>
        </main>
        <?php require 'blocks/aside.php'; ?>
    </div>
</div>
<?php require 'blocks/footer.php'; ?>
<script>
    $('#reg_user').click(function () {
        let username = $('#username').val();
        let email = $('#email').val();
        let login = $('#login').val();
        let password = $('#password').val();

        $.ajax({
            url: 'ajax/reg.php',
            type: 'POST',
            cache: false,
            data: {
                'username': username,
                'email': email,
                'login': login,
                'password': password
            },
            dataType: 'html',
            success: function (data) {
                if (data === 'done') {
                    $('#reg_user').text("Already done");
                    $('#error-block').hide();

                } else {
                    $('#error-block').show();
                    $('#error-block').text(data);
                }
            }
        })
    })
</script>
</body>
</html>

