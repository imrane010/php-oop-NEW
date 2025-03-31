<?php

class Character
{
    public function __construct(
        public string $name,
        public string $role,
        public int $health = 100,
        public int $attack = 10,
        public int $defense = 5, // Standaardwaarde 5
        public int $range = 1    // Standaardwaarde 1
    ) {}

    public function displayStats(): void
    {
        echo "<h2>Character Stats</h2>";
        echo "<p><strong>Name:</strong> {$this->name}</p>";
        echo "<p><strong>Role:</strong> {$this->role}</p>";
        echo "<p><strong>Health:</strong> {$this->health}</p>";
        echo "<p><strong>Attack:</strong> {$this->attack}</p>";
        echo "<p><strong>Defense:</strong> {$this->defense}</p>";
        echo "<p><strong>Range:</strong> {$this->range}</p>";
        echo "<hr>";
    }
}

?>

