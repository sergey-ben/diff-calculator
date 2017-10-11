<?php

namespace DiffCalculator\Contract;


interface DiffDataProvider
{
    public function getOldSize(): int;

    public function getNewSize(): int;

    public function getOldItemKey(int $index);

    public function getNewItemKey(int $index);

    public function getOldItem(int $index);

    public function getNewItem(int $index);

    public function getOldItemWithKey($key);

    public function getNewItemWithKey($key);

    public function hasOldItem(int $index): bool;

    public function hasNewItem(int $index): bool;

    public function hasOldItemWithKey($key): bool;

    public function hasNewItemWithKey($key): bool;

    public function identical($itemA, $itemB): bool;
}