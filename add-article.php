<?php
if (!isset($_COOKIE['login'])) {
    header("Location: register.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?php $website_title = "Article page";
    require "blocks/head.php"; ?>
</head>
<body>
<?php require 'blocks/header.php'; ?>

<main class="main">
    <h1>Add article</h1>
    <form>
        <label for="title">Title article</label>
        <input name="title" id="title">

        <label for="anons">Anons article </label>
        <textarea name="anons" id="anons"></textarea>

        <label for="full_text">Main text</label>
        <textarea name="full_text" id="full_text"></textarea>

        <div class="error-message" id="error-block"></div>
        <button type="button" id="add_article">Post</button>
    </form>
</main>

<?php require 'blocks/aside.php'; ?>
<?php require 'blocks/footer.php'; ?>
<script>
    $('#add_article').click(function () {
        let title = $('#title').val();
        let anons = $('#anons').val();
        let full_text = $('#full_text').val();

        $.ajax({
            url: 'ajax/add-article.php',
            type: 'POST',
            cache: false,
            data: {
                'title': title,
                'anons': anons,
                'full_text': full_text
            },
            dataType: 'html',
            success: function (data) {
                if (data === 'done') {
                    $('#add_article').text("Already posted article");
                    $('#error-block').hide();
                    $('#title').val("");
                    $('#anons').val("");
                    $('#full_text').val("");
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

