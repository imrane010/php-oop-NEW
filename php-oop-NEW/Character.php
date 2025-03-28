<?php

class Character
{
    private $name;
    private $health;
    private $attack;
    private $defence;
    private $energy;
    private $experience;

    public function __construct(string $name, int $health = 100, int $defence = 5, int $energy = 50 )
    {
        $this->name = $name;
        $this->health = $health;
        $this->attack = $attack;
        $this->defence = $defence;
        $this->energy = $energy;
        $this->experience = 0;
    }

    public function attack(Character $opponent): void
    {
        if ($this->energy <= 0) {
        echo "{$this->name} heeft niet genoeg energie om aan te vallen!\n";
        return;
    }
    $damage = max(0, $this->attack - $opponent->defense);
    $opponent->takeDamage($damage);
    $this->energy -= 10;
    echo "{$this->name}";
    }
    public function takeDamage(int $damage): viod
    {
        $this->health -= $damage;
        if ($this->health <= 0) {
            echo "{$this->name} is verslagen!\n";
        }
    }

    public function restoreEnergy(int $amount): void
    {
        $this->energy += $amount;
        echo "{$this->name} herstelt {$amount} energie!\n";
    }

    public function gainExperience(int $xp): void
    {
        $this->experience += $xp;
        echo "{$this->name} krijgt {$xp} XP!\n";
    }

    public function getStatus(): void
    {
        echo "{$this->name}: HP = {$this->health}, Attack = {$this->attack}, Defense = {$this->defense}, Energy = {$this->energy}, XP = {$this->experience}\n";
    }

}
?>