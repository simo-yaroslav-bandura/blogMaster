<?php

use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;

require_once '../vendor/autoload.php';
$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals();
$test = $queryParam = $request->getParsedBody();

$result = "";
if ($request->getServerParams()["REQUEST_METHOD"] === "POST") {
    $a = (float)$test["a"];
    $b = (float)$test["b"];
    $operation = $test["operation"];

    $calc = new Calculator();

    $result = $calc->calculate($a, $operation, $b);
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../src/Calculator/Templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/../data/cache',
    'autoescape' => 'html',
    'auto_reload' => true,
]);

echo $twig->render('calculator.twig', [
    'result' => $result,
    'a' => $a,
    'b' => $b,
    'operation' => $operation,
]);
?>