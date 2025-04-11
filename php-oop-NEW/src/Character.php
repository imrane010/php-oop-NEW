<?php

namespace Game;

use Game\Inventory;


class Character
{
    private string $name;
    private string $role;
    private int $health;
    private int $attack;
    private int $defense;
    private int $range;
    private Inventory $inventory;

    public function __construct(
        string $name,
        string $role,
        int $health,
        int $attack,
        int $defense = 5,
        int $range = 1
    ) {
        $this->name = $name;
        $this->role = $role;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->range = $range;
        $this->inventory = new Inventory();
    }

    public function getName(): string { return $this->name; }
    public function getRole(): string { return $this->role; }
    public function getHealth(): int { return $this->health; }
    public function getAttack(): int { return $this->attack; }
    public function getDefense(): int { return $this->defense; }
    public function getRange(): int { return $this->range; }
    public function getInventory(): Inventory { return $this->inventory; }

    public function takeDamage(int $amount): void
    {
        $this->health -= $amount;
        if ($this->health < 0) {
            $this->health = 0;
        }
    }

    public function displayStats(): void
    {
        echo "<pre>";
        echo "Naam: {$this->name}\n";
        echo "Rol: {$this->role}\n";
        echo "Health: {$this->health}\n";
        echo "Attack: {$this->attack}\n";
        echo "Defense: {$this->defense}\n";
        echo "Range: {$this->range}\n";
        echo "</pre>";
    }

    public function getSummary(): string
    {
        return "{$this->name} is een {$this->role} met {$this->health} HP en {$this->attack} aanvalskracht.";
    }
}
