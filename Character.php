<?php

namespace Game;

use Game\Character;

/**
 * Class CharacterList
 * Beheert een lijst van Character-objecten.
 */
class CharacterList
{
    /**
     * @var Character[] $characters
     */
    private array $characters = [];

    /**
     * Voeg een character toe.
     *
     * @param Character $character
     * @return string
     */
    public function addCharacter(Character $character): string
    {
        $this->characters[] = $character;
        return "Character {$character->getName()} added to list";
    }

    /**
     * Haal alle characters op.
     *
     * @return Character[]
     */
    public function getCharacters(): array
    {
        return $this->characters;
    }
}
public function getCharacter(string $name): Character|string
{
    foreach ($this->characters as $character) {
        if ($character->getName() == $name) {
            return $character;
        }
    }
    return "Character not found";
}

public function removeCharacter(Character $character): string
{
    $key = array_search($character, $this->characters, true);
    if ($key !== false) {
        unset($this->characters[$key]);
        return "Character {$character->getName()} removed from list";
    }
    return "Character not found in list";
}
/**
 * @var Character[] $characters
 */
private array $characters;
/**
 * @return string[]
 */
public function getNames(): array {
    // ...
}
/** @var int[] $levels */
$levels = [1, 2, 3];
