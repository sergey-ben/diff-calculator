<?php


class MyDataProvider implements \DiffCalculator\Contract\DataProvider
{
    /**
     * @var MyEntity[]
     */
    private $old;

    /**
     * @var MyEntity[]
     */
    private $new;

    public function __construct(array $old, array $new)
    {
        $this->old = $old;
        $this->new = $new;
    }

    /**
     * @return int
     */
    public function getOldSize(): int
    {
        return count($this->old);
    }

    /**
     * @return int
     */
    public function getNewSize(): int
    {
        return count($this->new);
    }

    /**
     * @param int $index
     * @return MyEntity
     */
    public function getOldItem(int $index)
    {
        return $this->old[$index];
    }

    /**
     * @param int $index
     * @return MyEntity
     */
    public function getNewItem(int $index)
    {
        return $this->new[$index];
    }

    /**
     * @param MyEntity $itemA
     * @param MyEntity $itemB
     * @return bool
     */
    public function identical($itemA, $itemB): bool
    {
        return $itemA->equals($itemB);
    }

    /**
     * @param MyEntity $item
     * @return int
     */
    public function getKeyOfItem($item)
    {
        return $item->getId();
    }
}