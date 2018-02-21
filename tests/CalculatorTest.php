<?php

namespace DiffCalculator\Tests;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use DiffCalculator\Contract\ResultCallbacks;
use DiffCalculator\Calculator;
use DiffCalculator\Tests\Fixtures\ArrayDataProvider;
use DiffCalculator\Tests\Fixtures\Item;

class CalculatorTest extends \PHPUnit\Framework\TestCase
{
    use MockeryPHPUnitIntegration;

    /**
     * @test
     * @dataProvider deleted_items_data_provider
     */
    public function it_should_add_deleted_items_to_result($old, $new, $deleted)
    {
        $data = new ArrayDataProvider($new, $old);
        $calculator = new Calculator();

        $result = $calculator->calculate($data);

        $callbacks = \Mockery::mock(ResultCallbacks::class);
        $callbacks
            ->shouldReceive('onDeleted')
            ->times(count($deleted))
            ->withArgs(function($arg) use ($deleted) {
                return in_array($arg, $deleted);
            });

        $result->dispatch($callbacks);
    }

    /**
     * @test
     * @dataProvider inserted_items_data_provider
     */
    public function it_should_add_inserted_items_to_result($old, $new, $inserted)
    {
        $data = new ArrayDataProvider($new, $old);
        $calculator = new Calculator();

        $result = $calculator->calculate($data);

        $callbacks = \Mockery::mock(ResultCallbacks::class);
        $callbacks
            ->shouldReceive('onInserted')
            ->times(count($inserted))
            ->withArgs(function($arg) use ($inserted) {
                return in_array($arg, $inserted);
            });

        $result->dispatch($callbacks);
    }

    /**
     * @test
     * @dataProvider changed_items_data_provider
     */
    public function it_should_add_changed_items_to_result($old, $new, $changed)
    {
        $data = new ArrayDataProvider($new, $old);
        $calculator = new Calculator();

        $result = $calculator->calculate($data);

        $callbacks = \Mockery::mock(ResultCallbacks::class);
        $callbacks
            ->shouldReceive('onChanged')
            ->times(count($changed))
            ->withArgs(function($arg) use ($changed) {
                return in_array($arg, $changed);
            });

        $result->dispatch($callbacks);
    }

    /**
     * @test
     * @dataProvider inserted_items_data_provider
     * @dataProvider changed_items_data_provider
     */
    public function it_should_not_add_items_to_deleted($old, $new)
    {
        $data = new ArrayDataProvider($new, $old);
        $calculator = new Calculator();

        $result = $calculator->calculate($data);

        $callbacks = \Mockery::mock(ResultCallbacks::class);
        $callbacks
            ->shouldIgnoreMissing()
            ->shouldReceive('onDeleted')
            ->never();

        $result->dispatch($callbacks);
    }

    /**
     * @test
     * @dataProvider inserted_items_data_provider
     * @dataProvider deleted_items_data_provider
     */
    public function it_should_not_add_items_to_changed($old, $new)
    {
        $data = new ArrayDataProvider($new, $old);
        $calculator = new Calculator();

        $result = $calculator->calculate($data);

        $callbacks = \Mockery::mock(ResultCallbacks::class);
        $callbacks
            ->shouldIgnoreMissing()
            ->shouldReceive('onChanged')
            ->never();

        $result->dispatch($callbacks);
    }

    /**
     * @test
     * @dataProvider changed_items_data_provider
     * @dataProvider deleted_items_data_provider
     */
    public function it_should_not_add_items_to_inserted($old, $new)
    {
        $data = new ArrayDataProvider($new, $old);
        $calculator = new Calculator();

        $result = $calculator->calculate($data);

        $callbacks = \Mockery::mock(ResultCallbacks::class);
        $callbacks
            ->shouldIgnoreMissing()
            ->shouldReceive('onInserted')
            ->never();

        $result->dispatch($callbacks);
    }

    public function deleted_items_data_provider()
    {
        $old = $this->get_items();
        $new = $this->get_items();

        $deletedA = [
            $new[rand(0, count($new) - 1)]
        ];

        $newA = array_filter($new, function($item) use ($deletedA) {
            return !in_array($item, $deletedA);
        });

        $deletedB = [
            $new[rand(0, count($new) - 1)], $new[rand(0, count($new) - 1)]
        ];

        $newB = array_filter($new, function($item) use ($deletedB) {
            return !in_array($item, $deletedB);
        });

        $deletedC = [
            $new[rand(0, count($new) - 1)], $new[rand(0, count($new) - 1)], $new[rand(0, count($new) - 1)], $new[rand(0, count($new) - 1)]
        ];

        $newC = array_filter($new, function($item) use ($deletedC) {
            return !in_array($item, $deletedC);
        });

        return [
            [$old, array_values($newA), array_unique($deletedA, SORT_REGULAR)],
            [$old, array_values($newB), array_unique($deletedB, SORT_REGULAR)],
            [$old, array_values($newC), array_unique($deletedC, SORT_REGULAR)]
        ];
    }

    public function inserted_items_data_provider()
    {
        $old = $this->get_items();
        $new = $this->get_items();

        $insertedA = [
            $old[rand(0, count($old) - 1)]
        ];

        $oldA = array_filter($old, function($item) use ($insertedA) {
            return !in_array($item, $insertedA);
        });

        $insertedB = [
            $old[rand(0, count($old) - 1)], $old[rand(0, count($old) - 1)]
        ];

        $oldB = array_filter($old, function($item) use ($insertedB) {
            return !in_array($item, $insertedB);
        });

        $insertedC = [
            $old[rand(0, count($old) - 1)], $old[rand(0, count($old) - 1)], $old[rand(0, count($old) - 1)], $old[rand(0, count($old) - 1)]
        ];

        $oldC = array_filter($old, function($item) use ($insertedC) {
            return !in_array($item, $insertedC);
        });

        return [
            [array_values($oldA), $new, array_unique($insertedA, SORT_REGULAR)],
            [array_values($oldB), $new, array_unique($insertedB, SORT_REGULAR)],
            [array_values($oldC), $new, array_unique($insertedC, SORT_REGULAR)]
        ];
    }

    public function changed_items_data_provider()
    {
        $old = $this->get_items();
        $newA = $this->get_items();
        $newB = $this->get_items();
        $newC = $this->get_items();

        $change = function($item) {
            $item->change();
        };

        $changedA = [
            $newA[rand(0, count($newA) - 1)]
        ];

        $changedB = [
            $newB[rand(0, count($newB) - 1)], $newB[rand(0, count($newB) - 1)]
        ];

        $changedC = [
            $newC[rand(0, count($newC) - 1)], $newC[rand(0, count($newC) - 1)], $newC[rand(0, count($newC) - 1)], $newC[rand(0, count($newC) - 1)]
        ];

        array_map($change, $changedA);
        array_map($change, $changedB);
        array_map($change, $changedC);

        return [
            [$old, $newA, array_unique($changedA, SORT_REGULAR)],
            [$old, $newB, array_unique($changedB, SORT_REGULAR)],
            [$old, $newC, array_unique($changedC, SORT_REGULAR)]
        ];
    }

    private function get_items()
    {
        $item1 = new Item(1, 'first');
        $item2 = new Item(2, 'second');
        $item3 = new Item(3, 'third');
        $item4 = new Item(4, 'fourth');
        $item5 = new Item(5, 'fifth');

        return [
            $item1, $item2, $item3, $item4, $item5
        ];
    }
}