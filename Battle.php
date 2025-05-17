<?php

namespace Game;

use Game\Character;

/**
 * Deze class voert een gevecht uit tussen twee characters.
 */
class Battle
{
    private string $battleLog = '';
    private int $maxRounds = 10;
    private int $roundNumber = 1;

    public function getBattleLog(): string
    {
        return $this->battleLog;
    }

    public function getMaxRounds(): int
    {
        return $this->maxRounds;
    }

    public function getRoundNumber(): int
    {
        return $this->roundNumber;
    }

    public function changeMaxRounds(int $rounds): void
    {
        $this->maxRounds = $rounds;
    }

    public function startFight(Character $fighter1, Character $fighter2): string
    {
        while (
            $fighter1->getHealth() > 0 &&
            $fighter2->getHealth() > 0 &&
            $this->roundNumber <= $this->maxRounds
        ) {
            // beurt fighter1 → fighter2
            $damage = $this->calculateDamage($fighter1, $fighter2);
            $fighter2->takeDamage($damage);
            $this->logAttack($fighter1, $fighter2, $damage);

            if ($fighter2->getHealth() <= 0) break;

            // beurt fighter2 → fighter1
            $damage = $this->calculateDamage($fighter2, $fighter1);
            $fighter1->takeDamage($damage);
            $this->logAttack($fighter2, $fighter1, $damage);

            $this->roundNumber++;
        }

        if ($fighter1->getHealth() <= 0) {
            $this->battleLog .= "{$fighter2->getName()} heeft gewonnen!\n";
            return "{$fighter2->getName()} wint!";
        } elseif ($fighter2->getHealth() <= 0) {
            $this->battleLog .= "{$fighter1->getName()} heeft gewonnen!\n";
            return "{$fighter1->getName()} wint!";
        } else {
            $this->battleLog .= "Het maximale aantal rondes is bereikt.\n";
            return "Geen winnaar na {$this->maxRounds} rondes.";
        }
    }

    /**
     * Berekent de schade van een aanval.
     *
     * @param Character $attacker
     * @param Character $defender
     * @return int
     */
    private function calculateDamage(Character $attacker, Character $defender): int
    {
        $randomFactor = rand(70, 100) / 100; // 70% tot 100%
        $rawDamage = $attacker->getAttack() * $randomFactor;
        $damage = max(0, round($rawDamage - $defender->getDefense()));

        return (int)$damage;
    }

    /**
     * Voegt een aanval toe aan het gevechtsverslag.
     *
     * @param Character $attacker
     * @param Character $defender
     * @param int $damage
     */
    private function logAttack(Character $attacker, Character $defender, int $damage): void
    {
        $this->battleLog .= "{$attacker->getName()} valt {$defender->getName()} aan en doet {$damage} schade.\n";
    }
}
<form method="post" action="index.php?page=startBattle">
  <div class="mb-3">
    <label for="character1">Character 1:</label>
    <select name="character1" id="character1" class="form-control">
      {foreach from=$characters item=char}
        <option value="{$char->getName()}">{$char->getName()}</option>
      {/foreach}
    </select>
  </div>

  <div class="mb-3">
    <label for="character2">Character 2:</label>
    <select name="character2" id="character2" class="form-control">
      {foreach from=$characters item=char}
        <option value="{$char->getName()}">{$char->getName()}</option>
      {/foreach}
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Start Battle</button>
</form>
<li class="nav-item">
  <a class="nav-link" href="index.php?page=battleForm">Battle Arena</a>
</li>

namespace Game;

class Battle
{
    private Character $fighter1;
    private Character $fighter2;
    private array $selectedAttacks = ['fighter1' => null, 'fighter2' => null];

    public function __construct(Character $fighter1, Character $fighter2)
    {
        $this->fighter1 = $fighter1;
        $this->fighter2 = $fighter2;

        $this->fighter1->resetAttributes();
        $this->fighter2->resetAttributes();
    }

    public function setAttackForFighter(Character $fighter, ?string $attackName): void
    {
        if ($fighter === $this->fighter1) {
            $this->selectedAttacks['fighter1'] = $attackName === 'normal' ? null : $attackName;
        } elseif ($fighter === $this->fighter2) {
            $this->selectedAttacks['fighter2'] = $attackName === 'normal' ? null : $attackName;
        }
    }

    public function executeTurn(): void
    {
        // Fighter 1 aanval
        $this->executeAttack($this->fighter1, $this->fighter2, $this->selectedAttacks['fighter1']);
        // Fighter 2 aanval
        if ($this->fighter2->health > 0) {
            $this->executeAttack($this->fighter2, $this->fighter1, $this->selectedAttacks['fighter2']);
        }
        // Reset na beurt
        $this->fighter1->resetAttributes();
        $this->fighter2->resetAttributes();
        $this->selectedAttacks = ['fighter1' => null, 'fighter2' => null];
    }

    private function executeAttack(Character $attacker, Character $defender, ?string $specialAttack): void
    {
        if ($specialAttack === null) {
            // Normale aanval
            $damage = $attacker->attack - $defender->defense;
            $damage = max(0, $damage);
            $defender->health -= $damage;
            // Log etc.
        } else {
            $message = $attacker->executeSpecialAttack($specialAttack);
            // Log message en pas schade toe als nodig
            // Bijvoorbeeld speciale aanvallen kunnen schade doen, maar dat hangt van je implementatie af
        }
    }

    // Andere methoden blijven hetzelfde
}
<select name="fighter1Attack" {{ fighter1.health <= 0 ? 'disabled' : '' }}>
    <option value="normal" selected>Normal Attack</option>
    {foreach $fighter1->getSpecialAttacks() as $attack}
        <option value="{$attack}">{$attack|capitalize}</option>
    {/foreach}
</select>

<select name="fighter2Attack" {{ fighter2.health <= 0 ? 'disabled' : '' }}>
    <option value="normal" selected>Normal Attack</option>
    {foreach $fighter2->getSpecialAttacks() as $attack}
        <option value="{$attack}">{$attack|capitalize}</option>
    {/foreach}
</select>

<button type="submit">Fight Round</button>
case 'battleRound':
    $fighter1Attack = $_POST['fighter1Attack'] ?? 'normal';
    $fighter2Attack = $_POST['fighter2Attack'] ?? 'normal';

    $battle->setAttackForFighter($battle->getFighter1(), $fighter1Attack);
    $battle->setAttackForFighter($battle->getFighter2(), $fighter2Attack);

    $battle->executeTurn();

    $_SESSION['battle'] = serialize($battle);
    // Redirect of toon resultaat
    break;
