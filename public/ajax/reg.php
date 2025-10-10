<?php
    $username = trim(filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
    $login = trim(filter_var($_POST["login"], FILTER_SANITIZE_SPECIAL_CHARS));
    $password = trim(filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS));

    $error = "";
    if(strlen($username) < 2)
        $error = "Username must be at least 2 characters long.";
    else if(strlen($email) < 5)
        $error = "Email must be at least 5 characters long.";
    else if(strlen($login) < 3)
        $error = "Login must be at least 3 characters long.";
    else if(strlen($password) < 5)
        $error = "Password must be at least 5 characters long.";


    if($error != ""){
        echo $error;
        exit();
    }

    require_once "../lib/mysql.php";


    $salt = "?YVV.2D-<t3ar";
    $password = md5($salt . $password);

    $sql='INSERT INTO users(name,email,login,password) VALUES(?,?,?,?)';
    $query = $pdo->prepare($sql);
    $query->execute([$username,$email,$login,$password]);

    echo "done";
