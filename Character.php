<?php
abstract class Character {
    // Static properties
    public static int $totalCharacters = 0;
    public static array $characterTypes = [];
    public static array $existingNames = [];

    protected string $role;
    protected string $name;

    public function __construct(string $name, string $role) {
        $this->name = $name;
        $this->role = $role;

        self::$totalCharacters++;
        self::$characterTypes[] = $role;
        self::$existingNames[] = $name;
    }

    // Private static method: load from session
    private static function loadFromSession(): void {
        if (isset($_SESSION['characterStats']) && is_array($_SESSION['characterStats'])) {
            $stats = $_SESSION['characterStats'];
            self::$totalCharacters = $stats['totalCharacters'] ?? 0;
            self::$characterTypes = $stats['characterTypes'] ?? [];
            self::$existingNames = $stats['existingNames'] ?? [];
        }
    }

    // Private static method: save to session
    private static function saveToSession(): void {
        $_SESSION['characterStats'] = [
            'totalCharacters' => self::$totalCharacters,
            'characterTypes' => self::$characterTypes,
            'existingNames' => self::$existingNames,
        ];
    }

    // Public static getters
    public static function getTotalCharacters(): int {
        return self::$totalCharacters;
    }

    public static function getAllCharacterNames(): array {
        return self::$existingNames;
    }

    public static function getAllCharacterTypes(): array {
        return self::$characterTypes;
    }

    // Count how many times a specific character type appears
    public static function getCharacterTypeCount(string $type): int {
        return count(array_filter(self::$characterTypes, fn($t) => $t === $type));
    }

    // Reset all statistics
    public static function resetAllStatistics(): void {
        self::$totalCharacters = 0;
        self::$characterTypes = [];
        self::$existingNames = [];
        self::saveToSession();
    }

    // Recalculate statistics from CharacterList
    public static function recalculateStatistics(CharacterList $characterList): void {
        self::resetAllStatistics();

        foreach ($characterList->getAllCharacters() as $character) {
            self::$totalCharacters++;
            self::$characterTypes[] = $character->getRole();
            self::$existingNames[] = $character->getName();
        }

        self::saveToSession();
    }

    // Remove a character from stats by name and role
    public static function removeCharacterFromStats(string $name, string $role): void {
        if (self::$totalCharacters > 0) {
            $nameKey = array_search($name, self::$existingNames, true);
            $roleKey = array_search($role, self::$characterTypes, true);

            if ($nameKey !== false && $roleKey !== false) {
                self::$totalCharacters--;

                unset(self::$existingNames[$nameKey]);
                unset(self::$characterTypes[$roleKey]);

                // Re-index arrays
                self::$existingNames = array_values(self::$existingNames);
                self::$characterTypes = array_values(self::$characterTypes);

                self::saveToSession();
            }
        }
    }

    // Initialize session static properties
    public static function initializeSession(): void {
        self::loadFromSession();
    }

    // Save static properties to session
    public static function saveSession(): void {
        self::saveToSession();
    }

    // Getters for role and name - nodig voor recalculate en remove
    public function getRole(): string {
        return $this->role;
    }

    public function getName(): string {
        return $this->name;
    }
}


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

// src/Character.php

class Character
{
    private string $name;
    private string $role;
    private int $health;
    private int $attack;
    private ?int $rage = null;
    private ?int $mana = null;

    public function __construct(string $name, string $role, int $health, int $attack)
    {
        $this->name = $name;
        $this->role = $role;
        $this->health = $health;
        $this->attack = $attack;

        if ($role === 'Warrior') {
            $this->rage = 100;
        } elseif ($role === 'Mage') {
            $this->mana = 100;
        }
    }

    public function getRage(): ?int
    {
        return $this->rage;
    }

    public function setRage(?int $rage): void
    {
        $this->rage = $rage;
    }

    public function getMana(): ?int
    {
        return $this->mana;
    }

    public function setMana(?int $mana): void
    {
        $this->mana = $mana;
    }

    // ... bestaande getters en setters ...
}


<?php
namespace Game;

class Character
{
    private string $name;
    private string $role;
    private int $health;
    protected int $attack;
    protected int $defense;
    private int $range;
    private Inventory $inventory;

    protected int $tempAttack = 0;
    protected int $tempDefense = 0;

