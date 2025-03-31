<?php


require_once 'Character.php';

$player1 = new Character("Held");
$player2 = new Character("Vijand");

$player1->getStatus();
$player2->getStatus();

$player1->attack($player2);
$player2->attack($player1);

$player1->restoreEnergy(20);
$player1->gainExperience(50);

$player1->getStatus();
$player2->getStatus();


