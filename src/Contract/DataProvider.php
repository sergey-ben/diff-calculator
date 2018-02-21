<?php

namespace DiffCalculator\Contract;


interface DataProvider
{
    public function getOldSize(): int;

    public function getNewSize(): int;

    public function getOldItem(int $index);

    public function getNewItem(int $index);

    public function getKeyOfItem($item);

    public function identical($itemA, $itemB): bool;
}