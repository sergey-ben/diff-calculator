<?php

namespace DiffCalculator\Contract;


interface DiffCalculator
{

    public function calculate(DiffDataProvider $data) : DiffResult;

}