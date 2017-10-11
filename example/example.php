<?php

use DiffCalculator\DiffCalculator;

require_once __DIR__ . '/../vendor/autoload.php';

require_once 'SomeEntity.php';
require_once 'MyDataProvider.php';
require_once 'MyCallbacks.php';

$old = [
    new SomeEntity(0, 'dfg'),
    new SomeEntity(1, 'first'),
    new SomeEntity(2, 'second'),
    new SomeEntity(3, 'third'),
    new SomeEntity(4, 'fourth')
];

$new = [
    new SomeEntity(1, 'first'),
    new SomeEntity(null, 'added six'),
    new SomeEntity(2, 'second new'),
    new SomeEntity(4, 'fourth'),
    new SomeEntity(null, 'added five'),
];

$calculator = new DiffCalculator();
$result = $calculator->calculate(new MyDataProvider($old, $new));

$result->dispatch(new MyCallbacks());