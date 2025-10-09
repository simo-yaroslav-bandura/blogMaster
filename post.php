<!DOCTYPE html>
<html lang="ru">
<head>
    <?php require_once "lib/mysql.php";
    $sql = "SELECT * FROM articles WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$_GET['id']]);

    $article = $query->fetch(PDO::FETCH_OBJ);
    $website_title = $article->title;
    require "blocks/head.php";
    ?>
</head>
<body>
<?php require 'blocks/header.php'; ?>

<div class="container">
    <div class="row g-4">

        <main class="col-12 col-md-8 col-lg-9">
            <?php
            echo
                    "<div class='post'>
        <h2>" . $article->title . "</h2>
        <p class='anons'>" . $article->anons . "</p>
        <p>" . $article->full_text . "</p>
        <p class='author'> Author: <span> " . $article->author . " </span> </p>
        <p>" . date("d M | H:i", $article->date) . " </p>
        </div>";
            ?>
            <h3>Comments</h3>
            <form>
                <?php if (isset($_COOKIE['login'])): ?>
                    <label for="username">Ваше имя</label><input type="text" name="username" id="username"
                                                                 value="<?= $_COOKIE["login"] ?>">
                    <label for="mess">Message</label>
                    <textarea name="mess" id="mess"></textarea>
                    <div class="error-message" id="error-block"></div>
                    <button type="button" id="mess_send">Add comments</button>
                <?php else: ?>
                    <div class="comment-fail">
                        <h3>Please login or create account, then you can send comment </h3>
                        <button class="form_message"><a href="register.php">Registration</a></button>
                        <button class="form_message"><a href="login.php">Login</a></button>
                    </div>
                <?php endif; ?>
            </form>
            <div class="comments" id="comments">
                <?php
                $sql = "SELECT * FROM comments WHERE article_id = ? ORDER BY date DESC";
                $query = $pdo->prepare($sql);
                $query->execute([$_GET['id']]);

                $comments = $query->fetchAll(PDO::FETCH_OBJ);
                foreach ($comments as $comment) {
                    echo "<div class='comment'>
        <h4>" . $comment->name . "</h4>
        <p class='mess_text'>" . $comment->message . "</p>
        <p class='date'>" . date("d M H:i", $comment->date) . "</p>
        </div>";
                }
                ?>
            </div>
        </main>

        <?php require 'blocks/aside.php'; ?>
    </div>
</div>
<?php require 'blocks/footer.php'; ?>

<script>
    $('#mess_send').click(function () {
        let name = $('#username').val();
        let mess = $('#mess').val();

        $.ajax({
            url: 'ajax/comment_add.php',
            type: 'POST',
            cache: false,
            data: {
                'username': name,
                'message': mess,
                'id': <?= $_GET['id'] ?>
            },
            dataType: 'html',
            success: function (data) {
                if (data === 'done') {
                    $(".comments").prepend(`<div class="comment">
                    <h4>${name}</h4>
                    <p class='mess_text'>${mess}</p>
                    </div>`);
                    $('#mess_send').text("Added");
                    $('#error-block').hide();
                    $('#mess').val("");
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