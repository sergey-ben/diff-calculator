<?php


class MyCallbacks implements \DiffCalculator\Contract\DiffCallbacks
{

    public function onInserted($item)
    {
        echo sprintf('Inserted item with key %s, name %s', $item->getId(), $item->getName()) . PHP_EOL;
    }

    public function onDeleted($item)
    {
        echo sprintf('Deleted item with key %s, name %s', $item->getId(), $item->getName()) . PHP_EOL;
    }

    public function onChanged($item)
    {
        echo sprintf('Changed item with key %s, name %s', $item->getId(), $item->getName()) . PHP_EOL;
    }
}