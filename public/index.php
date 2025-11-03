<?php
use SimoBanduraYaroslav\Blogmaster\Calculator\Calculator;

require_once '../vendor/autoload.php';
$calculator= new Calculator();
echo $calculator->calculate();