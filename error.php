<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $website_title = "Error 404";
    require "blocks/head.php"; ?>
</head>
<body>
<?php
require "blocks/header.php";
?>
<div class="container">
    <div class="row g-4">
        <main class="col-12 col-md-8 col-lg-9">
            <p>Ошибка 404! Вернитесь на главную страницу <a href="/">Главная</a></p>
        </main>
        <?php
        require "blocks/aside.php";
        ?>
    </div>
</div>
<?php
require "blocks/footer.php";
?>
</body>
</html>
