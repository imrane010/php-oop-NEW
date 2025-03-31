<?php

require_once 'vendor/autoload.php';


use Game\Characters\Character;
use Game\Combat\Battle;

// Maak twee Characters
$hero1 = new Character(name: "Hero1", role: "Warrior", health: 100, attack: 20, defense: 5);
$hero2 = new Character(name: "Hero2", role: "Mage", health: 90, attack: 15, defense: 3);

// Maak een Battle-object aan
$battle = new Battle();

// Start het gevecht en toon het verslag
$battleLog = $battle->startFight($hero1, $hero2);
echo $battleLog;

// Toon de eindstatus van de Characters
$hero1->displayStats();
$hero2->displayStats();

?>
