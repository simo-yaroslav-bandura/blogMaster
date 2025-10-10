<?php
$login = trim(filter_var($_POST["login"], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS));

$error = "";
if (strlen($login) < 3)
    $error = "Login must be at least 3 characters long.";
else if (strlen($password) < 5)
    $error = "Password must be at least 5 characters long.";


if ($error != "") {
    echo $error;
    exit();
}

require_once "../lib/mysql.php";

$salt = "?YVV.2D-<t3ar";
$password = md5($salt . $password);

$sql = 'SELECT id FROM users WHERE `login` = ? AND `password` = ?';
$query = $pdo->prepare($sql);
$query->execute([$login, $password]);

if ($query->rowCount() == 0) {
    echo "No users found";
} else {
    setcookie('login', $login, time() + 3600 * 24 * 30, "/");
    echo "done";
}