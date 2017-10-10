<?php

namespace Contract;

require_once 'DiffCallbacks.php';

interface DiffResult
{
    public function dispatch(DiffCallbacks $callbacks);
}