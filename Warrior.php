<?php
namespace Game;

class Warrior extends Character
{
    private int $originalRage;

    public function __construct(string $name, int $health, int $attack, int $defense = 10, int $rage = 100)
    {
        parent::__construct($name, 'Warrior', $health, $attack, $defense);
        $this->rage = $rage;
        $this->originalRage = $rage;
        $this->specialAttacks = ['rageAttack', 'whirlwind'];
    }

    public function performWhirlwind(): string
    {
        if ($this->rage < 35) {
            return "Not enough rage for Whirlwind attack!";
        }
        $this->modifyTemporaryStats($this->attack * 0.6, $this->defense * 0.5);
        $this->rage -= 35;
        return "{$this->name} performs a Whirlwind attack!";
    }

    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'rageAttack':
                return $this->performRageAttack(); // Bestaat al in jouw klasse
            case 'whirlwind':
                return $this->performWhirlwind();
            default:
                return "Invalid special attack: {$attackName}";
        }
    }

    public function resetAttributes(): void
    {
        $this->rage = $this->originalRage;
    }
}
