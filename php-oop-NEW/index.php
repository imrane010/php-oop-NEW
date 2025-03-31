<?php

require_once 'Character.php';

// Object met named arguments, waarbij alleen name, health en attack worden ingesteld
$hero1 = new Character(name: "Hero1", role: "Warrior", health: 120, attack: 20);

// Object met named arguments, waarbij range op de standaardwaarde blijft en defense wordt overschreven
$hero2 = new Character(name: "Hero2", role: "Mage", health: 90, attack: 15, defense: 10);

// Toon de stats voor beide characters
$hero1->displayStats();
$hero2->displayStats();

?>