    public function setCharacter(string $name, string $role, int $health, int $attack, int $defense, int $range): void
    {
        $this->name = $name;
        $this->role = $role;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->range = $range;
        $this->inventory = new Inventory();
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    public function getAttack(): int
    {
        return $this->attack + $this->tempAttack;
    }

    public function getDefense(): int
    {
        return $this->defense + $this->tempDefense;
    }

    public function resetTempStats(): void
    {
        $this->tempAttack = 0;
        $this->tempDefense = 0;
    }

    // (Optioneel getters voor name, role etc.)
}
{if $character->getRole() == 'Rogue' && $character->getEnergy() !== null}
<p class="card-text"><strong>Energy:</strong> {$character->getEnergy()}</p>
{/if}
namespace Game;

class Character
{
    private string $name;
    private string $role;
    private int $health;
    private int $attack;
    private int $defense;
    private int $range;
    private Inventory $inventory;

    public function __construct(
        string $name,
        string $role,
        int $health,
        int $attack,
        int $defense,
        int $range
    ) {
        $this->name = $name;
        $this->role = $role;
        $this->health = $health;
        $this->attack = $attack;
        $this->defense = $defense;
        $this->range = $range;
        $this->inventory = new Inventory();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setHealth(int $health): void
    {
        $this->health = $health;
    }

    public function getAttack(): int
    {
        return $this->attack;
    }

    public function getDefense(): int
    {
        return $this->defense;
    }

    public function getRange(): int
    {
        return $this->range;
    }

    public function getInventory(): Inventory
    {
        return $this->inventory;
    }
}
abstract class Character {
    protected static int $totalCharacters = 0;
    protected static array $existingNames = [];
    protected static array $characterTypes = [];

    // Private static method om data uit session te laden
    private static function loadFromSession(): void {
        if (isset($_SESSION['characterStats'])) {
            $stats = $_SESSION['characterStats'];
            self::$totalCharacters = $stats['totalCharacters'] ?? 0;
            self::$existingNames = $stats['existingNames'] ?? [];
            self::$characterTypes = $stats['characterTypes'] ?? [];
        }
    }

    // Private static method om data naar session te schrijven
    private static function saveToSession(): void {
        $_SESSION['characterStats'] = [
            'totalCharacters' => self::$totalCharacters,
            'existingNames' => self::$existingNames,
            'characterTypes' => self::$characterTypes,
        ];
    }

    // Public static method om totalCharacters op te halen
    public static function getTotalCharacters(): int {
        return self::$totalCharacters;
    }

    // Public static method om alle namen op te halen
    public static function getAllCharacterNames(): array {
        return self::$existingNames;
    }

    // Public static method om alle types op te halen
    public static function getAllCharacterTypes(): array {
        return self::$characterTypes;
    }

    // Reset alle statistieken
    public static function resetAllStatistics(): void {
        self::$totalCharacters = 0;
        self::$existingNames = [];
        self::$characterTypes = [];
    }

    // Recalculate statistics gebaseerd op een CharacterList
    public static function recalculateStatistics(CharacterList $characterList): void {
        self::resetAllStatistics();

        foreach ($characterList->getCharacters() as $character) {
            self::$totalCharacters++;
            // Voeg role toe als die nog niet bestaat
            if (!in_array($character->getRole(), self::$characterTypes, true)) {
                self::$characterTypes[] = $character->getRole();
            }
            // Voeg name toe als die nog niet bestaat
            if (!in_array($character->getName(), self::$existingNames, true)) {
                self::$existingNames[] = $character->getName();
            }
        }
    }

    // Verwijder character uit statistieken
    public static function removeCharacterFromStats(string $name, string $role): void {
        if (self::$totalCharacters > 0) {
            self::$totalCharacters--;
        }

        $nameKey = array_search($name, self::$existingNames, true);
        $roleKey = array_search($role, self::$characterTypes, true);

        if ($nameKey !== false && $roleKey !== false) {
            unset(self::$existingNames[$nameKey], self::$characterTypes[$roleKey]);
            self::$existingNames = array_values(self::$existingNames);
            self::$characterTypes = array_values(self::$characterTypes);
        }
    }

    // Session management
    public static function initializeSession(): void {
        self::loadFromSession();
    }

    public static function saveSession(): void {
        self::saveToSession();
    }

    // Verder bestaande code van Character class ...
}

