<?php
$title = trim(filter_var($_POST["title"], FILTER_SANITIZE_SPECIAL_CHARS));
$anons = trim(filter_var($_POST["anons"], FILTER_SANITIZE_SPECIAL_CHARS));
$full_text = trim(filter_var($_POST["full_text"], FILTER_SANITIZE_SPECIAL_CHARS));

$error = "";
if (strlen($title) < 5)
    $error = "Title is too short or empty";
else if (strlen($anons) < 10)
    $error = "Anons is too short or empty";
else if (strlen($full_text) < 10)
    $error = "Your text is too short or empty";

if ($error != "") {
    echo $error;
    exit();
}

require_once "../lib/mysql.php";

$sql = 'INSERT INTO articles(title,anons,full_text,date,author) VALUES(?,?,?,?,?)';
$query = $pdo->prepare($sql);
$query->execute([$title, $anons, $full_text, time(), $_COOKIE["login"]]);

echo "done";

