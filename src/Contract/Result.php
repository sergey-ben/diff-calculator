<?php

namespace DiffCalculator\Contract;


interface Result
{

    public function dispatch(ResultCallbacks $callbacks);

    public function dispatchInserted(callable $callback);

    public function dispatchDeleted(callable $callback);

    public function dispatchChanged(callable $callback);

}