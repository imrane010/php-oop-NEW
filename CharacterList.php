<?php
class CharacterList {
    private array $characters = [];

    // Bestaande methodes ...

    public function removeCharacter(string $name): bool {
        foreach ($this->characters as $index => $character) {
            if ($character->getName() === $name) {
                // Eerst naam en role ophalen
                $role = $character->getRole();

                // Verwijder uit array
                array_splice($this->characters, $index, 1);

                // Update statistics
                Character::removeCharacterFromStats($name, $role);

                return true;
            }
        }
        return false;
    }

    // Voeg een getter toe voor alle characters (voor recalculate)
    public function getAllCharacters(): array {
        return $this->characters;
    }
}
