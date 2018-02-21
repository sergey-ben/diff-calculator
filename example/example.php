<?php

use DiffCalculator\Calculator;

require_once __DIR__ . '/../vendor/autoload.php';

require_once 'MyEntity.php';
require_once 'MyDataProvider.php';
require_once 'MyCallbacks.php';

$old = [
    new MyEntity(0, 'test'),
    new MyEntity(1, 'first'),
    new MyEntity(2, 'second'),
    new MyEntity(3, 'third'),
    new MyEntity(4, 'fourth')
];

$new = [
    new MyEntity(1, 'first'),
    new MyEntity(null, 'added six'),
    new MyEntity(2, 'second new'),
    new MyEntity(4, 'fourth'),
    new MyEntity(5, 'added five'),
];

$calculator = new Calculator();
$result = $calculator->calculate(new MyDataProvider($old, $new));

$result->dispatch(new MyCallbacks());