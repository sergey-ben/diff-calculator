<?php

namespace DiffCalculator\Contract;


interface DiffCallbacks
{
    public function onInserted($item);

    public function onDeleted($item);

    public function onChanged($item);
}