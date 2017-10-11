<?php

namespace DiffCalculator;


class DiffCalculator implements Contract\DiffCalculator
{

    public function calculate(Contract\DiffDataProvider $data): Contract\DiffResult
    {
        $result = new DiffResult();

        $oldSize = $data->getOldSize();
        $newSize = $data->getNewSize();

        $iterations = $oldSize;

        if ($oldSize < $newSize) {
            $iterations = $newSize;
        }

        for ($index = 0; $index < $iterations; $index++) {
            if (true === $data->hasOldItem($index)) {
                $key = $data->getOldItemKey($index);

                if (false === $data->hasNewItemWithKey($key)) {
                    $result->addDeleted($data->getOldItem($index));
                }
            }

            if (true === $data->hasNewItem($index)) {
                $key = $data->getNewItemKey($index);

                if (false === $data->hasOldItemWithKey($key)) {
                    $result->addInserted($data->getNewItem($index));
                }
            }

            if (true === $data->hasOldItem($index)) {
                $key = $data->getOldItemKey($index);

                if (true === $data->hasOldItemWithKey($key) && true === $data->hasNewItemWithKey($key)) {
                    $itemA = $data->getOldItemWithKey($key);
                    $itemB = $data->getNewItemWithKey($key);

                    if (false === $data->identical($itemA, $itemB)) {
                        $result->addChanged($itemB);
                    }
                }
            }
        }

        return $result;
    }
}