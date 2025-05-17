<?php
namespace Game;

class Healer extends Character
{
    private int $originalSpirit;

    public function __construct(string $name, int $health, int $attack, int $defense = 10, int $spirit = 100)
    {
        parent::__construct($name, 'Healer', $health, $attack, $defense);
        $this->spirit = $spirit;
        $this->originalSpirit = $spirit;
        $this->specialAttacks = ['healingPrayer', 'divineShield'];
    }

    public function castDivineShield(): string
    {
        if ($this->spirit < 60) {
            return "Not enough spirit for Divine Shield!";
        }
        $this->modifyTemporaryStats($this->attack * 0.3, $this->defense * 1.5);
        $this->spirit -= 60;
        return "{$this->name} casts Divine Shield!";
    }

    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'healingPrayer':
                return $this->performHealingPrayer();
            case 'divineShield':
                return $this->castDivineShield();
            default:
                return "Invalid special attack: {$attackName}";
        }
    }

    public function resetAttributes(): void
    {
        $this->spirit = $this->originalSpirit;
    }
}
