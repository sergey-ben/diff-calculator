<?php

namespace DiffCalculator;


class DiffResult implements Contract\DiffResult
{
    private $changed = [];

    private $inserted = [];

    private $deleted = [];

    public function dispatch(Contract\DiffCallbacks $callbacks)
    {
        foreach ($this->changed as $item) {
            $callbacks->onChanged($item);
        }

        foreach ($this->deleted as $item) {
            $callbacks->onDeleted($item);
        }

        foreach ($this->inserted as $item) {
            $callbacks->onInserted($item);
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