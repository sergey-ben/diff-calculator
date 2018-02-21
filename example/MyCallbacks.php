<?php


class MyCallbacks implements \DiffCalculator\Contract\ResultCallbacks
{
    /**
     * @param MyEntity $item
     */
    public function onInserted($item)
    {
        echo sprintf(
            'Inserted item with key %s, name %s%s', $item->getId(), $item->getName(), PHP_EOL
        );
    }

    /**
     * @param MyEntity $item
     */
    public function onDeleted($item)
    {
        echo sprintf(
            'Deleted item with key %s, name %s%s', $item->getId(), $item->getName(), PHP_EOL
        );
    }

    /**
     * @param MyEntity $item
     */
    public function onChanged($item)
    {
        echo sprintf(
            'Changed item with key %s, name %s%s', $item->getId(), $item->getName(), PHP_EOL
        );
    }
}