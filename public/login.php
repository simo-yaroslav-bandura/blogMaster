<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $website_title = "Login page";
    require "blocks/head.php"; ?>
</head>
<body>
<?php require 'blocks/header.php'; ?>
<div class="container">
    <div class="row g-4">
        <main class="col-12 col-md-8 col-lg-9">
            <?php if (!isset($_COOKIE['login'])): ?>
                <h1>Authorisation</h1>
                <form>
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login">

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">

                    <div class="error-message" id="error-block"></div>
                    <button type="button" id="login_user">Login</button>
                </form>
            <?php else: ?>
                <h2><?php echo $_COOKIE['login'] ?></h2>
                <form>
                    <button type="button" id="exit_user">Logout</button>
                </form>
            <?php endif; ?>
        </main>
        <?php require 'blocks/aside.php'; ?>
    </div>
</div>
<?php require 'blocks/footer.php'; ?>
<script>
    $('#login_user').click(function () {

        let login = $('#login').val();
        let password = $('#password').val();

        $.ajax({
            url: 'ajax/login.php',
            type: 'POST',
            cache: false,
            data: {
                'login': login,
                'password': password
            },
            dataType: 'html',
            success: function (data) {
                if (data === 'done') {
                    $('#login_user').text("Already done");
                    $('#error-block').hide();
                    document.location.reload(true);
                } else {
                    $('#error-block').show();
                    $('#error-block').text(data);
                }
            }
        })
    })

    $('#exit_user').click(function () {
        $.ajax({
            url: 'ajax/exit.php',
            type: 'POST',
            cache: false,
            data: {},
            dataType: 'html',
            success: function () {
                document.location.reload(true);
            }
        })
    })
</script>
</body>
</html>