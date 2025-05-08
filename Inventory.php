<?php

namespace Game;


class Inventory
{
    private array $items = [];

    public function addItem(string $item): void
    {
        $this->items[] = $item;
    }

    public function removeItem(string $item): void
    {
        $this->items = array_filter($this->items, fn($i) => $i !== $item);
    }

    public function getItems(): array
    {
        return $this->items;
    }
}

