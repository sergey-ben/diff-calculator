<?php

namespace DiffCalculator\Contract;


interface Calculator
{

    public function calculate(DataProvider $data) : Result;

}