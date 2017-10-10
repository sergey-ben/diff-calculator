<?php

namespace Contract;

require_once 'DiffResult.php';

interface DiffCalculator
{

    public function calculate(DiffDataProvider $data) : DiffResult;

}