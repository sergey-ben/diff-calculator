<?php

namespace DiffCalculator;


class Result implements Contract\Result
{
    private $changed = [];

    private $inserted = [];

    private $deleted = [];

    public function dispatch(Contract\ResultCallbacks $callbacks)
    {
        $this->dispatchInserted([$callbacks, 'onInserted']);
        $this->dispatchDeleted([$callbacks, 'onDeleted']);
        $this->dispatchChanged([$callbacks, 'onChanged']);
    }

    public function dispatchInserted(callable $callback)
    {
        foreach ($this->inserted as $item) {
            $callback($item);
        }
    }

    public function dispatchDeleted(callable $callback)
    {
        foreach ($this->deleted as $item) {
            $callback($item);
        }
    }

    public function dispatchChanged(callable $callback)
    {
        foreach ($this->changed as $item) {
            $callback($item);
        }
    }

    public function addChanged($item) {
        $this->changed[] = $item;
    }

    public function addDeleted($item) {
        $this->deleted[] = $item;
    }

    public function addInserted($item) {
        $this->inserted[] = $item;
    }
}