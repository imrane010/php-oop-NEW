<?php
namespace Game;

class Rogue extends Character
{
    private int $originalEnergy;

    public function __construct(string $name, int $health, int $attack, int $defense = 10, int $energy = 100)
    {
        parent::__construct($name, 'Rogue', $health, $attack, $defense);
        $this->energy = $energy;
        $this->originalEnergy = $energy;
        $this->specialAttacks = ['sneakAttack', 'poisonDagger'];
    }

    public function usePoisonDagger(): string
    {
        if ($this->energy < 30) {
            return "Not enough energy for Poison Dagger!";
        }
        $this->modifyTemporaryStats($this->attack * 0.8, $this->defense * 0.7);
        $this->energy -= 30;
        return "{$this->name} uses Poison Dagger!";
    }

    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'sneakAttack':
                return $this->performSneakAttack();
            case 'poisonDagger':
                return $this->usePoisonDagger();
            default:
                return "Invalid special attack: {$attackName}";
        }
    }

    public function resetAttributes(): void
    {
        $this->energy = $this->originalEnergy;
    }
}
