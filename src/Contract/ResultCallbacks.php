<?php

namespace DiffCalculator\Contract;


interface ResultCallbacks
{
    public function onInserted($item);

    public function onDeleted($item);

    public function onChanged($item);
}