<?php
namespace Game;

class Mage extends Character
{
    private int $originalMana;

    public function __construct(string $name, int $health, int $attack, int $defense = 10, int $mana = 100)
    {
        parent::__construct($name, 'Mage', $health, $attack, $defense);
        $this->mana = $mana;
        $this->originalMana = $mana;
        $this->specialAttacks = ['fireball', 'frostNova'];
    }

    public function castFrostNova(): string
    {
        if ($this->mana < 45) {
            return "Not enough mana for Frost Nova!";
        }
        $this->modifyTemporaryStats($this->attack * 0.4, $this->defense * 1.2);
        $this->mana -= 45;
        return "{$this->name} casts Frost Nova!";
    }

    public function executeSpecialAttack(string $attackName): string
    {
        switch ($attackName) {
            case 'fireball':
                return $this->castFireball(); // Bestaande methode
            case 'frostNova':
                return $this->castFrostNova();
            default:
                return "Invalid special attack: {$attackName}";
        }
    }

    public function resetAttributes(): void
    {
        $this->mana = $this->originalMana;
    }
}
