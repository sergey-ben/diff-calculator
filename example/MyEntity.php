<?php

class MyEntity
{
    private $id;

    private $name;

    public function __construct(int $id = null, string $name = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function equals(MyEntity $entity): bool
    {
        return
            $this->getId() === $entity->getId() &&
            $this->getName() === $entity->getName();
    }
}