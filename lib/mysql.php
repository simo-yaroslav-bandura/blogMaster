<?php

$user="root";
$pass="1234";
$db="web-log";
$host="db";
$port=3306;

$dsn="mysql:host=".$host.";port=".$port.";dbname=".$db;
$pdo=new PDO($dsn, $user, $pass);
