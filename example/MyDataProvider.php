<?php

require_once '../Contract/DiffDataProvider.php';

class MyDataProvider implements \Contract\DiffDataProvider
{
    /**
     * @var array
     */
    private $old;

    /**
     * @var array
     */
    private $new;

    public function __construct(array $old, array $new)
    {
        $this->old = $old;
        $this->new = $new;
    }

    public function getOldSize(): int
    {
        return count($this->old);
    }

    public function getNewSize(): int
    {
        return count($this->new);
    }

    public function getOldItemKey(int $index)
    {
        return $this->old[$index]->getId();
    }

    public function getNewItemKey(int $index)
    {
        return $this->new[$index]->getId();
    }

    public function getOldItem(int $index)
    {
        return $this->old[$index];
    }

    public function getNewItem(int $index)
    {
        return $this->new[$index];
    }

    public function getOldItemWithKey($key)
    {
        return $this->findByKey($this->old, $key);
    }

    public function getNewItemWithKey($key)
    {
        return $this->findByKey($this->new, $key);
    }

    public function hasOldItem(int $index): bool
    {
        return isset($this->old[$index]);
    }

    public function hasNewItem(int $index): bool
    {
        return isset($this->new[$index]);
    }

    public function hasOldItemWithKey($key): bool
    {
        return null !== $this->getOldItemWithKey($key);
    }

    public function hasNewItemWithKey($key): bool
    {
        return null !== $this->getNewItemWithKey($key);
    }

    public function identical($itemA, $itemB): bool
    {
        return
            $itemA->getId() === $itemB->getId() &&
            $itemA->getName() === $itemB->getName();
    }

    private function findByKey(array $data, $key) {
        $result = array_filter($data, function($item) use ($key) {
            return $item->getId() === $key;
        });

        return empty($result)
            ? null
            : reset($result);
    }
}