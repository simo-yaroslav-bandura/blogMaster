<header class="header">
    <a href="index.php" class="logo">Blog Master</a>
    <nav class="nav">
        <?php if(isset($_COOKIE['login'])):?>
            <a href="add-article.php" class="btn" >Add article</a>
            <a href="login.php" class="btn" >Users profile</a>
        <?php else:?>
            <a href="login.php" class="btn" >Login</a>
            <a href="register.php" class="btn">Registration</a>
        <?php endif;?>
    </nav>
</header>
