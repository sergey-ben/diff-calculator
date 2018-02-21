<?php

namespace DiffCalculator\Tests\Fixtures;


class Item
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    public function __construct(int $id, string $text)
    {
        $this->id = $id;
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    public function change()
    {
        $this->text = sprintf('%s changed', $this->getText());
    }

    public function equals(Item $item): bool
    {
        return
            $this->getId() === $item->getId() &&
            $this->getText() === $item->getText();
    }
}