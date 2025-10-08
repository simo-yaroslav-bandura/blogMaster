<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $website_title = "Blog Master";
    require "blocks/head.php"; ?>
</head>
<body>
<?php require 'blocks/header.php'; ?>

<main>
    <?php
    require "lib/mysql.php";

    $sql = 'SELECT * FROM articles ORDER BY date DESC';
    $result = $pdo->query($sql);
    while ($row = $result->fetch(PDO::FETCH_OBJ)) {
        echo
                "<div class='post'>
        <h2>  $row->title  </h2>
        <p>  $row->anons  </p>
        <p class='author'> Author: <span> $row->author </span> </p>
        <a href='/post.php?id=" . $row->id . "'>Read</a>
        </div>";
    }
    ?>

</main>

<?php require 'blocks/aside.php'; ?>
<?php require 'blocks/footer.php'; ?>
</body>
</html>
