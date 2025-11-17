<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $website_title = "Blog Master";
    require "blocks/head.php"; ?>
</head>
<body>
<?php require 'blocks/header.php'; ?>

<div class='container text-center'>
    <div class='row g-4'>
        <main class="col-12 col-md-8 col-lg-9">
            <div class='row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4'>
                <?php
                require "lib/mysql.php";

                $sql = 'SELECT * FROM articles ORDER BY date DESC';
                $result = $pdo->query($sql);

                while ($row = $result->fetch(PDO::FETCH_OBJ)) {
                    echo "
                    <div class='col'>
                        <div class='article-card h-100'>
                            <h2>{$row->title}</h2>
                            <p class='anons'>{$row->anons}</p>
                            <p class='author'>Author: <span>{$row->author}</span></p>
                            <a href='/post.php?id={$row->id}'>Read</a>
                        </div>
                    </div>";
                }
                ?>
            </div>
        </main>
        <?php require 'blocks/aside.php'; ?>

    </div>
</div>

<?php require 'blocks/footer.php'; ?>
</body>
</html>

