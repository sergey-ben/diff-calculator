<?php

namespace DiffCalculator\Contract;


interface DiffResult
{
    public function dispatch(DiffCallbacks $callbacks);
}