<?php

namespace DiffCalculator;


class DataProviderWrapper
{
    /**
     * @var Contract\DataProvider
     */
    private $data;

    /**
     * @var array
     */
    private $old = [];

    /**
     * @var array
     */
    private $new = [];

    public function __construct(Contract\DataProvider $data)
    {
        $this->data = $data;

        $oldSize = $this->data->getOldSize();
        $newSize = $this->data->getNewSize();

        for ($i = 0; $i < $oldSize; $i++) {
            $item = $this->data->getOldItem($i);
            $key = $this->data->getKeyOfItem($item);

            $this->old[$key] = $item;
        }

        for ($i = 0; $i < $newSize; $i++) {
            $item = $this->data->getNewItem($i);
            $key = $this->data->getKeyOfItem($item);

            $this->new[$key] = $item;
        }
    }

    public function getOldSize(): int
    {
        return $this->data->getOldSize();
    }

    public function getNewSize(): int
    {
        return $this->data->getNewSize();
    }

    public function hasOldItem(int $index): bool
    {
        return $this->data->getOldSize() > $index;
    }

    public function hasNewItem(int $index): bool
    {
        return $this->data->getNewSize() > $index;
    }

    public function hasOldItemWithKey($key): bool
    {
        return isset($this->old[$key]);
    }

    public function hasNewItemWithKey($key): bool
    {
        return isset($this->new[$key]);
    }

    public function getOldItem(int $index)
    {
        return $this->data->getOldItem($index);
    }

    public function getNewItem(int $index)
    {
        return $this->data->getNewItem($index);
    }

    public function getOldItemKey(int $index)
    {
        $item = $this->getOldItem($index);

        return $this->getKeyOfItem($item);
    }

    public function getNewItemKey(int $index)
    {
        $item = $this->getNewItem($index);

        return $this->getKeyOfItem($item);
    }

    public function getOldItemWithKey($key)
    {
        return $this->old[$key];
    }

    public function getNewItemWithKey($key)
    {
        return $this->new[$key];
    }

    public function identical($itemA, $itemB): bool
    {
        return $this->data->identical($itemA, $itemB);
    }

    public function getKeyOfItem($item)
    {
        return $this->data->getKeyOfItem($item);
    }
}