<?php

namespace DiffCalculator\Tests\Fixtures;


use DiffCalculator\Contract\DataProvider;

class ArrayDataProvider implements DataProvider
{
    /**
     * @var Item[]
     */
    private $new;

    /**
     * @var Item[]
     */
    private $old;

    public function __construct(array $new, array $old)
    {
        $this->new = $new;
        $this->old = $old;
    }

    public function getOldSize(): int
    {
        return count($this->old);
    }

    public function getNewSize(): int
    {
        return count($this->new);
    }

    public function getOldItem(int $index)
    {
        return $this->old[$index];
    }

    public function getNewItem(int $index)
    {
        return $this->new[$index];
    }

    public function identical($itemA, $itemB): bool
    {
        return $itemA->equals($itemB);
    }

    public function getKeyOfItem($item)
    {
        return $item->getId();
    }
}