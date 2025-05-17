<?php
namespace Game;

class Tank extends Character
{
    private int $originalShield;

    public function __construct(string $name, int $health, int $attack, int $defense = 10, int $range = 1, int $shield = 50)
    {
        parent::__construct($name, 'Tank', $health, $attack, $defense, $range);
        $this->shield = $shield;
        $this->originalShield = $shield;
        $this->specialAttacks = ['barrierShield', 'taunt'];
    }

    public function performTaunt(): string
    {
        if ($this->shield < 10) {
            return "Not enough shield durability for Taunt!";
        }
        $this->modifyTemporaryStats($this->attack * 0.4, $this->defense * 1.3);
        $this->shield -= 10;
        return "{$this->name} performs Taunt to provoke the enemy!";
    }

    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'barrierShield':
                return $this->activateBarrierShield();
            case 'taunt':
                return $this->performTaunt();
            default:
                return "Invalid special attack: {$attackName}";
        }
    }

    public function resetAttributes(): void
    {
        $this->shield = $this->originalShield;
    }
}
