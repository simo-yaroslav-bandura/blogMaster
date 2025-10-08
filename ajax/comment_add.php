<?php
$username = trim(filter_var($_POST["username"], FILTER_SANITIZE_SPECIAL_CHARS));
$message = trim(filter_var($_POST["message"], FILTER_SANITIZE_SPECIAL_CHARS));
$id = trim(filter_var($_POST["id"], FILTER_SANITIZE_SPECIAL_CHARS));

$error = "";
if(strlen($username) < 2)
    $error = "Username must be at least 2 characters long.";
else if(strlen($message) < 5)
    $error = "Message must be at least 5 characters long.";

if($error != ""){
    echo $error;
    exit();
}

require_once "../lib/mysql.php";

$sql='INSERT INTO comments(name,message,article_id,date) VALUES(?,?,?,?)';
$query = $pdo->prepare($sql);
$query->execute([$username,$message,$id,time()]);

echo "done";
