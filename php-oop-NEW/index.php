<?php

require_once 'vendor/autoload.php';

use Game\Character;
use Game\Battle;

// Character objecten aanmaken
$hero = new Character(name: "Arthas", role: "Paladin", health: 100, attack: 30);
$villain = new Character(name: "Gul'dan", role: "Warlock", health: 90, attack: 25);

// Eerste gevecht
$battle1 = new Battle();
$battle1->changeMaxRounds(5);
$result1 = $battle1->startFight($hero, $villain);
echo $battle1->getBattleLog();
echo "Resultaat: $result1\n";

// Reset health
$hero->setHealth(100);
$villain->setHealth(90);

// Tweede gevecht
$battle2 = new Battle();
$battle2->changeMaxRounds(10);
$result2 = $battle2->startFight($hero, $villain);
echo $battle2->getBattleLog();
echo "Resultaat: $result2\n";
